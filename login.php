<?php
header('Content-Type: application/json');

$arquivo = 'usuarios.json';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(["status" => "erro", "mensagem" => "Preencha todos os campos!"]);
    exit;
}

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([]));
}

$usuarios = json_decode(file_get_contents($arquivo), true);
$usuarioEncontrado = false;

foreach ($usuarios as $usuario) {
    if ($usuario['email'] === $email) {
        if ($usuario['senha'] === $password) {
            echo json_encode(["status" => "sucesso", "mensagem" => "Login realizado com sucesso!"]);
            exit;
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Senha incorreta!"]);
            exit;
        }
    }
}

$usuarios[] = ["email" => $email, "senha" => $password];
file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT));

echo json_encode(["status" => "sucesso", "mensagem" => "Cadastro realizado e login efetuado com sucesso!"]);
?>
