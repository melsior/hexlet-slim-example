<?php

namespace App;

class Repository
{
    public function __construct()
    {
        session_start();
    }

    public function all()
    {
        return array_values($_SESSION);
    }

    public function find(int $id)
    {
        return $_SESSION[$id];
    }
}
