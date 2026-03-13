<?php

namespace frontend\modules\fs\helpers;

use Yii;

/**
 * Bridges Yii2 DB config to a mysqli connection for the FS module.
 */
class FsDbBridge
{
    private static $connection = null;

    /**
     * Get a mysqli connection using Yii2's DB config.
     * @return \mysqli|false
     */
    public static function getConnection()
    {
        if (self::$connection && self::$connection->ping()) {
            return self::$connection;
        }

        $db = Yii::$app->db;
        $dsn = $db->dsn;

        // Parse DSN: mysql:host=localhost;dbname=hrvc_alpha
        preg_match('/host=([^;]+)/', $dsn, $hostMatch);
        preg_match('/dbname=([^;]+)/', $dsn, $dbMatch);

        $host = $hostMatch[1] ?? 'localhost';
        $dbname = $dbMatch[1] ?? 'hrvc_alpha';
        $user = $db->username;
        $pass = $db->password;

        self::$connection = @mysqli_connect($host, $user, $pass, $dbname);
        if (self::$connection) {
            mysqli_set_charset(self::$connection, "utf8");
        }

        return self::$connection;
    }
}
