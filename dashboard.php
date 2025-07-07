<?php
session_start();
if(!isset($_SESSION["id"])){
    header("Location: login.php");
    exit();
}
include 'db/conexao.php';

$usuario_id = $_SESSION["id"];
$sql = "SELECT * FROM tarefas WHERE usuario_id = $usuario_id";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <body class="tema-claro">

<h2>Bem-vindo, <?php echo $_SESSION["nome"]; ?> | <a href="logout.php">Sair</a></h2>
<button onclick="alternarTema()">🌗 Alternar Tema</button> 
<h3>Suas Tarefas:</h3>
<ul>
<?php while ($tarefa = $res->fetch_assoc()) : ?>
    <li>
        <strong><?php echo $tarefa["titulo"]; ?></strong> - <?php echo $tarefa["status"]; ?>
        [<a href="editar_tarefa.php?id=<?php echo $tarefa['id']; ?>">Editar</a>]
        [<a href="excluir_tarefa.php?id=<?php echo $tarefa['id']; ?>">Excluir</a>]
</li>
<?php endwhile; ?>
</ul>

<h3>Nova Tarefa:</h3>
<form method="post" action="adicionar_tarefa.php">
    Título: <input type="text" name="titulo"><br>
    Descrição: <textarea name="descricao"></textarea><br>
    Categoria: <input type="text" name="categoria"><br>
    Data de Entrega: <input type="date" name="data_entrega"><br>
    <button type="submit">Adicionar</button>
</form>
</div>
<script src="js/script.js"></script>
</body>
</html>