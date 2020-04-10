<?php


namespace App\Entity;


class Admin
{
    private $email;
    private $pwd;

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPwd(string $pwd)
    {
        $this->pwd = $pwd;
        return $this;
    }

    public function getPwd()
    {
        return $this->pwd;
    }
}