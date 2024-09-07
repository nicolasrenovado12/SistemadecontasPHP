<?php
// Incluir o arquivo de configuração do banco de dados
require_once 'config.php';

$id = rand(0, 1);
while ($stmt = $conn->prepare("SELECT * FROM users WHERE id = ?")) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $id += 1;
    } else {
        break;
    }
    $stmt->close();
}

// Verificar se o formulário de registro foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $palavrassenha = strlen($password);

    // Verificar se o email já existe
    $stmtEmail = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmtEmail->bind_param("s", $email);
    $stmtEmail->execute();
    $resultEmail = $stmtEmail->get_result();

    if ($resultEmail->num_rows == 1) {
        echo "Este email já existe";
    } else {
        // Verificar se o username já existe
        $stmtUsername = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmtUsername->bind_param("s", $username);
        $stmtUsername->execute();
        $resultUsername = $stmtUsername->get_result();

        if ($resultUsername->num_rows >= 1) {
            echo "Este usuário já existe\n";

            $b = 1;
            while ($b == 1) {
                $randnumber = rand(0, 20);
                $randnumber2 = rand(0, 20);
                $newusername = "$username$randnumber$randnumber2";

                // Verificar se o novo nome de usuário sugerido já existe
                $stmtNewUsername = $conn->prepare("SELECT * FROM users WHERE username = ?");
                $stmtNewUsername->bind_param("s", $newusername);
                $stmtNewUsername->execute();
                $resultNewUsername = $stmtNewUsername->get_result();

                if ($resultNewUsername->num_rows == 0) {                                                                         
                    echo "\nSugestão de usuário: $newusername";
                    $b += 1;
                }

                $stmtNewUsername->close();
            }
        } elseif ($palavrassenha < 8 || $palavrassenha > 16) {
            echo "Digite uma senha entre 8 e 16 caracteres";
        } else {
            // Registrar novo usuário
            $stmtInsert = $conn->prepare("INSERT INTO users (id, email, username, passwordd) VALUES (?, ?, ?, ?)");
            $stmtInsert->bind_param("isss", $id, $email, $username, $password);
            
            if ($stmtInsert->execute()) {
                echo "Sua conta foi registrada.";
            } else {
                echo "Erro ao registrar conta.";
            }

            $stmtInsert->close();
        }

        $stmtUsername->close();
    }

    $stmtEmail->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>
    <form action="register.php" method="post">
        
        <label for="username">Email:</label>
        <input type="text" id="email" name="email" >
        <br>
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" >
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" >
        <br>
        <input type="submit" value="Registrar">
        

    </form>
    <h3>Terminou de registrar?</h3>

    <form action="login.php" method="post">
        
    <input type="submit" value="Logar">

    </form>
</body>
</html>