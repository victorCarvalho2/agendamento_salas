<?php
include 'conexao.php';

// Consulta ajustada conforme os nomes das colunas reais
$sql = "
SELECT id, ambiente, data_reserva, turno, hora_inicio, hora_fim, responsavel, finalidade, observacoes, data_criacao
FROM reservas ORDER BY data_reserva DESC ";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<table class="tabela-reservas">';
    echo '<tr>
            <th>ID</th>
            <th>Ambiente</th>
            <th>Data</th>
            <th>Turno</th>
            <th>Horário</th>
            <th>Responsável</th>
            <th>Finalidade</th>
            <th>Observações</th>
            <th>Data da Criação</th>
          </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['ambiente']) . '</td>';
        echo '<td>' . date('d/m/Y', strtotime($row['data_reserva'])) . '</td>';
        echo '<td>' . htmlspecialchars($row['turno']) . '</td>';
        echo '<td>' . htmlspecialchars($row['hora_inicio']) . ' - ' . htmlspecialchars($row['hora_fim']) . '</td>';
        echo '<td>' . htmlspecialchars($row['responsavel']) . '</td>';
        echo '<td>' . htmlspecialchars($row['finalidade']) . '</td>';
        echo '<td>' . htmlspecialchars($row['observacoes']) . '</td>';
        echo '<td>' . date('d/m/Y', strtotime($row['data_criacao'])) . '</td>';

        echo '</tr>';
    }

    echo '</table>';
} else {
    echo '<p>Nenhuma reserva encontrada.</p>';
}

// Captura os filtros
$ambiente = $_GET['ambiente'] ?? '';
$status = $_GET['status'] ?? '';
$data = $_GET['data'] ?? '';
$responsavel = $_GET['responsavel'] ?? '';

$sql = "SELECT id, ambiente, data_reserva, turno, hora_inicio, hora_fim, responsavel, finalidade, observacoes 
        FROM reservas 
        WHERE 1=1";

// Filtros dinâmicos
if (!empty($ambiente)) {
    $sql .= " AND ambiente = '" . $conn->real_escape_string($ambiente) . "'";
}
if (!empty($status)) {
    $sql .= " AND status = '" . $conn->real_escape_string($status) . "'";
}
if (!empty($data)) {
    $sql .= " AND data_reserva = '" . $conn->real_escape_string($data) . "'";
}
if (!empty($responsavel)) {
    $sql .= " AND responsavel LIKE '%" . $conn->real_escape_string($responsavel) . "%'";
}

$sql .= " ORDER BY data_reserva DESC";

$result = $conn->query($sql);

// Exibe as linhas normalmente
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['ambiente']) . '</td>';
        echo '<td>' . date('d/m/Y', strtotime($row['data_reserva'])) . '</td>';
        echo '<td>' . htmlspecialchars($row['turno']) . '</td>';
        echo '<td>' . htmlspecialchars($row['hora_inicio']) . ' - ' . htmlspecialchars($row['hora_fim']) . '</td>';
        echo '<td>' . htmlspecialchars($row['responsavel']) . '</td>';
        echo '<td>' . htmlspecialchars($row['finalidade']) . '</td>';
        echo '<td>' . htmlspecialchars($row['observacoes']) . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="8">Nenhuma reserva encontrada.</td></tr>';
}






$conn->close();
?>
