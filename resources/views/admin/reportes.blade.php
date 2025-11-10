@extends('admin.layout')

@section('content')
<header>
    <h2>📊 Reportes del Sistema</h2>
    <p>Visualiza las métricas generales de la aplicación MiBienestarDigital.</p>
</header>

<div class="card">
    <h3>🌿 Estadísticas Globales</h3>

    @php
        $reportes = [
            ['icon' => '📱', 'titulo' => 'Descargas Totales', 'valor' => '12,450', 'color' => '#00BCD4'],
            ['icon' => '👤', 'titulo' => 'Usuarios Activos', 'valor' => '9,830', 'color' => '#4CAF50'],
            ['icon' => '🔥', 'titulo' => 'Rachas Promedio', 'valor' => '14 días', 'color' => '#FF9800'],
            ['icon' => '💬', 'titulo' => 'Consejos Compartidos', 'valor' => '1,245', 'color' => '#9C27B0'],
            ['icon' => '🧘', 'titulo' => 'Hábitos Creados', 'valor' => '3,780', 'color' => '#3F51B5'],
        ];
    @endphp

    <div class="grid">
        @foreach($reportes as $r)
        <div class="stat" style="border-left: 6px solid {{ $r['color'] }};">
            <span class="icon" style="background-color: {{ $r['color'] }}15;">{{ $r['icon'] }}</span>
            <div class="info">
                <h4>{{ $r['titulo'] }}</h4>
                <p style="color: {{ $r['color'] }};">{{ $r['valor'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="card">
    <h3>📈 Gráficos del Progreso Global</h3>
    <div class="chart-container">
        <div class="chart">
            <h4>Usuarios Activos</h4>
            <div class="bar" style="--value:85%; background:#4CAF50;"></div>
            <small>85%</small>
        </div>
        <div class="chart">
            <h4>Hábitos Creados</h4>
            <div class="bar" style="--value:70%; background:#00BCD4;"></div>
            <small>70%</small>
        </div>
        <div class="chart">
            <h4>Consejos Compartidos</h4>
            <div class="bar" style="--value:55%; background:#9C27B0;"></div>
            <small>55%</small>
        </div>
    </div>
</div>

<style>
    h3 { color: #00BCD4; margin-bottom: 15px; }
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }
    .stat {
        background: #f8fdfc;
        border-radius: 10px;
        padding: 20px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: 0.3s;
    }
    .stat:hover { transform: translateY(-3px); }
    .stat .icon {
        font-size: 28px;
        background: white;
        padding: 10px;
        border-radius: 50%;
        margin-right: 12px;
    }
    .chart-container {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
        gap: 30px;
    }
    .chart {
        background: white;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        width: 200px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .chart .bar {
        height: 120px;
        width: 40px;
        margin: 10px auto;
        border-radius: 10px;
        position: relative;
        background: #ccc;
        overflow: hidden;
    }
    .chart .bar::before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: var(--value);
        background: inherit;
        border-radius: 10px;
        transition: height 1s ease;
    }
    small { color: #333; font-weight: bold; }
</style>
@endsection
