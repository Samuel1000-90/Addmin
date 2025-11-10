<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Administrador - MiBienestarDigital</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            display: flex;
            height: 100vh;
            background-color: #f4f8f7;
        }
        aside {
            width: 230px;
            background: linear-gradient(180deg, #4CAF50, #00BCD4);
            color: white;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        aside h2 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: 600;
        }
        aside nav a {
            display: block;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: background 0.3s;
        }
        aside nav a:hover, .active {
            background: rgba(255,255,255,0.2);
        }
        aside .logout {
            background: #E53935;
            text-align: center;
            border-radius: 8px;
            padding: 10px;
            text-decoration: none;
            color: white;
            font-weight: 500;
            transition: 0.3s;
        }
        aside .logout:hover {
            background: #c62828;
        }
        main {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        header h2 {
            color: #00BCD4;
            margin-bottom: 5px;
        }
        header p {
            color: #555;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-top: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <aside>
    <div>
        <h2>🌿 Admin Panel</h2>
        <nav>
            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
            <a href="/usuarios" class="{{ request()->is('usuarios') ? 'active' : '' }}">👥 Gestión Usuarios</a>
            <a href="/seguimiento" class="{{ request()->is('seguimiento') ? 'active' : '' }}">🌱 Seguimiento</a>
            <a href="/reportes" class="{{ request()->is('reportes') ? 'active' : '' }}">📊 Reportes</a>
        </nav>
    </div>
    <a href="/logout" class="logout">🚪 Cerrar sesión</a>
</aside>

    <main>
        @yield('content')
    </main>
</body>
</html>
