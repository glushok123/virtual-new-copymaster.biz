<?php
	include('./header.php');

	if (!isset($_SESSION['type']) || $_SESSION['type'] != "admin")
	{
		echo '<div class="page-wrapper"><div class="page-content-wrapper"><div class="page-content">ДОСТУП ЗАПРЕЩЕН !!!</div></div></div>';
		exit;
	}

	$calcConfigs = require __DIR__ . '/helpers/titelCalcConfig.php';
	$calcKey = titelCalcKey($calcConfigs, isset($_GET['calc']) ? $_GET['calc'] : '');
	$calc = $calcConfigs[$calcKey];

	function tcEsc($value)
	{
		return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
	}

	function tcPlural($n, $one, $few, $many)
	{
		$n = abs((int)$n) % 100;
		if ($n > 10 && $n < 20) return $many;
		$n %= 10;
		if ($n === 1) return $one;
		if ($n >= 2 && $n <= 4) return $few;
		return $many;
	}

	// ── данные ─────────────────────────────────────────────
	$db = getDbInstance();
	$titles = null;
	$loadError = null;
	$availableCalcs = [];
	try {
		foreach ($calcConfigs as $key => $config) {
			if ($db->tableExists($config['table'])) {
				$availableCalcs[$key] = $config['label'];
			}
		}
		if (isset($availableCalcs[$calcKey])) {
			$titles = [];
			foreach ($db->orderBy('name', 'ASC')->get($calc['table'], null, ['name', 'titel']) as $row) {
				$titles[(string)$row['name']] = (string)$row['titel'];
			}
			ksort($titles, SORT_STRING);
		} else {
			$loadError = 'missing';
		}
	} catch (Exception $e) {
		$loadError = 'db';
	}

	// ── дерево: родитель = id без последнего символа, при пропуске — ближайший существующий предок ──
	$sections = [];
	foreach (titelCalcSections() as $key => $section) {
		$sections[$key] = $section + ['hidden' => in_array($key, $calc['hiddenSections'], true)];
	}
	$sections['other'] = ['title' => 'Прочие ключи', 'icon' => 'bx-hash', 'hidden' => false];
	foreach ($sections as $key => $section) {
		$sections[$key]['roots'] = [];
		$sections[$key]['count'] = 0;
	}

	$nodes = [];
	$scriptIds = titelCalcScriptIds(__DIR__ . '/' . $calc['script']);
	if ($titles) {
		foreach ($titles as $id => $titel) {
			$id = (string)$id;
			$chars = titelCalcChars($id);
			$parent = null;
			for ($len = count($chars) - 1; $len > 0; $len--) {
				$candidate = implode('', array_slice($chars, 0, $len));
				if (isset($nodes[$candidate])) {
					$parent = $candidate;
					break;
				}
			}
			$first = $chars ? $chars[0] : '';
			$section = ($first !== '' && $first !== 'other' && isset($sections[$first])) ? $first : 'other';
			$direct = count($chars) > 2 ? implode('', array_slice($chars, 0, -1)) : null;
			$hiddenNote = titelCalcHiddenNote($id, $calc['hidden']);
			$unused = $scriptIds !== null && !isset($scriptIds[$id]);

			$nodes[$id] = [
				'titel' => $titel,
				'parent' => $parent,
				'gap' => ($direct !== null && $parent !== $direct) ? $direct : null,
				'section' => $section,
				'hiddenNote' => $hiddenNote,
				'unused' => $unused,
				'inactive' => $unused || $hiddenNote !== null,
				'children' => [],
			];
			if ($parent === null) {
				$sections[$section]['roots'][] = $id;
			} else {
				$nodes[$parent]['children'][] = $id;
			}
			$sections[$section]['count']++;
		}

		// «Глубоко неактивный» узел — неактивен сам и все его потомки; только такие можно прятать.
		foreach (array_reverse(array_keys($nodes)) as $id) {
			$deep = $nodes[$id]['inactive'];
			foreach ($nodes[$id]['children'] as $child) {
				$deep = $deep && $nodes[$child]['deep'];
			}
			$nodes[$id]['deep'] = $deep;
		}
	}

	$inactiveCount = 0;
	foreach ($nodes as $node) {
		if ($node['deep']) $inactiveCount++;
	}
	if ($sections['other']['count'] === 0) {
		unset($sections['other']);
	}

	function tcRows($id, $depth, array $nodes, $calc)
	{
		$n = $nodes[$id];
		$kids = count($n['children']);
		$attrs = ' data-id="' . tcEsc($id) . '" data-parent="' . tcEsc($n['parent']) . '" style="--d:' . $depth . '"';
		if ($n['deep']) $attrs .= ' data-deep="1"';
		if ($n['unused']) $attrs .= ' data-unused="1"';
		if ($n['gap'] !== null) $attrs .= ' data-gap="' . tcEsc($n['gap']) . '"';

		$html = '<div class="tc-row' . ($n['inactive'] ? ' is-inactive' : '') . '"' . $attrs . '>';
		$html .= $kids
			? '<button type="button" class="tc-caret" tabindex="-1" aria-expanded="false" aria-label="Развернуть или свернуть"><i class="bx bx-chevron-right"></i></button>'
			: '<span class="tc-caret is-leaf" aria-hidden="true"></span>';
		$html .= '<span class="tc-id">' . tcEsc($id) . '</span>';
		$html .= '<input class="tc-input" type="text" maxlength="1000" autocomplete="off"'
			. ' data-orig="' . tcEsc($n['titel']) . '" value="' . tcEsc($n['titel']) . '" aria-label="Название ' . tcEsc($id) . '">';
		$html .= '<span class="tc-meta">';
		if ($kids) {
			$html .= '<em class="tc-kids" title="Вложенных пунктов: ' . $kids . '">' . $kids . '</em>';
		}
		if ($n['gap'] !== null) {
			$html .= '<span class="tc-tag tc-tag-gap" title="Строки «' . tcEsc($n['gap']) . '» нет в таблице — калькулятор берёт это название из своего кода">нет ' . tcEsc($n['gap']) . '</span>';
		}
		if ($n['hiddenNote'] !== null) {
			$html .= '<span class="tc-tag tc-tag-hidden" title="Ветка скрыта в калькуляторе, код сохранён">скрыто · ' . tcEsc($n['hiddenNote']) . '</span>';
		} elseif ($n['unused']) {
			$html .= '<span class="tc-tag tc-tag-unused" title="Ключ не встречается в ' . tcEsc($calc['script']) . ' — калькулятор его не показывает">не используется</span>';
		}
		$html .= '</span></div>';

		foreach ($n['children'] as $child) {
			$html .= tcRows($child, $depth + 1, $nodes, $calc);
		}
		return $html;
	}

	$total = count($nodes);
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

