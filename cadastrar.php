<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Carregar o arquivo JSON de usuários ou criar um novo array
    $users = file_exists('usuarios.json') ? json_decode(file_get_contents('usuarios.json'), true) : [];

    // Verificar se o usuário já existe
    if (isset($users[$username])) {
        $error = "Nome de usuário já existe!";
    } else {
        // Adicionar o novo usuário e salvar o arquivo
        $users[$username] = password_hash($password, PASSWORD_DEFAULT);
        file_put_contents('usuarios.json', json_encode($users));
        $_SESSION['logged_in'] = true;
        header("Location: agenda.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar</title>
    <style>
        /* Estilos do formulário */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
        }
        .container {
            width: 300px;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="password"], button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #7FA8DF;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #7FA8DF;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 10px;
        }
        .login-link {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastrar</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Usuário" required><br>
            <input type="password" name="password" placeholder="Senha" required><br>
            <button type="submit">Cadastrar</button>
        </form>
        <a href="index.php" class="login-link">Já tem uma conta? Faça login</a>
    </div>
</body>
</html>