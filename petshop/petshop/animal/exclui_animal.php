<?php
include '../conexao.php';

$animal_cod = $_GET['id'] ?? null;

if (!$animal_cod) {
    echo "<script>alert('ID do animal não informado.'); window.location.href='consulta_animal.php';</script>";
    exit;
}

$sql = "SELECT * FROM animal WHERE animal_cod = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $animal_cod);
$stmt->execute();
$result = $stmt->get_result();
$animal = $result->fetch_assoc();

if (!$animal) {
    echo "<script>alert('Animal não encontrado no banco de dados.'); window.location.href='consulta_animal.php';</script>";
    exit;
}

$delete = "DELETE FROM animal WHERE animal_cod = ?";
$stmt = $conn->prepare($delete);
$stmt->bind_param("i", $animal_cod);

try {
    if ($stmt->execute()) {
        echo "<script>alert('Animal excluído com sucesso!'); window.location.href='consulta_animal.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir o animal.'); window.location.href='consulta_animal.php';</script>";
    }
} catch (mysqli_sql_exception $e) {

    if ($e->getCode() == 1451) { 
        echo "<script>alert('Não é possível excluir este animal, pois existem agendamentos vinculados a ele.'); window.location.href='consulta_animal.php';</script>";
    } else {
        echo "<script>alert('Erro ao excluir: " . $e->getMessage() . "'); window.location.href='consulta_animal.php';</script>";
    }
}

$stmt->close();
$conn->close();
?>
