<?php

namespace App;


class Session
{
    const KEY_APP_FLASH = 'app_flash';
    const KEY_VALIDATION_FLASH = 'app_validation';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        $this->startSession();
    }

    /**
     * Start session if does not start, but leave it when it was started.
     */
    public function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            ini_set('session.gc_maxlifetime', 3600 * 24);

            session_set_cookie_params(3600 * 24);

            session_start();
        }
    }

    /**
     * Put single key value pair to session.
     *
     * @param $key
     * @param $value
     */
    public function putData($key, $value)
    {
        $_SESSION["app_{$key}"] = $value;
    }

    /**
     * Get data from session, provide default value if it does not exist.
     *
     * @param $key
     * @param string $default
     * @return string
     */
    public function getData($key, $default = '')
    {
        $data = $default;
        if (isset($_SESSION["app_{$key}"])) {
            $data = $_SESSION["app_{$key}"];
        }
        return $data;
    }

    /**
     * Remove data from session by key.
     *
     * @param $key
     */
    public function removeData($key)
    {
        if (isset($_SESSION["app_{$key}"])) {
            unset($_SESSION["app_{$key}"]);
        }
    }

    /**
     * Set one-called session, put in separate key of session (ep_flash),
     * remove if it called latter via getFlashData(), useful for displaying action message.
     *
     * @param $key
     * @param $value
     * @param string $flashKey
     */
    public function setFlashData($key, $value, $flashKey = 'app_flash')
    {
        $_SESSION[$flashKey][$key] = $value;
    }

    /**
     * Check is flash key exist.
     *
     * @param $key
     * @param string $flashKey
     * @return bool
     */
    public function isFlashExist($key, $flashKey = 'app_flash')
    {
        return isset($_SESSION[$flashKey][$key]);
    }

    /**
     * Get flash data, and remove it as well, provide default value it does not exist.
     *
     * @param $key
     * @param string $default
     * @param string $flashKey
     * @return string|array
     */
    public function getFlashData($key, $default = '', $flashKey = 'app_flash')
    {
        $flashData = $default;
        if (isset($_SESSION[$flashKey][$key])) {
            $flashData = $_SESSION[$flashKey][$key];
            unset($_SESSION[$flashKey][$key]);
        }

        return $flashData;
    }

    /**
     * Shorthand of clearing flash data.
     *
     * @param string $flashKey
     */
    public function clearFlashData($flashKey = 'app_flash')
    {
        $_SESSION[$flashKey] = [];
    }

    /**
     * Populate data in session, put in separate key (app_old),
     * similar to flash data, remove immediately after fetched.
     *
     * @param $data
     * @param $value
     */
    public function setOldData($data, $value = '')
    {
        if (is_array($data)) {
            $_SESSION['app_old'] = $data;
        } else {
            $_SESSION['app_old'][$data] = $value;
        }
    }

    /**
     * Get old data by key and provide default value if it does not exist,
     * remove after the data fetched, useful for populate form.
     *
     * @param $key
     * @param string $default
     * @return string
     */
    public function getOldData($key, $default = '')
    {
        $oldData = $default;
        if (isset($_SESSION['app_old'][$key])) {
            $oldData = $_SESSION['app_old'][$key];
            unset($_SESSION['app_old'][$key]);
        }

        return $oldData;
    }

    /**
     * Shorthand of clearing old data.
     */
    public function clearOldData()
    {
        $_SESSION['app_old'] = [];
    }
}