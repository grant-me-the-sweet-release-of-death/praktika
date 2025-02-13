<?php
require_once '../core/init.php'; 

try {
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $login = Cleaner::str($_POST['login']);
       $password = Cleaner::str($_POST['password']);
       
       $user = new User($login, password_hash('', PASSWORD_DEFAULT)); 
       if (Eshop::logIn($user)) { 
           header('Location: /admin'); 
           exit(); 
       }
   }
} catch (Exception $e) { 
   echo 'Error: ' . htmlspecialchars($e->getMessage()); 
}
?>

<h1>Admin console</h1>
<form action="login.php" method="post">
   <div>
       <label>Login:</label>
       <input type="text" name="login" required>
   </div>
   <div>
       <label>Password:</label>
       <input type="password" name="password" required>
   </div>
   <div>
       <input type="submit" value="Login">
   </div>
</form>
