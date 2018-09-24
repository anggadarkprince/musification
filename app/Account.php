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
        $validator = new Validator();
        $field = $validator->email($username) ? 'email' : 'username';

        $isLoggedIn = false;
        $query = "SELECT * FROM users WHERE {$field} = ?";
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
     * @param bool $force
     * @return bool
     */
    public function logout($force = true)
    {
        $session = new Session();
        $session->removeData('auth.id');
        $session->removeData('auth.is_logged_in');
        $session->clearFlashData();
        $session->clearOldData();
        if ($force) {
            return session_destroy();
        }
        return true;
    }

    /**
     * Registering our user data.
     *
     * @param $name
     * @param $username
     * @param $email
     * @param $password
     * @param string $avatar
     * @return bool
     */
    public function register($name, $username, $email, $password, $avatar = '')
    {
        $query = "INSERT INTO users (name, username, email, password, avatar) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->getConnection()->prepare($query);
        $statement->bind_param('sssss', $name, $username, $email, $password, $avatar);
        $result = $statement->execute();
        $statement->close();

        return $result;
    }

    /**
     * Get user by id.
     *
     * @param $id
     * @return array
     */
    public function getUser($id)
    {
        $statement = self::getConnection()->prepare('
          SELECT * FROM users WHERE id = ?
        ');
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Update user by given user id.
     *
     * @param $id
     * @param $name
     * @param $username
     * @param $email
     * @param $password
     * @return bool
     */
    public function updateUser($id, $name, $username, $email, $password)
    {
        $query = "UPDATE users SET name = ?, username = ?, email = ?, password = ? WHERE id = ?";
        $statement = $this->getConnection()->prepare($query);
        $statement->bind_param('ssssi', $name, $username, $email, $password, $id);
        $result = $statement->execute();
        $statement->close();

        return $result;
    }

}