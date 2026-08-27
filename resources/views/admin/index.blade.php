@extends('layouts.admin')
@section('content')
    <style>
        :root {
            --ncie-primary: #3B6CFF;
            --ncie-primary-dark: #2A4FCC;
            --ncie-primary-soft: #e8f2fc;
            --ncie-navy: #0B1230;
            --ncie-navy-deep: #0B1230;
            --ncie-magenta: #bc3e80;
            --ncie-bg: #f1f7fc;
            --ncie-surface: #ffffff;
            --ncie-text: #3d4b5c;
            --ncie-muted: #6b7c93;
            --ncie-border: #e3eaf2;
            --ncie-success: #1fa971;
            --ncie-warning: #f2a93b;
            --ncie-danger: #df1529;
            --ncie-info: #2bb3d9;
            --ncie-radius: 14px;
            --ncie-radius-sm: 10px;
            --ncie-shadow: 0 2px 15px rgba(0, 0, 0, .08);
            --ncie-shadow-lg: 0 14px 40px rgba(20, 47, 68, .14);
        }

        .dash-wrap {
            font-family: 'Archivo', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            color: var(--ncie-text, #3d4b5c);
            padding-top: 6px;
            padding-bottom: 24px;
        }

        /* ---------- Hero ---------- */
        .dash-hero {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 28px 32px;
            border-radius: 18px;
            color: #fff;
            background: linear-gradient(135deg, var(--ncie-navy-deep, #0B1230), var(--ncie-primary, #3B6CFF));
            box-shadow: var(--ncie-shadow-lg, 0 14px 40px rgba(20, 47, 68, .14));
            margin-bottom: 24px;
        }

        .dash-hero__body {
            position: relative;
            z-index: 1;
            min-width: 0;
        }

        .dash-hero__title {
            font-family: 'Archivo', system-ui, sans-serif;
            font-size: 26px;
            font-weight: 700;
            line-height: 1.2;
            margin: 0 0 4px;
            color: #fff;
            letter-spacing: -.01em;
        }

        .dash-hero__subtitle {
            margin: 0 0 14px;
            font-size: 15px;
            color: rgba(255, 255, 255, .85);
        }

        .dash-hero__chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .dash-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            max-width: 100%;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 12.5px;
            font-weight: 500;
            color: #fff;
            background: rgba(255, 255, 255, .16);
            border: 1px solid rgba(255, 255, 255, .28);
            word-break: break-all;
        }

        .dash-chip i {
            font-size: 13px;
            opacity: .9;
        }

        .dash-hero__date {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
            padding: 12px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .22);
            white-space: nowrap;
        }

        .dash-hero__date i {
            font-size: 18px;
        }

        .dash-hero__deco {
            position: absolute;
            right: 22px;
            bottom: -30px;
            font-size: 180px;
            line-height: 1;
            opacity: .18;
            color: #fff;
            pointer-events: none;
            z-index: 0;
        }

        /* ---------- KPI grid ---------- */
        .dash-section-title {
            font-family: 'Archivo', system-ui, sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: var(--ncie-muted, #6b7c93);
            margin: 0 0 12px;
        }

        .dash-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .dash-card {
            display: flex;
            flex-direction: column;
            min-height: 168px;
            padding: 18px 18px 14px;
            background: var(--ncie-surface, #fff);
            border: 1px solid var(--ncie-border, #e3eaf2);
            border-radius: var(--ncie-radius, 14px);
            box-shadow: var(--ncie-shadow, 0 2px 15px rgba(0, 0, 0, .08));
            color: var(--ncie-text, #3d4b5c);
            text-decoration: none;
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .dash-card:hover,
        .dash-card:focus {
            transform: translateY(-3px);
            box-shadow: var(--ncie-shadow-lg, 0 14px 40px rgba(20, 47, 68, .14));
            border-color: transparent;
            color: var(--ncie-text, #3d4b5c);
            text-decoration: none;
            outline: none;
        }

        .dash-card__icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            font-size: 22px;
            margin-bottom: 14px;
            transition: transform .2s ease;
        }

        .dash-card:hover .dash-card__icon {
            transform: scale(1.06);
        }

        .dash-card__value {
            font-family: 'Archivo', system-ui, sans-serif;
            font-size: 30px;
            font-weight: 700;
            line-height: 1.1;
            color: var(--ncie-navy, #0B1230);
            margin-bottom: 2px;
        }

        .dash-card__value--text {
            font-family: 'Archivo', system-ui, sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: var(--ncie-muted, #6b7c93);
            padding-top: 6px;
        }

        .dash-card__label {
            font-size: 14px;
            font-weight: 500;
            color: var(--ncie-muted, #6b7c93);
            line-height: 1.35;
        }

        .dash-card__more {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: auto;
            padding-top: 12px;
            font-size: 13px;
            font-weight: 600;
            color: var(--ncie-primary, #3B6CFF);
        }

        .dash-card__more i {
            transition: transform .2s ease;
        }

        .dash-card:hover .dash-card__more i {
            transform: translateX(3px);
        }

        /* Color variants */
        .dash-card--primary .dash-card__icon {
            color: var(--ncie-primary, #3B6CFF);
            background: #e8f2fc;
            background: color-mix(in srgb, var(--ncie-primary, #3B6CFF) 12%, white);
        }

        .dash-card--info .dash-card__icon {
            color: var(--ncie-info, #2bb3d9);
            background: #e6f6fa;
            background: color-mix(in srgb, var(--ncie-info, #2bb3d9) 12%, white);
        }

        .dash-card--success .dash-card__icon {
            color: var(--ncie-success, #1fa971);
            background: #e5f5ee;
            background: color-mix(in srgb, var(--ncie-success, #1fa971) 12%, white);
        }

        .dash-card--warning .dash-card__icon {
            color: var(--ncie-warning, #f2a93b);
            background: #fdf3e5;
            background: color-mix(in srgb, var(--ncie-warning, #f2a93b) 12%, white);
        }

        .dash-card--danger .dash-card__icon {
            color: var(--ncie-danger, #df1529);
            background: #fbe4e6;
            background: color-mix(in srgb, var(--ncie-danger, #df1529) 12%, white);
        }

        .dash-card--navy .dash-card__icon {
            color: var(--ncie-navy, #0B1230);
            background: #e6eaee;
            background: color-mix(in srgb, var(--ncie-navy, #0B1230) 12%, white);
        }

        /* ---------- Buttons ---------- */
        .dash-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 50px;
            border: 1px solid var(--ncie-primary, #3B6CFF);
            background: var(--ncie-primary, #3B6CFF);
            color: #fff;
            font-family: 'Archivo', system-ui, sans-serif;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.2;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
            transition: background .2s ease, box-shadow .2s ease, transform .2s ease, color .2s ease;
        }

        .dash-btn:hover,
        .dash-btn:focus {
            background: var(--ncie-primary-dark, #2A4FCC);
            border-color: var(--ncie-primary-dark, #2A4FCC);
            color: #fff;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(25, 119, 204, .3);
            transform: translateY(-1px);
            outline: none;
        }

        .dash-btn--ghost {
            background: #fff;
            color: var(--ncie-navy, #0B1230);
            border-color: var(--ncie-border, #e3eaf2);
        }

        .dash-btn--ghost:hover,
        .dash-btn--ghost:focus {
            background: var(--ncie-bg, #f1f7fc);
            border-color: var(--ncie-border, #e3eaf2);
            color: var(--ncie-navy, #0B1230);
            box-shadow: none;
            transform: none;
        }

        /* ---------- Panel (calendar) ---------- */
        .dash-panel {
            background: var(--ncie-surface, #fff);
            border: 1px solid var(--ncie-border, #e3eaf2);
            border-radius: var(--ncie-radius, 14px);
            box-shadow: var(--ncie-shadow, 0 2px 15px rgba(0, 0, 0, .08));
            margin-bottom: 24px;
            overflow: hidden;
        }

        .dash-panel__head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            padding: 20px 24px;
            border-bottom: 1px solid var(--ncie-border, #e3eaf2);
        }

        .dash-panel__title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Archivo', system-ui, sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--ncie-navy, #0B1230);
            margin: 0 0 3px;
        }

        .dash-panel__title i {
            color: var(--ncie-primary, #3B6CFF);
        }

        .dash-panel__subtitle {
            margin: 0;
            font-size: 13.5px;
            color: var(--ncie-muted, #6b7c93);
        }

        .dash-panel__body {
            padding: 20px 24px 24px;
        }

        /* ---------- FullCalendar skin ---------- */
        #calendar {
            min-height: 640px;
            font-family: 'Archivo', system-ui, sans-serif;
        }

        #calendar .fc .fc-toolbar {
            flex-wrap: wrap;
            gap: 10px;
        }

        #calendar .fc .fc-toolbar-title {
            font-family: 'Archivo', system-ui, sans-serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--ncie-navy, #0B1230);
            text-transform: capitalize;
        }

        #calendar .fc .fc-button-primary {
            background: var(--ncie-primary, #3B6CFF);
            border-color: var(--ncie-primary, #3B6CFF);
            border-radius: 8px;
            font-weight: 500;
            font-size: .85rem;
            padding: .4em .9em;
            text-transform: capitalize;
            box-shadow: none;
            transition: background .2s ease;
        }

        #calendar .fc .fc-button-primary:hover {
            background: var(--ncie-primary-dark, #2A4FCC);
            border-color: var(--ncie-primary-dark, #2A4FCC);
        }

        #calendar .fc .fc-button-primary:not(:disabled).fc-button-active,
        #calendar .fc .fc-button-primary:not(:disabled):active {
            background: var(--ncie-navy, #0B1230);
            border-color: var(--ncie-navy, #0B1230);
            box-shadow: none;
        }

        #calendar .fc .fc-button-primary:disabled {
            background: var(--ncie-primary, #3B6CFF);
            border-color: var(--ncie-primary, #3B6CFF);
            opacity: .55;
        }

        #calendar .fc .fc-button-primary:focus {
            box-shadow: 0 0 0 3px rgba(25, 119, 204, .25);
        }

        #calendar .fc .fc-button-group > .fc-button {
            border-radius: 0;
        }

        #calendar .fc .fc-button-group > .fc-button:first-child {
            border-radius: 8px 0 0 8px;
        }

        #calendar .fc .fc-button-group > .fc-button:last-child {
            border-radius: 0 8px 8px 0;
        }

        #calendar .fc-theme-standard td,
        #calendar .fc-theme-standard th,
        #calendar .fc-theme-standard .fc-scrollgrid {
            border-color: var(--ncie-border, #e3eaf2);
        }

        #calendar .fc .fc-col-header-cell-cushion {
            padding: 10px 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--ncie-muted, #6b7c93);
            text-decoration: none;
        }

        #calendar .fc .fc-daygrid-day-number {
            font-size: 13px;
            font-weight: 500;
            color: var(--ncie-text, #3d4b5c);
            text-decoration: none;
            padding: 6px 8px;
        }

        #calendar .fc .fc-daygrid-day.fc-day-today {
            background: var(--ncie-primary-soft, #e8f2fc);
        }

        #calendar .fc .fc-daygrid-day.fc-day-today .fc-daygrid-day-number {
            color: var(--ncie-primary, #3B6CFF);
            font-weight: 700;
        }

        #calendar .fc-event,
        #calendar .fc-daygrid-event,
        #calendar .fc-timegrid-event {
            border-radius: 6px;
            border: none;
            padding: 2px 6px;
            font-size: 12.5px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(20, 47, 68, .12);
        }

        #calendar .fc-daygrid-dot-event .fc-event-title {
            font-weight: 500;
        }

        #calendar .fc .fc-more-link {
            color: var(--ncie-primary, #3B6CFF);
            font-weight: 600;
        }

        /* ---------- Modal ---------- */
        #eventModal .modal-content {
            border: none;
            border-radius: 14px;
            box-shadow: var(--ncie-shadow-lg, 0 14px 40px rgba(20, 47, 68, .14));
            font-family: 'Archivo', system-ui, sans-serif;
            overflow: hidden;
        }

        #eventModal .modal-header {
            align-items: center;
            padding: 18px 24px;
            border-bottom: 1px solid var(--ncie-border, #e3eaf2);
            background: var(--ncie-bg, #f1f7fc);
        }

        #eventModal .modal-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Archivo', system-ui, sans-serif;
            font-size: 17px;
            font-weight: 600;
            color: var(--ncie-navy, #0B1230);
        }

        .dash-modal__icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            font-size: 17px;
            color: var(--ncie-primary, #3B6CFF);
            background: #e8f2fc;
            background: color-mix(in srgb, var(--ncie-primary, #3B6CFF) 12%, white);
        }

        #eventModal .close {
            color: var(--ncie-navy, #0B1230);
            opacity: .6;
            text-shadow: none;
            transition: opacity .2s ease;
        }

        #eventModal .close:hover {
            opacity: 1;
        }

        #eventModal .modal-body {
            padding: 20px 24px 8px;
        }

        .dash-dl {
            margin: 0;
        }

        .dash-dl__row {
            padding: 10px 0;
            border-bottom: 1px solid var(--ncie-border, #e3eaf2);
        }

        .dash-dl__row:last-child {
            border-bottom: none;
        }

        .dash-dl dt {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--ncie-muted, #6b7c93);
            margin-bottom: 3px;
        }

        .dash-dl dd {
            font-size: 15px;
            font-weight: 500;
            color: var(--ncie-text, #3d4b5c);
            margin: 0;
            line-height: 1.45;
            word-break: break-word;
        }

        #eventModal .modal-footer {
            padding: 14px 24px 20px;
            border-top: 1px solid var(--ncie-border, #e3eaf2);
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 767.98px) {
            .dash-hero {
                flex-direction: column;
                align-items: flex-start;
                padding: 22px 20px;
                gap: 16px;
            }

            .dash-hero__title {
                font-size: 22px;
            }

            .dash-hero__date {
                white-space: normal;
                padding: 10px 14px;
                font-size: 13px;
            }

            .dash-hero__deco {
                font-size: 130px;
                right: -10px;
                bottom: -34px;
            }

            .dash-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 12px;
            }

            .dash-card {
                min-height: 150px;
                padding: 14px 14px 12px;
            }

            .dash-card__value {
                font-size: 26px;
            }

            .dash-panel__head,
            .dash-panel__body {
                padding: 16px;
            }

            .dash-panel__head .dash-btn {
                width: 100%;
                justify-content: center;
            }

            #calendar {
                min-height: 520px;
            }

            #calendar .fc .fc-toolbar-title {
                font-size: 1rem;
            }
        }

        /* ---- Ajustes 2026-09-11: compacto y legible al 100 % ---- */
        .content-wrapper .dash-hero h1.dash-hero__title { color: #fff; font-size: 22px; margin-bottom: 2px; }
        .dash-hero { padding: 18px 24px; margin-bottom: 16px; border-radius: 16px; gap: 16px; }
        .dash-hero__subtitle { margin: 0 0 10px; font-size: 14px; }
        .dash-hero__date { padding: 9px 14px; font-size: 13px; border-radius: 10px; }
        .dash-hero__deco { font-size: 120px; opacity: .10; right: 120px; }
        .dash-section-title { margin: 0 0 10px; font-size: 12.5px; }
        .dash-grid { grid-template-columns: repeat(auto-fill, minmax(215px, 1fr)); gap: 12px; margin-bottom: 20px; }
        .dash-card {
            display: grid;
            grid-template-columns: 44px minmax(0, 1fr) auto;
            grid-template-areas: "icon value more" "icon label more";
            column-gap: 14px; row-gap: 0;
            align-items: center;
            min-height: 0;
            padding: 12px 14px 12px 14px;
            border-radius: 14px;
        }
        .dash-card:hover, .dash-card:focus { transform: none; }
        .dash-card__icon { grid-area: icon; width: 44px; height: 44px; margin: 0; border-radius: 12px; font-size: 20px; }
        .dash-card__value { grid-area: value; font-size: 24px; line-height: 1.05; margin: 0; align-self: end; }
        .dash-card__value--text { font-size: 13.5px; padding-top: 0; }
        .dash-card__label { grid-area: label; font-size: 13px; line-height: 1.3; align-self: start; }
        .dash-card__more { grid-area: more; margin: 0; padding: 0; font-size: 0; }
        .dash-card__more i { font-size: 18px; }
        .dash-panel { margin-top: 4px; }
        @media (max-width: 575.98px) {
            .dash-grid { grid-template-columns: 1fr 1fr; }
            .dash-card { padding: 10px 12px; column-gap: 10px; grid-template-columns: 38px minmax(0, 1fr) auto; }
            .dash-card__icon { width: 38px; height: 38px; font-size: 17px; }
            .dash-card__value { font-size: 20px; }
        }

        /* ---- Menos ruido visual: sin flechas, iconos uniformes, banner sobrio ---- */
        .dash-hero { background: linear-gradient(135deg, #0B1230 0%, #1B2E7A 100%); box-shadow: none; padding: 20px 26px; flex-wrap: wrap; }
        .dash-hero__date { white-space: normal; }
        .dash-wrap { min-width: 0; }
        .dash-hero__subtitle { margin: 0; }
        .dash-hero__date { background: transparent; border: 0; padding: 0; font-size: 14px; color: rgba(255, 255, 255, .85); }
        .dash-hero__date i { display: none; }
        .dash-section-title { text-transform: none; letter-spacing: 0; font-size: 14px; font-weight: 600; color: var(--ncie-muted, #5F6B88); margin: 0 0 10px; }
        .dash-grid { grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 10px; }
        .dash-card {
            grid-template-columns: 40px minmax(0, 1fr);
            grid-template-areas: "icon value" "icon label";
            column-gap: 12px;
            padding: 12px 14px;
            box-shadow: none;
            border: 1px solid var(--ncie-border, #DFE4F2);
            transition: border-color .15s ease, background-color .15s ease;
        }
        .dash-card:hover, .dash-card:focus { box-shadow: none; border-color: var(--ncie-primary, #3B6CFF); background: #FBFCFF; }
        .dash-card__more { display: none; }
        .dash-card__icon,
        .dash-card--primary .dash-card__icon, .dash-card--info .dash-card__icon, .dash-card--success .dash-card__icon,
        .dash-card--warning .dash-card__icon, .dash-card--danger .dash-card__icon, .dash-card--navy .dash-card__icon {
            width: 40px; height: 40px; border-radius: 11px; font-size: 18px;
            background: #EEF1F8; color: var(--ncie-navy, #0B1230);
        }
        .dash-card:hover .dash-card__icon { transform: none; background: #E9EEFF; color: var(--ncie-primary, #3B6CFF); }
        .dash-card__value { font-size: 22px; }
        .dash-card__label { font-size: 13px; color: var(--ncie-muted, #5F6B88); }
    </style>

    <div class="container-fluid dash-wrap">

        {{-- Cabecera de bienvenida --}}
        <div class="dash-hero">
            <div class="dash-hero__body">
                <h1 class="dash-hero__title">¡Hola, {{ Auth::user()->name }}!</h1>
                <p class="dash-hero__subtitle">Bienvenido/a al panel del Sistema NCIE</p>
            </div>
            <div class="dash-hero__date">
                <i class="bi bi-calendar3"></i>
                <span>{{ ucfirst(\Carbon\Carbon::now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY')) }}</span>
            </div>
        </div>

        {{-- Tarjetas de resumen --}}
        <p class="dash-section-title">Resumen general</p>
        <div class="dash-grid">
            @can('admin.usuarios.index')
                <a href="{{url('admin/usuarios')}}" class="dash-card dash-card--info">
                    <span class="dash-card__icon"><i class="bi bi-file-person"></i></span>
                    <div class="dash-card__value">{{$total_usuarios}}</div>
                    <div class="dash-card__label">Usuarios</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.administracion.index')
                <a href="{{url('admin/administracion')}}" class="dash-card dash-card--primary">
                    <span class="dash-card__icon"><i class="bi bi-person-circle"></i></span>
                    <div class="dash-card__value">{{$total_administrativos}}</div>
                    <div class="dash-card__label">Administrativos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.alumnos.index')
                <a href="{{url('admin/alumnos')}}" class="dash-card dash-card--success">
                    <span class="dash-card__icon"><i class="bi bi-person-add"></i></span>
                    <div class="dash-card__value">{{$total_alumnos}}</div>
                    <div class="dash-card__label">Alumnos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.areas.index')
                <a href="{{url('admin/areas')}}" class="dash-card dash-card--warning">
                    <span class="dash-card__icon"><i class="bi bi-building-add"></i></span>
                    <div class="dash-card__value">{{$total_areas}}</div>
                    <div class="dash-card__label">Áreas</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.gestores.index')
                <a href="{{url('admin/gestores')}}" class="dash-card dash-card--danger">
                    <span class="dash-card__icon"><i class="bi bi-person-lines-fill"></i></span>
                    <div class="dash-card__value">{{$total_gestores}}</div>
                    <div class="dash-card__label">Gestores</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.horarios.index')
                <a href="{{url('admin/horarios')}}" class="dash-card dash-card--navy">
                    <span class="dash-card__icon"><i class="bi bi-calendar2-week"></i></span>
                    <div class="dash-card__value">{{$total_horarios}}</div>
                    <div class="dash-card__label">Horarios</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.cursos.index')
                <a href="{{url('admin/cursos')}}" class="dash-card dash-card--primary">
                    <span class="dash-card__icon"><i class="bi bi-clipboard2-check"></i></span>
                    <div class="dash-card__value">{{$total_cursos}}</div>
                    <div class="dash-card__label">Cursos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.proyectos.index')
                <a href="{{url('admin/proyectos')}}" class="dash-card dash-card--info">
                    <span class="dash-card__icon"><i class="bi bi-book"></i></span>
                    <div class="dash-card__value">{{$total_proyectos}}</div>
                    <div class="dash-card__label">Proyectos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.asignaciones.index')
                <a href="{{url('admin/asignaciones')}}" class="dash-card dash-card--warning">
                    <span class="dash-card__icon"><i class="bi bi-clipboard2-minus-fill"></i></span>
                    <div class="dash-card__value">{{$total_aignaciones}}</div>
                    <div class="dash-card__label">Asignación de Cursos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.proyecto_gestores.index')
                <a href="{{url('admin/proyecto_gestores')}}" class="dash-card dash-card--success">
                    <span class="dash-card__icon"><i class="bi bi-journal-check"></i></span>
                    <div class="dash-card__value">{{$total_gestores_proyectos}}</div>
                    <div class="dash-card__label">Proyectos a gestores</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.alumno_proyecto.index')
                <a href="{{url('admin/alumno_proyecto')}}" class="dash-card dash-card--danger">
                    <span class="dash-card__icon"><i class="bi bi-journal-plus"></i></span>
                    <div class="dash-card__value">{{$total_alumnos_proyectos}}</div>
                    <div class="dash-card__label">Proyectos a alumnos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('admin.presupuestos.index')
                <a href="{{url('admin/presupuestos')}}" class="dash-card dash-card--navy">
                    <span class="dash-card__icon"><i class="bi bi-coin"></i></span>
                    <div class="dash-card__value">{{$total_presupuestos}}</div>
                    <div class="dash-card__label">Presupuestos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('inscripciones.mis-cursos')
                <a href="{{route('inscripciones.mis-cursos')}}" class="dash-card dash-card--info">
                    <span class="dash-card__icon"><i class="bi bi-clipboard2-check"></i></span>
                    <div class="dash-card__value dash-card__value--text">Ver listado</div>
                    <div class="dash-card__label">Mis cursos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('inscripciones.mis_proyectos')
                <a href="{{route('inscripciones.mis_proyectos')}}" class="dash-card dash-card--primary">
                    <span class="dash-card__icon"><i class="bi bi-book"></i></span>
                    <div class="dash-card__value dash-card__value--text">Ver listado</div>
                    <div class="dash-card__label">Mis proyectos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('reportes.index')
                <a href="{{route('reportes.cursos-asignados')}}" class="dash-card dash-card--primary">
                    <span class="dash-card__icon"><i class="bi bi-clipboard2-check"></i></span>
                    <div class="dash-card__value dash-card__value--text">Ver listado</div>
                    <div class="dash-card__label">Mis cursos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('reportes.index')
                <a href="{{route('reportes.index')}}" class="dash-card dash-card--success">
                    <span class="dash-card__icon"><i class="bi bi-file-person"></i></span>
                    <div class="dash-card__value dash-card__value--text">Ver listado</div>
                    <div class="dash-card__label">Usuarios inscritos a mis cursos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            @can('reportes.mis_proyectos')
                <a href="{{route('reportes.mis_proyectos')}}" class="dash-card dash-card--danger">
                    <span class="dash-card__icon"><i class="bi bi-book"></i></span>
                    <div class="dash-card__value dash-card__value--text">Ver listado</div>
                    <div class="dash-card__label">Mis proyectos</div>
                    <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
                </a>
            @endcan

            <a href="{{route('post.notifications')}}" class="dash-card dash-card--navy">
                <span class="dash-card__icon"><i class="bi bi-bell-fill"></i></span>
                <div class="dash-card__value dash-card__value--text">Ver avisos</div>
                <div class="dash-card__label">Mis notificaciones</div>
                <div class="dash-card__more">Ver más <i class="bi bi-arrow-right"></i></div>
            </a>
        </div>

        @can('inscripciones.mis-cursos')
            {{-- Calendario --}}
            <div class="dash-panel">
                <div class="dash-panel__head">
                    <div>
                        <h2 class="dash-panel__title"><i class="bi bi-calendar3"></i> Calendario de cursos del nodo</h2>
                        <p class="dash-panel__subtitle">Haz clic en un curso para ver los detalles</p>
                    </div>
                    <a href="{{ route('inscripciones.create') }}" class="dash-btn">
                        <i class="bi bi-plus-circle"></i> Registrarse a un curso
                    </a>
                </div>
                <div class="dash-panel__body">
                    <div id='calendar'></div>
                </div>
            </div>

            {{-- Modal para detalles del curso --}}
            <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <span class="dash-modal__icon"><i class="bi bi-calendar-event"></i></span>
                                Detalles del curso
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <dl class="dash-dl">
                                <div class="dash-dl__row">
                                    <dt>Nombre</dt>
                                    <dd><span id="eventTitle"></span></dd>
                                </div>
                                <div class="dash-dl__row">
                                    <dt>Fecha</dt>
                                    <dd><span id="eventDate"></span></dd>
                                </div>
                                <div class="dash-dl__row">
                                    <dt>Horario</dt>
                                    <dd><span id="eventTime"></span></dd>
                                </div>
                                <div class="dash-dl__row">
                                    <dt>Lugar</dt>
                                    <dd><span id="eventLocation"></span></dd>
                                </div>
                                <div class="dash-dl__row">
                                    <dt>Modalidad</dt>
                                    <dd><span id="eventModality"></span></dd>
                                </div>
                                <div class="dash-dl__row">
                                    <dt>Requisitos</dt>
                                    <dd><span id="eventRequirements"></span></dd>
                                </div>
                                <div class="dash-dl__row">
                                    <dt>Descripción</dt>
                                    <dd><span id="eventDescription"></span></dd>
                                </div>
                            </dl>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="dash-btn dash-btn--ghost" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: {
                        url: '{{ route("admin.cursos.calendar-events") }}', // Usa el helper de route
                        method: 'GET',
                        failure: function (error) {
                            console.error('Error:', error);
                            alert('Error al cargar eventos. Verifica la consola (F12 > Console)');
                        }
                    },
                    eventClick: function (info) {
                        var titleParts = info.event.title.split(' (');
                        var courseName = titleParts[0];
                        var schedule = titleParts[1] ? titleParts[1].replace(')', '') : 'Horario no especificado';

                        var startDate = new Date(info.event.start);
                        var endDate = info.event.end ? new Date(info.event.end) : startDate;
                        endDate.setDate(endDate.getDate() - 1);

                        var dateStr = startDate.toLocaleDateString('es-ES');
                        if (startDate.getTime() !== endDate.getTime()) {
                            dateStr += ' al ' + endDate.toLocaleDateString('es-ES');
                        }

                        $('#eventTitle').text(courseName);
                        $('#eventDate').text(dateStr);
                        $('#eventTime').text(schedule);
                        $('#eventLocation').text(info.event.extendedProps?.lugar || 'No especificado');
                        $('#eventModality').text(info.event.extendedProps?.modalidad || 'No especificado');
                        var requisitos = info.event.extendedProps?.requisitos;
                        $('#eventRequirements').text(requisitos && requisitos.trim() !== '' ? requisitos : 'No hay requisitos para este curso');
                        $('#eventDescription').text(info.event.extendedProps?.descripcion || 'No hay descripción disponible');

                        $('#eventModal').modal('show');

                        info.jsEvent.preventDefault();
                    },
                    eventDidMount: function (info) {
                        $(info.el).tooltip({
                            title: info.event.title,
                            placement: 'top',
                            container: 'body'
                        });
                    }
                });

                calendar.render();
            }
        });
    </script>
@endsection
