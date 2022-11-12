<?php

function crudGetAll()
{
    return json_decode(file_get_contents(DATA_LOCATION), true);
}

function crudSave(array $users)
{
    return file_put_contents(DATA_LOCATION, json_encode($users));
}

function crudCreate(array $user)
{
    // Array com os usuários já cadastrados
    $users = crudGetAll();

    // Adiciona o novo usuário na próxima posição do array
    $users[] = $user;

    // Salva o usuário no arquivo users.json
    return crudSave($users);
}

function crudUpdate(array $user)
{
    // Variável de controle
    $validate = false;

    // Array com os usuários já cadastrados
    $users = crudGetAll();

    // Posição
    $keyUserEncontred = array_search($user['email'], array_column($users, 'email'));

    if (is_int($keyUserEncontred) === true) {
        $users[$keyUserEncontred] = $user;
        $validate = true;
        crudSave($users);
    }

    // Salva o usuário no arquivo users.json
    return $validate;
}

function searchEmail(string $email)
{
    // Array com os usuários já cadastrados
    $users = crudGetAll();

    // Posição
    $keyUserEncontred = array_search($email, array_column($users, 'email'));

    if ($keyUserEncontred === false) {
        return false;
    }

    // Salva o usuário no arquivo users.json
    return $users[$keyUserEncontred];
}

function validateEmail(string $email)
{
    // Variável de controle
    $validate = false;

    // Array com os usuários já cadastrados
    $users = crudGetAll();

    // Posição
    $keyUserEncontred = array_search($email, array_column($users, 'email'));

    if (is_int($keyUserEncontred) === true) {
        $users[$keyUserEncontred]['mail_validation'] = true;
        $validate = true;
        crudSave($users);
    }

    return $validate;
}

function crudDelete(string $email)
{
    // Variável de controle
    $validate = false;

    // Array com os usuários já cadastrados
    $users = crudGetAll();

    // Posição
    $keyUserEncontred = array_search($email, array_column($users, 'email'));

    if (is_int($keyUserEncontred) === true) {

        unset($users[$keyUserEncontred]);
        $validate = true;
        crudSave($users);
    }

    return $validate;
}