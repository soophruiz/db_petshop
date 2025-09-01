<?php
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop Manager</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1> Controle de Clientes, Pets e Agendamentos 🐾</h1>
        <p>Escolha uma seção para gerenciar:</p>
        <div class="menu">
            <a href="cliente/consulta_cliente.php">👤 Clientes</a>
            <a href="animal/consulta_animal.php">🐕‍🦺 Animais</a>
            <a href="agendamento/consulta_agenda.php">📌 Agendamentos</a>
        </div>
        <footer>
            &copy; <?php echo date("Y"); ?> Petshop Manager
        </footer>
    </div>
</body>
</html>
