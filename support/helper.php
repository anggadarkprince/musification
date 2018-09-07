<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Redirect to specific url.
 *
 * @param $path
 * @param bool $withInput
 * @param string $fallbackUrl
 */
function redirect($path, $withInput = true, $fallbackUrl = '../index.php')
{
    if (empty($path) || $path == '_back') {
        if (!empty($_POST) && $withInput) {
            $session = new App\Session();
            $session->setOldData($_POST);
        }
        $backUrl = empty($_SERVER['HTTP_REFERER']) ? $fallbackUrl : $_SERVER['HTTP_REFERER'];
        header('Location:' . $backUrl);
    } else {
        header('Location:' . $path);
    }
    exit;
}

/**
 * Simple flash message.
 *
 * @param $type
 * @param $message
 */
function flash($type, $message)
{
    $session = new App\Session();
    $session->setFlashData('type', $type);
    $session->setFlashData('message', $message);
}

/**
 * Get field validation error flash message.
 *
 * @param $field
 * @param string $prefix
 * @param string $suffix
 * @param bool $firstErrorOnly
 * @return string
 */
function validation_error($field, $prefix = '<p class="input-text-error">', $suffix = '</p>', $firstErrorOnly = true)
{
    $session = new App\Session();
    $errors = $session->getFlashData($field, '', App\Session::KEY_VALIDATION_FLASH);

    $messages = '';
    if (is_array($errors)) {
        foreach ($errors as $error) {
            $messages .= ($prefix . $error . $suffix);

            if ($firstErrorOnly) {
                break;
            }
        }
    } elseif (!empty($errors)) {
        $messages = ($prefix . $errors . $suffix);
    }

    return $messages;
}

/**
 * Get old data via helper.
 *
 * @param $field
 * @param string $default
 * @return string
 */
function get_old($field, $default = '')
{
    $session = new App\Session();

    return $session->getOldData($field, $default);
}

/**
 * Get data from array.
 *
 * @param $array
 * @param $key
 * @param string $default
 * @return string
 */
function get_array_value($array, $key, $default = '')
{
    if (key_exists($key, $array)) {
        if (!empty($array[$key])) {
            return $array[$key];
        }
    }
    return $default;
}

/**
 * Get POST input.
 *
 * @param $field
 * @param string $default
 * @return string
 */
function get_input($field, $default = '')
{
    return get_array_value($_POST, $field, $default);
}

/**
 * Get GET params.
 *
 * @param $field
 * @param string $default
 * @return string
 */
function get_param($field, $default = '')
{
    return get_array_value($_GET, $field, $default);
}