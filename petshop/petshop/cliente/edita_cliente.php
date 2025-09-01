<?php
include '../conexao.php';

if(isset($_GET['cliente_cpf'])) {
    $cpf = $_GET['cliente_cpf'];

    if(isset($_POST['salvar'])) {
        $nome = $_POST['cliente_nome'];
        $endereco = $_POST['cliente_endereco'];
        $stmt = $conn->prepare("UPDATE cliente SET cliente_nome=?, cliente_endereco=? WHERE cliente_cpf=?");
        $stmt->bind_param("sss", $nome, $endereco, $cpf); 
        $stmt->execute();
        $stmt->close();

        header("Location: consulta_cliente.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT cliente_nome, cliente_endereco FROM cliente WHERE cliente_cpf=?");
    $stmt->bind_param("s", $cpf); 
    $stmt->execute();
    $stmt->bind_result($nome, $endereco);
    $stmt->fetch();
    $stmt->close();
} else {
    header("Location: consulta_cliente.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="card-form">
        <h1>Editar Cliente</h1>
        <form method="post">
            <label for="cliente_nome">Nome:</label>
            <input type="text" id="cliente_nome" name="cliente_nome" value="<?= htmlspecialchars($nome) ?>" required>

            <label for="cliente_endereco">Endereço:</label>
            <input type="text" id="cliente_endereco" name="cliente_endereco" value="<?= htmlspecialchars($endereco) ?>" required>

            <button type="submit" name="salvar">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
