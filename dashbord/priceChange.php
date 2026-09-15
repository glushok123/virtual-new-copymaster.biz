<?php
	include('./header.php');

	if (!isset($_SESSION['type']) || $_SESSION['type'] != "admin")
	{
		echo '<div class="page-wrapper"><div class="page-content-wrapper"><div class="page-content">ДОСТУП ЗАПРЕЩЕН !!!</div></div></div>';
		exit;
	}

	$sections = require __DIR__ . '/helpers/priceChangeConfig.php';

	$db = getDbInstance();
	$prices = [];
	foreach ($db->get('pricecalc', null, ['name', 'price']) as $row) {
		$prices[$row['name']] = $row['price'];
	}

	function pcEsc($value)
	{
		return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
	}

	function pcInput($key, array $prices, $label)
	{
		$value = isset($prices[$key]) ? $prices[$key] : '';
		return '<span class="pc-field"><input class="pc-input" type="text" inputmode="decimal" autocomplete="off"'
			. ' data-key="' . pcEsc($key) . '" data-orig="' . pcEsc($value) . '" value="' . pcEsc($value) . '"'
			. ' aria-label="' . pcEsc($label) . '"><i>₽</i></span>';
	}

	$positions = count(priceChangeKeys($sections));
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

<style>
	.pc {
		--pc-surface: rgba(10, 14, 24, .42);
		--pc-surface-hi: rgba(255, 255, 255, .055);
		--pc-line: rgba(255, 255, 255, .09);
		--pc-text: #eef2f7;
		--pc-muted: rgba(226, 232, 240, .56);
		--pc-accent: #5eead4;
		--pc-accent-ink: #062a26;
		--pc-dirty: #fbbf24;
		--pc-bad: #fb7185;
		--pc-radius: 14px;
		font-family: 'Onest', 'Segoe UI', Tahoma, sans-serif;
		color: var(--pc-text);
		max-width: 1480px;
		margin: 0 auto;
		padding-bottom: 110px;
	}
	.pc *, .pc *::before, .pc *::after { box-sizing: border-box; }

	/* ── шапка ─────────────────────────────── */
	.pc-head {
		display: flex;
		flex-wrap: wrap;
		align-items: flex-end;
		justify-content: space-between;
		gap: 18px 32px;
		margin-bottom: 22px;
		animation: pc-rise .45s ease both;
	}
	.pc-eyebrow {
		display: inline-block;
		font-size: 11px;
		font-weight: 600;
		letter-spacing: .14em;
		text-transform: uppercase;
		color: var(--pc-accent);
	}
	.pc-head h1 {
		margin: 4px 0 6px;
		font-family: inherit;
		font-size: clamp(28px, 3.2vw, 40px);
		font-weight: 700;
		letter-spacing: -.02em;
		line-height: 1.05;
		color: var(--pc-text);
	}
	.pc-head p { margin: 0; color: var(--pc-muted); font-size: 14px; }

	.pc-stats { display: flex; gap: 8px; flex-wrap: wrap; }
	.pc-chip {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		height: 34px;
		padding: 0 14px;
		border: 1px solid var(--pc-line);
		border-radius: 999px;
		background: var(--pc-surface-hi);
		color: var(--pc-muted);
		font: 500 13px/1 'Onest', sans-serif;
		cursor: pointer;
		transition: background .15s, color .15s, border-color .15s;
	}
	.pc-chip b { color: var(--pc-text); font-weight: 600; font-variant-numeric: tabular-nums; }
	.pc-chip:hover { color: var(--pc-text); border-color: rgba(255, 255, 255, .22); }
	.pc-chip.is-active { background: var(--pc-accent); border-color: var(--pc-accent); color: var(--pc-accent-ink); }
	.pc-chip.is-active b { color: var(--pc-accent-ink); }
	.pc-chip:focus-visible { outline: 2px solid var(--pc-accent); outline-offset: 2px; }
	.pc-chip[data-filter="dirty"] .pc-dot { background: var(--pc-dirty); }
	.pc-chip[data-filter="empty"] .pc-dot { background: var(--pc-bad); }
	.pc-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--pc-accent); }

	/* ── панель поиска и вкладок ───────────── */
	.pc-toolbar {
		position: sticky;
		top: 70px;
		z-index: 9;
		margin: 0 -12px 22px;
		padding: 12px;
		border-radius: calc(var(--pc-radius) + 4px);
		background: rgba(35, 43, 54, .82);
		backdrop-filter: blur(14px);
		-webkit-backdrop-filter: blur(14px);
		border: 1px solid var(--pc-line);
		box-shadow: 0 12px 30px -18px rgba(0, 0, 0, .7);
		animation: pc-rise .45s .05s ease both;
	}
	.pc-search {
		position: relative;
		display: block;
		margin: 0 0 10px;
	}
	.pc-search > i {
		position: absolute;
		left: 16px;
		top: 50%;
		transform: translateY(-50%);
		font-size: 20px;
		color: var(--pc-muted);
		pointer-events: none;
	}
	.pc-search input {
		width: 100%;
		height: 48px;
		padding: 0 92px 0 48px;
		border: 1px solid var(--pc-line);
		border-radius: 12px;
		background: rgba(0, 0, 0, .22);
		color: var(--pc-text);
		font: 500 15px 'Onest', sans-serif;
		outline: none;
		transition: border-color .15s, box-shadow .15s;
	}
	.pc-search input::placeholder { color: rgba(226, 232, 240, .38); }
	.pc-search input:focus { border-color: var(--pc-accent); box-shadow: 0 0 0 3px rgba(94, 234, 212, .16); }
	.pc-search input::-webkit-search-cancel-button { display: none; }
	.pc-search-aside {
		position: absolute;
		right: 10px;
		top: 50%;
		transform: translateY(-50%);
		display: flex;
		align-items: center;
		gap: 6px;
	}
	.pc-kbd {
		display: inline-grid;
		place-items: center;
		min-width: 24px;
		height: 24px;
		padding: 0 6px;
		border: 1px solid var(--pc-line);
		border-bottom-width: 2px;
		border-radius: 6px;
		color: var(--pc-muted);
		font: 600 11px 'JetBrains Mono', monospace;
	}
	.pc-clear {
		display: none;
		width: 30px;
		height: 30px;
		border: 0;
		border-radius: 8px;
		background: var(--pc-surface-hi);
		color: var(--pc-text);
		font-size: 18px;
		line-height: 1;
		cursor: pointer;
	}
	.pc.is-searching .pc-clear { display: inline-grid; place-items: center; }
	.pc.is-searching .pc-search .pc-kbd { display: none; }

	.pc-tabs {
		display: flex;
		gap: 6px;
		overflow-x: auto;
		scrollbar-width: none;
	}
	.pc-tabs::-webkit-scrollbar { display: none; }
	.pc-tab {
		position: relative;
		flex: 1 0 auto;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 9px;
		height: 44px;
		padding: 0 18px;
		border: 1px solid transparent;
		border-radius: 10px;
		background: transparent;
		color: var(--pc-muted);
		font: 600 15px 'Onest', sans-serif;
		white-space: nowrap;
		cursor: pointer;
		transition: background .15s, color .15s;
	}
	.pc-tab i { font-size: 20px; }
	.pc-tab:hover { color: var(--pc-text); background: var(--pc-surface-hi); }
	.pc-tab:focus-visible { outline: 2px solid var(--pc-accent); outline-offset: -2px; }
	.pc-tab.is-active { color: var(--pc-accent-ink); background: var(--pc-accent); }
	.pc-tab-count {
		min-width: 24px;
		padding: 2px 7px;
		border-radius: 999px;
		background: rgba(255, 255, 255, .08);
		font: 600 11px/1.4 'JetBrains Mono', monospace;
		font-style: normal;
	}
	.pc-tab.is-active .pc-tab-count { background: rgba(6, 42, 38, .16); }
	.pc.is-results .pc-tab.is-active { color: var(--pc-text); background: var(--pc-surface-hi); }
	.pc.is-results .pc-tab.is-active .pc-tab-count { background: rgba(255, 255, 255, .08); }
	.pc-tab.is-nomatch { opacity: .4; }
	.pc-tab-dirty {
		position: absolute;
		top: 7px;
		right: 7px;
		width: 8px;
		height: 8px;
		border-radius: 50%;
		background: var(--pc-dirty);
		box-shadow: 0 0 0 2px rgba(35, 43, 54, .9);
		display: none;
	}
	.pc-tab.has-dirty .pc-tab-dirty { display: block; }

	/* ── разделы и группы ──────────────────── */
	.pc-panel { display: none; }
	.pc-panel.is-active { display: block; animation: pc-fade .25s ease both; }
	.pc.is-results .pc-panel { display: block; animation: none; }
	.pc.is-results .pc-panel.is-nomatch { display: none; }
	.pc-panel-title {
		display: none;
		align-items: center;
		gap: 10px;
		margin: 8px 0 14px;
		font: 700 13px 'Onest', sans-serif;
		letter-spacing: .12em;
		text-transform: uppercase;
		color: var(--pc-muted);
	}
	.pc-panel-title::after { content: ''; flex: 1; height: 1px; background: var(--pc-line); }
	.pc.is-results .pc-panel-title { display: flex; }
	.pc.is-results .pc-panel + .pc-panel { margin-top: 28px; }

	.pc-groups {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(min(100%, 420px), 1fr));
		gap: 16px;
		align-items: start;
	}
	.pc-group {
		grid-column: span 1;
		min-width: 0;
		border: 1px solid var(--pc-line);
		border-radius: var(--pc-radius);
		background: var(--pc-surface);
		overflow: hidden;
	}
	.pc-group.is-wide { grid-column: 1 / -1; }
	.pc-group.is-nomatch, .pc-unit.is-nomatch { display: none !important; }
	.pc-group-head {
		display: flex;
		flex-wrap: wrap;
		align-items: baseline;
		justify-content: space-between;
		gap: 4px 16px;
		padding: 14px 18px 12px;
		border-bottom: 1px solid var(--pc-line);
	}
	.pc-group-head h3 {
		margin: 0;
		font: 600 16px 'Onest', sans-serif;
		color: var(--pc-text);
	}
	.pc-note { color: var(--pc-muted); font-size: 12.5px; }

	/* список */
	.pc-list { padding: 6px; }
	.pc-item {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 16px;
		margin: 0;
		padding: 7px 8px 7px 12px;
		border-radius: 9px;
		cursor: text;
		transition: background .12s;
	}
	.pc-item:hover, .pc-item:focus-within { background: var(--pc-surface-hi); }
	.pc-item-label { font-size: 14.5px; line-height: 1.3; color: var(--pc-text); }
	.pc-item-label small { margin-left: 6px; color: var(--pc-muted); font-size: 12px; }

	/* матрица */
	.pc-scroll { overflow-x: auto; }
	.pc-matrix {
		width: 100%;
		border-collapse: separate;
		border-spacing: 0;
		font-size: 14px;
	}
	.pc-matrix th, .pc-matrix td { padding: 6px 6px; border: 0; vertical-align: middle; }
	.pc-matrix thead th {
		padding-top: 10px;
		padding-bottom: 8px;
		color: var(--pc-muted);
		font: 600 11.5px 'JetBrains Mono', monospace;
		text-align: right;
		white-space: nowrap;
	}
	.pc-matrix thead th:not(:first-child) { padding-right: 32px; }
	.pc-matrix thead th:last-child { padding-right: 40px; }
	.pc-matrix td { text-align: right; }
	.pc-matrix thead th:first-child { text-align: left; padding-left: 18px; font-family: 'Onest', sans-serif; }
	.pc-matrix tbody tr { transition: background .12s; }
	.pc-matrix tbody tr:hover, .pc-matrix tbody tr:focus-within { background: var(--pc-surface-hi); }
	.pc-matrix tbody tr + tr > * { border-top: 1px solid rgba(255, 255, 255, .045); }
	.pc-row-label {
		position: sticky;
		left: 0;
		z-index: 1;
		min-width: 170px;
		padding-left: 18px !important;
		background: rgba(36, 44, 55, .96);
		color: var(--pc-text);
		font-weight: 500;
		text-align: left;
		white-space: nowrap;
	}
	.pc-matrix td:last-child { padding-right: 14px; }
	.pc-none { display: inline-block; width: 104px; padding-right: 26px; color: rgba(226, 232, 240, .25); }

	/* поле цены */
	.pc-field {
		position: relative;
		display: inline-flex;
		align-items: center;
		flex: 0 0 auto;
	}
	.pc-field i {
		position: absolute;
		right: 10px;
		color: var(--pc-muted);
		font: 500 12px 'Onest', sans-serif;
		font-style: normal;
		pointer-events: none;
	}
	.pc-input {
		width: 108px;
		height: 36px;
		padding: 0 26px 0 10px;
		border: 1px solid transparent;
		border-radius: 8px;
		background: rgba(0, 0, 0, .24);
		color: var(--pc-text);
		font: 600 14px 'JetBrains Mono', monospace;
		font-variant-numeric: tabular-nums;
		text-align: right;
		outline: none;
		transition: border-color .12s, background .12s, box-shadow .12s;
	}
	.pc-matrix .pc-input { width: 104px; }
	.pc-input:hover { border-color: rgba(255, 255, 255, .16); }
	.pc-input:focus { border-color: var(--pc-accent); background: rgba(0, 0, 0, .34); box-shadow: 0 0 0 3px rgba(94, 234, 212, .15); }
	.pc-input.is-empty { background: repeating-linear-gradient(135deg, rgba(251, 113, 133, .08) 0 6px, transparent 6px 12px), rgba(0, 0, 0, .24); }
	.pc-input.is-dirty { border-color: rgba(251, 191, 36, .75); background: rgba(251, 191, 36, .12); color: #fff3cd; }
	.pc-input.is-invalid { border-color: var(--pc-bad); background: rgba(251, 113, 133, .14); color: #ffe0e5; }
	.pc-input.is-saved { animation: pc-saved 1.1s ease; }

	.pc-empty {
		padding: 56px 20px;
		border: 1px dashed var(--pc-line);
		border-radius: var(--pc-radius);
		text-align: center;
		color: var(--pc-muted);
	}
	.pc-empty i { display: block; margin-bottom: 8px; font-size: 34px; }

	/* ── нижняя панель сохранения ──────────── */
	.pc-bar {
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
		font-family: 'Onest', sans-serif;
		color: var(--pc-text);
		transform: translate(-50%, 140%);
		opacity: 0;
		pointer-events: none;
		transition: transform .28s cubic-bezier(.2, .9, .3, 1.2), opacity .2s;
	}
	.pc-bar.is-visible { transform: translate(-50%, 0); opacity: 1; pointer-events: auto; }
	.pc-bar-text { font-size: 14px; white-space: nowrap; }
	.pc-bar-text b { color: var(--pc-dirty); font-variant-numeric: tabular-nums; }
	.pc-bar-text .pc-bar-bad { margin-left: 8px; color: var(--pc-bad); }
	.pc-btn {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		height: 42px;
		padding: 0 18px;
		border: 1px solid var(--pc-line);
		border-radius: 11px;
		background: transparent;
		color: var(--pc-text);
		font: 600 14px 'Onest', sans-serif;
		white-space: nowrap;
		cursor: pointer;
		transition: background .15s, transform .1s;
	}
	.pc-btn:hover { background: var(--pc-surface-hi); }
	.pc-btn:active { transform: translateY(1px); }
	.pc-btn:disabled { opacity: .55; cursor: default; }
	.pc-btn-primary { border-color: var(--pc-accent); background: var(--pc-accent); color: var(--pc-accent-ink); }
	.pc-btn-primary:hover { background: #7ff0dd; }
	.pc-btn-primary .pc-kbd { border-color: rgba(6, 42, 38, .25); color: rgba(6, 42, 38, .7); }

	@keyframes pc-rise { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }
	@keyframes pc-fade { from { opacity: 0; } to { opacity: 1; } }
	@keyframes pc-saved { 0% { box-shadow: 0 0 0 0 rgba(94, 234, 212, .7); border-color: var(--pc-accent); } 100% { box-shadow: 0 0 0 10px rgba(94, 234, 212, 0); } }

	@media (max-width: 767px) {
		.page-content { padding: 16px; }
		.pc-toolbar { margin: 0 -6px 16px; padding: 8px; }
		.pc-tab { flex: 0 0 auto; padding: 0 14px; }
		.pc-tab span { font-size: 14px; }
		.pc-search input { font-size: 14px; }
		.pc-search .pc-kbd { display: none; }
		.pc-item { flex-wrap: wrap; gap: 6px 16px; }
		.pc-row-label { min-width: 130px; white-space: normal; }
		.pc-bar { left: 16px; right: 16px; bottom: 12px; max-width: none; transform: translateY(140%); padding-left: 14px; }
		.pc-bar.is-visible { transform: none; }
		.pc-bar-text { flex: 1; white-space: normal; font-size: 13px; }
		.pc-btn { padding: 0 12px; }
		.pc-btn .pc-kbd, .pc-btn-label-long { display: none; }
	}
	@media (prefers-reduced-motion: reduce) {
		.pc *, .pc-bar { animation: none !important; transition: none !important; }
	}
</style>

		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="pc" id="pc">

						<div class="pc-head">
							<div>
								<span class="pc-eyebrow">Калькулятор ФИЗ</span>
								<h1>Цены калькулятора</h1>
								<p>Изменения попадают в калькулятор сразу после сохранения.</p>
							</div>
							<div class="pc-stats" role="group" aria-label="Фильтр позиций">
								<button type="button" class="pc-chip is-active" data-filter="all"><span class="pc-dot"></span>Все <b><?= $positions ?></b></button>
								<button type="button" class="pc-chip" data-filter="empty"><span class="pc-dot"></span>Без цены <b id="pcEmptyCount">0</b></button>
								<button type="button" class="pc-chip" data-filter="dirty"><span class="pc-dot"></span>Изменённые <b id="pcDirtyChip">0</b></button>
							</div>
						</div>

						<div class="pc-toolbar">
							<label class="pc-search">
								<i class="bx bx-search"></i>
								<input id="pcSearch" type="search" placeholder="Поиск: «ламинирование A4», «визитки срочно», «переплёт»…" autocomplete="off">
								<span class="pc-search-aside">
									<button type="button" class="pc-clear" id="pcClear" aria-label="Очистить поиск">×</button>
									<span class="pc-kbd">/</span>
								</span>
							</label>

							<nav class="pc-tabs" role="tablist">
								<?php foreach ($sections as $section): ?>
									<button type="button" class="pc-tab" role="tab" data-tab="<?= pcEsc($section['id']) ?>">
										<i class="bx <?= pcEsc($section['icon']) ?>"></i>
										<span><?= pcEsc($section['title']) ?></span>
										<em class="pc-tab-count" data-count-for="<?= pcEsc($section['id']) ?>"></em>
										<b class="pc-tab-dirty"></b>
									</button>
								<?php endforeach; ?>
							</nav>
						</div>

						<div class="pc-empty" id="pcEmpty" hidden>
							<i class="bx bx-search-alt"></i>
							Ничего не найдено. Попробуйте другое слово или сбросьте фильтр.
						</div>

						<?php foreach ($sections as $section): ?>
							<section class="pc-panel" role="tabpanel" data-panel="<?= pcEsc($section['id']) ?>">
								<h2 class="pc-panel-title"><?= pcEsc($section['title']) ?></h2>
								<div class="pc-groups">
									<?php foreach ($section['groups'] as $group): ?>
										<?php
											$isMatrix = $group['type'] === 'matrix';
											$isWide = $isMatrix && count($group['cols']) > 2;
											$groupSearch = $section['title'] . ' ' . $group['title'];
										?>
										<article class="pc-group<?= $isWide ? ' is-wide' : '' ?>">
											<header class="pc-group-head">
												<h3><?= pcEsc($group['title']) ?></h3>
												<?php if (!empty($group['note'])): ?>
													<span class="pc-note"><?= pcEsc($group['note']) ?></span>
												<?php endif; ?>
											</header>

											<?php if ($isMatrix): ?>
												<div class="pc-scroll">
													<table class="pc-matrix">
														<thead>
															<tr>
																<th scope="col"><?= !empty($group['colsTitle']) ? pcEsc($group['colsTitle']) : '' ?></th>
																<?php foreach ($group['cols'] as $col): ?>
																	<th scope="col"><?= pcEsc($col) ?></th>
																<?php endforeach; ?>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($group['rows'] as $row): ?>
																<tr class="pc-unit" data-search="<?= pcEsc($groupSearch . ' ' . $row[0] . ' ' . implode(' ', $group['cols']) . ' ' . implode(' ', array_filter($row[1]))) ?>">
																	<th scope="row" class="pc-row-label"><?= pcEsc($row[0]) ?></th>
																	<?php foreach ($row[1] as $i => $key): ?>
																		<td>
																			<?php if ($key === null): ?>
																				<span class="pc-none">—</span>
																			<?php else: ?>
																				<?= pcInput($key, $prices, $group['title'] . ' · ' . $row[0] . ' · ' . $group['cols'][$i]) ?>
																			<?php endif; ?>
																		</td>
																	<?php endforeach; ?>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
												</div>
											<?php else: ?>
												<div class="pc-list">
													<?php foreach ($group['items'] as $item): ?>
														<label class="pc-item pc-unit" data-search="<?= pcEsc($groupSearch . ' ' . $item[1] . ' ' . $item[0]) ?>">
															<span class="pc-item-label">
																<?= pcEsc($item[1]) ?>
																<?php if (!empty($item[2])): ?><small>за <?= pcEsc($item[2]) ?></small><?php endif; ?>
															</span>
															<?= pcInput($item[0], $prices, $group['title'] . ' · ' . $item[1]) ?>
														</label>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>
										</article>
									<?php endforeach; ?>
								</div>
							</section>
						<?php endforeach; ?>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="pc-bar" id="pcBar" role="region" aria-live="polite">
		<span class="pc-bar-text">Не сохранено: <b id="pcDirtyCount">0</b><span class="pc-bar-bad" id="pcBadText" hidden></span></span>
		<button type="button" class="pc-btn" id="pcReset">Отменить<span class="pc-btn-label-long"> всё</span></button>
		<button type="button" class="pc-btn pc-btn-primary" id="pcSave">Сохранить <span class="pc-kbd">Ctrl S</span></button>
	</div>

	<!--end switcher-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<!--plugins-->
	<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!-- Vector map JavaScript -->
	<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-in-mill.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-uk-mill-en.js"></script>
	<script src="assets/plugins/vectormap/jquery-jvectormap-au-mill.js"></script>

	<script src="assets/js/index.js"></script>
	<!-- App JS -->
	<script src="assets/js/app.js"></script>

<script>
(function () {
	var root = document.getElementById('pc');
	var searchInput = document.getElementById('pcSearch');
	var inputs = Array.prototype.slice.call(root.querySelectorAll('.pc-input'));
	var tabs = Array.prototype.slice.call(root.querySelectorAll('.pc-tab'));
	var panels = Array.prototype.slice.call(root.querySelectorAll('.pc-panel'));
	var chips = Array.prototype.slice.call(root.querySelectorAll('.pc-chip'));
	var bar = document.getElementById('pcBar');
	var saveBtn = document.getElementById('pcSave');
	var filter = 'all';
	var activeTab = null;
	var saving = false;

	// Кириллица и латиница в названиях перемешаны (А4 / A4) — сравниваем в одном алфавите.
	var LOOKALIKE = { 'а': 'a', 'в': 'b', 'е': 'e', 'ё': 'e', 'к': 'k', 'м': 'm', 'н': 'h', 'о': 'o', 'р': 'p', 'с': 'c', 'т': 't', 'у': 'y', 'х': 'x', '×': 'x', '–': '-', '—': '-' };
	function normalize(text) {
		return String(text).toLowerCase()
			.replace(/[авеёкмнорстух×–—]/g, function (ch) { return LOOKALIKE[ch]; })
			.replace(/ /g, '')
			.replace(/\s+/g, ' ')
			.trim();
	}

	var units = Array.prototype.slice.call(root.querySelectorAll('.pc-unit')).map(function (el) {
		return {
			el: el,
			haystack: normalize(el.getAttribute('data-search')),
			inputs: Array.prototype.slice.call(el.querySelectorAll('.pc-input')),
			group: el.closest('.pc-group'),
			panel: el.closest('.pc-panel')
		};
	});

	function cleanValue(value) {
		return String(value).trim().replace(',', '.');
	}
	function isValid(value) {
		return value === '' || /^\d+(\.\d+)?$/.test(value);
	}
	function isDirty(input) {
		return cleanValue(input.value) !== cleanValue(input.getAttribute('data-orig'));
	}

	function refreshInput(input) {
		var value = cleanValue(input.value);
		var dirty = isDirty(input);
		input.classList.toggle('is-dirty', dirty);
		input.classList.toggle('is-invalid', !isValid(value));
		input.classList.toggle('is-empty', value === '');
		input.title = dirty ? 'Было: ' + (input.getAttribute('data-orig') || 'пусто') : '';
	}

	function refreshState() {
		var dirtyCount = 0, badCount = 0, emptyCount = 0;
		inputs.forEach(function (input) {
			if (input.classList.contains('is-dirty')) dirtyCount++;
			if (input.classList.contains('is-invalid')) badCount++;
			if (input.classList.contains('is-empty')) emptyCount++;
		});
		document.getElementById('pcDirtyCount').textContent = dirtyCount;
		document.getElementById('pcDirtyChip').textContent = dirtyCount;
		document.getElementById('pcEmptyCount').textContent = emptyCount;

		var badText = document.getElementById('pcBadText');
		badText.hidden = badCount === 0;
		badText.textContent = 'ошибок: ' + badCount;

		bar.classList.toggle('is-visible', dirtyCount > 0);
		saveBtn.disabled = saving || badCount > 0;

		tabs.forEach(function (tab) {
			var panel = root.querySelector('[data-panel="' + tab.getAttribute('data-tab') + '"]');
			tab.classList.toggle('has-dirty', !!panel.querySelector('.pc-input.is-dirty'));
		});
		if (filter !== 'all') applyFilter();
	}

	function setTab(id, focusTab) {
		if (!root.querySelector('[data-panel="' + id + '"]')) id = tabs[0].getAttribute('data-tab');
		activeTab = id;
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

	function applyFilter() {
		// Отбрасываем окончание длинных слов: «визитки» найдёт «визиток», «срочно» — «срочное».
		var words = normalize(searchInput.value).split(' ').filter(Boolean).map(function (w) {
			return w.length > 5 ? w.slice(0, w.length - 2) : w;
		});
		var results = words.length > 0 || filter !== 'all';
		root.classList.toggle('is-results', results);
		root.classList.toggle('is-searching', words.length > 0);

		var perPanel = {}, perGroup = new Map(), total = 0;
		units.forEach(function (unit) {
			var match = words.every(function (w) { return unit.haystack.indexOf(w) !== -1; });
			if (match && filter === 'dirty') match = unit.inputs.some(function (i) { return i.classList.contains('is-dirty'); });
			if (match && filter === 'empty') match = unit.inputs.some(function (i) { return i.classList.contains('is-empty'); });
			unit.el.classList.toggle('is-nomatch', results && !match);
			if (match) {
				var id = unit.panel.getAttribute('data-panel');
				perPanel[id] = (perPanel[id] || 0) + 1;
				perGroup.set(unit.group, true);
				total++;
			}
		});

		root.querySelectorAll('.pc-group').forEach(function (group) {
			group.classList.toggle('is-nomatch', results && !perGroup.has(group));
		});
		panels.forEach(function (panel) {
			panel.classList.toggle('is-nomatch', results && !perPanel[panel.getAttribute('data-panel')]);
		});
		tabs.forEach(function (tab) {
			var id = tab.getAttribute('data-tab');
			var count = root.querySelectorAll('[data-panel="' + id + '"] .pc-unit').length;
			tab.querySelector('.pc-tab-count').textContent = results ? (perPanel[id] || 0) : count;
			tab.classList.toggle('is-nomatch', results && !perPanel[id]);
		});
		document.getElementById('pcEmpty').hidden = !(results && total === 0);
	}

	function setFilter(value) {
		filter = value;
		chips.forEach(function (chip) {
			chip.classList.toggle('is-active', chip.getAttribute('data-filter') === value);
		});
		applyFilter();
	}

	function visibleInputs() {
		return inputs.filter(function (input) { return input.offsetParent !== null; });
	}

	function save() {
		if (saving) return;
		var changed = inputs.filter(isDirty);
		if (!changed.length) return;
		if (changed.some(function (i) { return i.classList.contains('is-invalid'); })) {
			toastr.error('Исправьте поля с ошибками: только число, например 150 или 12.5');
			return;
		}

		var payload = {};
		changed.forEach(function (input) { payload[input.getAttribute('data-key')] = cleanValue(input.value); });

		saving = true;
		saveBtn.disabled = true;
		saveBtn.firstChild.textContent = 'Сохранение… ';

		$.ajax({
			url: 'save_price.php',
			method: 'POST',
			data: { info: JSON.stringify(payload) },
			dataType: 'json'
		}).done(function (response) {
			var rejected = response.rejected || [];
			changed.forEach(function (input) {
				if (rejected.indexOf(input.getAttribute('data-key')) !== -1) {
					input.classList.add('is-invalid');
					return;
				}
				input.value = payload[input.getAttribute('data-key')];
				input.setAttribute('data-orig', input.value);
				input.classList.remove('is-saved');
				void input.offsetWidth;
				input.classList.add('is-saved');
				refreshInput(input);
			});
			if (rejected.length) {
				toastr.error('Не сохранено позиций: ' + rejected.length);
			} else {
				toastr.success('Сохранено позиций: ' + response.saved);
			}
		}).fail(function (xhr) {
			var message = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Ошибка сервера (' + xhr.status + ')';
			toastr.error('Не удалось сохранить: ' + message);
		}).always(function () {
			saving = false;
			saveBtn.firstChild.textContent = 'Сохранить ';
			refreshState();
		});
	}

	// ── события ──────────────────────────
	inputs.forEach(refreshInput);

	root.addEventListener('input', function (e) {
		if (e.target.classList.contains('pc-input')) {
			refreshInput(e.target);
			refreshState();
		}
	});

	root.addEventListener('keydown', function (e) {
		var input = e.target;
		if (!input.classList || !input.classList.contains('pc-input')) return;
		if (e.key === 'Enter') {
			e.preventDefault();
			var list = visibleInputs();
			var next = list[list.indexOf(input) + (e.shiftKey ? -1 : 1)];
			if (next) { next.focus(); next.select(); }
		} else if (e.key === 'Escape') {
			input.value = input.getAttribute('data-orig');
			refreshInput(input);
			refreshState();
		}
	});
	root.addEventListener('focusin', function (e) {
		if (e.target.classList.contains('pc-input')) e.target.select();
	});

	tabs.forEach(function (tab, index) {
		tab.addEventListener('click', function () {
			var id = tab.getAttribute('data-tab');
			if (root.classList.contains('is-results')) {
				var panel = root.querySelector('[data-panel="' + id + '"]');
				if (!panel.classList.contains('is-nomatch')) {
					window.scrollTo({ top: panel.getBoundingClientRect().top + window.pageYOffset - 200, behavior: 'smooth' });
				}
				setTab(id);
				return;
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

	searchInput.addEventListener('input', applyFilter);
	searchInput.addEventListener('keydown', function (e) {
		if (e.key === 'Escape') { searchInput.value = ''; applyFilter(); }
		if (e.key === 'Enter') {
			e.preventDefault();
			var first = visibleInputs()[0];
			if (first) first.focus();
		}
	});
	document.getElementById('pcClear').addEventListener('click', function () {
		searchInput.value = '';
		applyFilter();
		searchInput.focus();
	});

	document.getElementById('pcReset').addEventListener('click', function () {
		if (!confirm('Отменить все несохранённые изменения?')) return;
		inputs.forEach(function (input) {
			input.value = input.getAttribute('data-orig');
			refreshInput(input);
		});
		refreshState();
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
	refreshState();
	applyFilter();
})();
</script>

</body>
</html>
