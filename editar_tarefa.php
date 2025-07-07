<?php
session_start();
include 'db/conexao.php';

if(!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

$id_tarefa = $_GET["id"];
$usuario_id = $_SESSION["id"];

$sql = "SELECT * FROM tarefas WHERE id=$id_tarefa AND usuario_id=$usuario_id";
$res = $conn->query($sql);

if($res->num_rows == 0){
    echo "Tarefa não encontrada.";
    exti();
}

$tarefa = $res->fetch_assoc();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $categoria = $_POST["categoria"];
    $data_entrega = $_POST["data_entrega"];
    $status = $_POST["status"];

    $sql = "UPDATE tarefas SET titulo='$titulo', descricao='$descricao', categoria='$categoria', data_entrega='$data_entrega', status='$status' WHERE id=$id_tarefa AND usuario_id=$usuario_id";

    if($conn->query($sql)){
        header("Location: dashboard.php");
        exit();
     } else {
        echo "Erro ao atualizar tarefa: ". $conn->error;
     }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<h3>Editar Tarefa</h3>
<form method="post">
    Título: <input type="text" name="titulo" value="<?php echo $tarefa['titulo']; ?>"><br>
    Descrição: <textarea name="descricao"><?php echo $tarefa['descricao']; ?></textarea><br>
    Categoria: <input type="text" name="categoria" value="<?php echo $tarefa['categoria']; ?>"><br>
    Data de Entrega: <input type="date" name="data_entrega" value="<?php echo $tarefa['data_entrega']; ?>"><br>
    Status:
    <select name="status">
        <option value="pendente" <?php if($tarefa['status'] == 'pendente') echo 'selected'; ?>>Pedente</option>
        <option value="concluida" <?php if($tarefa['status'] == 'concluida') echo 'selected'; ?>>Concluída</option></select><br>
        <button type="submut">Salvar</button>
</form>
<a href="dashboard.php">Voltar</a>
</div>
</body>
</html>
