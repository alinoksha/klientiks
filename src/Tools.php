<?php

namespace Alina\Klientiks;

class Tools
{
    private static $logPath = __FILE__ . '.log';

    public static function generateBirthDate(): string
    {
        return date('d.m.Y', rand(0, 978220800));
    }

    public static function generatePhone(): string
    {
        return rand(70000000000, 79999999999);
    }

    public static function generateName(): string
    {
        return Config::NAMES[rand(0, 99)];
    }

    public static function log(string $message)
    {
        $message = date('Y.m.d H:i:s') . ' ? ' . $message . PHP_EOL;
        file_put_contents(self::$logPath, $message, FILE_APPEND);
    }

    public static function logSetup(string $path)
    {
        self::$logPath = $path;
    }
}
