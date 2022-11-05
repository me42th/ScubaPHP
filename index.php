<?php

session_start();

include 'boot.php';

if (authUser() === true) {
    guestRoutes();
} else {
    authRoutes();
}