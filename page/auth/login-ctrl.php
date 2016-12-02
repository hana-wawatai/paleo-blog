<?php

$headTemplate = new HeadTemplate('Login | Cooking Paleo', 'Login for Cooking Paleo');


$dao = new UserDao();
if (isset($_POST['submit'])) {
 

    if (isset($_POST['email']) && isset($_POST['password'])) {

//        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
//        $password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_PASSWORD);
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $user = $dao->findByCredentials($email, $password);
        if ($user === null) {
            Utils::redirect('login', array('module' => 'auth'));
        }
        if ($email === $user->getEmail() && $password === $user->getPassword()) {

            $_SESSION['email'] = $user->getEmail();
           
//            $_SESSION['privilege'] = $user->getPrivilege();

            Utils::redirect('list', array('module' => 'blog'));
        } else {
            $error = "email and/or password is incorrect!";
        }
    }

        
}
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php?module=review&page=list');
}

//$errors = '';
//if (isset($_POST['submit'])) {
//
//    $email = filter_input(INPUT_POST, 'inputEmail', FILTER_VALIDATE_EMAIL);
//    $password = $_POST['inputPassword'];
//    $userDao = new userDao();
//    $user = $userDao->findtials($email, $password);
//
//    if ($email === $user->getEmail() && $password === $user->getPassword()) {
//        $_SESSION['user_id'] = $user->getId();
//        $_SESSION['user_role'] = $user->getRole();
//
//        header('Location: index.php');
//    } else {
//        $errors = 'These credentials are not recognised.';
//    }
//}

