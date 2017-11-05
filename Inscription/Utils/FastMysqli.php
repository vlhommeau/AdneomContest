<?php

namespace Utils;

use mysqli;

class FastMysqli
{
    /**
     * @param string $string
     * @return mixed
     */
    public static function fastQuery($string = "")
    {
        $mysqli = new mysqli("localhost", "root", "", "adneom", 3388);
        $result = $mysqli->query($string);
        $mysqli->close();

        return $result;
    }

    public static function escape($string = "")
    {
        $mysqli = new mysqli("localhost", "root", "", "adneom", 3388);
        $result = $mysqli->real_escape_string($string);
        $mysqli->close();

        return $result;
    }
}