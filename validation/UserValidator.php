<?php


final class UserValidator {

    private function __construct() {
    }

    
    public static function validate(User $user) {
        $errors = array();
        if (!$user->getFirstName()) {
            $errors[] = new Error('first_name', 'First Name is empty or invalid First Name.');
        }
        if (!$user->getLastName()) {
            $errors[] = new Error('last_name', 'Last name is empty or invalid Last Name.');
        }
                if (!$user->getEmail()) {
            $errors[] = new Error('email', 'Email is empty or invalid First Name.');
        }
        if (!$user->getPassword()) {
            $errors[] = new Error('password', 'Password is empty or invalid Last Name.');
        }
        return $errors;
    }

 

}
