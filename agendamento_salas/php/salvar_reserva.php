<?php
include("conexao.php");

// Recebe os dados do formulário
$ambiente = $_POST['ambiente'] ?? '';
$data_reserva = $_POST['data'] ?? '';
$turno = $_POST['turno'] ?? '';
$horaInicio = $_POST['horaInicio'] ?? '';
$horaFim = $_POST['horaFim'] ?? '';
$responsavel = $_POST['responsavel'] ?? '';
$finalidade = $_POST['finalidade'] ?? '';
$observacoes = $_POST['observacoes'] ?? '';

// Verifica se campos obrigatórios foram preenchidos
if (empty($ambiente) || empty($data_reserva) || empty($turno) || empty($horaInicio) || empty($horaFim) || empty($responsavel) || empty($finalidade)) {
    die("Por favor, preencha todos os campos obrigatórios.");
}

// Prepara e executa a inserção
$stmt = $conn->prepare("INSERT INTO reservas (ambiente, data_reserva, turno, hora_inicio, hora_fim, responsavel, finalidade, observacoes)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("issssiss", $ambiente, $data_reserva, $turno, $horaInicio, $horaFim, $responsavel, $finalidade, $observacoes);

if ($stmt->execute()) {
    echo "✅ Reserva salva com sucesso!";
} else {
    echo "❌ Erro ao salvar reserva: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