<style>
	.tc, .tc-bar {
		--tc-surface: rgba(10, 14, 24, .42);
		--tc-surface-hi: rgba(255, 255, 255, .055);
		--tc-line: rgba(255, 255, 255, .09);
		--tc-guide: rgba(255, 255, 255, .1);
		--tc-text: #eef2f7;
		--tc-muted: rgba(226, 232, 240, .56);
		--tc-accent: #5eead4;
		--tc-accent-ink: #062a26;
		--tc-dirty: #fbbf24;
		--tc-bad: #fb7185;
		--tc-radius: 14px;
		--tc-step: 22px;
		font-family: 'Onest', 'Segoe UI', Tahoma, sans-serif;
		color: var(--tc-text);
	}
	.tc {
		max-width: 1180px;
		margin: 0 auto;
		padding-bottom: 110px;
	}
	.tc *, .tc *::before, .tc *::after, .tc-bar * { box-sizing: border-box; }

	/* ── шапка ─────────────────────────────── */
	.tc-head {
		display: flex;
		flex-wrap: wrap;
		align-items: flex-end;
		justify-content: space-between;
		gap: 18px 32px;
		margin-bottom: 22px;
		animation: tc-rise .45s ease both;
	}
	.tc-head-main { min-width: 0; max-width: 640px; }
	.tc-eyebrow {
		display: inline-block;
		font-size: 11px;
		font-weight: 600;
		letter-spacing: .14em;
		text-transform: uppercase;
		color: var(--tc-accent);
	}
	.tc-switch { display: inline-flex; gap: 4px; padding: 3px; border: 1px solid var(--tc-line); border-radius: 999px; }
	.tc-switch a {
		padding: 3px 10px;
		border-radius: 999px;
		color: var(--tc-muted);
		font-size: 11px;
		font-weight: 600;
		letter-spacing: .1em;
		text-transform: uppercase;
		text-decoration: none;
	}
	.tc-switch a:hover { color: var(--tc-text); }
	.tc-switch a.is-active { background: var(--tc-accent); color: var(--tc-accent-ink); }
	.tc-head h1 {
		margin: 4px 0 6px;
		font-family: inherit;
		font-size: clamp(28px, 3.2vw, 40px);
		font-weight: 700;
		letter-spacing: -.02em;
		line-height: 1.05;
		color: var(--tc-text);
	}
	.tc-head p { margin: 0; color: var(--tc-muted); font-size: 14px; line-height: 1.45; }
	.tc-head p q { quotes: '«' '»'; color: var(--tc-text); }

	.tc-stats { display: flex; gap: 8px; flex-wrap: wrap; }
	.tc-chip {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		height: 34px;
		padding: 0 14px;
		border: 1px solid var(--tc-line);
		border-radius: 999px;
		background: var(--tc-surface-hi);
		color: var(--tc-muted);
		font: 500 13px/1 'Onest', sans-serif;
		cursor: pointer;
		transition: background .15s, color .15s, border-color .15s;
	}
	.tc-chip b { color: var(--tc-text); font-weight: 600; font-variant-numeric: tabular-nums; }
	.tc-chip i { font-size: 16px; }
	.tc-chip:hover { color: var(--tc-text); border-color: rgba(255, 255, 255, .22); }
	.tc-chip.is-active { background: var(--tc-accent); border-color: var(--tc-accent); color: var(--tc-accent-ink); }
	.tc-chip.is-active b { color: var(--tc-accent-ink); }
	.tc-chip:focus-visible { outline: 2px solid var(--tc-accent); outline-offset: 2px; }
	.tc-chip[data-filter="dirty"] .tc-dot { background: var(--tc-dirty); }
	.tc-chip[data-filter="empty"] .tc-dot { background: var(--tc-bad); }
	.tc-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--tc-accent); }
	.tc-chip-toggle { border-style: dashed; }
	.tc-chip-toggle.is-on { border-style: solid; color: var(--tc-text); background: rgba(255, 255, 255, .1); }

	/* ── панель поиска, вкладок и превью ───── */
	.tc-toolbar {
		position: sticky;
		top: 70px;
		z-index: 9;
		margin: 0 -12px 22px;
		padding: 12px;
		border-radius: calc(var(--tc-radius) + 4px);
		background: rgba(35, 43, 54, .86);
		backdrop-filter: blur(14px);
		-webkit-backdrop-filter: blur(14px);
		border: 1px solid var(--tc-line);
		box-shadow: 0 12px 30px -18px rgba(0, 0, 0, .7);
		animation: tc-rise .45s .05s ease both;
	}
	.tc-search { position: relative; display: block; margin: 0 0 10px; }
	.tc-search > i {
		position: absolute;
		left: 16px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 20px;
		color: var(--tc-muted);
		pointer-events: none;
	}
	.tc-search input {
		width: 100%;
		height: 48px;
		padding: 0 92px 0 48px;
		border: 1px solid var(--tc-line);
		border-radius: 12px;
		background: rgba(0, 0, 0, .22);
		color: var(--tc-text);
		font: 500 15px 'Onest', sans-serif;
		outline: none;
		transition: border-color .15s, box-shadow .15s;
	}
	.tc-search input::placeholder { color: rgba(226, 232, 240, .38); }
	.tc-search input:focus { border-color: var(--tc-accent); box-shadow: 0 0 0 3px rgba(94, 234, 212, .16); }
	.tc-search input::-webkit-search-cancel-button { display: none; }
	.tc-search-aside {
		position: absolute;
		right: 10px;
		top: 50%;
		transform: translateY(-50%);
		display: flex;
		align-items: center;
		gap: 6px;
	}
	.tc-kbd {
		display: inline-grid;
		place-items: center;
		min-width: 24px;
		height: 24px;
		padding: 0 6px;
		border: 1px solid var(--tc-line);
		border-bottom-width: 2px;
		border-radius: 6px;
		color: var(--tc-muted);
		font: 600 11px 'JetBrains Mono', monospace;
	}
	.tc-clear {
		display: none;
		width: 30px;
		height: 30px;
		border: 0;
		border-radius: 8px;
		background: var(--tc-surface-hi);
		color: var(--tc-text);
		font-size: 18px;
		line-height: 1;
		cursor: pointer;
	}
	.tc.is-searching .tc-clear { display: inline-grid; place-items: center; }
	.tc.is-searching .tc-search .tc-kbd { display: none; }

	.tc-tabs { display: flex; gap: 6px; overflow-x: auto; scrollbar-width: none; }
	.tc-tabs::-webkit-scrollbar { display: none; }
	.tc-tab {
		position: relative;
		flex: 1 0 auto;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 9px;
		height: 44px;
		padding: 0 16px;
		border: 1px solid transparent;
		border-radius: 10px;
		background: transparent;
		color: var(--tc-muted);
		font: 600 15px 'Onest', sans-serif;
		white-space: nowrap;
		cursor: pointer;
		transition: background .15s, color .15s;
	}
	.tc-tab i { font-size: 20px; }
	.tc-tab:hover { color: var(--tc-text); background: var(--tc-surface-hi); }
	.tc-tab:focus-visible { outline: 2px solid var(--tc-accent); outline-offset: -2px; }
	.tc-tab.is-active { color: var(--tc-accent-ink); background: var(--tc-accent); }
	.tc-tab-count {
		min-width: 24px;
		padding: 2px 7px;
		border-radius: 999px;
		background: rgba(255, 255, 255, .08);
		font: 600 11px/1.4 'JetBrains Mono', monospace;
		font-style: normal;
	}
	.tc-tab.is-active .tc-tab-count { background: rgba(6, 42, 38, .16); }
	.tc-tab-flag {
		padding: 2px 7px;
		border: 1px dashed currentColor;
		border-radius: 999px;
		font: 600 10px/1.3 'Onest', sans-serif;
		letter-spacing: .02em;
		opacity: .8;
	}
	.tc.is-results .tc-tab.is-active { color: var(--tc-text); background: var(--tc-surface-hi); }
	.tc.is-results .tc-tab.is-active .tc-tab-count { background: rgba(255, 255, 255, .08); }
	.tc-tab.is-nomatch { opacity: .4; }
	.tc-tab-dirty {
		position: absolute;
		top: 7px;
		right: 7px;
		width: 8px;
		height: 8px;
		border-radius: 50%;
		background: var(--tc-dirty);
		box-shadow: 0 0 0 2px rgba(35, 43, 54, .9);
		display: none;
	}
	.tc-tab.has-dirty .tc-tab-dirty { display: block; }

	.tc-preview {
		display: flex;
		align-items: baseline;
		gap: 10px;
		min-height: 40px;
		margin-top: 10px;
		padding: 9px 14px;
		border-radius: 10px;
		background: rgba(0, 0, 0, .2);
		font-size: 14px;
		line-height: 1.45;
	}
	.tc-preview-label {
		flex: 0 0 auto;
		display: inline-flex;
		align-items: center;
		gap: 6px;
		color: var(--tc-accent);
		font-size: 11px;
		font-weight: 600;
		letter-spacing: .12em;
		text-transform: uppercase;
		align-self: center;
	}
	.tc-preview-label i { font-size: 16px; }
	.tc-preview-id {
		flex: 0 0 auto;
		color: var(--tc-muted);
		font: 600 12px 'JetBrains Mono', monospace;
	}
	.tc-preview-text { min-width: 0; flex: 1; color: var(--tc-muted); overflow-wrap: anywhere; }
	.tc-preview-text mark {
		padding: 0 3px;
		border-radius: 4px;
		background: rgba(94, 234, 212, .16);
		color: var(--tc-text);
		font-weight: 600;
	}
	.tc-preview-text .tc-pv-anc { color: rgba(238, 242, 247, .82); }
	.tc-preview-text .tc-pv-gap { color: var(--tc-muted); font-family: 'JetBrains Mono', monospace; font-size: 12px; }
	.tc-preview-text .tc-pv-empty { color: var(--tc-bad); font-style: italic; }
	.tc-preview-note { flex: 0 0 auto; color: var(--tc-dirty); font-size: 12px; }
	.tc-preview.is-idle .tc-preview-text { font-style: italic; color: rgba(226, 232, 240, .42); }

	/* ── разделы ───────────────────────────── */
	.tc-panel { display: none; }
	.tc-panel.is-active { display: block; animation: tc-fade .25s ease both; }
	.tc.is-results .tc-panel { display: block; animation: none; }
	.tc.is-results .tc-panel.is-nomatch { display: none; }
	.tc.is-results .tc-panel + .tc-panel { margin-top: 22px; }

	.tc-panel-head {
		display: flex;
		flex-wrap: wrap;
		align-items: center;
		gap: 6px 14px;
		margin: 0 0 10px;
		padding: 0 4px;
	}
	.tc-panel-head h2 {
		margin: 0;
		font: 700 13px 'Onest', sans-serif;
		letter-spacing: .12em;
		text-transform: uppercase;
		color: var(--tc-muted);
	}
	.tc-panel-note { color: var(--tc-muted); font-size: 13px; }
	.tc-panel-note.is-warn { color: var(--tc-dirty); }
	.tc-panel-actions { display: flex; gap: 6px; margin-left: auto; }
	.tc.is-results .tc-panel-actions, .tc.is-results .tc-panel-note.is-summary { display: none; }
	.tc-mini {
		display: inline-flex;
		align-items: center;
		gap: 6px;
		height: 30px;
		padding: 0 11px;
		border: 1px solid var(--tc-line);
		border-radius: 8px;
		background: transparent;
		color: var(--tc-muted);
		font: 500 13px 'Onest', sans-serif;
		cursor: pointer;
	}
	.tc-mini i { font-size: 16px; }
	.tc-mini:hover { color: var(--tc-text); background: var(--tc-surface-hi); }

	.tc-tree {
		padding: 6px 6px 6px 0;
		border: 1px solid var(--tc-line);
		border-radius: var(--tc-radius);
		background: var(--tc-surface);
	}

	/* строка дерева */
	.tc-row {
		position: relative;
		isolation: isolate;
		display: flex;
		align-items: center;
		gap: 8px;
		min-height: 42px;
		padding: 3px 6px 3px calc(8px + var(--d) * var(--tc-step));
	}
	.tc-row::before {
		content: '';
		position: absolute;
		left: 8px;
		top: 0;
		bottom: 0;
		width: calc(var(--d) * var(--tc-step));
		background: repeating-linear-gradient(to right,
			transparent 0, transparent calc(var(--tc-step) / 2 + 2px),
			var(--tc-guide) calc(var(--tc-step) / 2 + 2px), var(--tc-guide) calc(var(--tc-step) / 2 + 3px),
			transparent calc(var(--tc-step) / 2 + 3px), transparent var(--tc-step));
		pointer-events: none;
	}
	.tc-row::after {
		content: '';
		position: absolute;
		z-index: -1;
		top: 1px;
		bottom: 1px;
		left: calc(4px + var(--d) * var(--tc-step));
		right: 0;
		border-radius: 9px;
		transition: background .12s;
	}
	.tc-row:hover::after, .tc-row:focus-within::after { background: var(--tc-surface-hi); }
	.tc-row.is-current::after { background: rgba(94, 234, 212, .07); }

	.tc-caret {
		flex: 0 0 26px;
		display: inline-grid;
		place-items: center;
		width: 26px;
		height: 26px;
		padding: 0;
		border: 0;
		border-radius: 7px;
		background: transparent;
		color: var(--tc-muted);
		cursor: pointer;
	}
	.tc-caret i { font-size: 20px; transition: transform .15s; }
	.tc-caret:hover { background: rgba(255, 255, 255, .08); color: var(--tc-text); }
	.tc-caret.is-open i { transform: rotate(90deg); }
	.tc-caret.is-partial i { color: var(--tc-accent); }
	.tc-caret.is-leaf { cursor: default; position: relative; }
	.tc-caret.is-leaf::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: rgba(255, 255, 255, .22); }
	.tc-caret.is-leaf:hover, .tc-caret.is-void:hover { background: transparent; }
	.tc-caret.is-void { cursor: default; }
	.tc-caret.is-void i { display: none; }
	.tc-caret.is-void::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: rgba(255, 255, 255, .22); }

	.tc-id {
		flex: 0 0 64px;
		overflow: hidden;
		color: var(--tc-muted);
		font: 600 12px 'JetBrains Mono', monospace;
		letter-spacing: .02em;
		text-overflow: ellipsis;
		white-space: nowrap;
		cursor: default;
	}
	.tc-row:has(> button.tc-caret:not(.is-void)) .tc-id { cursor: pointer; }

	.tc-input {
		flex: 1 1 auto;
		min-width: 0;
		height: 36px;
		padding: 0 11px;
		border: 1px solid transparent;
		border-radius: 8px;
		background: rgba(0, 0, 0, .2);
		color: var(--tc-text);
		font: 500 14.5px 'Onest', sans-serif;
		outline: none;
		transition: border-color .12s, background .12s, box-shadow .12s;
	}
	.tc-input:hover { border-color: rgba(255, 255, 255, .16); }
	.tc-input:focus { border-color: var(--tc-accent); background: rgba(0, 0, 0, .34); box-shadow: 0 0 0 3px rgba(94, 234, 212, .15); }
	.tc-input.is-empty { background: repeating-linear-gradient(135deg, rgba(251, 113, 133, .08) 0 6px, transparent 6px 12px), rgba(0, 0, 0, .2); }
	.tc-input.is-dirty { border-color: rgba(251, 191, 36, .75); background: rgba(251, 191, 36, .12); color: #fff3cd; }
	.tc-input.is-invalid, .tc-input.is-rejected { border-color: var(--tc-bad); background: rgba(251, 113, 133, .14); color: #ffe0e5; }
	.tc-input.is-saved { animation: tc-saved 1.1s ease; }

	.tc-meta { flex: 0 0 auto; display: flex; align-items: center; gap: 6px; }
	.tc-kids {
		min-width: 24px;
		padding: 2px 7px;
		border-radius: 999px;
		background: rgba(255, 255, 255, .07);
		color: var(--tc-muted);
		font: 600 11px/1.4 'JetBrains Mono', monospace;
		font-style: normal;
		text-align: center;
	}
	.tc-caret.is-open ~ .tc-meta .tc-kids { opacity: .45; }
	.tc-tag {
		padding: 2px 8px;
		border: 1px dashed rgba(255, 255, 255, .2);
		border-radius: 999px;
		color: var(--tc-muted);
		font-size: 11.5px;
		line-height: 1.35;
		white-space: nowrap;
		cursor: help;
	}
	.tc-tag-gap { border-color: rgba(251, 191, 36, .35); color: rgba(251, 191, 36, .85); }

	.tc-row.is-inactive .tc-input:not(:focus):not(.is-dirty) { color: rgba(238, 242, 247, .55); background: rgba(0, 0, 0, .12); }
	.tc-row.is-inactive .tc-id { opacity: .6; }
	.tc-row.is-context .tc-input:not(:focus):not(.is-dirty) { color: rgba(238, 242, 247, .62); }
	.tc-row.is-context .tc-id { opacity: .55; }

	.tc-empty {
		padding: 56px 20px;
		border: 1px dashed var(--tc-line);
		border-radius: var(--tc-radius);
		text-align: center;
		color: var(--tc-muted);
	}
	.tc-empty i { display: block; margin-bottom: 8px; font-size: 34px; }
	.tc-empty code { color: var(--tc-accent); font-family: 'JetBrains Mono', monospace; }
	.tc-hint {
		margin: -8px 0 16px;
		color: var(--tc-muted);
		font-size: 13px;
		text-align: center;
	}
	.tc-link {
		padding: 0;
		border: 0;
		background: none;
		color: var(--tc-accent);
		font: inherit;
		text-decoration: underline;
		text-underline-offset: 3px;
		cursor: pointer;
	}

	/* ── нижняя панель сохранения ──────────── */
	.tc-bar {
		position: fixed;
		left: 50%;
		bottom: 22px;
		z-index: 20;
		display: flex;
		align-items: center;
		gap: 10px;
		max-width: calc(100vw - 32px);
		padding: 8px 8px 8px 20px;
		border: 1px solid rgba(251, 191, 36, .35);
		border-radius: 16px;
		background: rgba(22, 27, 36, .94);
		backdrop-filter: blur(14px);
		-webkit-backdrop-filter: blur(14px);
		box-shadow: 0 18px 50px -12px rgba(0, 0, 0, .8);
		transform: translate(-50%, 140%);
		opacity: 0;
		pointer-events: none;
		transition: transform .28s cubic-bezier(.2, .9, .3, 1.2), opacity .2s;
	}
	.tc-bar.is-visible { transform: translate(-50%, 0); opacity: 1; pointer-events: auto; }
	.tc-bar-text { font-size: 14px; white-space: nowrap; }
	.tc-bar-text b { color: var(--tc-dirty); font-variant-numeric: tabular-nums; }
	.tc-bar-text .tc-bar-bad { margin-left: 8px; color: var(--tc-bad); }
	.tc-btn {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		height: 42px;
		padding: 0 18px;
		border: 1px solid var(--tc-line);
		border-radius: 11px;
		background: transparent;
		color: var(--tc-text);
		font: 600 14px 'Onest', sans-serif;
		white-space: nowrap;
		cursor: pointer;
		transition: background .15s, transform .1s;
	}
	.tc-btn:hover { background: var(--tc-surface-hi); }
	.tc-btn:active { transform: translateY(1px); }
	.tc-btn:disabled { opacity: .55; cursor: default; }
	.tc-btn-primary { border-color: var(--tc-accent); background: var(--tc-accent); color: var(--tc-accent-ink); }
	.tc-btn-primary:hover { background: #7ff0dd; }
	.tc-btn-primary .tc-kbd { border-color: rgba(6, 42, 38, .25); color: rgba(6, 42, 38, .7); }

	@keyframes tc-rise { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }
	@keyframes tc-fade { from { opacity: 0; } to { opacity: 1; } }
	@keyframes tc-saved { 0% { box-shadow: 0 0 0 0 rgba(94, 234, 212, .7); border-color: var(--tc-accent); } 100% { box-shadow: 0 0 0 10px rgba(94, 234, 212, 0); } }

	@media (max-width: 767px) {
		.page-content { padding: 16px; }
		.tc, .tc-bar { --tc-step: 14px; }
		.tc-toolbar { margin: 0 -6px 16px; padding: 8px; }
		.tc-tab { flex: 0 0 auto; padding: 0 12px; }
		.tc-tab span { font-size: 14px; }
		.tc-tab-long { display: none; }
		.tc-search input { font-size: 14px; }
		.tc-search .tc-kbd { display: none; }
		.tc-preview { flex-wrap: wrap; gap: 2px 8px; padding: 7px 10px; font-size: 13px; }
		.tc-preview-text { flex-basis: 100%; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
		.tc-preview.is-idle .tc-preview-text { -webkit-line-clamp: 1; }
		.tc-tree { padding: 4px 4px 4px 0; }
		.tc-row { flex-wrap: wrap; gap: 2px 6px; padding: 5px 4px 5px calc(4px + var(--d) * var(--tc-step)); }
		.tc-row::before { left: 4px; }
		.tc-row::after { left: calc(2px + var(--d) * var(--tc-step)); }
		.tc-id { flex: 1 1 auto; }
		.tc-input { order: 3; flex: 1 1 100%; margin-left: 0; }
		.tc-tag { font-size: 11px; }
		.tc-panel-actions { margin-left: 0; }
		.tc-bar { left: 16px; right: 16px; bottom: 12px; max-width: none; transform: translateY(140%); padding-left: 14px; }
		.tc-bar.is-visible { transform: none; }
		.tc-bar-text { flex: 1; white-space: normal; font-size: 13px; }
		.tc-btn { padding: 0 12px; }
		.tc-btn .tc-kbd, .tc-btn-label-long { display: none; }
	}
	@media (prefers-reduced-motion: reduce) {
		.tc *, .tc-bar { animation: none !important; transition: none !important; }
	}
</style>

		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="tc" id="tc" data-calc="<?= tcEsc($calcKey) ?>">

						<div class="tc-head">
							<div class="tc-head-main">
								<?php if (count($availableCalcs) > 1): ?>
									<nav class="tc-switch" aria-label="Калькулятор">
										<?php foreach ($availableCalcs as $key => $label): ?>
											<a href="?calc=<?= tcEsc($key) ?>" class="<?= $key === $calcKey ? 'is-active' : '' ?>"><?= tcEsc($label) ?></a>
										<?php endforeach; ?>
									</nav>
								<?php else: ?>
									<span class="tc-eyebrow"><?= tcEsc($calc['label']) ?></span>
								<?php endif; ?>
								<h1>Названия позиций</h1>
								<p>Строка в чеке складывается из названий по пути дерева: <q>Печать односторонней визитки</q> + <q>(Не Срочное изготовление)</q> + <q>100 шт</q>. Калькулятор подхватит изменения после обновления его страницы.</p>
							</div>
							<?php if ($titles): ?>
								<div class="tc-stats" role="group" aria-label="Фильтр названий">
									<button type="button" class="tc-chip is-active" data-filter="all"><span class="tc-dot"></span>Все <b><?= $total ?></b></button>
									<button type="button" class="tc-chip" data-filter="empty"><span class="tc-dot"></span>Пустые <b id="tcEmptyCount">0</b></button>
									<button type="button" class="tc-chip" data-filter="dirty"><span class="tc-dot"></span>Изменённые <b id="tcDirtyChip">0</b></button>
									<?php if ($inactiveCount > 0): ?>
										<button type="button" class="tc-chip tc-chip-toggle" id="tcInactive" aria-pressed="false"
											title="Названия, которые калькулятор сейчас не показывает: скрытые ветки кода и ключи, которых нет в <?= tcEsc($calc['script']) ?>">
											<i class="bx bx-hide"></i><span>Неактивные</span> <b><?= $inactiveCount ?></b>
										</button>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>

						<?php if ($loadError === 'missing'): ?>
							<div class="tc-empty">
								<i class="bx bx-data"></i>
								Для «<?= tcEsc($calc['label']) ?>» ещё нет таблицы названий <code><?= tcEsc($calc['table']) ?></code>.<br>
								Создайте её со столбцами <code>id</code>, <code>name</code>, <code>titel</code> — и названия появятся здесь.
							</div>
						<?php elseif ($loadError === 'db'): ?>
							<div class="tc-empty">
								<i class="bx bx-error-circle"></i>
								Не удалось прочитать таблицу <code><?= tcEsc($calc['table']) ?></code>. Обновите страницу или попробуйте позже.
							</div>
						<?php elseif (!$titles): ?>
							<div class="tc-empty">
								<i class="bx bx-folder-open"></i>
								Таблица <code><?= tcEsc($calc['table']) ?></code> пока пустая.
							</div>
						<?php else: ?>

						<div class="tc-toolbar">
							<label class="tc-search">
								<i class="bx bx-search"></i>
								<input id="tcSearch" type="search" placeholder="Название или id: «визитки срочно», «А4», «dca»…" autocomplete="off">
								<span class="tc-search-aside">
									<button type="button" class="tc-clear" id="tcClear" aria-label="Очистить поиск">×</button>
									<span class="tc-kbd">/</span>
								</span>
							</label>

							<nav class="tc-tabs" role="tablist">
								<?php foreach ($sections as $key => $section): ?>
									<button type="button" class="tc-tab" role="tab" data-tab="<?= tcEsc($key) ?>">
										<i class="bx <?= tcEsc($section['icon']) ?>"></i>
										<span><?= tcEsc($section['title']) ?></span>
										<em class="tc-tab-count"><?= $section['count'] ?></em>
										<?php if ($section['hidden']): ?>
											<small class="tc-tab-flag" title="Раздел скрыт в калькуляторе">скрыт<span class="tc-tab-long"> в калькуляторе</span></small>
										<?php endif; ?>
										<b class="tc-tab-dirty"></b>
									</button>
								<?php endforeach; ?>
							</nav>

							<div class="tc-preview is-idle" id="tcPreview" aria-live="polite">
								<span class="tc-preview-label"><i class="bx bx-receipt"></i>В чеке</span>
								<span class="tc-preview-id" id="tcPreviewId"></span>
								<span class="tc-preview-text" id="tcPreviewText">Наведите на строку или начните редактировать — здесь появится полное название, как в чеке.</span>
								<span class="tc-preview-note" id="tcPreviewNote"></span>
							</div>
						</div>

						<div class="tc-empty" id="tcEmpty" hidden>
							<i class="bx bx-search-alt"></i>
							Ничего не найдено. Попробуйте другое слово или сбросьте фильтр.
						</div>
						<p class="tc-hint" id="tcHiddenHint" hidden></p>

						<div id="tcPanels">
							<?php foreach ($sections as $key => $section): ?>
								<section class="tc-panel" role="tabpanel" data-panel="<?= tcEsc($key) ?>">
									<header class="tc-panel-head">
										<h2><?= tcEsc($section['title']) ?></h2>
										<span class="tc-panel-note is-summary"><?= $section['count'] ?> <?= tcPlural($section['count'], 'название', 'названия', 'названий') ?></span>
										<?php if ($section['hidden']): ?>
											<span class="tc-panel-note is-warn"><i class="bx bx-hide"></i> Раздел скрыт в калькуляторе — названия хранятся на случай, если его вернут</span>
										<?php endif; ?>
										<div class="tc-panel-actions">
											<button type="button" class="tc-mini" data-act="expand"><i class="bx bx-chevrons-down"></i>Развернуть всё</button>
											<button type="button" class="tc-mini" data-act="collapse"><i class="bx bx-chevrons-up"></i>Свернуть</button>
										</div>
									</header>
									<div class="tc-tree">
										<?php foreach ($section['roots'] as $rootId): ?>
											<?= tcRows($rootId, 0, $nodes, $calc) ?>
										<?php endforeach; ?>
									</div>
								</section>
							<?php endforeach; ?>
						</div>

						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php if ($titles): ?>
	<div class="tc-bar" id="tcBar" role="region" aria-live="polite">
		<span class="tc-bar-text">Не сохранено: <b id="tcDirtyCount">0</b><span class="tc-bar-bad" id="tcBadText" hidden></span></span>
		<button type="button" class="tc-btn" id="tcReset">Отменить<span class="tc-btn-label-long"> всё</span></button>
		<button type="button" class="tc-btn tc-btn-primary" id="tcSave">Сохранить <span class="tc-kbd">Ctrl S</span></button>
	</div>
	<?php endif; ?>

	<!--end switcher-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="assets/js/index.js"></script>
	<!-- App JS -->
	<script src="assets/js/app.js"></script>

<?php if ($titles): ?>
<script>
(function () {
	var root = document.getElementById('tc');
	var CALC = root.getAttribute('data-calc');
	var searchInput = document.getElementById('tcSearch');
	var tabs = Array.prototype.slice.call(root.querySelectorAll('.tc-tab'));
	var panels = Array.prototype.slice.call(root.querySelectorAll('.tc-panel'));
	var chips = Array.prototype.slice.call(root.querySelectorAll('.tc-chip[data-filter]'));
	var inactiveChip = document.getElementById('tcInactive');
	var bar = document.getElementById('tcBar');
	var saveBtn = document.getElementById('tcSave');
	var preview = {
		box: document.getElementById('tcPreview'),
		id: document.getElementById('tcPreviewId'),
		text: document.getElementById('tcPreviewText'),
		note: document.getElementById('tcPreviewNote'),
		idle: document.getElementById('tcPreviewText').textContent
	};
	var filter = 'all';
	var saving = false;
	var BAD_CHARS = /["\\<>\u0000-\u001f\u007f]/;

	// ── состояние в браузере (раскрытые ветки, показ неактивных) ──
	function load(key, fallback) {
		try {
			var raw = localStorage.getItem('tc:' + CALC + ':' + key);
			return raw === null ? fallback : JSON.parse(raw);
		} catch (e) { return fallback; }
	}
	function store(key, value) {
		try { localStorage.setItem('tc:' + CALC + ':' + key, JSON.stringify(value)); } catch (e) {}
	}

	// ── модель дерева ──
	var nodes = {}, order = [];
	Array.prototype.slice.call(root.querySelectorAll('.tc-row')).forEach(function (el) {
		var node = {
			id: el.getAttribute('data-id'),
			el: el,
			input: el.querySelector('.tc-input'),
			caret: el.querySelector('button.tc-caret'),
			kids: el.querySelector('.tc-kids'),
			parent: null,
			children: [],
			deep: el.hasAttribute('data-deep'),
			unused: el.hasAttribute('data-unused'),
			gap: el.getAttribute('data-gap'),
			panel: el.closest('.tc-panel').getAttribute('data-panel')
		};
		nodes[node.id] = node;
		order.push(node);
	});
	order.forEach(function (node) {
		var parent = nodes[node.el.getAttribute('data-parent')];
		if (parent) {
			node.parent = parent;
			parent.children.push(node);
		}
	});
	var inputs = order.map(function (node) { return node.input; });
	function nodeOf(el) {
		var row = el.closest ? el.closest('.tc-row') : null;
		return row ? nodes[row.getAttribute('data-id')] : null;
	}

	var open = load('open', null);
	if (!open || typeof open !== 'object') {
		open = {};
		order.forEach(function (node) { if (!node.parent && node.children.length) open[node.id] = true; });
	}
	var searchOpen = {};
	var showInactive = !!load('inactive', false);

	// Кириллица и латиница в названиях перемешаны (А4 / A4) — сравниваем в одном алфавите.
	var LOOKALIKE = { 'а': 'a', 'в': 'b', 'е': 'e', 'ё': 'e', 'к': 'k', 'м': 'm', 'н': 'h', 'о': 'o', 'р': 'p', 'с': 'c', 'т': 't', 'у': 'y', 'х': 'x', '×': 'x', '–': '-', '—': '-' };
	function normalize(text) {
		return String(text).toLowerCase()
			.replace(/[авеёкмнорстух×–—]/g, function (ch) { return LOOKALIKE[ch]; })
			.replace(/[\u00a0\u202f]/g, ' ')
			.replace(/\s+/g, ' ')
			.trim();
	}
	function parseWords() {
		return searchInput.value.toLowerCase().split(/\s+/).filter(Boolean).map(function (raw) {
			var norm = normalize(raw);
			// Отбрасываем окончание длинных слов: «визитки» найдёт «визиток», «срочно» — «срочное».
			return {
				norm: norm.length > 5 ? norm.slice(0, norm.length - 2) : norm,
				// Похоже на id (есть латиница, других знаков нет) — ищем ещё и по началу id.
				id: /[a-z]/.test(raw) && /^[a-z0-9_а-яё]+$/.test(raw) ? norm : null
			};
		});
	}

	function cleanValue(value) { return String(value).trim(); }
	function isDirty(input) { return cleanValue(input.value) !== cleanValue(input.getAttribute('data-orig')); }
	function isInvalid(input) {
		var value = cleanValue(input.value);
		return BAD_CHARS.test(value) || value.length > 1000;
	}

	// Узел найден, если все слова есть в полном названии (путь + своё), и хотя бы одно — в своём названии или id.
	function matches(node, words) {
		if (filter === 'dirty' && !isDirty(node.input)) return false;
		if (filter === 'empty' && cleanValue(node.input.value) !== '') return false;
		if (!words.length) return true;
		var own = normalize(node.input.value), path = null, ownHit = false;
		for (var i = 0; i < words.length; i++) {
			var w = words[i];
			if ((w.id && normalize(node.id).indexOf(w.id) === 0) || own.indexOf(w.norm) !== -1) {
				ownHit = true;
				continue;
			}
			if (path === null) {
				var parts = [];
				for (var p = node.parent; p; p = p.parent) parts.push(p.input.value);
				path = normalize(parts.join(' '));
			}
			if (path.indexOf(w.norm) === -1) return false;
		}
		return ownHit;
	}

	// ── отрисовка видимости ──
	function render() {
		var words = parseWords();
		var results = words.length > 0 || filter !== 'all';
		root.classList.toggle('is-results', results);
		root.classList.toggle('is-searching', words.length > 0);

		var perPanel = {}, total = 0, hiddenMatches = 0, i, node;
		if (results) {
			order.forEach(function (n) {
				n.match = matches(n, words);
				if (n.match && n.deep && !showInactive) {
					n.match = false;
					hiddenMatches++;
				}
			});
			for (i = order.length - 1; i >= 0; i--) {
				node = order[i];
				node.below = node.children.some(function (c) { return c.match || c.below; });
			}
		}

		order.forEach(function (n) {
			var p = n.parent, show;
			if (n.deep && !showInactive) show = false;
			else if (!results) show = !p || (p.shown && !!open[p.id]);
			else show = n.match || n.below || (!!p && p.shown && !!searchOpen[p.id]);
			n.shown = show;
			n.el.hidden = !show;
			n.el.classList.toggle('is-context', results && show && !n.match);
			if (results ? n.match : (showInactive || !n.deep)) {
				perPanel[n.panel] = (perPanel[n.panel] || 0) + 1;
				if (n.match) total++;
			}
		});

		order.forEach(function (n) {
			if (!n.caret) return;
			var eligible = n.children.filter(function (c) { return showInactive || !c.deep; }).length;
			n.caret.classList.toggle('is-void', eligible === 0);
			n.kids.textContent = eligible;
			n.kids.hidden = eligible === 0;
			var anyShown = n.children.some(function (c) { return c.shown; });
			var partial = results && n.below && !searchOpen[n.id] && n.children.some(function (c) { return !c.shown && (showInactive || !c.deep); });
			n.caret.classList.toggle('is-open', anyShown);
			n.caret.classList.toggle('is-partial', !!partial);
			n.caret.setAttribute('aria-expanded', anyShown ? 'true' : 'false');
			n.caret.title = partial ? 'Показать все вложенные' : '';
		});

		panels.forEach(function (panel) {
			panel.classList.toggle('is-nomatch', results && !perPanel[panel.getAttribute('data-panel')]);
		});
		tabs.forEach(function (tab) {
			var id = tab.getAttribute('data-tab');
			tab.querySelector('.tc-tab-count').textContent = perPanel[id] || 0;
			tab.classList.toggle('is-nomatch', results && !perPanel[id]);
		});
		document.getElementById('tcEmpty').hidden = !(results && total === 0);

		var hint = document.getElementById('tcHiddenHint');
		hint.hidden = !(results && hiddenMatches > 0);
		if (!hint.hidden) {
			hint.innerHTML = 'Ещё ' + hiddenMatches + ' среди неактивных названий. <button type="button" class="tc-link" data-act="show-inactive">Показать</button>';
		}
	}

	// ── превью строки чека ──
	// Показываем последнее, с чем работали: строку под курсором или поле, в котором печатают.
	var hoverNode = null, lastHover = null, focusNode = null, currentRow = null;
	function setPreview() {
		var node = hoverNode || focusNode;
		if (currentRow) currentRow.classList.remove('is-current');
		currentRow = node ? node.el : null;
		if (currentRow) currentRow.classList.add('is-current');

		preview.box.classList.toggle('is-idle', !node);
		preview.text.textContent = '';
		preview.note.textContent = '';
		preview.id.textContent = node ? node.id : '';
		if (!node) {
			preview.text.textContent = preview.idle;
			return;
		}

		var chain = [];
		for (var p = node; p; p = p.parent) {
			chain.unshift({ node: p });
			if (p.gap) chain.unshift({ gap: p.gap });
		}
		var first = true;
		chain.forEach(function (item) {
			var span = document.createElement(item.node === node ? 'mark' : 'span');
			if (item.gap) {
				span.className = 'tc-pv-gap';
				span.textContent = '[' + item.gap + ']';
				span.title = 'Строки «' + item.gap + '» нет в таблице — название берётся из кода калькулятора';
			} else {
				var value = cleanValue(item.node.input.value);
				// Калькулятор пропускает пустые названия и ключи, которые он не читает.
				if (item.node !== node && (value === '' || item.node.unused)) return;
				if (item.node !== node) span.className = 'tc-pv-anc';
				if (value === '') {
					span.className = 'tc-pv-empty';
					value = 'пусто';
				}
				span.textContent = value;
			}
			if (!first) preview.text.appendChild(document.createTextNode(' '));
			preview.text.appendChild(span);
			first = false;
		});
		if (node.unused) preview.note.textContent = 'калькулятор не использует этот ключ';
		else if (node.el.classList.contains('is-inactive')) preview.note.textContent = 'ветка скрыта в калькуляторе';
	}

	// ── состояние полей ──
	function refreshInput(input) {
		var dirty = isDirty(input);
		var invalid = isInvalid(input);
		input.classList.remove('is-rejected');
		input.classList.toggle('is-dirty', dirty);
		input.classList.toggle('is-invalid', invalid);
		input.classList.toggle('is-empty', cleanValue(input.value) === '');
		input.title = invalid
			? 'Нельзя использовать символы " \\ < > — калькулятор перестанет открываться. Кавычки: «ёлочки»'
			: (dirty ? 'Было: ' + (input.getAttribute('data-orig') || 'пусто') : '');
	}

	function refreshState() {
		var dirtyCount = 0, badCount = 0, emptyCount = 0;
		inputs.forEach(function (input) {
			var dirty = input.classList.contains('is-dirty');
			if (dirty) dirtyCount++;
			if (dirty && input.classList.contains('is-invalid')) badCount++;
			if (input.classList.contains('is-empty')) emptyCount++;
		});
		document.getElementById('tcDirtyCount').textContent = dirtyCount;
		document.getElementById('tcDirtyChip').textContent = dirtyCount;
		document.getElementById('tcEmptyCount').textContent = emptyCount;

		var badText = document.getElementById('tcBadText');
		badText.hidden = badCount === 0;
		badText.textContent = 'ошибок: ' + badCount;

		bar.classList.toggle('is-visible', dirtyCount > 0);
		saveBtn.disabled = saving || badCount > 0;

		tabs.forEach(function (tab) {
			var panel = root.querySelector('[data-panel="' + tab.getAttribute('data-tab') + '"]');
			tab.classList.toggle('has-dirty', !!panel.querySelector('.tc-input.is-dirty'));
		});
	}

	// ── вкладки и фильтры ──
	function setTab(id, focusTab) {
		if (!root.querySelector('[data-panel="' + id + '"]')) id = tabs[0].getAttribute('data-tab');
		tabs.forEach(function (tab) {
			var on = tab.getAttribute('data-tab') === id;
			tab.classList.toggle('is-active', on);
			tab.setAttribute('aria-selected', on ? 'true' : 'false');
			if (on) {
				var strip = tab.parentNode;
				var left = tab.offsetLeft - strip.offsetLeft;
				if (left < strip.scrollLeft || left + tab.offsetWidth > strip.scrollLeft + strip.clientWidth) {
					strip.scrollLeft = left - 8;
				}
				if (focusTab) tab.focus();
			}
		});
		panels.forEach(function (panel) {
			panel.classList.toggle('is-active', panel.getAttribute('data-panel') === id);
		});
		try { history.replaceState(null, '', '#' + id); } catch (e) {}
	}

	function setFilter(value) {
		filter = value;
		chips.forEach(function (chip) {
			chip.classList.toggle('is-active', chip.getAttribute('data-filter') === value);
		});
		searchOpen = {};
		render();
	}

	function setShowInactive(value) {
		showInactive = value;
		store('inactive', value);
		if (inactiveChip) {
			inactiveChip.classList.toggle('is-on', value);
			inactiveChip.setAttribute('aria-pressed', value ? 'true' : 'false');
			inactiveChip.querySelector('i').className = 'bx ' + (value ? 'bx-show' : 'bx-hide');
		}
		render();
	}

	function toggleNode(node) {
		if (root.classList.contains('is-results')) {
			searchOpen[node.id] = !searchOpen[node.id];
		} else {
			if (open[node.id]) delete open[node.id];
			else open[node.id] = true;
			store('open', open);
		}
		render();
	}

	function visibleInputs() {
		return inputs.filter(function (input) { return input.offsetParent !== null; });
	}

	// ── сохранение ──
	function save() {
		if (saving) return;
		var changed = inputs.filter(isDirty);
		if (!changed.length) return;
		if (changed.some(isInvalid)) {
			toastr.error('Уберите из названий символы " \\ < > — для кавычек используйте «ёлочки»');
			return;
		}

		var payload = {};
		changed.forEach(function (input) { payload[nodeOf(input).id] = cleanValue(input.value); });

		saving = true;
		saveBtn.disabled = true;
		saveBtn.firstChild.textContent = 'Сохранение… ';

		$.ajax({
			url: 'updateTitelPrice.php',
			method: 'POST',
			data: { calc: CALC, info: JSON.stringify(payload) },
			dataType: 'json'
		}).done(function (response) {
			var rejected = response.rejected || [];
			changed.forEach(function (input) {
				var id = nodeOf(input).id;
				if (rejected.indexOf(id) !== -1) {
					input.classList.add('is-rejected');
					return;
				}
				input.value = payload[id];
				input.setAttribute('data-orig', input.value);
				input.classList.remove('is-saved');
				void input.offsetWidth;
				input.classList.add('is-saved');
				refreshInput(input);
			});
			if (rejected.length) {
				toastr.error('Не сохранено названий: ' + rejected.length + ' (' + rejected.slice(0, 5).join(', ') + (rejected.length > 5 ? '…' : '') + ')');
			} else {
				toastr.success('Сохранено названий: ' + response.saved + '. Обновите страницу калькулятора, чтобы увидеть их в чеке.');
			}
		}).fail(function (xhr) {
			var message = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Ошибка сервера (' + xhr.status + ')';
			toastr.error('Не удалось сохранить: ' + message);
		}).always(function () {
			saving = false;
			saveBtn.firstChild.textContent = 'Сохранить ';
			refreshState();
			setPreview();
		});
	}

	// ── события ──
	inputs.forEach(refreshInput);

	root.addEventListener('input', function (e) {
		if (!e.target.classList.contains('tc-input')) return;
		refreshInput(e.target);
		refreshState();
		hoverNode = null;
		setPreview();
	});

	root.addEventListener('keydown', function (e) {
		var input = e.target;
		if (!input.classList || !input.classList.contains('tc-input')) return;
		if (e.key === 'Enter') {
			e.preventDefault();
			var list = visibleInputs();
			var next = list[list.indexOf(input) + (e.shiftKey ? -1 : 1)];
			if (next) { next.focus(); next.select(); }
		} else if (e.key === 'Escape') {
			input.value = input.getAttribute('data-orig');
			refreshInput(input);
			refreshState();
			setPreview();
		}
	});

	root.addEventListener('focusin', function (e) {
		if (!e.target.classList.contains('tc-input')) return;
		focusNode = nodeOf(e.target);
		hoverNode = null;
		setPreview();
	});
	root.addEventListener('focusout', function (e) {
		if (!e.target.classList.contains('tc-input')) return;
		setTimeout(function () {
			if (!document.activeElement || !document.activeElement.classList.contains('tc-input')) {
				focusNode = null;
				setPreview();
			}
		}, 0);
	});

	var panelsWrap = document.getElementById('tcPanels');
	panelsWrap.addEventListener('mouseover', function (e) {
		var node = nodeOf(e.target);
		if (node && node !== lastHover) {
			lastHover = hoverNode = node;
			setPreview();
		}
	});
	panelsWrap.addEventListener('mouseleave', function () {
		hoverNode = lastHover = null;
		setPreview();
	});

	root.addEventListener('click', function (e) {
		var target = e.target;
		var act = target.closest('[data-act]');
		if (act) {
			var action = act.getAttribute('data-act');
			if (action === 'show-inactive') {
				setShowInactive(true);
				return;
			}
			var panelId = act.closest('.tc-panel').getAttribute('data-panel');
			order.forEach(function (node) {
				if (node.panel !== panelId || !node.children.length) return;
				if (action === 'expand') open[node.id] = true;
				else delete open[node.id];
			});
			store('open', open);
			render();
			return;
		}
		if (target.closest('button.tc-caret') || target.closest('.tc-id')) {
			var node = nodeOf(target);
			if (node && node.caret && !node.caret.classList.contains('is-void')) toggleNode(node);
			else if (node) node.input.focus();
		}
	});

	tabs.forEach(function (tab, index) {
		tab.addEventListener('click', function () {
			var id = tab.getAttribute('data-tab');
			if (root.classList.contains('is-results')) {
				var panel = root.querySelector('[data-panel="' + id + '"]');
				if (!panel.classList.contains('is-nomatch')) {
					window.scrollTo({ top: panel.getBoundingClientRect().top + window.pageYOffset - 260, behavior: 'smooth' });
				}
			}
			setTab(id);
		});
		tab.addEventListener('keydown', function (e) {
			if (e.key !== 'ArrowRight' && e.key !== 'ArrowLeft') return;
			var next = tabs[(index + (e.key === 'ArrowRight' ? 1 : tabs.length - 1)) % tabs.length];
			setTab(next.getAttribute('data-tab'), true);
		});
	});

	chips.forEach(function (chip) {
		chip.addEventListener('click', function () {
			var value = chip.getAttribute('data-filter');
			setFilter(filter === value ? 'all' : value);
		});
	});
	if (inactiveChip) {
		inactiveChip.addEventListener('click', function () { setShowInactive(!showInactive); });
	}

	searchInput.addEventListener('input', function () {
		searchOpen = {};
		render();
	});
	searchInput.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') { searchInput.value = ''; searchOpen = {}; render(); }
		if (e.key === 'Enter') {
			e.preventDefault();
			var first = root.querySelector('.tc-row:not([hidden]):not(.is-context) .tc-input') || visibleInputs()[0];
			if (first) first.focus();
		}
	});
	document.getElementById('tcClear').addEventListener('click', function () {
		searchInput.value = '';
		searchOpen = {};
		render();
		searchInput.focus();
	});

	document.getElementById('tcReset').addEventListener('click', function () {
		if (!confirm('Отменить все несохранённые изменения?')) return;
		inputs.forEach(function (input) {
			input.value = input.getAttribute('data-orig');
			refreshInput(input);
		});
		refreshState();
		setPreview();
		if (filter === 'dirty') render();
	});
	saveBtn.addEventListener('click', save);

	document.addEventListener('keydown', function (e) {
		if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'ы' || e.keyCode === 83)) {
			e.preventDefault();
			save();
			return;
		}
		var tag = (e.target.tagName || '').toLowerCase();
		if (e.key === '/' && tag !== 'input' && tag !== 'textarea') {
			e.preventDefault();
			searchInput.focus();
		}
	});

	window.addEventListener('beforeunload', function (e) {
		if (inputs.some(isDirty)) {
			e.preventDefault();
			e.returnValue = '';
		}
	});

	setTab((location.hash || '').slice(1));
	if (inactiveChip) setShowInactive(showInactive); else render();
	refreshState();
})();
</script>
<?php endif; ?>

</body>
</html>
