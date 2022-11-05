<?php

function doRegister()
{
    $data = [];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $user = $_POST['person'];

        // Erros caso existam
        $data = validateRegister($user);

        if (count($data) === 0) {
            // Remover índice de confirmação de senha
            unset($user['password-confirm']);

            // Criptografar a senha do usuário
            $user['password'] = password_hash($user['password'], PASSWORD_BCRYPT);

            $user['mail_validation'] = false;

            // Chama função para criar o usuário
            if (crudCreate($user) === false) {
                die('Erro ao criar o usuário!');
            }
            
            sendEmailConfirmation($user);            

            $_SESSION['login-msg-success'] = 'Você ainda precisa confirmar o email!';
            header('Location: /?page=login');
            exit;
        }
    }

    http_response_code(200);
    renderView('register', $data);
}

function doLogin()
{
    $data = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $user = $_POST['person'];
        
        $email    = htmlspecialchars($user['email']);
        $password = htmlspecialchars($user['password']);

        // Erros caso existam
        $data = authentication($email, $password);

        if (isset($data['errors']) === false) {

            $_SESSION['logged']     = 'true';
            $_SESSION['user_email'] = $data['user']['email'];

            header('Location: /?page=home');
            exit;
        }
    }
    
    if (isset($_SESSION['login-msg-success'])) {
        $data['login-msg-success'] = $_SESSION['login-msg-success'];
        unset($_SESSION['login-msg-success']);
    }

    if (isset($_SESSION['login-msg-error'])) {
        $data['login-msg-error'] = $_SESSION['login-msg-error'];
        unset($_SESSION['login-msg-error']);
    }

    http_response_code(200);
    renderView('login', $data);
}

function doNotFound()
{
    http_response_code(404);
    renderView('not_found');
}

function doValidation()
{
    if (isset($_GET['token'])) {

        $token = $_GET['token'];

        $emailUser = sslDecrypt($token);

        if (validateEmail($emailUser) === false) {
            $_SESSION['login-msg-error'] = 'Token inválido!';
        } else {
            $_SESSION['login-msg-success'] = 'E-mail validado com sucesso!';
        }

        header('Location: /?page=login');
        exit;
    }
}

function doHome()
{
    $data = [];

    $emailSession = $_SESSION['user_email'];

    $user = searchEmail($emailSession);

    $data['user'] = $user;

    http_response_code(404);
    renderView('home', $data);
}

function doLogout()
{
    logout();
    header('Location: /');
}

function doDeleteAccount()
{
    $email = $_SESSION['user_email'];
    crudDelete($email);
    doLogout();
}

function doForgetPassword()
{
    $data = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = $_POST['person']['email'];

        $existUser = searchEmail($email);

        if ($existUser === false) {
            $data['errors']['msg-error'] = 'E-mail não encontrado!';
        } else {

            sendEmailPasswordRedefinition($existUser);
            $data['success']['msg-success'] = 'Redefinição de senha enviada com sucesso!';
        }
    }

    http_response_code(200);
    renderView('forget_password', $data);
}

function doChangePassword()
{
    $data = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $token  = $_POST['token'];
        $str    = sslDecrypt($token);
        $vector = explode('|', $str);

        $data['token'] = $token;
        $data['email'] = $vector[0];

        $person = $_POST['person'];

        // Erros caso existam
        $data['errors'] = validatePassword($person);

        if (count($data['errors']) === 0) {

            $user = searchEmail($data['email']);

            // Criptografar a senha do usuário
            $user['password'] = password_hash($person['password'], PASSWORD_BCRYPT);

            // Chama função para editar o usuário
            if (crudUpdate($user) === false) {
                die('Erro ao editar senha do usuário!');
            }

            $_SESSION['login-msg-success'] = 'Senha alterada com sucesso!';
            header('Location: /?page=login');
            exit;
        }
    }

    if (isset($_GET['token'])) {

        $token  = $_GET['token'];
        $str    = sslDecrypt($token);
        $vector = explode('|', $str);

        $data['token'] = $token;
        $data['email'] = $vector[0];

        if ($vector[1] !== date('Y-m-d')) {
            $_SESSION['login-msg-error'] = 'Token expirado!';
            header('Location: /?page=login');
            exit;
        }
    }

    http_response_code(200);
    renderView('change_password', $data);
}
