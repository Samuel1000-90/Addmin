@extends('admin.layout')

@section('content')
<header><h2>🌱 Progreso de Usuarios</h2></header>

<div class="card">
    <table>
        <tr><th>Usuario</th><th>Actividad</th><th>Avance</th></tr>
        @foreach($progresos as $p)
        <tr>
            <td>{{ $p['usuario'] }}</td>
            <td>{{ $p['actividad'] }}</td>
            <td>{{ $p['avance'] }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
