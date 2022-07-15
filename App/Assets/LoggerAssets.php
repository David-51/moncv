<?php

namespace App\Assets;

class Logger
{
    /**
     * @param string $message write the message you want to log
     * @return void
     */
    public static function setMessage(string $message) :void{
        $date = date('d-m-Y h:i:s');        
        error_log($date.' - '. $_SERVER['REMOTE_ADDR'] . ' '.$message.PHP_EOL, 3, './log/'.self::createLogName());
    }

    private static function createLogName() :string{
        $date = date('Ymd');
        return $date.'-logger.log';
    }
}