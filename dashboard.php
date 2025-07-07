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