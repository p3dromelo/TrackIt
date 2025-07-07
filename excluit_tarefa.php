<?php
session_start();
include 'db/conexao.php';

if(!isset($_SESSION["id"])){
    header("Location: login.php");
    exit();
}

$id_tarefa = $_GET["id"];
$usuario_id = $_SESSION["id"];

$sql = "DELETE FROM tarefas WHERE id=$id_tarefa AND usuario_id=$usuario_id";

if ($conn->query($sql)) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Erro ao excluir: ". $conn->error;
}
?>