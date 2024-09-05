<?php
// Incluir o arquivo de configuração do banco de dados
require_once 'config.php';


$id = rand(0, 1);
while ($conn->query("SELECT * FROM users WHERE id=$id")->num_rows == 1) {  
        $id+=1;
    }
// Verificar se o formulário de registro foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {





    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
     
    // Consulta SQL para inserir um novo usuário no banco de dados
    
    $sqlemail = "SELECT * FROM users WHERE email='$email'";
    $sqlusuario = "SELECT * FROM users WHERE username='$username'";

    $string = "Este é um exemplo de string com várias palavras.";
    $palavrassenha = strlen($password);

    if ($conn->query($sqlemail)->num_rows == 1) {
            
        print("Este email já existe");
        
    } elseif ($conn->query($sqlusuario)->num_rows >= 1) {
            
        print("Este usuario já existe\n");
        $b = 1;
        while ($b == 1) {
            global $username;
            global $conn;
            
            $randnumber = rand(0, 20);

            $randnumber2 = rand(0, 20);
            

            $newusername = "$username$randnumber$randnumber2 ";
            $sqlusuario2 = "SELECT * FROM users WHERE username='$newusername'";
            
            if ($conn->query($sqlusuario2)->num_rows >= 1) {
                
            } else {

                print("\nSugestão de usuario:  +  $newusername");
                $b +=1;
            }

        }
     

    } elseif (($conn->query($sqlusuario)->num_rows == 0) && $conn->query($sqlemail)->num_rows == 0) {

        
        if (($palavrassenha > 16 ) || ($palavrassenha < 8)) {
            print("Digite uma senha menor que 16 caracteres ou digite uma senha maior que 8 caracteres");
        } else {
            print("Sua conta foi registrada. ");

                
            $sqlrequire = "INSERT INTO users (id,email,username, passwordd) VALUES ('$id','$email','$username', '$password')";


            $conn->query($sqlrequire);
        }

    }
    
}

if (isset($_POST['palavrassenha'])) {
    echo "baby";
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
    <button ></button>

    <h3>Terminou de registrar?</h3>

    <form action="login.php" method="post">
        
    <input type="submit" value="Logar">

    </form>
</body>
</html>
