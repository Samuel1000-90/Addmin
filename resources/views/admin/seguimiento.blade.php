@extends('admin.layout')

@section('content')
<header>
    <h2>🌱 Seguimiento de Usuarios</h2>
    <p>Monitorea el avance y los hábitos de bienestar digital de cada usuario.</p>
</header>

<div class="card">
    <h3>📈 Progreso Personal</h3>

    @php
        $seguimiento = [
            ['usuario' => 'Juan Pérez', 'dias' => 15, 'progreso' => '75%', 'habito' => 'Ejercicio diario'],
            ['usuario' => 'María López', 'dias' => 8, 'progreso' => '50%', 'habito' => 'Reducir tiempo en pantalla'],
            ['usuario' => 'Carlos Ruiz', 'dias' => 22, 'progreso' => '90%', 'habito' => 'Mindfulness'],
            ['usuario' => 'Ana Torres', 'dias' => 12, 'progreso' => '60%', 'habito' => 'Dormir mejor'],
            ['usuario' => 'Laura Gómez', 'dias' => 30, 'progreso' => '95%', 'habito' => 'Alimentación saludable'],
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

<style>
    h3 { color: #00BCD4; margin-bottom: 15px; }
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
</style>
@endsection

