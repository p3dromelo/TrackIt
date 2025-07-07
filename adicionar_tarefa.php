<?php
session_start();
include 'db/conexao.php';

$usuario_id = $_SESSION["id"];
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$categoria = $_POST["categoria"];
$data = $_POST["data_entrega"];

$sql = "INSERT INTO tarefas (usuario_id, titulo, descricao, categoria, data_entrega) VALUES ($usuario_id, '$titulo', '$descricao', '$categoria', '$data')";

$conn->query($sql);
header("Location: dashboard.php");
?>