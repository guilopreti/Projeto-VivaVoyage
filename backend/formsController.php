<?php

// importando arquivo de conexão com o banco
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;
    $rua = $_POST['rua'] ?? null;
    $logradouro = $_POST['logradouro'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $estado = $_POST['estado'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $action = $_POST['action'] ?? null;
    $camposObrigatorios = [];

    if ($action == 'cadastro') {
        if (empty($nome)) {
            $camposObrigatorios[] = "O campo nome não pode ser nulo";
        }

        if (empty($email)) {
            $camposObrigatorios[] = "O campo email não pode ser nulo";
        }

        if (empty($senha)) {
            $camposObrigatorios[] = "O campo senha não pode ser nulo";
        }

        if (empty($rua)) {
            $camposObrigatorios[] = "O campo rua não pode ser nulo";
        }

        if (empty($logradouro)) {
            $camposObrigatorios[] = "O campo logradouro não pode ser nulo";
        }

        if (empty($cidade)) {
            $camposObrigatorios[] = "O campo cidade não pode ser nulo";
        }

        if (empty($estado)) {
            $camposObrigatorios[] = "O campo estado não pode ser nulo";
        }

        if (empty($cep)) {
            $camposObrigatorios[] = "O campo cep não pode ser nulo";
        }
    }

    if (count($camposObrigatorios) > 0) {
        header('HTTP/1.1 400 Bad Request');
        exit();
    }

    if (!empty($action)) {
        if ($action == 'cadastro') {
            try {
                $statement = $pdo->prepare(
                    "INSERT INTO usuarios (nome, email, senha, rua, logradouro, cidade, cep, estado) VALUES (
                        :nome, :email, :senha, :rua, :logradouro, :cidade, :cep, :estado
                    )"
                );
                $statement->bindParam(":nome", trim($nome));
                $statement->bindParam(":email", trim($email));
                $statement->bindParam(":senha", trim($senha));
                $statement->bindParam(":rua", trim($rua));
                $statement->bindParam(":logradouro", trim($logradouro));
                $statement->bindParam(":cidade", trim($cidade));
                $statement->bindParam(":cep", trim($cep));
                $statement->bindParam(":estado", trim($estado));
                $statement->execute();

                header('HTTP/1.1 201 created!');
                exit();
            } catch (\PDOException $error) {
                echo $error->getMessage();
            }
        }

        if ($action == 'login') {
            try {
                $statement = $pdo->prepare("SELECT nome FROM usuarios WHERE email = :email AND senha = :senha");
                $statement->bindParam(":email", $email);
                $statement->bindParam(":senha", $senha);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_OBJ);

                if (!$user->nome) {
                    header('HTTP/1.1 401');
                    exit();
                }

                header('HTTP/1.1 200');
                echo json_encode($user);

            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }
    }
}
