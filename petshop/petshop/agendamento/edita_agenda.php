<?php

include '../conexao.php';

$agendamento_id = $_GET['id'] ?? null;

if (!$agendamento_id) {
    echo "Agendamento não encontrado.";
    exit;
}

$sql = "SELECT ag.agendamento_code, ag.agendamento_procedimento, ag.agendamento_data,
               ag.fk_animal_code, ag.fk_cliente_cpf,
               an.animal_nome, cl.cliente_nome
        FROM agendamento ag
        INNER JOIN animal an ON ag.fk_animal_code = an.animal_cod
        INNER JOIN cliente cl ON ag.fk_cliente_cpf = cl.cliente_cpf
        WHERE ag.agendamento_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $agendamento_id);
$stmt->execute();
$result = $stmt->get_result();
$agendamento = $result->fetch_assoc();

if (!$agendamento) {
    echo "Agendamento não encontrado.";
    exit;
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $procedimento = $_POST['procedimento'];
    $data = $_POST['data'];
    $animal_cod = $_POST['animal'];
    $cliente_cpf = $_POST['cliente'];

    $update = "UPDATE agendamento SET agendamento_procedimento=?, agendamento_data=?,
               fk_animal_code=?, fk_cliente_cpf=? WHERE agendamento_code=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssisi", $procedimento, $data, $animal_cod, $cliente_cpf, $agendamento_id);
    $stmt->execute();

    $msg = "Agendamento atualizado com sucesso!";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $agendamento_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $agendamento = $result->fetch_assoc();
}

$animais = $conn->query("SELECT animal_cod, animal_nome FROM animal");
$clientes = $conn->query("SELECT cliente_cpf, cliente_nome FROM cliente");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="card-form">
    <h1>Editar Agendamento</h1>

    <?php if($msg): ?>
        <p><?= $msg ?></p>
    <?php endif; ?>

    <form method="POST">
        <div>
            <label>Procedimento</label><br>
            <input type="text" name="procedimento" value="<?= htmlspecialchars($agendamento['agendamento_procedimento']) ?>">
        </div>
        <div>
            <label>Data</label><br>
            <input type="date" name="data" value="<?= date('Y-m-d', strtotime($agendamento['agendamento_data'])) ?>">
        </div>
        <div>
            <label>Nome do Animal</label><br>
            <select name="animal">
                <?php while($a = $animais->fetch_assoc()): ?>
                    <option value="<?= $a['animal_cod'] ?>" <?= $a['animal_cod'] == $agendamento['fk_animal_code'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($a['animal_nome']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div>
            <label>Nome do Cliente</label><br>
            <select name="cliente">
                <?php while($c = $clientes->fetch_assoc()): ?>
                    <option value="<?= $c['cliente_cpf'] ?>" <?= $c['cliente_cpf'] == $agendamento['fk_cliente_cpf'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['cliente_nome']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <br>
        <button type="submit">Salvar Alterações</button>
        <button type="button" onclick="window.location.href='consulta_agenda.php'">Voltar</button>
    </form>
                </div>

</body>
</html>
