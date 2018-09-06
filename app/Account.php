<?php

namespace App;


class Account extends Database
{
    /**
     * Get authenticated user.
     *
     * @param $key
     * @param string $default
     * @return string
     */
    public static function getLoginData($key, $default = '')
    {
        $session = new Session();
        $userId = $session->getData('auth.id');

        $query = "SELECT * FROM users WHERE id = ?";
        $statement = self::getConnection()->prepare($query);
        $statement->bind_param('i', $userId);
        $statement->execute();
        $result = $statement->get_result();
        if (mysqli_num_rows($result) > 0) {
            $user = $result->fetch_assoc();
            if (key_exists($key, $user)) {
                if (!empty($user[$key])) {
                    return $user[$key];
                }
            }
        }
        return $default;
    }

    /**
     * Check user credentials.
     *
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username, $password)
    {
        $isLoggedIn = false;
        $query = "SELECT * FROM users WHERE username = ?";
        $statement = $this->getConnection()->prepare($query);
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result();

        if (mysqli_num_rows($result) > 0) {
            $user = $result->fetch_assoc();
            $hashedPassword = $user['password'];
            if (password_verify($password, $hashedPassword)) {
                $session = new Session();
                $session->putData('auth.id', $user['id']);
                $session->putData('auth.is_logged_in', true);
                $isLoggedIn = true;
            }
        }
        $statement->close();

        return $isLoggedIn;
    }

    /**
     * Remove authentication data.
     */
    public function logout()
    {
        $session = new Session();
        $session->removeData('auth.id');
        $session->removeData('auth.is_logged_in');
    }

    /**
     * Registering our user data.
     *
     * @param $firstName
     * @param $lastName
     * @param $username
     * @param $email
     * @param $password
     * @param string $avatar
     * @return bool
     */
    public function register($firstName, $lastName, $username, $email, $password, $avatar = '')
    {
        $query = "INSERT INTO users (first_name, last_name, username, email, password, avatar) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $this->getConnection()->prepare($query);
        $statement->bind_param('ssssss', $firstName, $lastName, $username, $email, $password, $avatar);
        $result = $statement->execute();
        $statement->close();

        return $result;
    }

}