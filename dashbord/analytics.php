<?php
	include('./header.php');

	if (!isset($_SESSION['type']) || $_SESSION['type'] != "admin")
	{
		echo '<div class="page-wrapper"><div class="page-content-wrapper"><div class="page-content">ДОСТУП ЗАПРЕЩЕН !!!</div></div></div>';
		exit;
	}
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Onest:wght@400;500;600;700&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>

<style>
	.an {
		--an-surface: rgba(10, 14, 24, .42);
		--an-surface-solid: #262e38;
		--an-surface-hi: rgba(255, 255, 255, .055);
		--an-line: rgba(255, 255, 255, .09);
		--an-grid: rgba(255, 255, 255, .07);
		--an-text: #eef2f7;
		--an-muted: rgba(226, 232, 240, .58);
		--an-faint: rgba(226, 232, 240, .36);
		--an-accent: #5eead4;
		--an-accent-ink: #062a26;
		/* категориальная палитра (dark, проверена валидатором на фоне карточек) */
		--an-s1: #3987e5;
		--an-s2: #d95926;
		--an-s3: #199e70;
		--an-s4: #c98500;
		--an-s5: #d55181;
		--an-s6: #9085e9;
		--an-other: #7b8494;
		--an-good: #3ecf5e;
		--an-bad: #f07171;
		--an-radius: 14px;
		font-family: 'Onest', 'Segoe UI', Tahoma, sans-serif;
		color: var(--an-text);
		max-width: 1480px;
		margin: 0 auto;
		padding-bottom: 60px;
	}
	.an *, .an *::before, .an *::after { box-sizing: border-box; }
	.an h1, .an h2, .an h3 { font-family: inherit; color: var(--an-text); }

	/* шапка */
	.an-head { display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 16px 32px; margin-bottom: 20px; }
	.an-eyebrow { font-size: 11px; font-weight: 600; letter-spacing: .14em; text-transform: uppercase; color: var(--an-accent); }
	.an-head h1 { margin: 4px 0 6px; font-size: clamp(28px, 3.2vw, 40px); font-weight: 700; letter-spacing: -.02em; line-height: 1.05; }
	.an-head p { margin: 0; color: var(--an-muted); font-size: 14px; }
	.an-live { display: inline-flex; align-items: center; gap: 8px; }
	.an-live::before { content: ''; width: 8px; height: 8px; border-radius: 50%; background: var(--an-accent); box-shadow: 0 0 0 0 rgba(94, 234, 212, .6); animation: an-pulse 2.4s infinite; }

	/* панель фильтров */
	.an-toolbar {
		position: sticky; top: 70px; z-index: 9;
		margin: 0 -12px 22px; padding: 10px 12px;
		border: 1px solid var(--an-line); border-radius: 18px;
		background: rgba(35, 43, 54, .85);
		backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px);
		box-shadow: 0 12px 30px -18px rgba(0, 0, 0, .7);
	}
	.an-filters { display: flex; flex-wrap: wrap; align-items: center; gap: 8px 14px; margin-bottom: 10px; }
	.an-presets { display: flex; gap: 4px; overflow-x: auto; scrollbar-width: none; }
	.an-presets::-webkit-scrollbar { display: none; }
	.an-range { display: flex; align-items: center; gap: 6px; margin-left: auto; color: var(--an-muted); font-size: 13px; }
	.an-range input {
		height: 36px; padding: 0 10px; border: 1px solid var(--an-line); border-radius: 9px;
		background: rgba(0, 0, 0, .22); color: var(--an-text); font: 500 13px 'JetBrains Mono', monospace;
		color-scheme: dark; outline: none;
	}
	.an-range input:focus { border-color: var(--an-accent); }

	.an-seg, .an-tab, .an-btn {
		display: inline-flex; align-items: center; justify-content: center; gap: 8px;
		height: 36px; padding: 0 13px; border: 1px solid transparent; border-radius: 9px;
		background: transparent; color: var(--an-muted); font: 600 13.5px 'Onest', sans-serif;
		white-space: nowrap; cursor: pointer; transition: background .15s, color .15s, border-color .15s;
	}
	.an-seg:hover, .an-tab:hover, .an-btn:hover { color: var(--an-text); background: var(--an-surface-hi); }
	.an-seg.is-active { color: var(--an-accent-ink); background: var(--an-accent); }
	.an-seg:focus-visible, .an-tab:focus-visible, .an-btn:focus-visible { outline: 2px solid var(--an-accent); outline-offset: 1px; }
	.an-btn { border-color: var(--an-line); }
	.an-btn i { font-size: 18px; }
	.an-btn.is-spinning i { animation: an-spin .8s linear infinite; }

	.an-tabs { display: flex; gap: 6px; overflow-x: auto; scrollbar-width: none; border-top: 1px solid var(--an-line); padding-top: 10px; }
	.an-tabs::-webkit-scrollbar { display: none; }
	.an-tab { flex: 1 0 auto; height: 42px; font-size: 14.5px; }
	.an-tab i { font-size: 19px; }
	.an-tab.is-active { color: var(--an-accent-ink); background: var(--an-accent); }

	.an-segs { display: inline-flex; gap: 2px; padding: 3px; border: 1px solid var(--an-line); border-radius: 11px; background: rgba(0, 0, 0, .18); }
	.an-segs .an-seg { height: 30px; padding: 0 11px; font-size: 12.5px; border-radius: 8px; }

	/* панели */
	.an-panel { display: none; }
	.an-panel.is-active { display: block; animation: an-fade .25s ease both; }
	.an-main.is-loading .an-panel { opacity: .55; transition: opacity .2s; pointer-events: none; }
	.an-grid { display: grid; gap: 16px; margin-bottom: 16px; }
	.an-grid-2 { grid-template-columns: repeat(auto-fit, minmax(min(100%, 480px), 1fr)); }
	.an-card { min-width: 0; border: 1px solid var(--an-line); border-radius: var(--an-radius); background: var(--an-surface); }
	.an-card-head { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 8px 16px; padding: 14px 18px 0; }
	.an-card-head h3 { margin: 0; font-size: 16px; font-weight: 600; }
	.an-card-head .an-note { flex-basis: 100%; margin-top: -4px; }
	.an-card-body { padding: 14px 18px 18px; }
	.an-note { color: var(--an-muted); font-size: 12.5px; }
	.an-chart { position: relative; height: 300px; }
	.an-chart.is-short { height: 240px; }
	.an-legend { display: flex; flex-wrap: wrap; gap: 6px 16px; color: var(--an-muted); font-size: 12.5px; }
	.an-legend span { display: inline-flex; align-items: center; gap: 7px; }
	.an-key { width: 10px; height: 10px; border-radius: 3px; background: var(--an-s1); }
	.an-key.is-line { height: 2px; width: 16px; border-radius: 2px; background: var(--an-muted); }
	button.an-chip { border: 1px solid var(--an-line); background: transparent; color: var(--an-text); height: 28px; padding: 0 10px; border-radius: 999px; font: 500 12.5px 'Onest', sans-serif; cursor: pointer; display: inline-flex; align-items: center; gap: 7px; }
	button.an-chip.is-off { opacity: .4; }
	button.an-chip.is-active { border-color: var(--an-accent); color: var(--an-accent); }

	/* KPI */
	.an-kpis { grid-template-columns: repeat(auto-fit, minmax(min(100%, 210px), 1fr)); }
	.an-kpi { padding: 16px 18px; }
	.an-kpi-label { display: flex; align-items: center; gap: 7px; color: var(--an-muted); font-size: 13px; }
	.an-kpi-label i { font-size: 17px; }
	.an-kpi-value { margin: 8px 0 6px; font-size: clamp(24px, 2.4vw, 32px); font-weight: 700; letter-spacing: -.02em; line-height: 1.1; }
	.an-kpi.is-hero { background: linear-gradient(135deg, rgba(94, 234, 212, .12), rgba(57, 135, 229, .08)), var(--an-surface); border-color: rgba(94, 234, 212, .25); }
	.an-delta { display: inline-flex; align-items: center; gap: 4px; font-size: 12.5px; font-weight: 600; }
	.an-delta.is-up { color: var(--an-good); }
	.an-delta.is-down { color: var(--an-bad); }
	.an-delta.is-flat { color: var(--an-muted); }
	.an-delta + .an-note { margin-left: 4px; }

	/* списки с полосками */
	.an-bars { display: grid; gap: 10px; }
	.an-bar-row { display: grid; grid-template-columns: minmax(120px, 1.1fr) 2fr auto; align-items: center; gap: 12px; font-size: 13.5px; }
	button.an-bar-row { width: 100%; padding: 4px 6px; margin: -4px -6px; border: 0; border-radius: 8px; background: transparent; color: inherit; text-align: left; font: inherit; cursor: pointer; }
	button.an-bar-row:hover, button.an-bar-row.is-active { background: var(--an-surface-hi); }
	.an-bar-name { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
	.an-bar-track { height: 10px; border-radius: 4px; background: rgba(255, 255, 255, .05); overflow: hidden; }
	.an-bar-fill { height: 100%; border-radius: 4px; background: var(--an-s1); }
	.an-bar-value { font-variant-numeric: tabular-nums; text-align: right; white-space: nowrap; }
	.an-bar-value small { display: inline-block; min-width: 44px; margin-left: 8px; color: var(--an-muted); }

	.an-stack { display: flex; gap: 2px; height: 16px; margin: 4px 0 16px; border-radius: 4px; overflow: hidden; }
	.an-stack div { height: 100%; }
	.an-stack div:first-child { border-radius: 4px 0 0 4px; }
	.an-stack div:last-child { border-radius: 0 4px 4px 0; }

	/* таблицы */
	.an-scroll { overflow-x: auto; }
	.an-table { width: 100%; border-collapse: collapse; font-size: 13.5px; color: var(--an-text); }
	.an-table th, .an-table td { padding: 9px 10px; border-bottom: 1px solid rgba(255, 255, 255, .06); vertical-align: middle; }
	.an-table thead th { color: var(--an-muted); font-size: 12px; font-weight: 600; text-align: left; white-space: nowrap; border-bottom-color: var(--an-line); }
	.an-table th.num, .an-table td.num { text-align: right; font-variant-numeric: tabular-nums; white-space: nowrap; }
	.an-table tbody tr:hover { background: rgba(255, 255, 255, .03); }
	.an-table tfoot td { font-weight: 700; border-bottom: 0; border-top: 1px solid var(--an-line); }
	.an-table th[data-sort] { cursor: pointer; user-select: none; }
	.an-table th[data-sort]:hover { color: var(--an-text); }
	.an-table th.is-sorted { color: var(--an-accent); }
	.an-table th.is-sorted::after { content: ' ↓'; }
	.an-share { display: flex; align-items: center; gap: 8px; min-width: 120px; }
	.an-share .an-bar-track { flex: 1; height: 6px; }
	.an-share small { width: 40px; text-align: right; color: var(--an-muted); font-variant-numeric: tabular-nums; }
	.an-tag { display: inline-flex; align-items: center; gap: 6px; color: var(--an-muted); font-size: 12px; white-space: nowrap; }
	.an-tag::before { content: ''; width: 8px; height: 8px; border-radius: 2px; background: var(--dot, var(--an-other)); }
	.an-heat-cell { position: relative; }
	.an-heat-cell::before { content: ''; position: absolute; inset: 2px; border-radius: 6px; background: rgba(57, 135, 229, var(--a, 0)); z-index: 0; }
	.an-heat-cell span { position: relative; z-index: 1; }

	.an-input {
		height: 38px; padding: 0 12px; border: 1px solid var(--an-line); border-radius: 10px;
		background: rgba(0, 0, 0, .22); color: var(--an-text); font: 500 14px 'Onest', sans-serif; outline: none; min-width: 0;
	}
	.an-input:focus { border-color: var(--an-accent); }
	.an-tools { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; margin-bottom: 12px; }

	/* тепловая карта */
	.an-heatmap { display: grid; gap: 3px; min-width: 620px; }
	.an-heatmap div { display: grid; place-items: center; height: 34px; border-radius: 6px; font-size: 11px; color: var(--an-muted); }
	.an-heatmap .an-hm-cell { background: rgba(57, 135, 229, var(--a)); color: rgba(255, 255, 255, var(--t)); cursor: default; font-variant-numeric: tabular-nums; }
	.an-heatmap .an-hm-cell:hover { outline: 2px solid var(--an-text); outline-offset: -1px; }
	.an-heat-scale { display: flex; align-items: center; gap: 8px; margin-top: 12px; color: var(--an-muted); font-size: 12px; }
	.an-heat-scale i { width: 160px; height: 8px; border-radius: 4px; background: linear-gradient(90deg, rgba(57, 135, 229, .06), rgba(57, 135, 229, 1)); }

	/* чеки */
	.an-day-row { cursor: pointer; }
	.an-day-row td:first-child::before { content: '›'; display: inline-block; width: 14px; color: var(--an-muted); transition: transform .15s; }
	.an-day-row.is-open td:first-child::before { transform: rotate(90deg); }
	.an-day-row.is-empty { color: var(--an-faint); cursor: default; }
	.an-day-row.is-empty td:first-child::before { content: ''; }
	.an-day-detail > td { padding: 0 0 14px 24px !important; background: rgba(0, 0, 0, .12); }
	.an-checks { display: grid; gap: 8px; padding-top: 12px; padding-right: 12px; }
	.an-check { border: 1px solid var(--an-line); border-radius: 10px; background: var(--an-surface-solid); overflow: hidden; }
	.an-check-head { display: flex; flex-wrap: wrap; align-items: center; gap: 6px 14px; padding: 9px 12px; font-size: 13.5px; }
	.an-check-head b { font-variant-numeric: tabular-nums; }
	.an-check-head .an-check-sum { margin-left: auto; font-weight: 700; font-variant-numeric: tabular-nums; }
	.an-check .an-table { font-size: 12.5px; }
	.an-check .an-table td { padding: 6px 12px; border-bottom-color: rgba(255, 255, 255, .04); }
	.an-pay { display: inline-flex; align-items: center; gap: 6px; padding: 2px 8px; border-radius: 999px; background: rgba(255, 255, 255, .06); color: var(--an-muted); font-size: 12px; }
	.an-pay::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: var(--dot, var(--an-other)); }

	.an-empty, .an-error { padding: 36px 20px; text-align: center; color: var(--an-muted); }
	.an-error { color: var(--an-bad); }
	.an-loader { display: grid; place-items: center; min-height: 320px; color: var(--an-muted); }
	.an-loader::before { content: ''; width: 34px; height: 34px; margin-bottom: 12px; border: 3px solid var(--an-line); border-top-color: var(--an-accent); border-radius: 50%; animation: an-spin .8s linear infinite; }
	.an-tooltip {
		position: fixed; z-index: 30; pointer-events: none; padding: 8px 10px; border: 1px solid var(--an-line); border-radius: 9px;
		background: #1b2129; color: var(--an-text); font: 500 12.5px/1.45 'Onest', sans-serif; box-shadow: 0 10px 30px -10px rgba(0, 0, 0, .8);
	}

	@keyframes an-spin { to { transform: rotate(360deg); } }
	@keyframes an-fade { from { opacity: 0; } to { opacity: 1; } }
	@keyframes an-pulse { 0% { box-shadow: 0 0 0 0 rgba(94, 234, 212, .5); } 70% { box-shadow: 0 0 0 8px rgba(94, 234, 212, 0); } 100% { box-shadow: 0 0 0 0 rgba(94, 234, 212, 0); } }

	@media (max-width: 767px) {
		.page-content { padding: 16px; }
		.an-toolbar { margin: 0 -6px 16px; padding: 8px; }
		.an-range { margin-left: 0; width: 100%; }
		.an-range input { flex: 1; min-width: 0; }
		.an-tab { flex: 0 0 auto; }
		.an-chart { height: 240px; }
		.an-bar-row { grid-template-columns: 1fr auto; }
		.an-bar-row .an-bar-track { grid-column: 1 / -1; grid-row: 2; }
		.an-day-detail > td { padding-left: 8px !important; }
	}
	@media (prefers-reduced-motion: reduce) {
		.an *, .an *::before { animation: none !important; transition: none !important; }
	}
