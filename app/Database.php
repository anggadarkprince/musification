<?php

namespace App;

/**
 * Class Database
 * @package App
 */
class Database
{
    public static $db;

    /**
     * @return \mysqli
     */
    public static function getConnection(){
        if(is_null(self::$db)) {
            self::$db = mysqli_connect('localhost', 'root', '', 'musification');
            if(mysqli_connect_errno()) {
                die('Could not connect: ' . mysqli_error(self::$db));
            }
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        }
        return self::$db;
    }

}