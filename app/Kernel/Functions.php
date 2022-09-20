<?php

declare(strict_types=1);

/**
 * Created by.
 * User: DIFF
 * DATE: 2022/7/12
 * TIME: 11:12
 */

use App\Service\LogService;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

if (!function_exists('di')){
    /**
     * @param string|null $id
     * @return mixed|ContainerInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function di(?string $id = null)
    {
        $container = ApplicationContext::getContainer();
        if ($id) {
            return $container->get($id);
        }

        return $container;
    }
}

if (!function_exists('log')){
    /**
     * @param $msg
     * @param $data
     * @return void
     */
    function log($msg,$data){
        LogService::info($msg,$data);
    }
}

if (!function_exists('logCustom')){
    /**
     * 记录可自定义文件名称日志
     * @param $content
     * @param $fileName
     * @param string $dir
     * @return false|int
     */
    function logCustom($content, $fileName = null, string $dir = 'custom'){
        $logPath = BASE_PATH . '/runtime/logs/';
        if($dir) $logPath .= $dir.'/';
        if (!is_dir($logPath)) {
            mkdir($logPath, 0775);
        }
        empty($fileName) ? $fileName = date('Y-m-d') : $fileName .= '-'.date('Y-m-d');
        $fileName = $logPath. $fileName .'.txt';
        if(is_array($content)) $content = json_encode($content);
        return @file_put_contents($fileName, $content . "\n", FILE_APPEND);
    }
}