</style>

		<div class="page-wrapper">
			<div class="page-content-wrapper">
				<div class="page-content">
					<div class="an" id="an">

						<div class="an-head">
							<div>
								<span class="an-eyebrow">Калькулятор ФИЗ</span>
								<h1>Аналитика чеков</h1>
								<p class="an-live" id="anStatus">Загрузка данных…</p>
							</div>
							<button type="button" class="an-btn" id="anRefresh" title="Обновить данные"><i class="bx bx-refresh"></i>Обновить</button>
						</div>

						<div class="an-toolbar">
							<div class="an-filters">
								<div class="an-presets" role="group" aria-label="Период">
									<button type="button" class="an-seg" data-preset="today">Сегодня</button>
									<button type="button" class="an-seg" data-preset="yesterday">Вчера</button>
									<button type="button" class="an-seg" data-preset="7d">7 дней</button>
									<button type="button" class="an-seg" data-preset="30d">30 дней</button>
									<button type="button" class="an-seg" data-preset="month">Этот месяц</button>
									<button type="button" class="an-seg" data-preset="lastMonth">Прошлый месяц</button>
									<button type="button" class="an-seg" data-preset="year">Этот год</button>
									<button type="button" class="an-seg" data-preset="all">Всё время</button>
								</div>
								<label class="an-range">
									<input type="date" id="anFrom" aria-label="Начало периода">
									<span>—</span>
									<input type="date" id="anTo" aria-label="Конец периода">
								</label>
							</div>
							<nav class="an-tabs" role="tablist">
								<button type="button" class="an-tab" data-tab="overview"><i class="bx bx-grid-alt"></i>Обзор</button>
								<button type="button" class="an-tab" data-tab="years"><i class="bx bx-line-chart"></i>Годы</button>
								<button type="button" class="an-tab" data-tab="time"><i class="bx bx-time-five"></i>Время</button>
								<button type="button" class="an-tab" data-tab="services"><i class="bx bx-purchase-tag-alt"></i>Услуги</button>
								<button type="button" class="an-tab" data-tab="checks"><i class="bx bx-receipt"></i>Чеки</button>
							</nav>
						</div>

						<div class="an-main" id="anMain">
							<div class="an-loader" id="anLoader">Считаем чеки…</div>
							<div class="an-error" id="anError" hidden></div>

							<!-- ОБЗОР -->
							<section class="an-panel" data-panel="overview">
								<div class="an-grid an-kpis" id="anKpis"></div>

								<div class="an-card an-grid-item" style="margin-bottom:16px">
									<div class="an-card-head">
										<h3>Выручка</h3>
										<div class="an-legend">
											<span><i class="an-key"></i>Выбранный период</span>
											<span><i class="an-key is-line"></i>Предыдущий период</span>
										</div>
										<div class="an-segs" data-granularity>
											<button type="button" class="an-seg" data-gran="day">Дни</button>
											<button type="button" class="an-seg" data-gran="week">Недели</button>
											<button type="button" class="an-seg" data-gran="month">Месяцы</button>
										</div>
									</div>
									<div class="an-card-body"><div class="an-chart"><canvas id="chRevenue"></canvas></div></div>
								</div>

								<div class="an-grid an-grid-2">
									<div class="an-card">
										<div class="an-card-head"><h3>Способы оплаты</h3></div>
										<div class="an-card-body" id="anPayments"></div>
									</div>
									<div class="an-card">
										<div class="an-card-head">
											<h3>Разделы</h3>
											<span class="an-note">Выручка по позициям до скидок чека</span>
										</div>
										<div class="an-card-body" id="anCategories"></div>
									</div>
								</div>

								<div class="an-grid an-grid-2">
									<div class="an-card">
										<div class="an-card-head"><h3>Топ-10 услуг</h3><button type="button" class="an-btn" data-goto="services">Все услуги</button></div>
										<div class="an-card-body" id="anTopServices"></div>
									</div>
									<div class="an-card">
										<div class="an-card-head"><h3>Количество чеков</h3></div>
										<div class="an-card-body"><div class="an-chart is-short"><canvas id="chChecks"></canvas></div></div>
									</div>
								</div>
							</section>

							<!-- ГОДЫ -->
							<section class="an-panel" data-panel="years">
								<div class="an-card" style="margin-bottom:16px">
									<div class="an-card-head">
										<h3>Сравнение по годам</h3>
										<div class="an-segs" data-year-metric>
											<button type="button" class="an-seg is-active" data-metric="s">Выручка</button>
											<button type="button" class="an-seg" data-metric="n">Чеки</button>
											<button type="button" class="an-seg" data-metric="avg">Средний чек</button>
										</div>
										<span class="an-note">За всё время, не зависит от выбранного периода. Нажмите на год, чтобы скрыть его.</span>
									</div>
									<div class="an-card-body">
										<div class="an-legend" id="anYearChips" style="margin-bottom:12px"></div>
										<div class="an-chart"><canvas id="chYears"></canvas></div>
									</div>
								</div>
								<div class="an-card">
									<div class="an-card-head"><h3 id="anYearTableTitle">Выручка по месяцам</h3></div>
									<div class="an-card-body an-scroll" id="anYearTable"></div>
								</div>
							</section>

							<!-- ВРЕМЯ -->
							<section class="an-panel" data-panel="time">
								<div class="an-card" style="margin-bottom:16px">
									<div class="an-card-head">
										<h3>Загрузка по дням недели и часам</h3>
										<div class="an-segs" data-heat-metric>
											<button type="button" class="an-seg is-active" data-metric="n">Чеки</button>
											<button type="button" class="an-seg" data-metric="s">Выручка</button>
										</div>
										<span class="an-note">Сумма за выбранный период. Чем ярче ячейка, тем больше.</span>
									</div>
									<div class="an-card-body">
										<div class="an-scroll"><div class="an-heatmap" id="anHeatmap"></div></div>
										<div class="an-heat-scale"><span>меньше</span><i></i><span>больше</span></div>
									</div>
								</div>
								<div class="an-grid an-grid-2">
									<div class="an-card">
										<div class="an-card-head"><h3>По часам</h3><span class="an-note">Чеков в среднем за рабочий день</span></div>
										<div class="an-card-body"><div class="an-chart is-short"><canvas id="chHours"></canvas></div></div>
									</div>
									<div class="an-card">
										<div class="an-card-head"><h3>По дням недели</h3><span class="an-note">Средняя выручка за день с продажами</span></div>
										<div class="an-card-body"><div class="an-chart is-short"><canvas id="chWeekdays"></canvas></div></div>
									</div>
								</div>
							</section>

							<!-- УСЛУГИ -->
							<section class="an-panel" data-panel="services">
								<div class="an-grid an-grid-2">
									<div class="an-card">
										<div class="an-card-head"><h3>Разделы</h3><span class="an-note">Нажмите на раздел, чтобы отфильтровать таблицу</span></div>
										<div class="an-card-body" id="anServiceCategories"></div>
									</div>
									<div class="an-card">
										<div class="an-card-head"><h3>Подразделы</h3><span class="an-note">Топ-12 по выручке</span></div>
										<div class="an-card-body" id="anServiceGroups"></div>
									</div>
								</div>
								<div class="an-card">
									<div class="an-card-head">
										<h3>Все услуги</h3>
										<span class="an-note">Выручка по позициям до скидок чека</span>
									</div>
									<div class="an-card-body">
										<div class="an-tools">
											<input type="search" class="an-input" id="anServiceSearch" placeholder="Поиск услуги…" style="flex:1 1 240px">
											<div class="an-legend" id="anServiceChips"></div>
										</div>
										<div class="an-scroll" id="anServiceTable"></div>
									</div>
								</div>
							</section>

							<!-- ЧЕКИ -->
							<section class="an-panel" data-panel="checks">
								<div class="an-card" style="margin-bottom:16px">
									<div class="an-card-head"><h3>Найти чек</h3></div>
									<div class="an-card-body">
										<form class="an-tools" id="anCheckForm">
											<input type="number" min="1" class="an-input" id="anCheckId" placeholder="Номер чека, например 70770" style="flex:0 1 280px">
											<button type="submit" class="an-btn">Показать</button>
										</form>
										<div id="anCheckResult"></div>
									</div>
								</div>
								<div class="an-card">
									<div class="an-card-head"><h3>Чеки по дням</h3><span class="an-note">Нажмите на день, чтобы увидеть чеки и позиции</span></div>
									<div class="an-card-body an-scroll" id="anDays"></div>
								</div>
							</section>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="an-tooltip" id="anTooltip" hidden></div>

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

	var API = 'request/analytics/api.php';
	var REFRESH_MS = 5 * 60 * 1000;
	var root = document.getElementById('an');
	var css = getComputedStyle(root);
	var C = {
		s1: css.getPropertyValue('--an-s1').trim(), s2: css.getPropertyValue('--an-s2').trim(),
		s3: css.getPropertyValue('--an-s3').trim(), s4: css.getPropertyValue('--an-s4').trim(),
		s5: css.getPropertyValue('--an-s5').trim(), s6: css.getPropertyValue('--an-s6').trim(),
		other: css.getPropertyValue('--an-other').trim(),
		muted: 'rgba(226, 232, 240, .58)', grid: 'rgba(255, 255, 255, .07)', text: '#eef2f7'
	};
	var SERIES = [C.s1, C.s2, C.s3, C.s4, C.s5, C.s6];
	var CATEGORY_COLORS = { a: C.s1, b: C.s2, c: C.s3, d: C.s4, e: C.s5, x: C.other };
	var PAY = [
		{ key: 'card', label: 'Карта', color: C.s1 },
		{ key: 'cash', label: 'Наличные', color: C.s2 },
		{ key: 'yr', label: 'Юр. лица', color: C.s3 },
		{ key: 'other', label: 'Не указано', color: C.other }
	];
	var PAY_BY_KEY = { card: PAY[0], cash: PAY[1], yr: PAY[2] };
	var MONTHS = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'];
	var MONTHS_FULL = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
	var WEEKDAYS = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];

	var state = {
		tab: 'overview', preset: '30d', from: null, to: null, gran: null,
		summary: null, months: null, firstDate: null,
		yearMetric: 's', hiddenYears: {}, heatMetric: 'n',
		serviceCat: '', serviceSort: 'revenue', serviceLimit: 50
	};
	var charts = {};
	var loadSeq = 0;

	// ── форматирование ─────────────────────────
	var nf = new Intl.NumberFormat('ru-RU', { maximumFractionDigits: 0 });
	var nf1 = new Intl.NumberFormat('ru-RU', { maximumFractionDigits: 1 });
	function money(v) { return nf.format(Math.round(v || 0)) + ' ₽'; }
	function int(v) { return nf.format(Math.round(v || 0)); }
	function pct(v) { return nf1.format(v * 100) + '%'; }
	function compact(v) {
		var a = Math.abs(v);
		if (a >= 1e6) return nf1.format(v / 1e6) + ' млн';
		if (a >= 1e3) return nf1.format(v / 1e3) + ' тыс';
		return nf.format(v);
	}
	function esc(s) {
		return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
			return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
		});
	}
	function parseDate(s) { var p = s.split('-'); return new Date(+p[0], +p[1] - 1, +p[2]); }
	function ymd(d) {
		return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
	}
	function addDays(d, n) { var r = new Date(d); r.setDate(r.getDate() + n); return r; }
	function dayLabel(s, withYear) {
		var d = parseDate(s);
		return d.getDate() + ' ' + MONTHS[d.getMonth()].toLowerCase() + (withYear ? ' ' + d.getFullYear() : '');
	}
	function rangeLabel(from, to) {
		var sameYear = from.slice(0, 4) === to.slice(0, 4) && from.slice(0, 4) === String(new Date().getFullYear());
		return from === to ? dayLabel(from, !sameYear) : dayLabel(from, !sameYear) + ' – ' + dayLabel(to, !sameYear);
	}

	// ── период ─────────────────────────────────
	function presetRange(preset) {
		var today = new Date(); today.setHours(0, 0, 0, 0);
		switch (preset) {
			case 'today': return [today, today];
			case 'yesterday': return [addDays(today, -1), addDays(today, -1)];
			case '7d': return [addDays(today, -6), today];
			case '30d': return [addDays(today, -29), today];
			case 'month': return [new Date(today.getFullYear(), today.getMonth(), 1), today];
			case 'lastMonth': return [new Date(today.getFullYear(), today.getMonth() - 1, 1), new Date(today.getFullYear(), today.getMonth(), 0)];
			case 'year': return [new Date(today.getFullYear(), 0, 1), today];
			case 'all': return [state.firstDate ? parseDate(state.firstDate) : new Date(2020, 0, 1), today];
		}
		return null;
	}

	function setPeriod(from, to, preset) {
		state.from = from; state.to = to; state.preset = preset || '';
		state.gran = null;
		document.getElementById('anFrom').value = from;
		document.getElementById('anTo').value = to;
		root.querySelectorAll('[data-preset]').forEach(function (b) {
			b.classList.toggle('is-active', b.getAttribute('data-preset') === state.preset);
		});
		saveHash();
		loadSummary();
	}

	function saveHash() {
		var parts = ['tab=' + state.tab];
		if (state.preset) parts.push('preset=' + state.preset);
		else parts.push('from=' + state.from, 'to=' + state.to);
		try { history.replaceState(null, '', '#' + parts.join('&')); } catch (e) {}
	}

	function readHash() {
		var out = {};
		(location.hash || '').slice(1).split('&').forEach(function (p) {
			var kv = p.split('=');
			if (kv[0]) out[kv[0]] = decodeURIComponent(kv[1] || '');
		});
		return out;
	}

	// ── загрузка ───────────────────────────────
	function api(params) {
		var query = Object.keys(params).map(function (k) { return k + '=' + encodeURIComponent(params[k]); }).join('&');
		return fetch(API + '?' + query, { credentials: 'same-origin' }).then(function (r) {
			return r.json().catch(function () { return { error: 'Ответ сервера не распознан (' + r.status + ')' }; }).then(function (data) {
				if (!r.ok || data.error) throw new Error(data.error || ('Ошибка ' + r.status));
				return data;
			});
		});
	}

	function showError(message) {
		var box = document.getElementById('anError');
		box.hidden = !message;
		box.textContent = message ? 'Не удалось загрузить данные: ' + message : '';
	}

	function loadSummary(silent) {
		var seq = ++loadSeq;
		var main = document.getElementById('anMain');
		if (state.summary) main.classList.add('is-loading');
		var btn = document.getElementById('anRefresh');
		btn.classList.add('is-spinning');

		return api({ action: 'summary', from: state.from, to: state.to }).then(function (data) {
			if (seq !== loadSeq) return;
			state.summary = prepare(data);
			document.getElementById('anLoader').hidden = true;
			showError('');
			renderAll();
			setStatus(data.generatedAt);
		}).catch(function (e) {
			if (seq !== loadSeq) return;
			document.getElementById('anLoader').hidden = true;
			if (!silent || !state.summary) showError(e.message);
		}).then(function () {
			if (seq === loadSeq) {
				main.classList.remove('is-loading');
				btn.classList.remove('is-spinning');
			}
		});
	}

	function loadMonths() {
		return api({ action: 'months' }).then(function (data) {
			state.months = data.months;
			if (data.months.length) {
				var first = data.months[0];
				state.firstDate = first[0] + '-' + String(first[1]).padStart(2, '0') + '-01';
			}
			if (state.tab === 'years') renderYears();
		});
	}

	function setStatus(generatedAt) {
		var t = generatedAt ? generatedAt.slice(11, 16) : '';
		var live = state.to >= ymd(new Date());
		document.getElementById('anStatus').textContent =
			'Период: ' + rangeLabel(state.from, state.to) + ' · данные на ' + t + (live ? ' · автообновление каждые 5 минут' : '');
	}

	// ── подготовка данных ──────────────────────
	function prepare(data) {
		data.totals = totals(data.daily);
		data.prevTotals = totals(data.prevDaily);
		return data;
	}

	function totals(rows) {
		var t = { n: 0, revenue: 0, discount: 0, discounted: 0, cash: 0, cash_n: 0, card: 0, card_n: 0, yr: 0, yr_n: 0, other: 0, other_n: 0, days: rows.length };
		rows.forEach(function (r) { Object.keys(t).forEach(function (k) { if (k !== 'days') t[k] += r[k] || 0; }); });
		t.avg = t.n ? t.revenue / t.n : 0;
		t.cashless = t.revenue ? (t.card + t.yr) / t.revenue : 0;
		return t;
	}

	function autoGranularity(days) { return days <= 45 ? 'day' : (days <= 210 ? 'week' : 'month'); }

	function bucketKey(dateStr, gran) {
		var d = parseDate(dateStr);
		if (gran === 'month') return dateStr.slice(0, 7);
		if (gran === 'week') { var wd = (d.getDay() + 6) % 7; return ymd(addDays(d, -wd)); }
		return dateStr;
	}

	/** Непрерывный ряд корзин от from до to, дни без продаж — нули. */
	function buckets(rows, from, to, gran) {
		var map = {};
		rows.forEach(function (r) {
			var k = bucketKey(r.d, gran);
			if (!map[k]) map[k] = { revenue: 0, n: 0 };
			map[k].revenue += r.revenue; map[k].n += r.n;
		});
		var out = [], seen = {};
		for (var d = parseDate(from), end = parseDate(to); d <= end; d = addDays(d, 1)) {
			var k = bucketKey(ymd(d), gran);
			if (seen[k]) continue;
			seen[k] = true;
			out.push({ key: k, revenue: map[k] ? map[k].revenue : 0, n: map[k] ? map[k].n : 0 });
		}
		return out;
	}

	function bucketLabel(key, gran) {
		if (gran === 'month') { var p = key.split('-'); return MONTHS[+p[1] - 1] + ' ' + p[0].slice(2); }
		if (gran === 'week') return 'с ' + dayLabel(key);
		return dayLabel(key);
	}

	// ── Chart.js ───────────────────────────────
	if (window.Chart) {
		Chart.defaults.color = C.muted;
		Chart.defaults.font.family = "'Onest', 'Segoe UI', sans-serif";
		Chart.defaults.font.size = 12;
		Chart.defaults.borderColor = C.grid;
		Chart.defaults.animation.duration = 350;
	}

	function tooltipStyle(extra) {
		var base = {
			backgroundColor: '#1b2129', borderColor: 'rgba(255,255,255,.12)', borderWidth: 1,
			titleColor: C.text, bodyColor: C.text, padding: 10, cornerRadius: 9, boxPadding: 5,
			titleFont: { weight: '600' }, usePointStyle: true
		};
		return Object.assign(base, extra || {});
	}

	function axes(yFormat) {
		return {
			x: { grid: { display: false }, border: { color: 'rgba(255,255,255,.14)' }, ticks: { maxRotation: 0, autoSkipPadding: 14 } },
			y: { beginAtZero: true, grid: { color: C.grid }, border: { display: false }, ticks: { callback: yFormat || compact, maxTicksLimit: 6 } }
		};
	}

	function drawChart(id, config) {
		if (!window.Chart) return;
		if (charts[id]) charts[id].destroy();
		charts[id] = new Chart(document.getElementById(id), config);
	}

	// ── рендер ─────────────────────────────────
	function renderAll() {
		if (!state.summary) return;
		if (state.tab === 'overview') renderOverview();
		if (state.tab === 'years') renderYears();
		if (state.tab === 'time') renderTime();
		if (state.tab === 'services') renderServices();
		if (state.tab === 'checks') renderChecks();
	}

	function delta(cur, prev, invert) {
		if (!prev) return '<span class="an-delta is-flat">нет данных для сравнения</span>';
		var ch = (cur - prev) / prev;
		if (Math.abs(ch) < 0.005) return '<span class="an-delta is-flat">без изменений</span>';
		var up = ch > 0;
		var good = invert ? !up : up;
		return '<span class="an-delta ' + (good ? 'is-up' : 'is-down') + '">' + (up ? '▲ +' : '▼ −') + nf1.format(Math.abs(ch) * 100) + '%</span>';
	}

	function renderOverview() {
		var s = state.summary, t = s.totals, p = s.prevTotals;
		var prevLabel = 'к ' + rangeLabel(s.prev.from, s.prev.to);
		var best = s.daily.reduce(function (b, r) { return !b || r.revenue > b.revenue ? r : b; }, null);

		var kpis = [
			{ hero: true, icon: 'bx-wallet', label: 'Выручка', value: money(t.revenue), delta: delta(t.revenue, p.revenue) },
			{ icon: 'bx-receipt', label: 'Чеков', value: int(t.n), delta: delta(t.n, p.n) },
			{ icon: 'bx-calculator', label: 'Средний чек', value: money(t.avg), delta: delta(t.avg, p.avg) },
			{ icon: 'bx-credit-card', label: 'Безналичные', value: pct(t.cashless), delta: '<span class="an-note">' + money(t.card + t.yr) + '</span>' },
			{ icon: 'bx-purchase-tag', label: 'Скидки', value: money(t.discount), delta: '<span class="an-note">' + (t.n ? pct(t.discounted / t.n) : '0%') + ' чеков со скидкой</span>' },
			{ icon: 'bx-trophy', label: 'Лучший день', value: best ? money(best.revenue) : '—', delta: '<span class="an-note">' + (best ? dayLabel(best.d, s.period.days > 300) + ' · ' + int(best.n) + ' чеков' : 'нет продаж') + '</span>' }
		];
		document.getElementById('anKpis').innerHTML = kpis.map(function (k, i) {
			var note = i < 3 && p.n ? '<span class="an-note">' + esc(prevLabel) + '</span>' : '';
			return '<div class="an-card an-kpi' + (k.hero ? ' is-hero' : '') + '">' +
				'<div class="an-kpi-label"><i class="bx ' + k.icon + '"></i>' + k.label + '</div>' +
				'<div class="an-kpi-value">' + k.value + '</div>' + k.delta + note + '</div>';
		}).join('');

		// выручка по корзинам
		var gran = state.gran || autoGranularity(s.period.days);
		root.querySelectorAll('[data-gran]').forEach(function (b) { b.classList.toggle('is-active', b.getAttribute('data-gran') === gran); });
		var cur = buckets(s.daily, s.period.from, s.period.to, gran);
		var prev = buckets(s.prevDaily, s.prev.from, s.prev.to, gran);
		var labels = cur.map(function (b) { return bucketLabel(b.key, gran); });

		drawChart('chRevenue', {
			type: 'bar',
			data: {
				labels: labels,
				datasets: [
					{
						type: 'line', label: 'Предыдущий период', order: 0,
						data: cur.map(function (_, i) { return prev[i] ? prev[i].revenue : null; }),
						borderColor: 'rgba(226,232,240,.5)', borderWidth: 2, pointRadius: 0, pointHoverRadius: 4,
						pointBackgroundColor: 'rgba(226,232,240,.8)', tension: .3, spanGaps: true
					},
					{
						label: 'Выручка', order: 1, data: cur.map(function (b) { return b.revenue; }),
						backgroundColor: C.s1, hoverBackgroundColor: '#5a9deb', borderRadius: 4, borderSkipped: 'start',
						maxBarThickness: 34, categoryPercentage: .86, barPercentage: .92
					}
				]
			},
			options: {
				responsive: true, maintainAspectRatio: false,
				interaction: { mode: 'index', intersect: false },
				plugins: {
					legend: { display: false },
					tooltip: tooltipStyle({
						callbacks: {
							title: function (items) { return labels[items[0].dataIndex]; },
							label: function (ctx) {
								var i = ctx.dataIndex;
								if (ctx.dataset.type === 'line') {
									return prev[i] ? ' Раньше (' + bucketLabel(prev[i].key, gran) + '): ' + money(prev[i].revenue) : null;
								}
								return ' ' + money(cur[i].revenue) + ' · ' + int(cur[i].n) + ' чеков';
							}
						}
					})
				},
				scales: axes()
			}
		});

		drawChart('chChecks', {
			type: 'bar',
			data: { labels: labels, datasets: [{ label: 'Чеков', data: cur.map(function (b) { return b.n; }), backgroundColor: C.s1, borderRadius: 4, borderSkipped: 'start', maxBarThickness: 26, categoryPercentage: .86, barPercentage: .92 }] },
			options: {
				responsive: true, maintainAspectRatio: false,
				plugins: { legend: { display: false }, tooltip: tooltipStyle({ callbacks: { label: function (ctx) { return ' ' + int(ctx.raw) + ' чеков · средний ' + money(cur[ctx.dataIndex].n ? cur[ctx.dataIndex].revenue / cur[ctx.dataIndex].n : 0); } } }) },
				scales: axes(function (v) { return nf.format(v); })
			}
		});

		renderPayments(t);
		document.getElementById('anCategories').innerHTML = categoryBars(false);
		renderTopServices();
	}

	function renderPayments(t) {
		var el = document.getElementById('anPayments');
		if (!t.revenue) { el.innerHTML = '<div class="an-empty">Нет продаж за период</div>'; return; }
		var items = PAY.map(function (p) { return { p: p, sum: t[p.key], n: t[p.key + '_n'] }; }).filter(function (x) { return x.n > 0; });
		el.innerHTML =
			'<div class="an-stack" role="img" aria-label="Доли способов оплаты">' +
			items.map(function (x) { return '<div style="flex:' + x.sum + ';background:' + x.p.color + '" title="' + esc(x.p.label + ': ' + pct(x.sum / t.revenue)) + '"></div>'; }).join('') +
			'</div>' +
			'<table class="an-table"><thead><tr><th>Способ</th><th class="num">Выручка</th><th class="num">Доля</th><th class="num">Чеков</th><th class="num">Средний чек</th></tr></thead><tbody>' +
			items.map(function (x) {
				return '<tr><td><span class="an-tag" style="--dot:' + x.p.color + ';color:var(--an-text)">' + x.p.label + '</span></td>' +
					'<td class="num">' + money(x.sum) + '</td><td class="num">' + pct(x.sum / t.revenue) + '</td>' +
					'<td class="num">' + int(x.n) + '</td><td class="num">' + money(x.sum / x.n) + '</td></tr>';
			}).join('') +
			'</tbody></table>';
	}

	function categoryTotals() {
		var s = state.summary, cats = {}, groups = {}, total = 0;
		s.services.forEach(function (sv) {
			total += sv.revenue;
			if (!cats[sv.cat]) cats[sv.cat] = { code: sv.cat, name: s.categories[sv.cat] || sv.cat, revenue: 0, qty: 0 };
			cats[sv.cat].revenue += sv.revenue; cats[sv.cat].qty += sv.qty;
			if (sv.group) {
				if (!groups[sv.group]) groups[sv.group] = { code: sv.group, cat: sv.cat, name: s.groups[sv.group] || sv.group, revenue: 0, qty: 0 };
				groups[sv.group].revenue += sv.revenue; groups[sv.group].qty += sv.qty;
			}
		});
		var sort = function (o) { return Object.keys(o).map(function (k) { return o[k]; }).sort(function (a, b) { return b.revenue - a.revenue; }); };
		return { cats: sort(cats), groups: sort(groups), total: total };
	}

	function barRow(name, value, share, max, color, extra) {
		return '<span class="an-bar-name">' + esc(name) + '</span>' +
			'<span class="an-bar-track"><span class="an-bar-fill" style="display:block;width:' + (max ? Math.max(1, value / max * 100) : 0) + '%;background:' + color + '"></span></span>' +
			'<span class="an-bar-value">' + money(value) + '<small>' + pct(share) + '</small></span>' + (extra || '');
	}

	function categoryBars(clickable) {
		var ct = categoryTotals();
		if (!ct.total) return '<div class="an-empty">Нет продаж за период</div>';
		var max = ct.cats[0].revenue;
		return '<div class="an-bars">' + ct.cats.map(function (c) {
			var inner = barRow(c.name, c.revenue, c.revenue / ct.total, max, CATEGORY_COLORS[c.code] || C.other);
			return clickable
				? '<button type="button" class="an-bar-row' + (state.serviceCat === c.code ? ' is-active' : '') + '" data-cat="' + c.code + '">' + inner + '</button>'
				: '<div class="an-bar-row">' + inner + '</div>';
		}).join('') + '</div>';
	}

	function renderTopServices() {
		var s = state.summary, list = s.services.slice(0, 10), total = s.services.reduce(function (a, b) { return a + b.revenue; }, 0);
		var el = document.getElementById('anTopServices');
		if (!list.length) { el.innerHTML = '<div class="an-empty">Нет продаж за период</div>'; return; }
		el.innerHTML = '<table class="an-table"><thead><tr><th>Услуга</th><th class="num">Кол-во</th><th class="num">Выручка</th></tr></thead><tbody>' +
			list.map(function (sv) {
				return '<tr><td><div>' + esc(sv.name) + '</div><span class="an-tag" style="--dot:' + (CATEGORY_COLORS[sv.cat] || C.other) + '">' + esc(s.categories[sv.cat]) + ' · ' + pct(sv.revenue / total) + '</span></td>' +
					'<td class="num">' + int(sv.qty) + '</td><td class="num">' + money(sv.revenue) + '</td></tr>';
			}).join('') + '</tbody></table>';
	}

	// Годы
	function renderYears() {
		if (!state.months) return;
		var byYear = {};
		state.months.forEach(function (m) {
			if (!byYear[m[0]]) byYear[m[0]] = { total: 0, months: {} };
			byYear[m[0]].months[m[1]] = { n: m[2], s: m[3] };
			byYear[m[0]].total += m[2];
		});
		// годы, где почти нет чеков (единичные записи), не показываем
		var years = Object.keys(byYear).filter(function (y) { return byYear[y].total >= 30; }).map(Number).sort(function (a, b) { return b - a; }).slice(0, 6);
		var metric = state.yearMetric;
		var value = function (y, m) {
			var c = byYear[y].months[m];
			if (!c) return null;
			return metric === 'avg' ? (c.n ? c.s / c.n : null) : c[metric];
		};
		var fmt = metric === 'n' ? int : money;
		var color = function (y) { return SERIES[years.indexOf(y)] || C.other; };

		root.querySelectorAll('[data-year-metric] [data-metric]').forEach(function (b) { b.classList.toggle('is-active', b.getAttribute('data-metric') === metric); });
		document.getElementById('anYearChips').innerHTML = years.map(function (y) {
			return '<button type="button" class="an-chip' + (state.hiddenYears[y] ? ' is-off' : '') + '" data-year="' + y + '"><i class="an-key" style="background:' + color(y) + '"></i>' + y + '</button>';
		}).join('');

		drawChart('chYears', {
			type: 'line',
			data: {
				labels: MONTHS,
				datasets: years.slice().reverse().map(function (y) {
					return {
						label: String(y), data: MONTHS.map(function (_, i) { return value(y, i + 1); }),
						borderColor: color(y), backgroundColor: color(y), borderWidth: y === years[0] ? 3 : 2,
						pointRadius: 3, pointHoverRadius: 6, pointBorderColor: '#262e38', pointBorderWidth: 2,
						tension: .3, spanGaps: false, hidden: !!state.hiddenYears[y]
					};
				})
			},
			options: {
				responsive: true, maintainAspectRatio: false,
				interaction: { mode: 'index', intersect: false },
				plugins: {
					legend: { display: false },
					tooltip: tooltipStyle({
						itemSort: function (a, b) { return (b.raw || 0) - (a.raw || 0); },
						callbacks: {
							title: function (items) { return MONTHS_FULL[items[0].dataIndex]; },
							label: function (ctx) { return ctx.raw == null ? null : ' ' + ctx.dataset.label + ': ' + fmt(ctx.raw); }
						}
					})
				},
				scales: axes(metric === 'n' ? function (v) { return nf.format(v); } : compact)
			}
		});

		// таблица месяц × год с подсветкой по величине
		var titles = { s: 'Выручка по месяцам', n: 'Чеки по месяцам', avg: 'Средний чек по месяцам' };
		document.getElementById('anYearTableTitle').textContent = titles[metric];
		var max = 0;
		years.forEach(function (y) { for (var m = 1; m <= 12; m++) { var v = value(y, m); if (v > max) max = v; } });
		var yearTotal = function (y) {
			var n = 0, s = 0;
			Object.keys(byYear[y].months).forEach(function (m) { n += byYear[y].months[m].n; s += byYear[y].months[m].s; });
			return metric === 'avg' ? (n ? s / n : 0) : (metric === 'n' ? n : s);
		};
		var html = '<table class="an-table"><thead><tr><th>Месяц</th>' + years.map(function (y) { return '<th class="num">' + y + '</th>'; }).join('') + '</tr></thead><tbody>';
		for (var m = 1; m <= 12; m++) {
			html += '<tr><td>' + MONTHS_FULL[m - 1] + '</td>' + years.map(function (y) {
				var v = value(y, m);
				return v == null ? '<td class="num" style="color:var(--an-faint)">—</td>'
					: '<td class="num an-heat-cell" style="--a:' + (max ? (0.08 + 0.5 * v / max).toFixed(3) : 0) + '"><span>' + fmt(v) + '</span></td>';
			}).join('') + '</tr>';
		}
		html += '</tbody><tfoot><tr><td>' + (metric === 'avg' ? 'За год' : 'Итого') + '</td>' + years.map(function (y) { return '<td class="num">' + fmt(yearTotal(y)) + '</td>'; }).join('') + '</tr></tfoot></table>';
		document.getElementById('anYearTable').innerHTML = html;
	}

	// Время
	function renderTime() {
		var s = state.summary, metric = state.heatMetric;
		root.querySelectorAll('[data-heat-metric] [data-metric]').forEach(function (b) { b.classList.toggle('is-active', b.getAttribute('data-metric') === metric); });

		var cells = {}, minH = 9, maxH = 21, max = 0;
		s.heatmap.forEach(function (c) {
			cells[c[0] + '_' + c[1]] = c;
			if (c[2] >= 3) { minH = Math.min(minH, c[1]); maxH = Math.max(maxH, c[1]); }
		});
		var hours = [];
		for (var h = minH; h <= maxH; h++) hours.push(h);
		s.heatmap.forEach(function (c) { if (hours.indexOf(c[1]) !== -1) max = Math.max(max, metric === 'n' ? c[2] : c[3]); });

		var el = document.getElementById('anHeatmap');
		el.style.gridTemplateColumns = '38px repeat(' + hours.length + ', minmax(34px, 1fr))';
		var html = '<div></div>' + hours.map(function (h) { return '<div>' + h + ':00</div>'; }).join('');
		WEEKDAYS.forEach(function (wd, i) {
			html += '<div style="justify-content:start">' + wd + '</div>';
			hours.forEach(function (h) {
				var c = cells[i + '_' + h];
				var v = c ? (metric === 'n' ? c[2] : c[3]) : 0;
				var ratio = max ? v / max : 0;
				var label = v ? (metric === 'n' ? int(v) : compact(v)) : '';
				html += '<div class="an-hm-cell" style="--a:' + (v ? (0.06 + 0.94 * ratio).toFixed(3) : 0.02) + ';--t:' + (ratio > 0.45 ? 1 : 0.7) + '"' +
					' data-tip="' + esc(wd + ', ' + h + ':00–' + (h + 1) + ':00|' + (c ? int(c[2]) + ' чеков · ' + money(c[3]) : 'нет чеков')) + '">' + label + '</div>';
			});
		});
		el.innerHTML = html;

		// по часам: среднее число чеков за день с продажами
		var workDays = s.daily.filter(function (r) { return r.n > 0; }).length || 1;
		var byHour = hours.map(function (h) {
			var n = 0;
			for (var d = 0; d < 7; d++) { var c = cells[d + '_' + h]; if (c) n += c[2]; }
			return n / workDays;
		});
		drawChart('chHours', {
			type: 'bar',
			data: { labels: hours.map(function (h) { return h + ':00'; }), datasets: [{ data: byHour, backgroundColor: C.s1, borderRadius: 4, borderSkipped: 'start', maxBarThickness: 26 }] },
			options: {
				responsive: true, maintainAspectRatio: false,
				plugins: { legend: { display: false }, tooltip: tooltipStyle({ callbacks: { label: function (ctx) { return ' ' + nf1.format(ctx.raw) + ' чеков в среднем'; } } }) },
				scales: axes(function (v) { return nf1.format(v); })
			}
		});

		// по дням недели: средняя выручка за день с продажами
		var wdSum = [0, 0, 0, 0, 0, 0, 0], wdDays = [0, 0, 0, 0, 0, 0, 0];
		s.daily.forEach(function (r) {
			if (!r.n) return;
			var i = (parseDate(r.d).getDay() + 6) % 7;
			wdSum[i] += r.revenue; wdDays[i]++;
		});
		drawChart('chWeekdays', {
			type: 'bar',
			data: { labels: WEEKDAYS, datasets: [{ data: wdSum.map(function (v, i) { return wdDays[i] ? v / wdDays[i] : 0; }), backgroundColor: C.s1, borderRadius: 4, borderSkipped: 'start', maxBarThickness: 40 }] },
			options: {
				responsive: true, maintainAspectRatio: false,
				plugins: { legend: { display: false }, tooltip: tooltipStyle({ callbacks: { label: function (ctx) { return ' ' + money(ctx.raw) + ' в среднем · дней: ' + wdDays[ctx.dataIndex]; } } }) },
				scales: axes()
			}
		});
	}

	// Услуги
	function renderServices() {
		var s = state.summary, ct = categoryTotals();
		document.getElementById('anServiceCategories').innerHTML = categoryBars(true);

		var groups = ct.groups.filter(function (g) { return !state.serviceCat || g.cat === state.serviceCat; }).slice(0, 12);
		var gmax = groups.length ? groups[0].revenue : 0;
		document.getElementById('anServiceGroups').innerHTML = groups.length
			? '<div class="an-bars">' + groups.map(function (g) { return '<div class="an-bar-row">' + barRow(g.name, g.revenue, ct.total ? g.revenue / ct.total : 0, gmax, CATEGORY_COLORS[g.cat] || C.other) + '</div>'; }).join('') + '</div>'
			: '<div class="an-empty">Нет данных</div>';

		document.getElementById('anServiceChips').innerHTML =
			'<button type="button" class="an-chip' + (!state.serviceCat ? ' is-active' : '') + '" data-cat="">Все разделы</button>' +
			ct.cats.map(function (c) {
				return '<button type="button" class="an-chip' + (state.serviceCat === c.code ? ' is-active' : '') + '" data-cat="' + c.code + '"><i class="an-key" style="background:' + (CATEGORY_COLORS[c.code] || C.other) + '"></i>' + esc(c.name) + '</button>';
			}).join('');
		renderServiceTable();
	}

	function renderServiceTable() {
		var s = state.summary;
		var q = document.getElementById('anServiceSearch').value.trim().toLowerCase().replace(/ё/g, 'е');
		var words = q ? q.split(/\s+/) : [];
		var total = s.services.reduce(function (a, b) { return a + b.revenue; }, 0);
		var list = s.services.filter(function (sv) {
			if (state.serviceCat && sv.cat !== state.serviceCat) return false;
			var hay = (sv.name + ' ' + (s.groups[sv.group] || '')).toLowerCase().replace(/ё/g, 'е');
			return words.every(function (w) { return hay.indexOf(w) !== -1; });
		});
		var key = state.serviceSort;
		list.sort(function (a, b) { return key === 'name' ? a.name.localeCompare(b.name, 'ru') : b[key] - a[key]; });

		var el = document.getElementById('anServiceTable');
		if (!list.length) { el.innerHTML = '<div class="an-empty">Ничего не найдено</div>'; return; }
		var shown = list.slice(0, state.serviceLimit);
		var max = Math.max.apply(null, list.map(function (x) { return x.revenue; }));
		var th = function (k, label, cls) { return '<th class="' + (cls || '') + (key === k ? ' is-sorted' : '') + '" data-sort="' + k + '">' + label + '</th>'; };
		var sums = list.reduce(function (a, x) { a.revenue += x.revenue; a.qty += x.qty; return a; }, { revenue: 0, qty: 0 });

		el.innerHTML = '<table class="an-table"><thead><tr>' + th('name', 'Услуга') + '<th>Раздел</th>' + th('qty', 'Кол-во', 'num') + th('checks', 'Чеков', 'num') + th('revenue', 'Выручка', 'num') + '<th>Доля</th></tr></thead><tbody>' +
			shown.map(function (sv) {
				var color = CATEGORY_COLORS[sv.cat] || C.other;
				return '<tr><td>' + esc(sv.name) + '</td><td><span class="an-tag" style="--dot:' + color + '">' + esc(s.groups[sv.group] || s.categories[sv.cat]) + '</span></td>' +
					'<td class="num">' + int(sv.qty) + '</td><td class="num">' + int(sv.checks) + '</td><td class="num">' + money(sv.revenue) + '</td>' +
					'<td><div class="an-share"><span class="an-bar-track"><span class="an-bar-fill" style="display:block;width:' + (max ? sv.revenue / max * 100 : 0) + '%;background:' + color + '"></span></span><small>' + pct(total ? sv.revenue / total : 0) + '</small></div></td></tr>';
			}).join('') +
			'</tbody><tfoot><tr><td colspan="2">Итого: ' + int(list.length) + ' услуг</td><td class="num">' + int(sums.qty) + '</td><td></td><td class="num">' + money(sums.revenue) + '</td><td></td></tr></tfoot></table>' +
			(list.length > shown.length ? '<div style="text-align:center;margin-top:12px"><button type="button" class="an-btn" data-more-services>Показать ещё ' + int(Math.min(50, list.length - shown.length)) + ' из ' + int(list.length - shown.length) + '</button></div>' : '');
	}

	// Чеки
	function renderChecks() {
		var s = state.summary;
		var map = {};
		s.daily.forEach(function (r) { map[r.d] = r; });
		var days = [];
		for (var d = parseDate(s.period.to), end = parseDate(s.period.from); d >= end && days.length < 400; d = addDays(d, -1)) days.push(ymd(d));

		var html = '<table class="an-table"><thead><tr><th>День</th><th class="num">Чеков</th><th class="num">Выручка</th><th class="num">Средний чек</th><th class="num">Карта</th><th class="num">Наличные</th><th class="num">Скидки</th></tr></thead><tbody>';
		days.forEach(function (day) {
			var r = map[day];
			var wd = WEEKDAYS[(parseDate(day).getDay() + 6) % 7];
			if (!r) {
				html += '<tr class="an-day-row is-empty"><td>' + dayLabel(day, true) + ', ' + wd.toLowerCase() + '</td><td class="num" colspan="6">нет чеков</td></tr>';
				return;
			}
			html += '<tr class="an-day-row" data-day="' + day + '" tabindex="0"><td>' + dayLabel(day, true) + ', ' + wd.toLowerCase() + '</td>' +
				'<td class="num">' + int(r.n) + '</td><td class="num"><b>' + money(r.revenue) + '</b></td><td class="num">' + money(r.revenue / r.n) + '</td>' +
				'<td class="num">' + money(r.card + r.yr) + '</td><td class="num">' + money(r.cash) + '</td><td class="num">' + (r.discount ? money(r.discount) : '—') + '</td></tr>';
		});
		html += '</tbody></table>';
		if (days.length >= 400) html += '<p class="an-note" style="margin-top:10px">Показаны последние 400 дней периода.</p>';
		document.getElementById('anDays').innerHTML = html;
	}

	function checksHtml(checks) {
		if (!checks.length) return '<div class="an-empty">Чеков нет</div>';
		return '<div class="an-checks">' + checks.map(function (c) {
			var pay = PAY_BY_KEY[c.pay] || PAY[3];
			var itemsSum = c.items.reduce(function (a, i) { return a + i.sum; }, 0);
			var contact = c.contact ? [c.contact.client, c.contact.tel, c.contact.srok].filter(Boolean).map(esc).join(' · ') : '';
			return '<div class="an-check"><div class="an-check-head">' +
				'<b>№ ' + c.id + '</b><span class="an-note">' + (c.time.slice(0, 10) === state.openDay ? c.time.slice(11, 16) : dayLabel(c.time.slice(0, 10), true) + ', ' + c.time.slice(11, 16)) + '</span>' +
				'<span class="an-pay" style="--dot:' + pay.color + '">' + pay.label + '</span>' +
				(c.draft ? '<span class="an-pay">черновик</span>' : '') +
				(contact ? '<span class="an-note"><i class="bx bx-user"></i> ' + contact + '</span>' : '') +
				'<span class="an-check-sum">' + money(c.cost) + (c.discount ? ' <span class="an-note">(скидка ' + money(c.discount) + ')</span>' : '') + '</span></div>' +
				'<table class="an-table"><tbody>' + c.items.map(function (i) {
					return '<tr><td>' + esc(i.name) + '</td><td class="num">' + int(i.qty) + ' × ' + money(i.unit) + '</td><td class="num">' + money(i.sum) + '</td></tr>';
				}).join('') +
				(c.items.length > 1 ? '<tr><td class="an-note">Позиций: ' + c.items.length + '</td><td></td><td class="num an-note">' + money(itemsSum) + '</td></tr>' : '') +
				'</tbody></table></div>';
		}).join('') + '</div>';
	}

	function toggleDay(row) {
		var day = row.getAttribute('data-day');
		var next = row.nextElementSibling;
		if (next && next.classList.contains('an-day-detail')) {
			next.remove();
			row.classList.remove('is-open');
			return;
		}
		row.classList.add('is-open');
		var detail = document.createElement('tr');
		detail.className = 'an-day-detail';
		detail.innerHTML = '<td colspan="7"><div class="an-empty">Загрузка чеков…</div></td>';
		row.parentNode.insertBefore(detail, row.nextSibling);
		api({ action: 'checks', date: day }).then(function (data) {
			state.openDay = day;
			detail.firstChild.innerHTML = checksHtml(data.checks);
		}).catch(function (e) {
			detail.firstChild.innerHTML = '<div class="an-error">' + esc(e.message) + '</div>';
		});
	}

	// ── события ────────────────────────────────
	function setTab(tab) {
		if (!root.querySelector('[data-panel="' + tab + '"]')) tab = 'overview';
		state.tab = tab;
		root.querySelectorAll('[data-tab]').forEach(function (b) { b.classList.toggle('is-active', b.getAttribute('data-tab') === tab); });
		root.querySelectorAll('[data-panel]').forEach(function (p) { p.classList.toggle('is-active', p.getAttribute('data-panel') === tab); });
		saveHash();
		if (tab === 'years' && !state.months) loadMonths().catch(function (e) { showError(e.message); });
		renderAll();
	}

	root.addEventListener('click', function (e) {
		var t = e.target.closest('button, .an-day-row');
		if (!t || !root.contains(t)) return;

		if (t.hasAttribute('data-tab')) return setTab(t.getAttribute('data-tab'));
		if (t.hasAttribute('data-goto')) { setTab(t.getAttribute('data-goto')); window.scrollTo({ top: 0, behavior: 'smooth' }); return; }
		if (t.hasAttribute('data-preset')) {
			var r = presetRange(t.getAttribute('data-preset'));
			return setPeriod(ymd(r[0]), ymd(r[1]), t.getAttribute('data-preset'));
		}
		if (t.hasAttribute('data-gran')) { state.gran = t.getAttribute('data-gran'); return renderOverview(); }
		if (t.closest('[data-year-metric]') && t.hasAttribute('data-metric')) { state.yearMetric = t.getAttribute('data-metric'); return renderYears(); }
		if (t.closest('[data-heat-metric]') && t.hasAttribute('data-metric')) { state.heatMetric = t.getAttribute('data-metric'); return renderTime(); }
		if (t.hasAttribute('data-year')) {
			var y = t.getAttribute('data-year');
			state.hiddenYears[y] = !state.hiddenYears[y];
			return renderYears();
		}
		if (t.hasAttribute('data-cat')) {
			var cat = t.getAttribute('data-cat');
			state.serviceCat = state.serviceCat === cat ? '' : cat;
			state.serviceLimit = 50;
			return renderServices();
		}
		if (t.hasAttribute('data-more-services')) { state.serviceLimit += 50; return renderServiceTable(); }
		if (t.classList.contains('an-day-row') && t.hasAttribute('data-day')) return toggleDay(t);
	});

	root.addEventListener('keydown', function (e) {
		if ((e.key === 'Enter' || e.key === ' ') && e.target.classList.contains('an-day-row') && e.target.hasAttribute('data-day')) {
			e.preventDefault();
			toggleDay(e.target);
		}
	});

	root.addEventListener('click', function (e) {
		var th = e.target.closest('th[data-sort]');
		if (!th) return;
		state.serviceSort = th.getAttribute('data-sort');
		renderServiceTable();
	});

	document.getElementById('anServiceSearch').addEventListener('input', function () { state.serviceLimit = 50; renderServiceTable(); });

	['anFrom', 'anTo'].forEach(function (id) {
		document.getElementById(id).addEventListener('change', function () {
			var from = document.getElementById('anFrom').value, to = document.getElementById('anTo').value;
			if (!from || !to) return;
			if (from > to) { var tmp = from; from = to; to = tmp; }
			setPeriod(from, to, '');
		});
	});

	document.getElementById('anRefresh').addEventListener('click', function () {
		if (state.preset) {
			var r = presetRange(state.preset);
			state.from = ymd(r[0]); state.to = ymd(r[1]);
		}
		loadSummary();
		if (state.months) loadMonths();
	});

	document.getElementById('anCheckForm').addEventListener('submit', function (e) {
		e.preventDefault();
		var id = document.getElementById('anCheckId').value;
		var out = document.getElementById('anCheckResult');
		if (!id) return;
		out.innerHTML = '<div class="an-empty">Поиск…</div>';
		api({ action: 'check', id: id }).then(function (data) {
			state.openDay = null;
			out.innerHTML = data.checks.length ? checksHtml(data.checks) : '<div class="an-empty">Чек № ' + esc(id) + ' не найден</div>';
		}).catch(function (err) { out.innerHTML = '<div class="an-error">' + esc(err.message) + '</div>'; });
	});

	// подсказка для тепловой карты
	var tip = document.getElementById('anTooltip');
	root.addEventListener('mousemove', function (e) {
		var cell = e.target.closest('[data-tip]');
		if (!cell) { tip.hidden = true; return; }
		var parts = cell.getAttribute('data-tip').split('|');
		tip.innerHTML = '<b>' + esc(parts[0]) + '</b><br>' + esc(parts[1]);
		tip.hidden = false;
		var x = Math.min(e.clientX + 14, window.innerWidth - tip.offsetWidth - 8);
		tip.style.left = x + 'px';
		tip.style.top = (e.clientY + 16) + 'px';
	});
	root.addEventListener('mouseleave', function () { tip.hidden = true; });

	// автообновление, пока период включает сегодня и вкладка открыта
	setInterval(function () {
		if (document.visibilityState !== 'visible' || !state.summary) return;
		var today = ymd(new Date());
		if (state.preset && state.preset !== 'yesterday' && state.preset !== 'lastMonth') {
			var r = presetRange(state.preset);
			state.from = ymd(r[0]); state.to = ymd(r[1]);
		}
		if (state.to >= today) loadSummary(true);
	}, REFRESH_MS);

	// ── старт ──────────────────────────────────
	if (!window.Chart) showError('не загрузилась библиотека графиков (нет доступа к cdnjs.cloudflare.com)');

	var h = readHash();
	state.tab = h.tab || 'overview';
	var init = function () {
		var preset = h.preset || (h.from && h.to ? '' : '30d');
		var range = preset ? presetRange(preset) : null;
		setTab(state.tab);
		setPeriod(range ? ymd(range[0]) : h.from, range ? ymd(range[1]) : h.to, preset);
	};
	// «Всё время» и вкладка «Годы» знают первую дату из помесячных итогов
	loadMonths().then(init, init);
})();
</script>

</body>
</html>
