@extends('admin.layout')

@section('content')
<header>
    <h2>🏠 Panel Principal del Administrador</h2>
    <p>Bienvenido al sistema de control MiBienestarDigital. Aquí puedes ver un resumen del estado general de la aplicación.</p>
</header>

<!-- 🔹 Sección de métricas globales -->
<div class="card">
    <h3>📊 Resumen General</h3>

    @php
        $estadisticas = [
            ['icon' => '📱', 'titulo' => 'Descargas Totales', 'valor' => '12,450', 'color' => '#00BCD4'],
            ['icon' => '👤', 'titulo' => 'Usuarios Activos', 'valor' => '9,830', 'color' => '#4CAF50'],
            ['icon' => '🧘', 'titulo' => 'Hábitos Creados', 'valor' => '3,780', 'color' => '#3F51B5'],
            ['icon' => '💬', 'titulo' => 'Consejos Compartidos', 'valor' => '1,245', 'color' => '#9C27B0'],
        ];
    @endphp

    <div class="grid">
        @foreach($estadisticas as $e)
        <div class="stat" style="border-left: 6px solid {{ $e['color'] }};">
            <span class="icon" style="background-color: {{ $e['color'] }}15;">{{ $e['icon'] }}</span>
            <div class="info">
                <h4>{{ $e['titulo'] }}</h4>
                <p style="color: {{ $e['color'] }};">{{ $e['valor'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- 🔹 Seguimiento rápido -->
<div class="card">
    <h3>🌱 Seguimiento Rápido de Usuarios</h3>
    @php
        $seguimiento = [
            ['usuario' => 'Juan Pérez', 'dias' => 15, 'progreso' => '75%', 'habito' => 'Ejercicio diario'],
            ['usuario' => 'María López', 'dias' => 8, 'progreso' => '50%', 'habito' => 'Reducir tiempo en pantalla'],
            ['usuario' => 'Carlos Ruiz', 'dias' => 22, 'progreso' => '90%', 'habito' => 'Mindfulness'],
        ];
    @endphp

    <table>
        <tr>
            <th>Usuario</th>
            <th>Hábito Actual</th>
            <th>Días de Racha</th>
            <th>Progreso</th>
        </tr>
        @foreach($seguimiento as $s)
            @php
                $color = intval($s['progreso']) >= 80 ? '#4CAF50' :
                         (intval($s['progreso']) >= 60 ? '#FFC107' : '#E53935');
            @endphp
            <tr>
                <td>{{ $s['usuario'] }}</td>
                <td>{{ $s['habito'] }}</td>
                <td>{{ $s['dias'] }} días</td>
                <td>
                    <div style="background:#eee; border-radius:8px; height:10px;">
                        <div style="width:{{ $s['progreso'] }}; background:{{ $color }}; height:10px; border-radius:8px;"></div>
                    </div>
                    <small>{{ $s['progreso'] }}</small>
                </td>
            </tr>
        @endforeach
    </table>
</div>

<!-- 🔹 Reportes visuales -->
<div class="card">
    <h3>📈 Actividad Global</h3>
    <div class="chart-container">
        <div class="chart">
            <h4>Usuarios Activos</h4>
            <div class="circle" style="--percent:85; --color:#4CAF50;"></div>
            <small>85%</small>
        </div>
        <div class="chart">
            <h4>Hábitos Completados</h4>
            <div class="circle" style="--percent:72; --color:#00BCD4;"></div>
            <small>72%</small>
        </div>
        <div class="chart">
            <h4>Consejos Compartidos</h4>
            <div class="circle" style="--percent:55; --color:#9C27B0;"></div>
            <small>55%</small>
        </div>
    </div>
</div>

<style>
    h3 { color: #00BCD4; margin-bottom: 15px; }

    /* --- Tarjetas estadísticas --- */
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
    .stat h4 { margin: 0; font-size: 16px; color: #333; }
    .stat p { margin: 0; font-weight: bold; font-size: 18px; }

    /* --- Tabla seguimiento --- */
    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }
    th {
        background: linear-gradient(90deg, #4CAF50, #00BCD4);
        color: white;
    }
    tr:hover { background-color: #f1f1f1; }

    /* --- Círculos de progreso --- */
    .chart-container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        margin-top: 20px;
        gap: 30px;
    }
    .chart {
        background: white;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        width: 180px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .circle {
        --size: 80px;
        width: var(--size);
        height: var(--size);
        border-radius: 50%;
        background: conic-gradient(var(--color) calc(var(--percent) * 1%), #ddd 0);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 10px auto;
        position: relative;
    }
    .circle::before {
        content: attr(--percent) '%';
        position: absolute;
        font-weight: bold;
        color: var(--color);
        font-size: 14px;
    }
</style>
@endsection

