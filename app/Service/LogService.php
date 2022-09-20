<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/27
 * TIME: 11:59
 */

namespace App\Service;

use App\Utils\Log\Log;
use Psr\Log\LogLevel;

class LogService
{
    //普通日志记录
    public static function info($message,$context){
        Log::get()->log(LogLevel::INFO,$message,$context);
    }

    //异常日志记录
    public static function exception($message,$context){
        Log::get('default','exception')->log(LogLevel::ERROR,$message,$context);
    }
}