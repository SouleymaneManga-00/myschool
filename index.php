<?php

require_once 'config/db.php';

require_once 'controllers/AuthControllers.php';

$auth = new AuthController($pdo);

$auth->login();

require_once 'views/auth/login.php';