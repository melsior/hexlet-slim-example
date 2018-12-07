<?php

namespace App;

class Validator implements ValidatorInterface
{
    public function validate(array $course)
    {
        $errors = [];
        if (empty($paid)) {
            $errors['paid'] = 'Can\'t be blank';
        }
        if (empty($title)) {
            $errors['title'] = 'Can\'t be blank';
        }

        return $errors;
    }
}
