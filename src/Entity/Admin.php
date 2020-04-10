<?php


namespace App\Entity;


use Symfony\Component\Security\Core\User\UserInterface;

class Admin implements UserInterface, \Serializable
{
    private $username;
    private $email;
    private $password;

    public function setUsername(string $username)
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return [
            'ROLE_USER'
        ];
    }

    public function getSalt(){}

    public function eraseCredentials(){}

    public function serialize()
    {
        return serialize([
            $this->username,
            $this->email,
            $this->password
        ]);
    }

    public function unserialize($string)
    {
        list(
            $this->username,
            $this->email,
            $this->password
        ) = unserialize($string, ['allowed_classes' => false]);
    }
}