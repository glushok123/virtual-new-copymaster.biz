<?php
	include('./header.php');

	// Как и раньше: страница доступна любому авторизованному сотруднику.
	if (!isset($_SESSION['user_logged_in'])) {
		echo '<div class="page-wrapper"><div class="page-content-wrapper"><div class="page-content">Необходимо авторизоваться!</div></div></div>';
		exit;
	}

	// Типы, статусы и справочники параметров — общие с API (api/routers/requests.php).
	$rqConfig = require __DIR__ . '/helpers/requestsConfig.php';
	$rqTypes = [];
	foreach ($rqConfig['types'] as $rqKey => $rqType) {
		$rqFields = [];
		foreach ($rqType['fields'] as $rqField) {
			$rqOptions = [];
			if (isset($rqField['options'])) {
				foreach ($rqField['options'] as $rqCode => $rqLabel) {
					$rqOptions[] = [(string)$rqCode, $rqLabel];
				}
			}
			$rqFields[] = [
				'key' => $rqField['key'],
				'label' => $rqField['label'],
				'group' => isset($rqField['group']) ? $rqField['group'] : '',
				'kind' => $rqField['kind'],
				'edit' => !empty($rqField['edit']) && $rqField['src'][0] === 'info',
				'options' => $rqOptions,
			];
		}
		$rqTypes[$rqKey] = [
			'label' => $rqType['label'],
			'full' => isset($rqType['full']) ? $rqType['full'] : $rqType['label'],
			'icon' => $rqType['icon'],
			'fields' => $rqFields,
			'clientComment' => !empty($rqType['clientComment']),
		];
	}
	$rqStatuses = [];
	foreach ($rqConfig['statuses'] as $rqKey => $rqStatus) {
		$rqStatuses[$rqKey] = ['label' => $rqStatus['label'], 'hint' => $rqStatus['hint'], 'open' => $rqStatus['open'], 'db' => $rqStatus['db']];
	}
	$rqJsonFlags = JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT;
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">

