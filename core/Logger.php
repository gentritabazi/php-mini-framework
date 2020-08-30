<?php

namespace Core;

class Logger
{
    const EMERGENCY = 'emergency';
    const ALERT = 'alert';
    const CRITICAL = 'critical';
    const ERROR = 'error';
    const WARNING = 'warning';
    const NOTICE = 'notice';
    const INFO = 'info';
    const DEBUG = 'debug';

    private static $instance;
    
    private static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    private function writeToFile($message)
    {
        file_put_contents(BASE_DIR. '/logs/log-'. date('Y-m-d'). '.txt', "$message\n", FILE_APPEND);
    }

    public static function log($message, $level = Logger::INFO)
    {
        $date = date('Y-m-d H:i:s');
        $severity = "[$level]";
        if (is_array($message)) {
            $message = json_encode($message);
        }
        if (is_object($message)) {
            $message = serialize($message);
        }
        $fullMessage = "$date $severity : $message";
        self::getInstance()->writeToFile($fullMessage);
    }
}
