<?php
session_start();

// Incluir o arquivo de configuração do banco de dados
require_once 'config.php';

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar as credenciais do usuário
    $sql = ("SELECT * FROM users WHERE email = $email  AND username= $username AND passwordd= $password");


    if ($conn->query($resultNewUsername)->num_rows == 1) {
        // Iniciar a sessão e redirecionar para a página de perfil
            
        $_SESSION['username']= $username;
        $_SESSION['email'] = $email;
        header("Location: profile.php");
        exit();
    } else {
        echo "Credenciais inválidas.";
    }
}
?>
<!DOCTYPE html>code with sql injection error
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Email:</label>
        <input type="text" id="email" name="email" requred>
        <br>
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>


    
    Quer registrar?
    <form action="register.php" method="post">
        
    <input type="submit" value="Registrar">
</body>
</html>