<style>
	.rq, .rq-layer {
		--rq-surface: rgba(10, 14, 24, .42);
		--rq-surface-solid: #1f262f;
		--rq-surface-hi: rgba(255, 255, 255, .055);
		--rq-line: rgba(255, 255, 255, .09);
		--rq-text: #eef2f7;
		--rq-muted: rgba(226, 232, 240, .58);
		--rq-faint: rgba(226, 232, 240, .36);
		--rq-accent: #5eead4;
		--rq-accent-ink: #062a26;
		--rq-warn: #fbbf24;
		--rq-bad: #f07171;
		--rq-radius: 14px;
		/* типы заявок (палитра страницы аналитики) */
		--rq-t-shtender: #3987e5;
		--rq-t-feedback: #199e70;
		--rq-t-petfoto: #d95926;
		--rq-t-vizitka: #9085e9;
		--rq-t-listovki: #c98500;
		--rq-t-petchat: #d55181;
		--rq-t-other: #7b8494;
		/* статусы */
		--rq-s-new: #5eead4;
		--rq-s-active: #60a5fa;
		--rq-s-wait: #fbbf24;
		--rq-s-paid: #a78bfa;
		--rq-s-closed: #7b8494;
		--rq-s-cancel: #f07171;
		font-family: 'Onest', 'Segoe UI', Tahoma, sans-serif;
		color: var(--rq-text);
	}
	.rq { max-width: 1480px; margin: 0 auto; padding-bottom: 110px; }
	.rq *, .rq *::before, .rq *::after, .rq-layer *, .rq-layer *::before, .rq-layer *::after { box-sizing: border-box; }
	.rq h1, .rq h2, .rq h3, .rq-layer h2, .rq-layer h3 { font-family: inherit; color: var(--rq-text); }
	.rq a, .rq-layer a { color: inherit; }
	.rq [hidden], .rq-layer [hidden] { display: none !important; }

	/* ── шапка ─────────────────────────────── */
	.rq-head { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 16px 32px; margin-bottom: 20px; animation: rq-rise .45s ease both; }
	.rq-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; color: var(--rq-accent); }
	.rq-head h1 { margin: 4px 0 6px; font-size: clamp(28px, 3.2vw, 40px); font-weight: 700; letter-spacing: -.02em; line-height: 1.05; }
	.rq-head p { margin: 0; color: var(--rq-muted); font-size: 14px; }
	.rq-live { display: inline-flex; align-items: center; gap: 8px; }
	.rq-live::before { content: ''; flex: 0 0 8px; width: 8px; height: 8px; border-radius: 50%; background: var(--rq-accent); animation: rq-pulse 2.4s infinite; }
	.rq-live.is-offline::before { background: var(--rq-bad); animation: none; }
	.rq-head-actions { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; }

	/* ── кнопки и сегменты ─────────────────── */
	.rq-btn, .rq-seg {
		display: inline-flex; align-items: center; justify-content: center; gap: 8px;
		height: 36px; padding: 0 13px; border: 1px solid transparent; border-radius: 9px;
		background: transparent; color: var(--rq-muted); font: 600 13.5px 'Onest', sans-serif;
		white-space: nowrap; cursor: pointer; text-decoration: none !important;
		transition: background .15s, color .15s, border-color .15s, opacity .15s;
	}
	.rq-btn { border-color: var(--rq-line); color: var(--rq-text); }
	.rq-btn i { font-size: 18px; }
	.rq-btn:hover, .rq-seg:hover { color: var(--rq-text); background: var(--rq-surface-hi); }
	.rq-btn:focus-visible, .rq-seg:focus-visible, .rq-chip:focus-visible, .rq-row:focus-visible, .rq-icon-btn:focus-visible { outline: 2px solid var(--rq-accent); outline-offset: 1px; }
	.rq-btn:disabled { opacity: .5; cursor: default; background: transparent; }
	.rq-btn.is-spinning i { animation: rq-spin .8s linear infinite; }
	.rq-btn-primary { border-color: var(--rq-accent); background: var(--rq-accent); color: var(--rq-accent-ink); }
	.rq-btn-primary:hover { background: #7ff0dd; color: var(--rq-accent-ink); }
	.rq-btn-primary:disabled { background: var(--rq-accent); color: var(--rq-accent-ink); }
	.rq-btn-danger { color: #fca5a5; border-color: rgba(240, 113, 113, .35); }
	.rq-btn-danger:hover { color: #fecaca; background: rgba(240, 113, 113, .12); }
	.rq-btn-ghost { border-color: transparent; color: var(--rq-muted); }
	.rq-seg.is-active { color: var(--rq-accent-ink); background: var(--rq-accent); }
	.rq-seg b { font: 600 11px/1.4 'JetBrains Mono', monospace; padding: 1px 6px; border-radius: 999px; background: rgba(255, 255, 255, .08); color: inherit; }
	.rq-seg.is-active b { background: rgba(6, 42, 38, .16); }
	.rq-seg.is-zero:not(.is-active) { opacity: .5; }
	.rq-segs { display: inline-flex; gap: 2px; padding: 3px; border: 1px solid var(--rq-line); border-radius: 11px; background: rgba(0, 0, 0, .18); }
	.rq-segs .rq-seg { height: 30px; padding: 0 11px; font-size: 12.5px; border-radius: 8px; }
	.rq-scroll-x { display: flex; gap: 4px; overflow-x: auto; scrollbar-width: none; }
	.rq-scroll-x::-webkit-scrollbar { display: none; }
	.rq-icon-btn {
		display: inline-grid; place-items: center; flex: 0 0 auto; width: 32px; height: 32px; border: 1px solid var(--rq-line); border-radius: 8px;
		background: transparent; color: var(--rq-muted); font-size: 17px; cursor: pointer; text-decoration: none !important; transition: background .15s, color .15s;
	}
	.rq-icon-btn:hover { color: var(--rq-text); background: var(--rq-surface-hi); }
	.rq-icon-btn:disabled { opacity: .35; cursor: default; background: transparent; }
	.rq-kbd {
		display: inline-grid; place-items: center; min-width: 22px; height: 22px; padding: 0 6px; border: 1px solid var(--rq-line); border-bottom-width: 2px;
		border-radius: 6px; color: var(--rq-muted); font: 600 11px 'JetBrains Mono', monospace;
	}
	.rq-btn-primary .rq-kbd { border-color: rgba(6, 42, 38, .25); color: rgba(6, 42, 38, .7); }

	/* ── панель фильтров ───────────────────── */
	.rq-toolbar {
		position: sticky; top: 70px; z-index: 9;
		margin: 0 -12px 16px; padding: 10px 12px;
		border: 1px solid var(--rq-line); border-radius: 18px;
		background: rgba(35, 43, 54, .86);
		backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
		box-shadow: 0 12px 30px -18px rgba(0, 0, 0, .7);
		animation: rq-rise .45s .05s ease both;
	}
	.rq-toolbar-row { display: flex; flex-wrap: wrap; align-items: center; gap: 8px 12px; }
	.rq-toolbar-row + .rq-toolbar-row { margin-top: 10px; }
	.rq-toolbar-row.is-divided { padding-top: 10px; border-top: 1px solid var(--rq-line); }
	.rq-search { position: relative; flex: 1 1 320px; min-width: 0; }
	.rq-search > i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 19px; color: var(--rq-muted); pointer-events: none; }
	.rq-search input {
		width: 100%; height: 42px; padding: 0 76px 0 42px; border: 1px solid var(--rq-line); border-radius: 11px;
		background: rgba(0, 0, 0, .22); color: var(--rq-text); font: 500 14.5px 'Onest', sans-serif; outline: none;
		transition: border-color .15s, box-shadow .15s;
	}
	.rq-search input::placeholder { color: rgba(226, 232, 240, .38); }
	.rq-search input:focus { border-color: var(--rq-accent); box-shadow: 0 0 0 3px rgba(94, 234, 212, .16); }
	.rq-search input::-webkit-search-cancel-button { display: none; }
	.rq-search-aside { position: absolute; right: 8px; top: 50%; transform: translateY(-50%); display: flex; align-items: center; gap: 6px; }
	.rq-search-aside .rq-icon-btn { width: 28px; height: 28px; border: 0; background: var(--rq-surface-hi); color: var(--rq-text); }
	.rq-period { display: flex; flex-wrap: wrap; align-items: center; gap: 6px 10px; }
	.rq-dates { display: flex; align-items: center; gap: 6px; color: var(--rq-muted); font-size: 13px; }
	.rq-dates input, .rq-input {
		height: 36px; padding: 0 10px; border: 1px solid var(--rq-line); border-radius: 9px; background: rgba(0, 0, 0, .22);
		color: var(--rq-text); font: 500 13px 'JetBrains Mono', monospace; color-scheme: dark; outline: none; min-width: 0;
	}
	.rq-dates input:focus, .rq-input:focus { border-color: var(--rq-accent); }
	.rq-fresh {
		display: inline-flex; align-items: center; gap: 8px; height: 32px; padding: 0 12px; border: 1px solid rgba(94, 234, 212, .45); border-radius: 999px;
		background: rgba(94, 234, 212, .14); color: var(--rq-accent); font: 600 13px 'Onest', sans-serif; cursor: pointer; animation: rq-pop .35s ease both;
	}
	.rq-fresh:hover { background: rgba(94, 234, 212, .22); }
	.rq-fresh::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: var(--rq-accent); animation: rq-pulse 1.6s infinite; }

	.rq-chip {
		display: inline-flex; align-items: center; gap: 7px; flex: 0 0 auto; height: 30px; padding: 0 11px;
		border: 1px solid var(--rq-line); border-radius: 999px; background: transparent; color: var(--rq-muted);
		font: 500 12.5px 'Onest', sans-serif; white-space: nowrap; cursor: pointer; transition: background .15s, color .15s, border-color .15s;
	}
	.rq-chip::before { content: ''; width: 8px; height: 8px; border-radius: 3px; background: var(--dot, var(--rq-t-other)); }
	.rq-chip.is-plain::before { display: none; }
	.rq-chip b { font: 600 11px 'JetBrains Mono', monospace; color: var(--rq-text); }
	.rq-chip:hover { color: var(--rq-text); border-color: rgba(255, 255, 255, .22); }
	.rq-chip.is-active { border-color: var(--rq-accent); color: var(--rq-accent); background: rgba(94, 234, 212, .08); }
	.rq-chip.is-zero:not(.is-active) { opacity: .45; }

	/* ── список ────────────────────────────── */
	.rq-listbar { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 8px 16px; margin: 0 2px 10px; color: var(--rq-muted); font-size: 13px; }
	.rq-listbar-left { display: flex; align-items: center; gap: 12px; }
	.rq-listbar b { color: var(--rq-text); font-variant-numeric: tabular-nums; }
	.rq-list { display: grid; gap: 6px; transition: opacity .2s; }
	.rq-list.is-loading { opacity: .5; pointer-events: none; }

	.rq-check { position: relative; display: inline-grid; place-items: center; width: 28px; height: 28px; margin: 0; cursor: pointer; flex: 0 0 auto; }
	.rq-check input { position: absolute; opacity: 0; width: 100%; height: 100%; margin: 0; cursor: pointer; }
	.rq-check span { width: 18px; height: 18px; border: 1.5px solid rgba(255, 255, 255, .28); border-radius: 5px; background: rgba(0, 0, 0, .2); transition: background .12s, border-color .12s; }
	.rq-check input:checked + span { border-color: var(--rq-accent); background: var(--rq-accent) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath d='M3.5 8.5l3 3 6-7' fill='none' stroke='%23062a26' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") center/14px no-repeat; }
	.rq-check input:indeterminate + span { border-color: var(--rq-accent); background: linear-gradient(var(--rq-accent), var(--rq-accent)) center/10px 2px no-repeat, rgba(0, 0, 0, .2); }
	.rq-check input:focus-visible + span { outline: 2px solid var(--rq-accent); outline-offset: 2px; }

	.rq-row {
		position: relative; display: grid; align-items: center; gap: 4px 16px;
		grid-template-columns: 28px 96px minmax(0, 1.35fr) minmax(0, 1fr) 150px 18px;
		min-height: 66px; padding: 10px 12px 10px 10px; border: 1px solid var(--rq-line); border-radius: 12px;
		background: var(--rq-surface); cursor: pointer; transition: background .12s, border-color .12s, opacity .2s;
	}
	.rq-row:hover { background: rgba(255, 255, 255, .045); border-color: rgba(255, 255, 255, .16); }
	.rq-row.is-new { background: linear-gradient(90deg, rgba(94, 234, 212, .075), transparent 45%), var(--rq-surface); }
	.rq-row.is-new::before { content: ''; position: absolute; left: -1px; top: 10px; bottom: 10px; width: 3px; border-radius: 0 3px 3px 0; background: var(--rq-accent); }
	.rq-row.is-open { border-color: var(--rq-accent); box-shadow: 0 0 0 1px var(--rq-accent) inset; }
	.rq-row.is-selected { background: rgba(94, 234, 212, .09); border-color: rgba(94, 234, 212, .4); }
	.rq-row.is-stale { opacity: .55; }
	.rq-row.is-fresh { animation: rq-fresh 2.2s ease; }
	.rq-row.is-removing { opacity: 0; transform: scale(.98); transition: opacity .25s, transform .25s; }
	.rq-row-id b { display: block; font: 600 13px 'JetBrains Mono', monospace; color: var(--rq-text); }
	.rq-row-id time { display: block; margin-top: 3px; color: var(--rq-muted); font-size: 12px; white-space: nowrap; }
	.rq-row-main, .rq-row-client { min-width: 0; }
	.rq-row-type { display: flex; flex-wrap: wrap; align-items: center; gap: 4px 8px; }
	.rq-type { display: inline-flex; align-items: center; gap: 6px; max-width: 100%; color: var(--rq-text); font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
	.rq-type i { flex: 0 0 auto; display: inline-grid; place-items: center; width: 22px; height: 22px; border-radius: 6px; font-size: 14px; color: #fff; background: var(--dot, var(--rq-t-other)); }
	.rq-urgent { display: inline-flex; align-items: center; gap: 3px; padding: 1px 7px 1px 5px; border-radius: 999px; background: rgba(251, 191, 36, .14); color: var(--rq-warn); font-size: 11.5px; font-weight: 600; }
	.rq-urgent i { font-size: 13px; }
	.rq-row-summary { margin-top: 4px; color: var(--rq-muted); font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
	.rq-row-name { font-size: 14px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
	.rq-row-name.is-empty { color: var(--rq-faint); font-weight: 500; }
	.rq-row-contacts { display: flex; flex-wrap: wrap; gap: 2px 12px; margin-top: 3px; font-size: 12.5px; color: var(--rq-muted); min-width: 0; }
	.rq-row-contacts a, .rq-row-contacts span { max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-decoration: none; }
	.rq-row-contacts a { font-family: 'JetBrains Mono', monospace; font-size: 12px; }
	.rq-row-contacts a:hover { color: var(--rq-accent); }
	.rq-row-status { display: flex; flex-direction: column; align-items: flex-start; gap: 5px; min-width: 0; }
	.rq-row-meta { display: flex; align-items: center; gap: 8px; max-width: 100%; color: var(--rq-muted); font-size: 12.5px; }
	.rq-row-meta span { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
	.rq-row-meta i { font-size: 15px; }
	.rq-row-go { color: var(--rq-faint); font-size: 18px; }
	.rq-row:hover .rq-row-go, .rq-row.is-open .rq-row-go { color: var(--rq-accent); }

	.rq-status {
		display: inline-flex; align-items: center; gap: 6px; height: 24px; padding: 0 9px 0 8px; border-radius: 999px;
		background: rgba(255, 255, 255, .06); color: var(--st, var(--rq-muted)); font-size: 12px; font-weight: 600; white-space: nowrap;
	}
	.rq-status::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: var(--st); }
	.rq-status[data-status="new"] { --st: var(--rq-s-new); background: rgba(94, 234, 212, .14); }
	.rq-status[data-status="active"] { --st: var(--rq-s-active); background: rgba(96, 165, 250, .14); }
	.rq-status[data-status="wait"] { --st: var(--rq-s-wait); background: rgba(251, 191, 36, .13); }
	.rq-status[data-status="paid"] { --st: var(--rq-s-paid); background: rgba(167, 139, 250, .14); }
	.rq-status[data-status="closed"] { --st: #aab2bf; background: rgba(170, 178, 191, .12); }
	.rq-status[data-status="cancel"] { --st: var(--rq-s-cancel); background: rgba(240, 113, 113, .13); }

	.rq-more { display: flex; justify-content: center; margin-top: 14px; }
	.rq-more .rq-btn { height: 42px; padding: 0 22px; }
	.rq-state { padding: 56px 20px; border: 1px dashed var(--rq-line); border-radius: var(--rq-radius); text-align: center; color: var(--rq-muted); }
	.rq-state i { display: block; margin-bottom: 8px; font-size: 34px; }
	.rq-state b { display: block; margin-bottom: 4px; color: var(--rq-text); font-size: 15px; }
	.rq-state .rq-btn { margin-top: 14px; }
	.rq-state.is-error { border-color: rgba(240, 113, 113, .35); color: #fca5a5; }
	.rq-skeleton { height: 66px; border-radius: 12px; border: 1px solid var(--rq-line); background: linear-gradient(90deg, rgba(255, 255, 255, .03) 25%, rgba(255, 255, 255, .07) 50%, rgba(255, 255, 255, .03) 75%) 0 0/200% 100%; animation: rq-shimmer 1.3s linear infinite; }

	/* ── нижняя панель выбора ──────────────── */
	.rq-bulk {
		position: fixed; left: 50%; bottom: 22px; z-index: 20; display: flex; flex-wrap: wrap; align-items: center; gap: 8px 10px;
		max-width: calc(100vw - 32px); padding: 8px 8px 8px 16px; border: 1px solid rgba(94, 234, 212, .35); border-radius: 16px;
		background: rgba(22, 27, 36, .95); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
		box-shadow: 0 18px 50px -12px rgba(0, 0, 0, .8);
		transform: translate(-50%, 160%); opacity: 0; pointer-events: none;
		transition: transform .28s cubic-bezier(.2, .9, .3, 1.2), opacity .2s;
	}
	.rq-bulk.is-visible { transform: translate(-50%, 0); opacity: 1; pointer-events: auto; }
	.rq-bulk-text { font-size: 14px; white-space: nowrap; }
	.rq-bulk-text b { color: var(--rq-accent); font-variant-numeric: tabular-nums; }
	.rq-bulk .rq-segs .rq-seg { color: var(--rq-text); }
	.rq-bulk .rq-seg::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: var(--st, var(--rq-muted)); }

	/* ── карточка заявки (панель справа) ───── */
	.rq-backdrop { position: fixed; inset: 0; z-index: 1040; background: rgba(5, 8, 14, .5); opacity: 0; pointer-events: none; transition: opacity .2s; }
	.rq-backdrop.is-visible { opacity: 1; pointer-events: auto; }
	.rq-drawer {
		position: fixed; top: 0; right: 0; bottom: 0; z-index: 1045; display: flex; flex-direction: column;
		width: min(640px, 100vw); border-left: 1px solid var(--rq-line); background: #1b2129;
		box-shadow: -30px 0 60px -30px rgba(0, 0, 0, .9);
		transform: translateX(104%); transition: transform .28s cubic-bezier(.2, .8, .2, 1); visibility: hidden;
	}
	.rq-drawer.is-open { transform: none; visibility: visible; }
	.rq-dr-head { display: flex; align-items: flex-start; gap: 12px; padding: 16px 18px 14px; border-bottom: 1px solid var(--rq-line); }
	.rq-dr-title { flex: 1; min-width: 0; }
	.rq-dr-title h2 { display: flex; flex-wrap: wrap; align-items: center; gap: 6px 10px; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -.01em; }
	.rq-dr-title h2 > span:first-child { font: 600 20px 'JetBrains Mono', monospace; }
	.rq-dr-title .rq-type { font-size: 15px; }
	.rq-dr-sub { margin-top: 6px; color: var(--rq-muted); font-size: 13px; }
	.rq-dr-nav { display: flex; gap: 6px; }
	.rq-dr-body { flex: 1; overflow-y: auto; overscroll-behavior: contain; padding: 4px 18px 24px; }
	.rq-dr-foot { display: flex; flex-wrap: wrap; align-items: center; gap: 8px; padding: 12px 18px; border-top: 1px solid var(--rq-line); background: rgba(0, 0, 0, .18); }
	.rq-dr-foot .rq-grow { flex: 1; }
	.rq-dr-foot .rq-btn { height: 40px; }
	.rq-dr-foot .rq-dirty { color: var(--rq-warn); font-size: 12.5px; }
	.rq-dr-foot .rq-dirty { display: none; }
	.rq-btn-primary.is-dirty { box-shadow: 0 0 0 3px rgba(94, 234, 212, .25); }
	.rq-params dt { display: flex; align-items: center; }
	.rq-section { padding: 16px 0; border-bottom: 1px solid rgba(255, 255, 255, .06); }
	.rq-section:last-child { border-bottom: 0; }
	.rq-section-head { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 10px; }
	.rq-section-head h3 { margin: 0; color: var(--rq-muted); font-size: 11.5px; font-weight: 600; letter-spacing: .12em; text-transform: uppercase; }
	.rq-section-head .rq-btn { height: 30px; padding: 0 10px; font-size: 12.5px; }
	.rq-status-pick { display: flex; flex-wrap: wrap; gap: 6px; }
	.rq-status-pick button {
		display: inline-flex; align-items: center; gap: 7px; height: 34px; padding: 0 12px; border: 1px solid var(--rq-line); border-radius: 9px;
		background: transparent; color: var(--rq-muted); font: 600 13px 'Onest', sans-serif; cursor: pointer; transition: background .12s, color .12s, border-color .12s;
	}
	.rq-status-pick button::before { content: ''; width: 8px; height: 8px; border-radius: 50%; background: var(--st); }
	.rq-status-pick button:hover { color: var(--rq-text); border-color: rgba(255, 255, 255, .22); }
	.rq-status-pick button.is-active { color: var(--rq-text); border-color: var(--st); background: rgba(255, 255, 255, .06); box-shadow: 0 0 0 1px var(--st) inset; }
	.rq-hint { margin-top: 8px; color: var(--rq-muted); font-size: 12.5px; }
	.rq-hint.is-warn { color: #fde68a; }

	.rq-client-name { margin-bottom: 10px; font-size: 18px; font-weight: 600; word-break: break-word; }
	.rq-contact { display: flex; align-items: center; gap: 8px; min-height: 40px; padding: 4px 4px 4px 12px; border: 1px solid var(--rq-line); border-radius: 10px; background: rgba(0, 0, 0, .16); }
	.rq-contact + .rq-contact { margin-top: 6px; }
	.rq-contact > i { color: var(--rq-muted); font-size: 18px; }
	.rq-contact-value { flex: 1; min-width: 0; font: 500 14px 'JetBrains Mono', monospace; word-break: break-all; }
	.rq-contact-value.is-empty { color: var(--rq-faint); font-family: 'Onest', sans-serif; }
	.rq-contact .rq-btn { height: 32px; padding: 0 10px; font-size: 12.5px; }

	.rq-params { display: grid; grid-template-columns: minmax(120px, 36%) 1fr; gap: 0; margin: 0; }
	.rq-params dt, .rq-params dd { margin: 0; padding: 8px 0; border-bottom: 1px solid rgba(255, 255, 255, .05); font-size: 14px; }
	.rq-params dt { padding-right: 12px; color: var(--rq-muted); font-weight: 500; }
	.rq-params dd { min-width: 0; word-break: break-word; }
	.rq-params dd.is-empty { color: var(--rq-faint); }
	.rq-params .rq-params-group { grid-column: 1 / -1; padding: 12px 0 2px; border: 0; color: var(--rq-accent); font-size: 12px; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; }
	.rq-params select, .rq-params input, .rq-field input, .rq-field textarea {
		width: 100%; min-height: 36px; padding: 6px 10px; border: 1px solid var(--rq-line); border-radius: 8px; background: rgba(0, 0, 0, .26);
		color: var(--rq-text); font: 500 14px 'Onest', sans-serif; outline: none; color-scheme: dark; transition: border-color .12s, box-shadow .12s;
	}
	.rq-params select option { background: #1b2129; color: var(--rq-text); }
	.rq-params select:focus, .rq-params input:focus, .rq-field input:focus, .rq-field textarea:focus { border-color: var(--rq-accent); box-shadow: 0 0 0 3px rgba(94, 234, 212, .14); }
	.rq-params .is-dirty, .rq-field .is-dirty { border-color: rgba(251, 191, 36, .75); background: rgba(251, 191, 36, .1); }
	.rq-field { display: block; margin: 0 0 12px; }
	.rq-field > span { display: flex; justify-content: space-between; margin-bottom: 6px; color: var(--rq-muted); font-size: 12.5px; font-weight: 500; }
	.rq-field > span small { font: 500 11px 'JetBrains Mono', monospace; color: var(--rq-faint); }
	.rq-field input { height: 40px; font: 600 15px 'JetBrains Mono', monospace; }
	.rq-field textarea { min-height: 96px; resize: vertical; line-height: 1.45; }

	.rq-files { display: grid; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); gap: 10px; }
	.rq-file { display: flex; flex-direction: column; min-width: 0; border: 1px solid var(--rq-line); border-radius: 12px; background: rgba(0, 0, 0, .18); overflow: hidden; }
	.rq-file-thumb { display: grid; place-items: center; height: 130px; background: repeating-conic-gradient(rgba(255, 255, 255, .04) 0 25%, transparent 0 50%) 0 0/16px 16px; color: var(--rq-muted); font-size: 34px; overflow: hidden; }
	.rq-file-thumb img { width: 100%; height: 100%; object-fit: contain; }
	.rq-file-foot { display: flex; align-items: center; gap: 6px; padding: 8px 8px 8px 10px; }
	.rq-file-meta { flex: 1; min-width: 0; }
	.rq-file-meta b { display: block; font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
	.rq-file-meta small { display: block; color: var(--rq-muted); font: 500 11px 'JetBrains Mono', monospace; }
	.rq-file.is-missing { border-style: dashed; }
	.rq-file.is-missing .rq-file-thumb { background: none; color: var(--rq-faint); font-size: 26px; }
	.rq-quote { margin: 0; padding: 10px 12px; border-left: 3px solid var(--rq-line); border-radius: 0 8px 8px 0; background: rgba(0, 0, 0, .16); color: var(--rq-text); font-size: 14px; white-space: pre-wrap; word-break: break-word; }
	.rq-meta-line { display: flex; flex-wrap: wrap; gap: 4px 14px; color: var(--rq-faint); font-size: 12px; }
	.rq-meta-line code { color: var(--rq-muted); background: none; font: 500 11.5px 'JetBrains Mono', monospace; }

	@keyframes rq-spin { to { transform: rotate(360deg); } }
	@keyframes rq-rise { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: none; } }
	@keyframes rq-pop { from { opacity: 0; transform: scale(.9); } to { opacity: 1; transform: none; } }
	@keyframes rq-pulse { 0% { box-shadow: 0 0 0 0 rgba(94, 234, 212, .5); } 70% { box-shadow: 0 0 0 8px rgba(94, 234, 212, 0); } 100% { box-shadow: 0 0 0 0 rgba(94, 234, 212, 0); } }
	@keyframes rq-fresh { 0%, 30% { box-shadow: 0 0 0 2px var(--rq-accent) inset; background: rgba(94, 234, 212, .16); } 100% { box-shadow: 0 0 0 0 transparent inset; } }
	@keyframes rq-shimmer { to { background-position: -200% 0; } }

	@media (max-width: 1100px) {
		.rq-row { grid-template-columns: 28px 86px minmax(0, 1fr) minmax(0, 1fr) 18px; }
		.rq-row-status { grid-column: 3 / 5; flex-direction: row; align-items: center; flex-wrap: wrap; gap: 6px 12px; }
		.rq-row-go { grid-column: 5; grid-row: 1; }
	}
	@media (max-width: 767px) {
		.page-content { padding: 16px; }
		.rq-head { margin-bottom: 14px; }
		.rq-head-actions .rq-btn span { display: none; }
		.rq-toolbar { position: static; margin: 0 -6px 12px; padding: 8px; animation: none; }
		.rq-search { flex-basis: 100%; }
		.rq-search .rq-kbd { display: none; }
		.rq-period { width: 100%; }
		.rq-period .rq-scroll-x { width: 100%; }
		.rq-dates { width: 100%; }
		.rq-dates input { flex: 1; }
		.rq-row {
			grid-template-columns: 28px minmax(0, 1fr) auto; grid-template-areas: "chk id go" "chk main main" "chk client client" "chk status status";
			align-items: start; gap: 6px 10px; padding: 10px 12px 12px 8px;
		}
		.rq-row .rq-check { grid-area: chk; }
		.rq-row-id { grid-area: id; display: flex; align-items: baseline; gap: 10px; }
		.rq-row-id time { margin: 0; }
		.rq-row-main { grid-area: main; }
		.rq-row-client { grid-area: client; }
		.rq-row-status { grid-area: status; grid-column: auto; flex-direction: row; flex-wrap: wrap; align-items: center; }
		.rq-row-go { grid-area: go; grid-column: auto; grid-row: auto; }
		.rq-row-summary { white-space: normal; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
		.rq-bulk { left: 12px; right: 12px; bottom: 12px; max-width: none; transform: translateY(160%); padding-left: 12px; }
		.rq-bulk.is-visible { transform: none; }
		.rq-bulk .rq-segs { order: 3; width: 100%; overflow-x: auto; scrollbar-width: none; }
		.rq-bulk .rq-bulk-text { flex: 1; }
		.rq-dr-head { padding: 12px 12px 10px; }
		.rq-dr-body { padding: 0 12px 20px; }
		.rq-dr-foot { padding: 10px 12px; }
		.rq-dr-foot .rq-kbd, .rq-dr-foot .rq-dirty { display: none; }
		.rq-params { grid-template-columns: 1fr; }
		.rq-params dt { padding-bottom: 0; border-bottom: 0; font-size: 12.5px; }
		.rq-params dd { padding-top: 4px; }
		.rq-files { grid-template-columns: repeat(2, minmax(0, 1fr)); }
		.rq-contact { flex-wrap: wrap; padding: 8px; }
		.rq-contact-value { flex-basis: calc(100% - 30px); }
	}
	@media (prefers-reduced-motion: reduce) {
		.rq *, .rq-layer, .rq-layer * { animation: none !important; transition: none !important; }
	}
</style>

		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="rq" id="rq">

						<div class="rq-head">
							<div>
								<span class="rq-eyebrow">Заявки с сайта</span>
								<h1>Обработка заявок</h1>
								<p class="rq-live" id="rqLive">Загрузка…</p>
							</div>
							<div class="rq-head-actions">
								<button type="button" class="rq-btn" id="rqExport" title="Скачать заявки по текущим фильтрам (CSV для Excel)"><i class="bx bx-download"></i><span>Экспорт</span></button>
								<button type="button" class="rq-btn" id="rqRefresh" title="Обновить список"><i class="bx bx-refresh"></i><span>Обновить</span></button>
							</div>
						</div>

						<div class="rq-toolbar" id="rqToolbar">
							<div class="rq-toolbar-row">
								<label class="rq-search">
									<i class="bx bx-search"></i>
									<input type="search" id="rqSearch" placeholder="Номер, имя, телефон, email, ФИО на штендере…" autocomplete="off" aria-label="Поиск заявок" maxlength="100">
									<span class="rq-search-aside">
										<button type="button" class="rq-icon-btn" id="rqSearchClear" title="Очистить" hidden><i class="bx bx-x"></i></button>
										<span class="rq-kbd" title="Быстрый поиск">/</span>
									</span>
								</label>
								<div class="rq-period">
									<div class="rq-segs rq-scroll-x" role="group" aria-label="Период">
										<button type="button" class="rq-seg" data-preset="all">Всё время</button>
										<button type="button" class="rq-seg" data-preset="today">Сегодня</button>
										<button type="button" class="rq-seg" data-preset="7d">7 дней</button>
										<button type="button" class="rq-seg" data-preset="30d">30 дней</button>
										<button type="button" class="rq-seg" data-preset="year">Этот год</button>
									</div>
									<label class="rq-dates">
										<input type="date" id="rqFrom" aria-label="С даты">
										<span>—</span>
										<input type="date" id="rqTo" aria-label="По дату">
									</label>
								</div>
								<button type="button" class="rq-fresh" id="rqFresh" hidden></button>
							</div>
							<div class="rq-toolbar-row is-divided">
								<div class="rq-scroll-x" id="rqStatuses" role="group" aria-label="Статус"></div>
							</div>
							<div class="rq-toolbar-row">
								<div class="rq-scroll-x" id="rqTypes" role="group" aria-label="Тип заявки"></div>
							</div>
						</div>

						<div class="rq-listbar">
							<div class="rq-listbar-left">
								<label class="rq-check" title="Выбрать все показанные"><input type="checkbox" id="rqSelectPage"><span></span></label>
								<span id="rqFound">&nbsp;</span>
							</div>
							<div class="rq-segs" role="group" aria-label="Сортировка">
								<button type="button" class="rq-seg" data-sort="new"><i class="bx bx-sort-down"></i>Сначала новые</button>
								<button type="button" class="rq-seg" data-sort="old"><i class="bx bx-sort-up"></i>Сначала старые</button>
							</div>
						</div>

						<div class="rq-list" id="rqList" aria-live="polite">
							<div class="rq-skeleton"></div><div class="rq-skeleton"></div><div class="rq-skeleton"></div><div class="rq-skeleton"></div>
						</div>
						<div class="rq-more" id="rqMore" hidden><button type="button" class="rq-btn" id="rqMoreBtn">Показать ещё</button></div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="rq-layer">
		<div class="rq-bulk" id="rqBulk" role="region" aria-label="Выбранные заявки">
			<span class="rq-bulk-text">Выбрано: <b id="rqBulkCount">0</b></span>
			<button type="button" class="rq-btn rq-btn-ghost" id="rqBulkAll" hidden></button>
			<div class="rq-segs" id="rqBulkStatuses" role="group" aria-label="Сменить статус"></div>
			<button type="button" class="rq-icon-btn" id="rqBulkClear" title="Снять выбор"><i class="bx bx-x"></i></button>
		</div>

		<div class="rq-backdrop" id="rqBackdrop"></div>
		<aside class="rq-drawer" id="rqDrawer" role="dialog" aria-modal="true" aria-labelledby="rqDrTitle" tabindex="-1">
			<div class="rq-dr-head">
				<div class="rq-dr-title">
					<h2 id="rqDrTitle"></h2>
					<div class="rq-dr-sub" id="rqDrSub"></div>
				</div>
				<div class="rq-dr-nav">
					<button type="button" class="rq-icon-btn" id="rqDrPrev" title="Предыдущая заявка (K)"><i class="bx bx-chevron-left"></i></button>
					<button type="button" class="rq-icon-btn" id="rqDrNext" title="Следующая заявка (J)"><i class="bx bx-chevron-right"></i></button>
					<button type="button" class="rq-icon-btn" id="rqDrClose" title="Закрыть (Esc)"><i class="bx bx-x"></i></button>
				</div>
			</div>
			<div class="rq-dr-body" id="rqDrBody"></div>
			<div class="rq-dr-foot">
				<button type="button" class="rq-btn rq-btn-danger" id="rqDelete"><i class="bx bx-trash"></i>Удалить</button>
				<span class="rq-grow"></span>
				<span class="rq-dirty" id="rqDirty" hidden>Есть несохранённые изменения</span>
				<button type="button" class="rq-btn" id="rqReset" hidden>Отменить</button>
				<button type="button" class="rq-btn rq-btn-primary" id="rqSave">Сохранить</button>
			</div>
		</aside>
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
	'use strict';

	var API = window.RQ_API || 'api/requests/';
	var TYPES = <?= json_encode($rqTypes, $rqJsonFlags) ?>;
	var STATUSES = <?= json_encode($rqStatuses, $rqJsonFlags) ?>;
	var LIMIT = 40;
	var POLL_MS = 60 * 1000;
	var TYPE_ORDER = Object.keys(TYPES).concat(['other']);
	var TYPE_COLORS = { shtender: '--rq-t-shtender', feedback: '--rq-t-feedback', petfoto: '--rq-t-petfoto', vizitka: '--rq-t-vizitka', listovki: '--rq-t-listovki', petchat: '--rq-t-petchat' };
	var STATUS_FILTERS = [
		{ key: 'open', label: 'Открытые' },
		{ key: 'new', label: 'Новые' }, { key: 'active', label: 'В работе' }, { key: 'wait', label: 'Ожидание' }, { key: 'paid', label: 'Оплаченные' },
		{ key: 'done', label: 'Завершённые' },
		{ key: 'closed', label: 'Закрытые' }, { key: 'cancel', label: 'Отменённые' },
		{ key: 'all', label: 'Все' }
	];
	var STATUS_COLORS = { new: '#5eead4', active: '#60a5fa', wait: '#fbbf24', paid: '#a78bfa', closed: '#aab2bf', cancel: '#f07171' };
	var MONTHS_GEN = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
	var MONTHS_SHORT = ['янв', 'фев', 'мар', 'апр', 'мая', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'];
	var BASE_TITLE = document.title;

	var $ = function (id) { return document.getElementById(id); };
	var root = $('rq');
	var listEl = $('rqList');
	var drawer = $('rqDrawer');

	var state = {
		f: { status: 'open', type: '', search: '', from: '', to: '', sort: 'new', preset: 'all' },
		items: [], byId: {}, total: 0, page: 0, pages: 0,
		counts: null, maxId: 0, seenMaxId: 0, announcedMaxId: 0, freshSince: 0, offset: 0,
		selected: {}, loadSeq: 0, loadedAt: null, offline: false,
		drawerId: null, editParams: false, form: null, saving: false
	};

	// ── утилиты ────────────────────────────────
	function esc(s) {
		return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
			return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
		});
	}
	var nf = new Intl.NumberFormat('ru-RU');
	function plural(n, one, few, many) {
		var m10 = n % 10, m100 = n % 100;
		if (m10 === 1 && m100 !== 11) return one;
		if (m10 >= 2 && m10 <= 4 && (m100 < 12 || m100 > 14)) return few;
		return many;
	}
	function pad(n) { return String(n).padStart(2, '0'); }
	function ymd(d) { return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate()); }
	function parseLocal(s) {
		var m = /^(\d{4})-(\d{2})-(\d{2})[ T](\d{2}):(\d{2})(?::(\d{2}))?/.exec(s || '');
		return m ? new Date(+m[1], +m[2] - 1, +m[3], +m[4], +m[5], +(m[6] || 0)) : null;
	}
	/** «Сейчас» по часам сервера: время заявок записано в его часовом поясе. */
	function serverNow() { return new Date(Date.now() + state.offset); }
	function hm(d) { return pad(d.getHours()) + ':' + pad(d.getMinutes()); }
	function absTime(s, raw) {
		var d = parseLocal(s);
		if (!d) return raw || '—';
		return d.getDate() + ' ' + MONTHS_GEN[d.getMonth()] + ' ' + d.getFullYear() + ', ' + hm(d);
	}
	function relTime(s, raw) {
		var d = parseLocal(s);
		if (!d) return raw || '—';
		var now = serverNow();
		var sec = (now - d) / 1000;
		var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
		if (sec < 60) return 'только что';
		if (sec < 3600) { var mi = Math.floor(sec / 60); return mi + ' мин назад'; }
		if (d >= today) { var h = Math.floor(sec / 3600); return h + ' ' + plural(h, 'час', 'часа', 'часов') + ' назад'; }
		if (d >= new Date(today.getTime() - 864e5)) return 'вчера, ' + hm(d);
		var days = Math.floor((today - new Date(d.getFullYear(), d.getMonth(), d.getDate())) / 864e5);
		if (days < 7) return days + ' ' + plural(days, 'день', 'дня', 'дней') + ' назад';
		if (d.getFullYear() === now.getFullYear()) return d.getDate() + ' ' + MONTHS_SHORT[d.getMonth()];
		return d.getDate() + ' ' + MONTHS_SHORT[d.getMonth()] + ' ' + d.getFullYear();
	}
	function sizeLabel(bytes) {
		if (!bytes) return '';
		if (bytes < 1024) return bytes + ' Б';
		if (bytes < 1048576) return Math.round(bytes / 1024) + ' КБ';
		return (bytes / 1048576).toFixed(1).replace('.', ',') + ' МБ';
	}
	function typeInfo(item) {
		var t = TYPES[item.type];
		return t ? t : { label: item.typeLabel || 'Другое', full: item.typeLabel || 'Другое', icon: 'bx-help-circle', fields: [], clientComment: false };
	}
	function typeColor(key) { return 'var(' + (TYPE_COLORS[key] || '--rq-t-other') + ')'; }
	function typeBadge(item, full) {
		var t = typeInfo(item);
		return '<span class="rq-type" style="--dot:' + typeColor(item.type) + '"><i class="bx ' + esc(t.icon) + '"></i>' + esc(full ? t.full : t.label) + '</span>';
	}
	function statusPill(key) {
		return '<span class="rq-status" data-status="' + esc(key) + '">' + esc(STATUSES[key] ? STATUSES[key].label : key) + '</span>';
	}
	function isOpenStatus(key) { return STATUSES[key] && STATUSES[key].open; }
	function qs(params) {
		return Object.keys(params).filter(function (k) { return params[k] !== '' && params[k] != null; }).map(function (k) {
			return encodeURIComponent(k) + '=' + encodeURIComponent(params[k]);
		}).join('&');
	}
	function filterParams() {
		return { status: state.f.status, type: state.f.type, search: state.f.search, from: state.f.from, to: state.f.to, sort: state.f.sort };
	}
	function copyText(text) {
		function fallback() {
			var ta = document.createElement('textarea');
			ta.value = text; ta.setAttribute('readonly', ''); ta.style.position = 'fixed'; ta.style.opacity = '0';
			document.body.appendChild(ta); ta.select();
			try { document.execCommand('copy'); } catch (e) {}
			document.body.removeChild(ta);
		}
		if (navigator.clipboard && window.isSecureContext) {
			navigator.clipboard.writeText(text).catch(fallback);
		} else {
			fallback();
		}
		toastr.success('Скопировано: ' + text);
	}

	function api(path, opts) {
		opts = opts || {};
		var init = { method: opts.method || 'GET', credentials: 'same-origin', cache: 'no-store', headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } };
		if (opts.body !== undefined) {
			init.headers['Content-Type'] = 'application/json';
			init.body = JSON.stringify(opts.body);
		}
		return fetch(API + path, init).then(function (r) {
			return r.json().catch(function () { return { error: 'Ответ сервера не распознан (' + r.status + ')' }; }).then(function (data) {
				if (!r.ok) {
					var err = new Error(r.status === 401 ? 'Сессия истекла — обновите страницу и войдите заново' : (data.error || 'Ошибка ' + r.status));
					err.status = r.status;
					err.data = data;
					throw err;
				}
				return data;
			});
		}, function () {
			throw new Error('Нет связи с сервером');
		});
	}

	// ── фильтры и адрес страницы ───────────────
	function readHash() {
		var out = {};
		(location.hash || '').slice(1).split('&').forEach(function (p) {
			var i = p.indexOf('=');
			if (i > 0) {
				try { out[p.slice(0, i)] = decodeURIComponent(p.slice(i + 1)); } catch (e) {}
			}
		});
		return out;
	}
	function saveHash() {
		var p = {};
		if (state.f.status !== 'open') p.status = state.f.status;
		if (state.f.type) p.type = state.f.type;
		if (state.f.search) p.search = state.f.search;
		if (state.f.preset && state.f.preset !== 'all' && state.f.preset !== 'custom') p.preset = state.f.preset;
		else if (state.f.preset === 'custom') { p.from = state.f.from; p.to = state.f.to; }
		if (state.f.sort !== 'new') p.sort = state.f.sort;
		if (state.drawerId) p.id = state.drawerId;
		var hash = qs(p);
		try { history.replaceState(null, '', location.href.split('#')[0] + (hash ? '#' + hash : '')); } catch (e) {}
	}
	function presetRange(preset) {
		var now = serverNow();
		var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
		switch (preset) {
			case 'today': return [today, today];
			case '7d': return [new Date(today.getTime() - 6 * 864e5), today];
			case '30d': return [new Date(today.getTime() - 29 * 864e5), today];
			case 'year': return [new Date(today.getFullYear(), 0, 1), today];
		}
		return null;
	}
	function applyPreset(preset) {
		var range = presetRange(preset);
		state.f.preset = range ? preset : 'all';
		state.f.from = range ? ymd(range[0]) : '';
		state.f.to = range ? ymd(range[1]) : '';
	}
	function setFilter(changes) {
		Object.keys(changes).forEach(function (k) { state.f[k] = changes[k]; });
		clearSelection(true);
		renderControls();
		saveHash();
		load();
	}

	function renderControls() {
		root.querySelectorAll('[data-preset]').forEach(function (b) {
			b.classList.toggle('is-active', b.getAttribute('data-preset') === state.f.preset);
		});
		root.querySelectorAll('[data-sort]').forEach(function (b) {
			b.classList.toggle('is-active', b.getAttribute('data-sort') === state.f.sort);
		});
		$('rqFrom').value = state.f.from;
		$('rqTo').value = state.f.to;
		if ($('rqSearch').value !== state.f.search && document.activeElement !== $('rqSearch')) $('rqSearch').value = state.f.search;
		$('rqSearchClear').hidden = !$('rqSearch').value;
		renderCounts();
	}

	function renderCounts() {
		var c = state.counts;
		$('rqStatuses').innerHTML = STATUS_FILTERS.map(function (s) {
			var label = s.label || STATUSES[s.key].label;
			var n = c ? c.status[s.key] : null;
			var title = STATUSES[s.key] ? STATUSES[s.key].hint : (s.key === 'open' ? 'Новые, в работе, ожидание и оплаченные' : s.key === 'done' ? 'Закрытые и отменённые' : 'Все заявки');
			return '<button type="button" class="rq-seg' + (state.f.status === s.key ? ' is-active' : '') + (n === 0 ? ' is-zero' : '') + '" data-status="' + s.key + '" title="' + esc(title) + '">'
				+ esc(label) + (n != null ? ' <b>' + nf.format(n) + '</b>' : '') + '</button>';
		}).join('');

		var types = TYPE_ORDER.filter(function (key) {
			return key === state.f.type || !c || c.type[key] > 0 || TYPES[key] && key !== 'other' && ['shtender', 'feedback', 'petfoto', 'vizitka', 'listovki', 'petchat'].indexOf(key) !== -1;
		});
		$('rqTypes').innerHTML = '<button type="button" class="rq-chip is-plain' + (state.f.type === '' ? ' is-active' : '') + '" data-type="">Все типы' + (c ? ' <b>' + nf.format(c.type.all) + '</b>' : '') + '</button>'
			+ types.map(function (key) {
				var label = TYPES[key] ? TYPES[key].label : 'Другие';
				var n = c ? c.type[key] : null;
				return '<button type="button" class="rq-chip' + (state.f.type === key ? ' is-active' : '') + (n === 0 ? ' is-zero' : '') + '" data-type="' + key + '" style="--dot:' + typeColor(key) + '">'
					+ esc(label) + (n != null ? ' <b>' + nf.format(n) + '</b>' : '') + '</button>';
			}).join('');
	}

	// ── загрузка списка ────────────────────────
	function load(opts) {
		opts = opts || {};
		var seq = ++state.loadSeq;
		var append = !!opts.append;
		var page = append ? state.page + 1 : 1;
		var params = filterParams();
		params.page = page;
		params.limit = LIMIT;

		var btn = $('rqRefresh');
		btn.classList.add('is-spinning');
		if (!append && state.items.length) listEl.classList.add('is-loading');
		if (append) { $('rqMoreBtn').disabled = true; $('rqMoreBtn').textContent = 'Загрузка…'; }

		return api('?' + qs(params)).then(function (data) {
			if (seq !== state.loadSeq) return;
			syncClock(data.now);
			var prevSeen = state.seenMaxId;
			state.counts = data.counts;
			state.total = data.total;
			state.page = data.page;
			state.pages = data.pages;
			state.maxId = Math.max(state.maxId, data.maxId);
			if (!append) {
				var openItem = state.drawerId ? state.byId[state.drawerId] : null;
				state.freshSince = opts.fresh ? prevSeen : 0;
				state.items = [];
				state.byId = {};
				if (openItem) state.byId[openItem.id] = openItem;
				state.seenMaxId = data.maxId;
				state.announcedMaxId = Math.max(state.announcedMaxId, data.maxId);
				setFresh(0);
			}
			data.items.forEach(function (item) {
				if (indexOfItem(item.id) === -1) state.items.push(item);
				if (!(state.drawerId === item.id && isDirty())) state.byId[item.id] = item;
			});
			state.loadedAt = new Date();
			setOffline(false);
			renderCounts();
			renderList(append ? data.items : null);
			if (!append && opts.scrollTop) window.scrollTo({ top: 0, behavior: 'smooth' });
			if (state.drawerId && !isDirty()) {
				var fresh = state.byId[state.drawerId];
				if (fresh) { resetForm(fresh); renderDrawer(); }
			}
		}).catch(function (e) {
			if (seq !== state.loadSeq) return;
			if (opts.silent && state.items.length) { setOffline(true); return; }
			renderError(e);
		}).then(function () {
			if (seq !== state.loadSeq) return;
			btn.classList.remove('is-spinning');
			listEl.classList.remove('is-loading');
			$('rqMoreBtn').disabled = false;
			renderMore();
		});
	}

	/** Только счётчики (после сохранения, смены статуса, удаления). */
	function refreshCounts() {
		var params = filterParams();
		params.limit = 10;
		return api('?' + qs(params)).then(function (data) {
			syncClock(data.now);
			state.counts = data.counts;
			state.total = data.total;
			renderCounts();
			renderFound();
		}).catch(function () {});
	}

	function syncClock(now) {
		var d = parseLocal(now);
		if (d) state.offset = d.getTime() - Date.now();
	}

	function setOffline(offline) {
		state.offline = offline;
		updateLive();
	}
	function updateLive() {
		var el = $('rqLive');
		el.classList.toggle('is-offline', state.offline);
		if (state.offline) { el.textContent = 'Нет связи с сервером — повторим через минуту'; return; }
		if (!state.loadedAt) return;
		el.textContent = 'Обновлено в ' + hm(state.loadedAt) + ' · новые заявки проверяются каждую минуту';
	}

	function renderFound() {
		var shown = state.items.length;
		var text = 'Найдено <b>' + nf.format(state.total) + '</b> ' + plural(state.total, 'заявка', 'заявки', 'заявок');
		if (state.total > shown) text += ' · показано ' + nf.format(shown);
		$('rqFound').innerHTML = text;
	}

	function renderMore() {
		var left = state.total - state.items.length;
		$('rqMore').hidden = left <= 0 || state.page >= state.pages;
		$('rqMoreBtn').textContent = 'Показать ещё ' + Math.min(LIMIT, left) + ' из ' + nf.format(left);
	}

	function rowHtml(item) {
		var t = typeInfo(item);
		var summary = item.summary || (item.comment ? item.comment.replace(/\s+/g, ' ') : '') || t.full;
		var contacts = '';
		if (item.phone) {
			contacts += item.phoneHref ? '<a href="tel:' + esc(item.phoneHref) + '" title="Позвонить">' + esc(item.phone) + '</a>' : '<span>' + esc(item.phone) + '</span>';
		}
		if (item.email) {
			contacts += item.emailValid ? '<a href="mailto:' + esc(item.email) + '" title="Написать">' + esc(item.email) + '</a>' : '<span>' + esc(item.email) + '</span>';
		}
		var meta = '';
		if (item.price) meta += '<span title="Цена">' + esc(item.price) + '</span>';
		if (item.comment && !t.clientComment) meta += '<span title="' + esc(item.comment) + '"><i class="bx bx-message-dots"></i></span>';
		var cls = 'rq-row'
			+ (item.status === 'new' ? ' is-new' : '')
			+ (state.selected[item.id] ? ' is-selected' : '')
			+ (state.drawerId === item.id ? ' is-open' : '')
			+ (state.freshSince && item.id > state.freshSince ? ' is-fresh' : '')
			+ (item.stale ? ' is-stale' : '');
		return '<article class="' + cls + '" data-id="' + item.id + '" tabindex="0" aria-label="Заявка ' + item.id + '">'
			+ '<label class="rq-check" title="Выбрать"><input type="checkbox" data-select="' + item.id + '"' + (state.selected[item.id] ? ' checked' : '') + '><span></span></label>'
			+ '<div class="rq-row-id"><b>№' + item.id + '</b><time datetime="' + esc(item.created || '') + '" title="' + esc(absTime(item.created, item.createdRaw)) + '">' + esc(relTime(item.created, item.createdRaw)) + '</time></div>'
			+ '<div class="rq-row-main"><div class="rq-row-type">' + typeBadge(item)
			+ (item.urgent && isOpenStatus(item.status) ? '<span class="rq-urgent" title="Клиент выбрал срочное изготовление"><i class="bx bx-bolt-circle"></i>Срочно</span>' : '') + '</div>'
			+ '<div class="rq-row-summary" title="' + esc(summary) + '">' + esc(summary) + '</div></div>'
			+ '<div class="rq-row-client"><div class="rq-row-name' + (item.name ? '' : ' is-empty') + '">' + esc(item.name || 'Имя не указано') + '</div>'
			+ (contacts ? '<div class="rq-row-contacts">' + contacts + '</div>' : '') + '</div>'
			+ '<div class="rq-row-status">' + statusPill(item.status) + (meta ? '<div class="rq-row-meta">' + meta + '</div>' : '') + '</div>'
			+ '<i class="bx bx-chevron-right rq-row-go" aria-hidden="true"></i>'
			+ '</article>';
	}

	function renderList(appended) {
		renderFound();
		if (!state.items.length) {
			var filtered = state.f.status !== 'all' || state.f.type || state.f.search || state.f.from || state.f.to;
			listEl.innerHTML = '<div class="rq-state"><i class="bx bx-check-double"></i><b>' + (filtered ? 'Заявок не найдено' : 'Заявок пока нет') + '</b>'
				+ (filtered ? 'Попробуйте изменить фильтры или поиск.<br><button type="button" class="rq-btn" data-action="reset-filters">Сбросить фильтры</button>' : '') + '</div>';
		} else if (appended) {
			listEl.insertAdjacentHTML('beforeend', appended.map(rowHtml).join(''));
		} else {
			listEl.innerHTML = state.items.map(rowHtml).join('');
		}
		renderSelection();
	}

	function renderError(e) {
		listEl.innerHTML = '<div class="rq-state is-error"><i class="bx bx-error-circle"></i><b>Не удалось загрузить заявки</b>' + esc(e.message)
			+ '<br><button type="button" class="rq-btn" data-action="' + (e.status === 401 ? 'relogin' : 'retry') + '">' + (e.status === 401 ? 'Обновить страницу' : 'Повторить') + '</button></div>';
		$('rqFound').innerHTML = '&nbsp;';
		$('rqMore').hidden = true;
	}

	function updateRow(item) {
		var el = listEl.querySelector('.rq-row[data-id="' + item.id + '"]');
		if (!el) return;
		var tmp = document.createElement('div');
		tmp.innerHTML = rowHtml(item);
		el.parentNode.replaceChild(tmp.firstChild, el);
	}

	/** Совпадает ли заявка с фильтром статуса/типа (после изменения — подсвечиваем «выпавшие»). */
	function matchesFilter(item) {
		var s = state.f.status;
		var okStatus = s === 'all' || s === item.status || (s === 'open' && isOpenStatus(item.status)) || (s === 'done' && !isOpenStatus(item.status));
		var okType = !state.f.type || state.f.type === item.type;
		return okStatus && okType;
	}

	function replaceItem(item) {
		item.stale = !matchesFilter(item);
		state.byId[item.id] = item;
		for (var i = 0; i < state.items.length; i++) {
			if (state.items[i].id === item.id) state.items[i] = item;
		}
		updateRow(item);
	}

	// ── новые заявки (автообновление) ──────────
	function poll() {
		if (!state.loadedAt) return;
		api('poll?since=' + state.seenMaxId).then(function (data) {
			syncClock(data.now);
			setOffline(false);
			setFresh(data.fresh);
			if (data.maxId > state.announcedMaxId) {
				var news = data.latest.filter(function (x) { return x.id > state.announcedMaxId; });
				state.announcedMaxId = data.maxId;
				if (news.length === 1) {
					toastr.info(esc(news[0].typeLabel) + (news[0].name ? ' · ' + esc(news[0].name) : ''), 'Новая заявка №' + news[0].id);
				} else if (news.length > 1) {
					toastr.info('Нажмите «Показать» в панели фильтров', 'Новых заявок: ' + data.fresh);
				}
				refreshCounts();
			}
			refreshTimes();
		}).catch(function (e) {
			if (e.status === 401) { setOffline(false); $('rqLive').textContent = e.message; $('rqLive').classList.add('is-offline'); return; }
			setOffline(true);
		});
	}
	function setFresh(n) {
		var btn = $('rqFresh');
		btn.hidden = !n;
		btn.textContent = n ? n + ' ' + plural(n, 'новая заявка', 'новые заявки', 'новых заявок') + ' — показать' : '';
		document.title = n ? '(' + n + ') ' + BASE_TITLE : BASE_TITLE;
	}
	function refreshTimes() {
		listEl.querySelectorAll('.rq-row time').forEach(function (el) {
			var item = state.byId[+el.closest('.rq-row').getAttribute('data-id')];
			if (item) el.textContent = relTime(item.created, item.createdRaw);
		});
		updateLive();
	}

	// ── выбор и массовые действия ──────────────
	function selectedIds() { return Object.keys(state.selected).map(Number); }
	function clearSelection(silent) {
		state.selected = {};
		if (!silent) {
			listEl.querySelectorAll('[data-select]').forEach(function (cb) { cb.checked = false; cb.closest('.rq-row').classList.remove('is-selected'); });
			renderSelection();
		}
	}
	function renderSelection() {
		var ids = selectedIds();
		var n = ids.length;
		$('rqBulk').classList.toggle('is-visible', n > 0);
		$('rqBulkCount').textContent = nf.format(n);
		var pageBox = $('rqSelectPage');
		var onPage = state.items.filter(function (x) { return state.selected[x.id]; }).length;
		pageBox.checked = state.items.length > 0 && onPage === state.items.length;
		pageBox.indeterminate = onPage > 0 && onPage < state.items.length;
		var all = $('rqBulkAll');
		all.hidden = !(n > 0 && state.total > n);
		all.textContent = 'Выбрать все ' + nf.format(state.total);
	}
	function toggleSelect(id, on) {
		if (on) state.selected[id] = true; else delete state.selected[id];
		var row = listEl.querySelector('.rq-row[data-id="' + id + '"]');
		if (row) {
			row.classList.toggle('is-selected', on);
			row.querySelector('[data-select]').checked = on;
		}
		renderSelection();
	}
	function bulkStatus(status) {
		var ids = selectedIds();
		if (!ids.length) return;
		var label = STATUSES[status].label;
		if (ids.length > 1 && !confirm('Поставить статус «' + label + '» для ' + nf.format(ids.length) + ' ' + plural(ids.length, 'заявки', 'заявок', 'заявок') + '?')) return;
		var buttons = $('rqBulkStatuses').querySelectorAll('button');
		buttons.forEach(function (b) { b.disabled = true; });
		api('bulk', { method: 'POST', body: { ids: ids, status: status } }).then(function (data) {
			toastr.success('Статус «' + label + '»: ' + nf.format(data.updated) + ' ' + plural(data.updated, 'заявка', 'заявки', 'заявок'));
			clearSelection(true);
			renderSelection();
			load({ keepDrawer: true });
			if (state.drawerId && ids.indexOf(state.drawerId) !== -1) reloadDrawerItem();
		}).catch(function (e) {
			toastr.error(e.message, 'Статус не изменён');
		}).then(function () {
			buttons.forEach(function (b) { b.disabled = false; });
		});
	}

	// ── карточка заявки ────────────────────────
	function openDrawer(id, opts) {
		opts = opts || {};
		if (state.drawerId && state.drawerId !== id && isDirty() && !confirm('Изменения в заявке №' + state.drawerId + ' не сохранены. Перейти без сохранения?')) return;
		var item = state.byId[id];
		if (!item) {
			api(String(id)).then(function (data) {
				state.byId[data.item.id] = data.item;
				openDrawer(data.item.id, opts);
			}).catch(function (e) {
				toastr.error(e.message, 'Заявка №' + id);
				if (state.drawerId === id) closeDrawer(true);
			});
			return;
		}
		var prevOpen = listEl.querySelector('.rq-row.is-open');
		if (prevOpen) prevOpen.classList.remove('is-open');
		var row = listEl.querySelector('.rq-row[data-id="' + id + '"]');
		if (row) {
			row.classList.add('is-open');
			if (opts.scroll) row.scrollIntoView({ block: 'nearest' });
		}
		var wasOpen = !!state.drawerId;
		state.drawerId = id;
		state.editParams = false;
		resetForm(item);
		renderDrawer();
		$('rqDrBody').scrollTop = 0;
		drawer.classList.add('is-open');
		$('rqBackdrop').classList.add('is-visible');
		if (!wasOpen) {
			state.returnFocus = document.activeElement;
			setTimeout(function () { drawer.focus({ preventScroll: true }); }, 30);
		}
		saveHash();
	}

	function closeDrawer(force) {
		if (!state.drawerId) return;
		if (!force && isDirty() && !confirm('Закрыть без сохранения изменений?')) return;
		var row = listEl.querySelector('.rq-row[data-id="' + state.drawerId + '"]');
		if (row) row.classList.remove('is-open');
		state.drawerId = null;
		state.form = null;
		drawer.classList.remove('is-open');
		$('rqBackdrop').classList.remove('is-visible');
		saveHash();
		if (row) row.focus({ preventScroll: true });
		else if (state.returnFocus && state.returnFocus.focus) state.returnFocus.focus({ preventScroll: true });
	}

	function reloadDrawerItem() {
		var id = state.drawerId;
		api(String(id)).then(function (data) {
			replaceItem(data.item);
			if (state.drawerId === id) { resetForm(data.item); renderDrawer(); }
		}).catch(function () {});
	}

	function resetForm(item) {
		var fields = {};
		item.fields.forEach(function (f) { fields[f.key] = f.raw; });
		state.form = { status: item.status, price: item.price, comment: item.comment, fields: fields };
	}

	function currentItem() { return state.drawerId ? state.byId[state.drawerId] : null; }

	function payload() {
		var item = currentItem();
		var form = state.form;
		if (!item || !form) return null;
		var p = {};
		if (form.status !== item.status && form.status !== 'new') p.status = form.status;
		if (form.price !== item.price) p.price = form.price;
		if (form.comment !== item.comment) p.comment = form.comment;
		var changed = {};
		item.fields.forEach(function (f) {
			if (form.fields[f.key] !== f.raw) changed[f.key] = form.fields[f.key];
		});
		if (Object.keys(changed).length) p.fields = changed;
		return p;
	}
	function isDirty() {
		var p = payload();
		return !!p && Object.keys(p).length > 0;
	}

	function renderDrawer() {
		var item = currentItem();
		if (!item) return;
		var t = typeInfo(item);
		var form = state.form;

		$('rqDrTitle').innerHTML = '<span>№' + item.id + '</span>' + typeBadge(item, true) + (item.urgent && isOpenStatus(item.status) ? '<span class="rq-urgent"><i class="bx bx-bolt-circle"></i>Срочно</span>' : '');
		$('rqDrSub').innerHTML = esc(absTime(item.created, item.createdRaw)) + (item.created ? ' · ' + esc(relTime(item.created, item.createdRaw)) : '');

		var idx = indexOfItem(item.id);
		$('rqDrPrev').disabled = idx <= 0;
		$('rqDrNext').disabled = idx === -1 || (idx >= state.items.length - 1 && state.page >= state.pages);

		var html = '';

		// статус
		html += '<section class="rq-section"><div class="rq-section-head"><h3>Статус</h3>' + statusPill(item.status) + '</div><div class="rq-status-pick" role="group" aria-label="Статус заявки">';
		Object.keys(STATUSES).forEach(function (key) {
			if (key === 'new') return;
			html += '<button type="button" data-set-status="' + key + '" style="--st:' + STATUS_COLORS[key] + '" class="' + (form.status === key ? 'is-active' : '') + '" title="' + esc(STATUSES[key].hint) + '">' + esc(STATUSES[key].label) + '</button>';
		});
		html += '</div>';
		if (item.status === 'new') html += '<div class="rq-hint">Заявка ещё не обрабатывалась. После сохранения она перейдёт в «В работе», если не выбран другой статус.</div>';
		html += '</section>';

		// клиент
		html += '<section class="rq-section"><div class="rq-section-head"><h3>Клиент</h3></div>'
			+ '<div class="rq-client-name">' + esc(item.name || 'Имя не указано') + '</div>'
			+ contactRow('bx-phone', item.phone, item.phoneHref ? 'tel:' + item.phoneHref : '', 'Позвонить', 'bx-phone-call')
			+ contactRow('bx-envelope', item.email, item.emailValid ? 'mailto:' + item.email + '?subject=' + encodeURIComponent('Ваша заявка №' + item.id + ' — Копимастер') : '', 'Написать', 'bx-mail-send')
			+ '</section>';

		// параметры заказа
		var fields = item.fields.filter(function (f) { return f.raw !== '' || fieldDef(item, f.key).edit; });
		var editable = t.fields.some(function (f) { return f.edit; });
		if (fields.length || editable) {
			html += '<section class="rq-section"><div class="rq-section-head"><h3>Параметры заказа</h3>'
				+ (editable ? '<button type="button" class="rq-btn" data-action="toggle-params"><i class="bx ' + (state.editParams ? 'bx-show' : 'bx-edit-alt') + '"></i>' + (state.editParams ? 'Просмотр' : 'Изменить') + '</button>' : '')
				+ '</div><dl class="rq-params">';
			var group = '';
			fields.forEach(function (f) {
				var def = fieldDef(item, f.key);
				if (f.group && f.group !== group) {
					group = f.group;
					html += '<dt class="rq-params-group">' + esc(group) + '</dt>';
				}
				html += '<dt>' + esc(f.label) + '</dt>';
				if (state.editParams && def.edit) {
					html += '<dd>' + fieldInput(item, f, def) + '</dd>';
				} else {
					var shown = displayValue(item, f, def);
					html += '<dd class="' + (shown === '' ? 'is-empty' : '') + '">' + (shown === '' ? 'не указано' : esc(shown)) + '</dd>';
				}
			});
			html += '</dl></section>';
		}

		// файлы
		if (item.files.length) {
			html += '<section class="rq-section"><div class="rq-section-head"><h3>Файлы</h3></div><div class="rq-files">';
			item.files.forEach(function (file) {
				if (file.exists === false) {
					html += '<div class="rq-file is-missing"><div class="rq-file-thumb"><i class="bx bx-image"></i></div><div class="rq-file-foot"><div class="rq-file-meta"><b>' + esc(file.label) + '</b><small>не загружено</small></div></div></div>';
					return;
				}
				var url = esc(file.url);
				html += '<div class="rq-file"><a class="rq-file-thumb" href="' + url + '" target="_blank" rel="noopener" title="Открыть">'
					+ (file.image ? '<img src="' + url + '" alt="' + esc(file.label) + '" loading="lazy">' : '<i class="bx bx-file"></i>') + '</a>'
					+ '<div class="rq-file-foot"><div class="rq-file-meta"><b>' + esc(file.label) + '</b><small>' + esc([file.ext.toUpperCase(), sizeLabel(file.size)].filter(Boolean).join(' · ')) + '</small></div>'
					+ '<a class="rq-icon-btn" href="' + url + '" target="_blank" rel="noopener" title="Открыть в новой вкладке"><i class="bx bx-link-external"></i></a>'
					+ '<a class="rq-icon-btn" href="' + url + '" download="' + esc('zayavka-' + item.id + '-' + file.name) + '" title="Скачать"><i class="bx bx-download"></i></a></div></div>';
			});
			html += '</div></section>';
		}

		// обработка
		html += '<section class="rq-section"><div class="rq-section-head"><h3>Обработка</h3></div>'
			+ '<label class="rq-field"><span>Цена<small id="rqPriceCount"></small></span><input type="text" id="rqPrice" maxlength="100" autocomplete="off" placeholder="Например, 1500 или «1500 ₽, без нал»" value="' + esc(form.price) + '"></label>'
			+ '<label class="rq-field"><span>Комментарий<small id="rqCommentCount"></small></span><textarea id="rqComment" maxlength="1000" rows="4" placeholder="Что обсудили с клиентом, сроки, детали заказа">' + esc(form.comment) + '</textarea></label>'
			+ (t.clientComment && item.comment ? '<div class="rq-hint is-warn"><i class="bx bx-info-circle"></i> Для этого типа комментарий пишет клиент при заказе — если его изменить, исходный текст будет заменён.</div>' : '')
			+ '</section>';

		html += '<section class="rq-section"><div class="rq-meta-line"><span>'
			+ (item.updated ? 'Изменена ' + esc(absTime(item.updated)) : 'Ещё не сохранялась в админке') + '</span>'
			+ (!Object.keys(STATUSES).some(function (k) { return STATUSES[k].db === item.statusRaw; }) ? '<span>Статус в базе: <code>' + esc(item.statusRaw || 'пусто') + '</code></span>' : '')
			+ '<span>Тип в базе: <code>' + esc(item.tip) + '</code></span>'
			+ (!item.created ? '<span>Дата создания: <code>' + esc(item.createdRaw || '—') + '</code></span>' : '')
			+ '</div></section>';

		var body = $('rqDrBody');
		var scroll = body.scrollTop;
		body.innerHTML = html;
		body.scrollTop = scroll;
		updateFormState();
	}

	function contactRow(icon, value, href, actionLabel, actionIcon) {
		if (!value) {
			return '<div class="rq-contact"><i class="bx ' + icon + '"></i><span class="rq-contact-value is-empty">не указан</span></div>';
		}
		return '<div class="rq-contact"><i class="bx ' + icon + '"></i><span class="rq-contact-value">' + esc(value) + '</span>'
			+ '<button type="button" class="rq-icon-btn" data-copy="' + esc(value) + '" title="Копировать"><i class="bx bx-copy"></i></button>'
			+ (href ? '<a class="rq-btn" href="' + esc(href) + '"><i class="bx ' + actionIcon + '"></i>' + actionLabel + '</a>' : '')
			+ '</div>';
	}

	function fieldDef(item, key) {
		var t = TYPES[item.type];
		var found = { key: key, kind: 'text', edit: false, options: [] };
		if (t) t.fields.forEach(function (f) { if (f.key === key) found = f; });
		return found;
	}
	function displayValue(item, field, def) {
		var raw = state.form.fields[field.key];
		if (raw === field.raw) return field.value;
		for (var i = 0; i < def.options.length; i++) {
			if (def.options[i][0] === raw) return def.options[i][1];
		}
		return raw;
	}
	function fieldInput(item, field, def) {
		var value = state.form.fields[field.key];
		var dirty = value !== field.raw ? ' is-dirty' : '';
		if (def.kind === 'select') {
			var known = def.options.some(function (o) { return o[0] === value; });
			return '<select data-field="' + esc(field.key) + '" class="' + dirty + '">'
				+ (known ? '' : '<option value="' + esc(value) + '" selected>' + (value === '' ? '— не указано —' : esc(value) + ' (нет в справочнике)') + '</option>')
				+ def.options.map(function (o) { return '<option value="' + esc(o[0]) + '"' + (o[0] === value ? ' selected' : '') + '>' + esc(o[1]) + '</option>'; }).join('')
				+ '</select>';
		}
		return '<input type="text" data-field="' + esc(field.key) + '" class="' + dirty + '" value="' + esc(value) + '" maxlength="' + (def.kind === 'number' ? 7 : 200) + '"'
			+ (def.kind === 'number' ? ' inputmode="numeric" pattern="\\d*"' : '') + ' autocomplete="off">';
	}

	function updateFormState() {
		var item = currentItem();
		if (!item) return;
		var dirty = isDirty();
		var save = $('rqSave');
		$('rqDirty').hidden = !dirty;
		$('rqReset').hidden = !dirty;
		save.classList.toggle('is-dirty', dirty);
		if (state.saving) {
			save.disabled = true;
			save.innerHTML = 'Сохранение…';
		} else if (dirty) {
			save.disabled = false;
			save.innerHTML = '<i class="bx bx-check"></i>Сохранить <span class="rq-kbd">Ctrl ↵</span>';
		} else if (item.status === 'new') {
			save.disabled = false;
			save.innerHTML = '<i class="bx bx-check"></i>Взять в работу';
		} else {
			save.disabled = true;
			save.innerHTML = '<i class="bx bx-check-double"></i>Сохранено';
		}
		var price = $('rqPrice');
		var comment = $('rqComment');
		if (price) {
			price.classList.toggle('is-dirty', state.form.price !== item.price);
			comment.classList.toggle('is-dirty', state.form.comment !== item.comment);
			$('rqPriceCount').textContent = price.value.length > 80 ? price.value.length + ' / 100' : '';
			$('rqCommentCount').textContent = comment.value.length > 800 ? comment.value.length + ' / 1000' : '';
		}
		$('rqDrBody').querySelectorAll('[data-set-status]').forEach(function (b) {
			b.classList.toggle('is-active', b.getAttribute('data-set-status') === state.form.status);
		});
	}

	function save() {
		var item = currentItem();
		if (!item || state.saving) return;
		var p = payload();
		if (!Object.keys(p).length) {
			if (item.status !== 'new') return;
			p.status = 'active';
		}
		var bad = item.fields.filter(function (f) {
			return p.fields && p.fields[f.key] !== undefined && fieldDef(item, f.key).kind === 'number' && !/^\d{0,7}$/.test(p.fields[f.key]);
		});
		if (bad.length) { toastr.error(bad[0].label + ': только целое число'); return; }
		p.expectedUpdated = item.updated;

		state.saving = true;
		updateFormState();
		var id = item.id;
		api(String(id), { method: 'PUT', body: p }).then(function (data) {
			var fresh = data.item;
			replaceItem(fresh);
			if (state.drawerId === id) {
				resetForm(fresh);
				state.editParams = false;
				renderDrawer();
			}
			flashRow(id);
			toastr.success('Заявка №' + id + ' — ' + STATUSES[fresh.status].label.toLowerCase(), 'Сохранено');
			refreshCounts();
		}).catch(function (e) {
			if (e.status === 409 && e.data && e.data.item) {
				replaceItem(e.data.item);
				if (state.drawerId === id) {
					// свежая версия + правки сотрудника поверх неё: можно сверить и сохранить ещё раз
					resetForm(e.data.item);
					if (p.status) state.form.status = p.status;
					if (p.price !== undefined) state.form.price = p.price;
					if (p.comment !== undefined) state.form.comment = p.comment;
					Object.keys(p.fields || {}).forEach(function (k) { state.form.fields[k] = p.fields[k]; });
					renderDrawer();
				}
				toastr.warning('Заявку уже изменил другой сотрудник. Данные обновлены, ваши правки остались в форме — проверьте и сохраните ещё раз.', 'Заявка №' + id, { timeOut: 9000 });
			} else if (e.status === 404) {
				toastr.error('Заявка уже удалена', 'Заявка №' + id);
				removeItem(id);
			} else {
				toastr.error(e.message, 'Не сохранено');
			}
		}).then(function () {
			state.saving = false;
			updateFormState();
		});
	}

	function flashRow(id) {
		var row = listEl.querySelector('.rq-row[data-id="' + id + '"]');
		if (!row) return;
		row.classList.remove('is-fresh');
		void row.offsetWidth;
		row.classList.add('is-fresh');
	}

	function removeItem(id) {
		state.items = state.items.filter(function (x) { return x.id !== id; });
		delete state.byId[id];
		delete state.selected[id];
		state.total = Math.max(0, state.total - 1);
		var row = listEl.querySelector('.rq-row[data-id="' + id + '"]');
		if (row) {
			row.classList.add('is-removing');
			setTimeout(function () {
				if (row.parentNode) row.parentNode.removeChild(row);
				if (!state.items.length) renderList();
			}, 260);
		}
		if (state.drawerId === id) closeDrawer(true);
		renderFound();
		renderMore();
		renderSelection();
		refreshCounts();
	}

	function removeRequest() {
		var item = currentItem();
		if (!item) return;
		if (!confirm('Удалить заявку №' + item.id + (item.name ? ' (' + item.name + ')' : '') + ' навсегда? Отменить удаление будет нельзя.')) return;
		var btn = $('rqDelete');
		btn.disabled = true;
		api(String(item.id), { method: 'DELETE' }).then(function () {
			toastr.success('Заявка №' + item.id + ' удалена');
			removeItem(item.id);
		}).catch(function (e) {
			if (e.status === 404) { removeItem(item.id); return; }
			toastr.error(e.message, 'Не удалено');
		}).then(function () { btn.disabled = false; });
	}

	function indexOfItem(id) {
		for (var i = 0; i < state.items.length; i++) if (state.items[i].id === id) return i;
		return -1;
	}
	function step(dir) {
		var idx = indexOfItem(state.drawerId);
		if (idx === -1) return;
		var next = state.items[idx + dir];
		if (next) { openDrawer(next.id, { scroll: true }); return; }
		if (dir > 0 && state.page < state.pages) {
			load({ append: true }).then(function () {
				var n = state.items[idx + 1];
				if (n) openDrawer(n.id, { scroll: true });
			});
		}
	}

	// ── события ────────────────────────────────
	$('rqStatuses').addEventListener('click', function (e) {
		var b = e.target.closest('[data-status]');
		if (b) setFilter({ status: b.getAttribute('data-status') });
	});
	$('rqTypes').addEventListener('click', function (e) {
		var b = e.target.closest('[data-type]');
		if (b) setFilter({ type: b.getAttribute('data-type') });
	});
	root.querySelectorAll('[data-preset]').forEach(function (b) {
		b.addEventListener('click', function () {
			applyPreset(b.getAttribute('data-preset'));
			setFilter({});
		});
	});
	root.querySelectorAll('[data-sort]').forEach(function (b) {
		b.addEventListener('click', function () { setFilter({ sort: b.getAttribute('data-sort') }); });
	});
	['rqFrom', 'rqTo'].forEach(function (id) {
		$(id).addEventListener('change', function () {
			var from = $('rqFrom').value, to = $('rqTo').value;
			if (from && to && from > to) { var x = from; from = to; to = x; }
			setFilter({ from: from, to: to, preset: from || to ? 'custom' : 'all' });
		});
	});

	var searchTimer = null;
	var searchInput = $('rqSearch');
	function applySearch() {
		clearTimeout(searchTimer);
		var value = searchInput.value.trim();
		$('rqSearchClear').hidden = !searchInput.value;
		if (value !== state.f.search) setFilter({ search: value });
	}
	searchInput.addEventListener('input', function () {
		$('rqSearchClear').hidden = !searchInput.value;
		clearTimeout(searchTimer);
		searchTimer = setTimeout(applySearch, 350);
	});
	searchInput.addEventListener('keydown', function (e) {
		if (e.key === 'Enter') { e.preventDefault(); applySearch(); }
		if (e.key === 'Escape') { searchInput.value = ''; applySearch(); searchInput.blur(); }
	});
	$('rqSearchClear').addEventListener('click', function () {
		searchInput.value = '';
		applySearch();
		searchInput.focus();
	});

	$('rqRefresh').addEventListener('click', function () { load({ keepDrawer: true }); });
	$('rqFresh').addEventListener('click', function () {
		if (state.f.sort !== 'new' || state.f.status === 'done' || state.f.status === 'closed' || state.f.status === 'cancel' || state.f.status === 'active'
			|| state.f.status === 'wait' || state.f.status === 'paid' || state.f.search || state.f.type || (state.f.to && state.f.to < ymd(serverNow()))) {
			state.f.status = 'open'; state.f.type = ''; state.f.search = ''; state.f.sort = 'new';
			applyPreset('all');
			searchInput.value = '';
			renderControls();
			saveHash();
		}
		load({ fresh: true, scrollTop: true });
	});
	$('rqExport').addEventListener('click', function () {
		window.location.href = API + 'export?' + qs(filterParams());
	});
	$('rqMoreBtn').addEventListener('click', function () { load({ append: true }); });

	listEl.addEventListener('click', function (e) {
		var action = e.target.closest('[data-action]');
		if (action) {
			var a = action.getAttribute('data-action');
			if (a === 'retry') load();
			if (a === 'relogin') location.reload();
			if (a === 'reset-filters') {
				state.f = { status: 'all', type: '', search: '', from: '', to: '', sort: state.f.sort, preset: 'all' };
				searchInput.value = '';
				setFilter({});
			}
			return;
		}
		if (e.target.closest('a, .rq-check')) return;
		var row = e.target.closest('.rq-row');
		if (row) openDrawer(+row.getAttribute('data-id'));
	});
	listEl.addEventListener('change', function (e) {
		var cb = e.target.closest('[data-select]');
		if (cb) toggleSelect(+cb.getAttribute('data-select'), cb.checked);
	});
	listEl.addEventListener('keydown', function (e) {
		var row = e.target.classList && e.target.classList.contains('rq-row') ? e.target : null;
		if (!row) return;
		if (e.key === 'Enter') { e.preventDefault(); openDrawer(+row.getAttribute('data-id')); }
		if (e.key === ' ') { e.preventDefault(); var id = +row.getAttribute('data-id'); toggleSelect(id, !state.selected[id]); }
		if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
			var sib = e.key === 'ArrowDown' ? row.nextElementSibling : row.previousElementSibling;
			if (sib && sib.classList.contains('rq-row')) { e.preventDefault(); sib.focus(); }
		}
	});

	$('rqSelectPage').addEventListener('change', function (e) {
		var on = e.target.checked;
		state.items.forEach(function (x) { if (on) state.selected[x.id] = true; else delete state.selected[x.id]; });
		listEl.querySelectorAll('.rq-row').forEach(function (row) {
			row.classList.toggle('is-selected', on);
			row.querySelector('[data-select]').checked = on;
		});
		renderSelection();
	});
	$('rqBulkClear').addEventListener('click', function () { clearSelection(); });
	$('rqBulkAll').addEventListener('click', function () {
		var btn = $('rqBulkAll');
		btn.disabled = true;
		api('ids?' + qs(filterParams())).then(function (data) {
			data.ids.forEach(function (id) { state.selected[id] = true; });
			listEl.querySelectorAll('.rq-row').forEach(function (row) {
				row.classList.add('is-selected');
				row.querySelector('[data-select]').checked = true;
			});
			renderSelection();
		}).catch(function (e) { toastr.error(e.message); }).then(function () { btn.disabled = false; });
	});
	$('rqBulkStatuses').innerHTML = Object.keys(STATUSES).filter(function (k) { return k !== 'new'; }).map(function (key) {
		return '<button type="button" class="rq-seg" data-bulk="' + key + '" style="--st:' + STATUS_COLORS[key] + '" title="' + esc(STATUSES[key].hint) + '">' + esc(STATUSES[key].label) + '</button>';
	}).join('');
	$('rqBulkStatuses').addEventListener('click', function (e) {
		var b = e.target.closest('[data-bulk]');
		if (b) bulkStatus(b.getAttribute('data-bulk'));
	});

	$('rqBackdrop').addEventListener('click', function () { closeDrawer(); });
	$('rqDrClose').addEventListener('click', function () { closeDrawer(); });
	$('rqDrPrev').addEventListener('click', function () { step(-1); });
	$('rqDrNext').addEventListener('click', function () { step(1); });
	$('rqSave').addEventListener('click', save);
	$('rqDelete').addEventListener('click', removeRequest);
	$('rqReset').addEventListener('click', function () {
		var item = currentItem();
		if (!item) return;
		resetForm(item);
		renderDrawer();
	});

	var body = $('rqDrBody');
	body.addEventListener('click', function (e) {
		var st = e.target.closest('[data-set-status]');
		if (st) {
			var item = currentItem();
			var key = st.getAttribute('data-set-status');
			state.form.status = state.form.status === key ? item.status : key;
			updateFormState();
			return;
		}
		var copy = e.target.closest('[data-copy]');
		if (copy) { copyText(copy.getAttribute('data-copy')); return; }
		var action = e.target.closest('[data-action="toggle-params"]');
		if (action) {
			state.editParams = !state.editParams;
			renderDrawer();
			if (state.editParams) {
				var first = body.querySelector('[data-field]');
				if (first) first.focus();
			}
		}
	});
	body.addEventListener('input', function (e) {
		var el = e.target;
		if (!state.form) return;
		if (el.id === 'rqPrice') state.form.price = el.value;
		else if (el.id === 'rqComment') state.form.comment = el.value;
		else if (el.hasAttribute('data-field')) {
			var item = currentItem();
			state.form.fields[el.getAttribute('data-field')] = el.value;
			var f = item.fields.filter(function (x) { return x.key === el.getAttribute('data-field'); })[0];
			el.classList.toggle('is-dirty', f && el.value !== f.raw);
		}
		updateFormState();
	});
	// select меняет значение через change
	body.addEventListener('change', function (e) {
		var el = e.target;
		if (el.tagName !== 'SELECT' || !state.form) return;
		state.form.fields[el.getAttribute('data-field')] = el.value;
		var item = currentItem();
		var f = item.fields.filter(function (x) { return x.key === el.getAttribute('data-field'); })[0];
		el.classList.toggle('is-dirty', f && el.value !== f.raw);
		updateFormState();
	});

	document.addEventListener('keydown', function (e) {
		var tag = (e.target.tagName || '').toLowerCase();
		var typing = tag === 'input' || tag === 'textarea' || tag === 'select' || e.target.isContentEditable;
		if (state.drawerId) {
			if (e.key === 'Escape') { e.preventDefault(); closeDrawer(); return; }
			if ((e.ctrlKey || e.metaKey) && (e.key === 'Enter' || e.key === 's' || e.key === 'ы' || e.keyCode === 83)) { e.preventDefault(); save(); return; }
			if (!typing && (e.key === 'j' || e.key === 'о')) { step(1); return; }
			if (!typing && (e.key === 'k' || e.key === 'л')) { step(-1); return; }
			if (e.key === 'Tab') trapFocus(e);
			return;
		}
		if (e.key === '/' && !typing) { e.preventDefault(); searchInput.focus(); searchInput.select(); }
	});
	function trapFocus(e) {
		var nodes = drawer.querySelectorAll('button:not([disabled]), a[href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
		if (!nodes.length) return;
		var first = nodes[0], last = nodes[nodes.length - 1];
		if (e.shiftKey && (document.activeElement === first || document.activeElement === drawer)) { e.preventDefault(); last.focus(); }
		else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
	}

	window.addEventListener('beforeunload', function (e) {
		if (state.drawerId && isDirty()) { e.preventDefault(); e.returnValue = ''; }
	});
	document.addEventListener('visibilitychange', function () {
		if (!document.hidden) poll();
	});
	setInterval(poll, POLL_MS);
	setInterval(refreshTimes, 30 * 1000);

	// ── старт ──────────────────────────────────
	var h = readHash();
	if (h.status && (STATUSES[h.status] || ['open', 'done', 'all'].indexOf(h.status) !== -1)) state.f.status = h.status;
	if (h.type && (TYPES[h.type] || h.type === 'other')) state.f.type = h.type;
	if (h.search) { state.f.search = h.search.slice(0, 100); searchInput.value = state.f.search; }
	if (h.sort === 'old') state.f.sort = 'old';
	if (h.preset) applyPreset(h.preset);
	else if (/^\d{4}-\d{2}-\d{2}$/.test(h.from || '') || /^\d{4}-\d{2}-\d{2}$/.test(h.to || '')) {
		state.f.from = h.from || ''; state.f.to = h.to || ''; state.f.preset = 'custom';
	}
	renderControls();
	load().then(function () {
		if (/^\d+$/.test(h.id || '')) openDrawer(+h.id);
	});
})();
</script>

</body>
</html>
