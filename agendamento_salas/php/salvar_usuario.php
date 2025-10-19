<?php
include "../conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $matricula = trim($_POST['matricula']);
    $senha = trim($_POST['senha']);
    $confirmar = trim($_POST['confirmar']);
    $funcao = $_POST['funcao'];
    $segmento = $_POST['segmento'];

    if ($senha !== $confirmar) {
        echo "<script>alert('As senhas não conferem!'); window.history.back();</script>";
        exit;
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, matricula, senha, funcao, segmento)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $matricula, $senha_hash, $funcao, $segmento);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='lista_usuarios.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
