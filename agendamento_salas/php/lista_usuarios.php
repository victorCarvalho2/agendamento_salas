<?php
include "conexao.php"; // ajuste se necessário

if (!$conn) {
    die("Erro: conexão com o banco falhou.");
}

// Testa a query
$sql = "SELECT * FROM usuarios ORDER BY id_usuario ASC";
$result = $conn->query($sql);

if (!$result) {
    die("Erro ao executar consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #7e6ee3;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
        }

        h3 {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #5565d0;
            color: #fff;
            padding: 10px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        .editar { background: #ffc107; color: #000; }
        .resetar { background: #17a2b8; }
        .excluir { background: #dc3545; }
    </style>
</head>
<body>
<div class="container">
    <h3>Lista de Usuários</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Matrícula</th>
                <th>Função</th>
                <th>Segmento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>#{$row['id_usuario']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['matricula']}</td>
                        <td>{$row['funcao']}</td>
                        <td>{$row['segmento']}</td>
                        <td>
                            <button class='btn editar'>✏️ Editar</button>
                            <button class='btn resetar'>🔍 Resetar</button>
                            <button class='btn excluir'>🗑 Excluir</button>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum usuário cadastrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>







</body>
</html>
