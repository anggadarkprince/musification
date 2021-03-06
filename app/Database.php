<?php

namespace App;

use \mysqli;

/**
 * Class Database
 * @package App
 */
class Database
{
    public static $db;

    /**
     * @return mysqli
     */
    public static function getConnection()
    {
        if (is_null(self::$db)) {
            self::$db = new mysqli(config('db.host'), config('db.user'), config('db.password'), config('db.database'));
            if (self::$db->connect_errno) {
                die('Could not connect: ' . self::$db->connect_error);
            }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        }
        return self::$db;
    }

}