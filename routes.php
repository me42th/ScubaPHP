<?php

function authRoutes()
{
    $page = ($_GET['page'] ?? 'login');

    switch ($page) {
        case 'login':
            doLogin();
            break;
        case 'register':
            doRegister();
            break;
        case 'forget-password':
            doForgetPassword();
            break;
        case 'change-password':
            doChangePassword();
            break;
        case 'mail-validation':
            doValidation();
            break;
        default:
            doNotFound();
    }
}

function guestRoutes()
{
    $page = ($_GET['page'] ?? 'home');

    switch ($page) {
        case 'home':
            doHome();
            break;
        case 'delete-account':
            doDeleteAccount();
            break;
        case 'logout':
            doLogout();
            break;
        default:
            doNotFound();
    }
}
