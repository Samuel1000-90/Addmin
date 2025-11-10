<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>MiBienestarDigital | Login</title>
<style>
    body {
        margin: 0; padding: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #4CAF50, #00BCD4);
        display: flex; align-items: center; justify-content: center;
        height: 100vh; color: #333;
    }
    .login-box {
        background: white; padding: 40px; border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        width: 350px; text-align: center;
        animation: fadeIn 0.8s ease;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    h2 { margin-bottom: 20px; color: #4CAF50; }
    input {
        width: 100%; padding: 10px; margin: 10px 0;
        border: 1px solid #ccc; border-radius: 8px; font-size: 15px;
        transition: 0.3s;
    }
    input:focus {
        border-color: #00BCD4;
        box-shadow: 0 0 5px rgba(0,188,212,0.5);
        outline: none;
    }
    button {
        width: 100%; padding: 10px; background: #4CAF50;
        color: white; border: none; border-radius: 8px;
        font-size: 16px; cursor: pointer; transition: 0.3s;
    }
    button:hover { background: #388E3C; }
    .error { color: red; margin-top: 10px; }
</style>
</head>
<body>
    <div class="login-box">
        <h2>🌿 Bienvenido a MiBienestarDigital</h2>
        <p>Inicia sesión como administrador</p>
        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
        <form method="POST" action="/login">
            @csrf
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
