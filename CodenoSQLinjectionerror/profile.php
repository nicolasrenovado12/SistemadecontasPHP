<?php
session_start();


function redirecionar() {
    header("Location: login.php");
    exit();
}

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    // Se não estiver logado, redirecionar para a página de login
    redirecionar();
} 

$username = $_SESSION['username'];
$email = $_SESSION['email'];

// Configurar PHPMailer

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($username); ?></h2>
    <h2>Este é o seu e-mail: <?php echo htmlspecialchars($email); ?></h2>
    <p>Esta é a página do seu perfil.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
