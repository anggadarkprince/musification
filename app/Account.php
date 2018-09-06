<?php

namespace App;


class Account extends Database
{
    public function login($username, $password)
    {
        echo $username . ' ' . $password;
    }

    public function register($firstName, $lastName, $username, $email, $password, $avatar = '')
    {
        $query = "INSERT INTO users (first_name, last_name, username, email, password, avatar) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->getConnection()->prepare($query);
        $statement->bind_param('ssssss', $firstName, $lastName, $username, $email, $password, $avatar);
        $result = $statement->execute();

        $statement->close();
        $this->getConnection()->close();

        return $result;
    }

}