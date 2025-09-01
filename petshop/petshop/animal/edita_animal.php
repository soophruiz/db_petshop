<?php
include '../conexao.php';

$animal_cod = $_GET['id'] ?? null;

if (!$animal_cod) {
    echo "Animal não encontrado.";
    exit;
}

$sql = "SELECT animal_cod, animal_nome, animal_raca FROM animal WHERE animal_cod = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $animal_cod);
$stmt->execute();
$result = $stmt->get_result();
$animal = $result->fetch_assoc();

if (!$animal) {
    echo "Animal não encontrado.";
    exit;
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['animal_nome'];
    $raca = $_POST['animal_raca'];

    $update = "UPDATE animal SET animal_nome = ?, animal_raca = ? WHERE animal_cod = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssi", $nome, $raca, $animal_cod);
    if ($stmt->execute()) {
        $msg = "Animal atualizado com sucesso!";
        $animal['animal_nome'] = $nome;
        $animal['animal_raca'] = $raca;
    } else {
        $msg = "Erro ao atualizar animal: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="card-form">
    <h1>Editar Animal</h1>

    <?php if($msg): ?>
        <p><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>

    <form method="POST">
        <div>
            <label for="animal_nome">Nome do Animal:</label>
            <input type="text" id="animal_nome" name="animal_nome" value="<?= htmlspecialchars($animal['animal_nome']) ?>" required>
        </div>
        <div>
            <label for="animal_raca">Raça:</label>
            <input type="text" id="animal_raca" name="animal_raca" value="<?= htmlspecialchars($animal['animal_raca']) ?>" required>
        </div>
        <button type="submit">Salvar Alterações</button>
        <button type="button" onclick="window.location.href='consulta_animal.php'">Voltar</button>
    </form>
    </div>
</body>
</html>
