<?php
include 'db/conexao.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $sql = "INSERT INTO usuarios (nome, email, senha, role) VALUES ('$nome', '$email', '$senha', '$role')";

    if($conn->query($sql)){
        header("Location: login.php");
    } else {
        echo "Erro ao cadastrar: ". $conn->error;
    }
}
?>

<form method="post">
    Nome: <input type="text" name="nome"><br>
    Email: <input type="email" name="email"><br>
    Senha: <input type="password" name="senha"><br>
    <select name="role">
        <option value="professor">Professor</option>
        <option value="aluno">Aluno</option>
</select><br>
<button type="submit">Cadastrar</button>
</form>