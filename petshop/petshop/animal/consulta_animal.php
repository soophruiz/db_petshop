<?php
include '../conexao.php';

$sql = "SELECT animal_cod, animal_nome, animal_tipo, animal_raca FROM animal";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Animais</title>
     <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="titulo"></div>
<h1>Animais Cadastrados</h1>
</div>
<?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Raça</th>
            <th>Ações</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["animal_nome"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["animal_tipo"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["animal_raca"]) . "</td>";
        echo "<td>
        <a href='edita_animal.php?id=" . $row["animal_cod"] . "'>Editar</a> 
        <a href='exclui_animal.php?id=" . $row["animal_cod"] . "' onclick=\"return confirm('Tem certeza que deseja excluir este animal?');\">Excluir</a>
      </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>Nenhum animal encontrado.</p>";
}
?>
</body>
</html>
