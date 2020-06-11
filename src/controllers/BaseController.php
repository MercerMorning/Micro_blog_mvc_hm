<?php
namespace App\Controllers;

class BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = ['is_admin' => 1];
    }

    protected function render($template, $data = [])
    {
        extract($data);
        include __DIR__ . '\..\views\\' . $template . '.php';
    }
}

