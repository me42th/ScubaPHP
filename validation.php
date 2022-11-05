<?php

function validatePassword(array $user)
{
    $errors = [];
    
    if (lenghtPasswordIsValid($user['password']) === false) {
        $errors['password-lenght-msg-erro']  = 'A senha deve ter no mínimo 10 caracteres!';
    }

    if (passwordConfirmed($user['password'], $user['password-confirm']) === false) {
        $errors['password-confirm-msg-erro']  = 'O campo senha deve ser igual ao campo repita senha!';
    }

    return $errors;
}

function validateRegister(array $user)
{
    $errors = [];

    if (existEmail($user['email']) !== false) {
        $errors['email-msg-erro']  = 'Este e-mail já foi cadastrado!';
    }

    $errorsPassword = validatePassword($user);

    return array_merge($errors, $errorsPassword);
}

function existEmail(string $email): mixed
{
    // Array com os usuários já cadastrados
    $users = (array) json_decode(file_get_contents(DATA_LOCATION));

    return array_search($email, array_column($users, 'email'));
}

function lenghtPasswordIsValid(string $password): bool
{
    if (strlen($password) < 10) {
        return false;
    }

    return true;
}

function passwordConfirmed(string $password, string $passwordConfirm): bool
{
    return ($password === $passwordConfirm);
}

