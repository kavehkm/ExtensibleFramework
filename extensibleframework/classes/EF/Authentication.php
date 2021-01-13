<?php
namespace EF;


class Authentication
{
    private $userTable;
    private $usernameColumn;
    private $passwordColumn;

    public function __construct(DatabaseTable $userTable, string $usernameColumn, string $passwordColumn)
    {
        // start session
        session_start();

        $this->userTable = $userTable;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
    }

    public function login($username, $password)
    {
        $user = $this->userTable->find($this->usernameColumn, strtolower($username));
        if (!empty($user) && password_verify($password, $user[0][$this->passwordColumn])) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user[0][$this->passwordColumn];
            return true;
        } else {
            return false;
        }
    }

    public function isLoggedIn()
    {
        if (empty($_SESSION['username'])) {
            return false;
        }
        $user = $this->userTable->find($this->usernameColumn, strtolower($_SESSION['username']));

        if (!empty($user) && $_SESSION['password'] === $user[0][$this->passwordColumn]) {
            return true;
        } else {
            return false;
        }
    }
}