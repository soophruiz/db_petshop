<?php
include '../conexao.php';

$sql = "
    SELECT 
        ag.agendamento_code,
        ag.agendamento_data,
        ag.agendamento_procedimento,
        an.animal_nome,
        cl.cliente_nome
    FROM agendamento ag
    INNER JOIN animal an ON ag.fk_animal_code = an.animal_cod
    INNER JOIN cliente cl ON ag.fk_cliente_cpf = cl.cliente_cpf
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendamentos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="titulo" >
<h1>Agendamentos Cadastrados</h1>
</div>
<div>
<?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th>Procedimento</th>
            <th>Data</th>
            <th>Nome do Animal</th>
            <th>Cliente</th>
            <th>Ações</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        $dataFormatada = date("d/m/Y", strtotime($row["agendamento_data"]));
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["agendamento_procedimento"]) . "</td>";
        echo "<td>" . $dataFormatada . "</td>";
        echo "<td>" . htmlspecialchars($row["animal_nome"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["cliente_nome"]) . "</td>";
        echo "<td>
                <a href='edita_agenda.php?id=" . $row["agendamento_code"] . "'>Editar</a> | 
                <a href='exclui_agenda.php?id=" . $row["agendamento_code"] . "' onclick=\"return confirm('Tem certeza que deseja excluir este agendamento?');\">Excluir</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>Nenhum agendamento encontrado.</p>";
}

?>
</div>
</body>
</html>
