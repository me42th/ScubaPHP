<?php

function authentication(string $email, string $password)
{
    $data = [];

    // Array com os usuários já cadastrados
    $users = crudGetAll();

    // Posição
    $keyUserEncontred = array_search($email, array_column($users, 'email'));

    if ($keyUserEncontred === false) {
        $data['errors']['email-msg-erro'] = 'E-mail não encontrado!';
        return $data;
    }

    if ($users[$keyUserEncontred]['mail_validation'] === false) {
        $data['errors']['email-msg-nao-validado'] = 'E-mail não validado!';
        return $data;
    }

    // Vetor com os dados do usuário encontrado
    $user = $users[$keyUserEncontred];

    if (password_verify($password, $user['password']) === false) {
        $data['errors']['password-msg-erro'] = 'Senha inválida!';
        return $data;
    }

    $data['user'] = $user;

    return $data;
}

function authUser()
{
    return (isset($_SESSION['logged']) && $_SESSION['logged'] === 'true');
}

function logout()
{
    //unset($_SESSION['logged']);
    //unset($_SESSION['user_email']);
    session_destroy();
}