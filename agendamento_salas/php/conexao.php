<?php
$host = "localhost";
$usuario = "root";     // usuário padrão do XAMPP
$senha = "123456789";           // senha em branco por padrão
$banco = "sistema_reservas";

$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>