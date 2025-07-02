<?php

namespace App\Utils;

class Logger
{
    public static function info(string $message): void
    {
        echo "[INFO] " . $message . PHP_EOL;
    }
}


?>