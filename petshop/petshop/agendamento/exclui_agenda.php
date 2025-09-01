<?php

include '../conexao.php';

$agendamento_id = $_GET['id'] ?? null;

if (!$agendamento_id) {
    echo "Agendamento não encontrado.";
    exit;
}

$sql = "SELECT agendamento_code FROM agendamento WHERE agendamento_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $agendamento_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Agendamento não encontrado.";
    exit;
}

$delete = "DELETE FROM agendamento WHERE agendamento_code = ?";
$stmt = $conn->prepare($delete);
$stmt->bind_param("i", $agendamento_id);
if($stmt->execute()) {
    echo "<p class='text-green-600 font-bold'>Agendamento excluído com sucesso!</p>";
    echo "<a href='consulta_agenda.php' class='text-blue-600 hover:underline'>Voltar à lista de agendamentos</a>";
} else {
    echo "<p class='text-red-600 font-bold'>Erro ao excluir o agendamento. Tente novamente.</p>";
}
$conn->close();
?>
