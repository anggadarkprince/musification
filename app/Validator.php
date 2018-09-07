<?php

namespace App;


class Validator
{
    private $errors = [];

    private $messages = [
        'required' => 'The %s is required',
        'minLength' => 'The %s is minimum length %s characters',
        'maxLength' => 'The %s is maximum length %s characters',
        'min' => 'The %s is minimum value %s',
        'max' => 'The %s is maximum value %s',
        'email' => 'The %s is not valid email',
        'url' => 'The %s is not valid url',
        'username' => 'The %s is not valid username',
        'unique' => 'The %s must be unique',
        'confirm' => 'The %s is not match with field %s',
        'regex' => 'The %s is not match with required pattern',
    ];

    /**
     * Validate the rules given and data.
     *
     * @param $rules
     * @param array $data
     * @param bool $redirectBack
     * @param string $fallbackUrl
     * @return bool
     */
    public function validate($rules, $data = [], $redirectBack = true, $fallbackUrl = 'index.php')
    {
        $session = new Session();
        $session->clearFlashData(Session::KEY_VALIDATION_FLASH);
        $session->clearOldData();
        
        if (empty($data)) {
            $data = $_POST;
        }

        foreach ($rules as $field => $rule) {
            $ruleCollections = explode('|', $rule);
            foreach ($ruleCollections as $method) {
                $param = '';

                // maxLength[10] -> 10, confirm[password] -> password
                if (preg_match('/\[.+\]+/', $method, $match)) {
                    $param = preg_replace('(^\[|\]$)', '', $match[0]);
                }

                // maxLength[10] -> maxLength
                $pureMethod = preg_replace('/\[.+\]/', '', $method);

                $paramValue = $param;
                if ($pureMethod == 'confirm') {
                    $paramValue = $data[$param];
                }

                // maxLength[10] -> maxLength(10)
                if (!$this->{$pureMethod}($data[$field], $paramValue)) {
                    $parsedMessage = $this->messages[$pureMethod];
                    $parsedField = ucwords(str_replace(['_', '-'], ' ', $field));
                    $this->errors[$field][] = sprintf($parsedMessage, $parsedField, $param);;
                }
            }
        }

        if (!empty($this->errors)) {
            if ($redirectBack) {
                foreach ($this->errors as $field => $message) {
                    $session->setFlashData($field, $message, Session::KEY_VALIDATION_FLASH);
                }
                $session->setOldData($data);
                header('Location:' . (empty($_SERVER['HTTP_REFERER']) ? $fallbackUrl : $_SERVER['HTTP_REFERER']));
                exit;
            }
            return false;
        }
        return true;
    }

    /**
     * Rule check if value is not empty.
     *
     * @param $value
     * @return bool
     */
    public function required($value)
    {
        return !empty($value);
    }

    /**
     * Check minimum length of string.
     *
     * @param $value
     * @param $min
     * @return bool
     */
    public function minLength($value, $min)
    {
        return strlen($value) >= $min;
    }

    /**
     * Check maximum length of string.
     *
     * @param $value
     * @param $max
     * @return bool
     */
    public function maxLength($value, $max)
    {
        return strlen($value) <= $max;
    }

    /**
     * Check min value of numeric value.
     *
     * @param $value
     * @param $min
     * @return bool
     */
    public function min($value, $min)
    {
        return $value >= $min;
    }

    /**
     * Check max value of numeric value.
     *
     * @param $value
     * @param $max
     * @return bool
     */
    public function max($value, $max)
    {
        return $value <= $max;
    }

    /**
     * Check if match with email pattern.
     *
     * @param $value
     * @return mixed
     */
    public function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Check the value is url.
     *
     * @param $value
     * @return mixed
     */
    public function url($value)
    {
        return filter_var($value, FILTER_VALIDATE_URL);
    }

    /**
     * Check common username pattern.
     *
     * @param $value
     * @return false|int
     */
    public function username($value)
    {
        return $this->regex($value, '/^[a-zA-Z0-9-_.]+$/');
    }

    /**
     * Check if the value is unique.
     *
     * @param $value
     * @param $tableField
     * @return bool
     */
    public function unique($value, $tableField)
    {
        $params = explode('.', $tableField);
        $table = $params[0];
        $field = $params[1];

        $db = new Database();
        $statement = $db->getConnection()->prepare("SELECT id FROM {$table} WHERE {$field} = ?");
        $statement->bind_param('s', $value);
        $statement->execute();
        $result = $statement->get_result();
        $statement->close();
        if (mysqli_num_rows($result) > 0) {
            return false;
        }
        return true;
    }

    /**
     * Check common username pattern.
     *
     * @param $value
     * @param $confirmation
     * @return false|int
     */
    public function confirm($value, $confirmation)
    {
        return $value === $confirmation;
    }

    /**
     * Check value is matched with pattern.
     *
     * @param $value
     * @param $pattern
     * @return false|int
     */
    public function regex($value, $pattern)
    {
        return preg_match($pattern, $value);
    }


    /**
     * Get all validation errors.
     *
     * @return array
     */
    public function getValidationErrors()
    {
        return $this->errors;
    }

    /**
     * Get field first error string.
     *
     * @param $field
     * @return string
     */
    public function getFieldError($field)
    {
        if (key_exists($field, $this->errors)) {
            return $this->errors[$field][0];
        }
        return '';
    }

    /**
     * Get all field error.
     *
     * @param $field
     * @return array|mixed
     */
    public function getFieldErrors($field)
    {
        if (key_exists($field, $this->errors)) {
            return $this->errors[$field];
        }
        return [];
    }

    /**
     * Find out if specific field is contain validation error.
     *
     * @param $field
     * @return bool
     */
    public function isFieldError($field)
    {
        if (key_exists($field, $this->errors)) {
            return !empty($this->errors[$field]);
        }
        return false;
    }

    /**
     * Check if validation is valid.
     *
     * @return bool
     */
    public function isValid()
    {
        return empty($this->errors);
    }
}