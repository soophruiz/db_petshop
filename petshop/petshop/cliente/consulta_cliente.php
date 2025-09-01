<?php
include '../conexao.php';

$sql = "SELECT cliente_cpf, cliente_nome, cliente_endereco FROM cliente";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Clientes</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="titulo">
    <h1>Clientes Cadastrados</h1>
    </div>
    <div class="titulo" >
    <table>
        <tr>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['cliente_nome']}</td>
                        <td>{$row['cliente_endereco']}</td>
                        <td>
                            <a href='edita_cliente.php?cliente_cpf={$row['cliente_cpf']}'>Editar</a> | 
                            <a href='exclui_cliente.php?cliente_cpf={$row['cliente_cpf']}' onclick='return confirm(\"Deseja realmente excluir?\")'>Excluir</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Nenhum cliente cadastrado.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
