<?php
session_start();
include 'db/conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE email='email'";
    $res = $conn->query($sql);

    if($res->num_rows>0){
        $usuario = $res->fetch_assoc();
        if (password_verify($senha, $usuario["senha"])){
            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nome"] = $usuario["nome"];
            header("Location: dashboard.php");
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>

<form method="post">
    Email: <input type="email" name="email"><br>
    Senha: <input type="password" name="senha"><br>
    <button type="submit">Entrar</button>
</form>