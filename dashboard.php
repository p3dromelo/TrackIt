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

<h2>Bem-vindo, <?php echo $_SESSION["nome"]; ?> | <a href="logout.php">Sair</a></h2>

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
    <button type="submit"Adicionar</button>
</form>