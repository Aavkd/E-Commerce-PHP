<?php
// src/Utils/Validator.php

class Validator {
    
    public static function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function validateRequired($fields, $data) {
        $errors = [];
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                $errors[] = "Le champ $field est requis.";
            }
        }
        return $errors;
    }
}
?>
