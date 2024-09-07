<?php
// Configurações do banco de dados
$db_host = 'localhost'; // Host do MySQL
$db_user = 'root'; // Nome de usuário do MySQL
$db_password = ''; // Senha do MySQL
$db_name = 'usuarios'; // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}
?>
