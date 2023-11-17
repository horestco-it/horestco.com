<?php


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Log
{
    public function __construct()
    {
        $log = new Logger('LOG');
        $log->pushHandler(new StreamHandler(APPPATH.'logs/metadata.log', Logger::WARNING));
        $this->log = $log;
    }

    public function warning($message)
    {
        $this->log->warning($message);
    }
}