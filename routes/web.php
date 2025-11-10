<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $user = $request->input('usuario');
    $pass = $request->input('password');

    $admins = [
        ['usuario' => 'admin', 'password' => '1234', 'nombre' => 'Administrador General'],
    ];

    $valido = collect($admins)->first(fn($u) => $u['usuario'] === $user && $u['password'] === $pass);

    if ($valido) {
        session(['admin' => $valido['nombre']]);
        return redirect()->route('dashboard');
    }

    return back()->with('error', 'Usuario o contraseña incorrectos');
});

Route::get('/dashboard', function () {
    if (!session('admin')) return redirect()->route('login');
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/usuarios', function () {
    if (!session('admin')) return redirect()->route('login');
    $usuarios = [
        ['nombre' => 'Juan Pérez', 'correo' => 'juan@gmail.com', 'estado' => 'Activo'],
        ['nombre' => 'María López', 'correo' => 'maria@gmail.com', 'estado' => 'Desactivado'],
        ['nombre' => 'Carlos Ruiz', 'correo' => 'carlos@gmail.com', 'estado' => 'Activo'],
        ['nombre' => 'Ana Torres', 'correo' => 'ana@gmail.com', 'estado' => 'Activo'],
    ];
    return view('admin.usuarios', compact('usuarios'));
})->name('usuarios');

Route::get('/reportes', function () {
    if (!session('admin')) return redirect()->route('login');
    $reportes = [
        ['usuario' => 'Juan Pérez', 'dias' => 15, 'progreso' => '75%'],
        ['usuario' => 'María López', 'dias' => 8, 'progreso' => '50%'],
        ['usuario' => 'Carlos Ruiz', 'dias' => 22, 'progreso' => '90%'],
    ];
    return view('admin.reportes', compact('reportes'));
})->name('reportes');

Route::get('/progreso', function () {
    if (!session('admin')) return redirect()->route('login');
    $progresos = [
        ['usuario' => 'Juan Pérez', 'actividad' => 'Ejercicio diario', 'avance' => '80%'],
        ['usuario' => 'Carlos Ruiz', 'actividad' => 'Reducir azúcar', 'avance' => '65%'],
        ['usuario' => 'Ana Torres', 'actividad' => 'Dormir mejor', 'avance' => '90%'],
    ];
    return view('admin.progreso', compact('progresos'));
})->name('progreso');

Route::get('/logout', function () {
    session()->forget('admin');
    return redirect()->route('login');
})->name('logout');

Route::get('/seguimiento', function () {
    return view('admin.seguimiento');
})->name('seguimiento');
