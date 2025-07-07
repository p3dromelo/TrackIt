<?php
session_start();
include 'db/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $usuario = $res->fetch_assoc();
        if (password_verify($senha, $usuario["senha"])) {
            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nome"] = $usuario["nome"];
            $_SESSION["role"] = $usuario["role"];

            if ($usuario["role"] === "professor") {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track It</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<form method="post">
    Email: <input type="email" name="email"><br>
    Senha: <input type="password" name="senha"><br>
    <button type="submit">Entrar</button>
</form>
</div>
</body>
</html>