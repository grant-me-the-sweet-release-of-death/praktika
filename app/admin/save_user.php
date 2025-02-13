<?php
require_once '../core/init.php'; 

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = Cleaner::str($_POST['login']);
        $password = Cleaner::str($_POST['password']);
        $email = Cleaner::str($_POST['email']);
        
        $hashedPassword = Eshop::createHash($password);
        $user = new User($login, $hashedPassword, $email);

        Eshop::userAdd($user);

        header('Location: /admin'); 
        exit();
        
    } else {
        throw new Exception('Wrong requesting method.');
    }
} catch (Exception $e) {
   echo 'Error: ' . htmlspecialchars($e->getMessage());
}
