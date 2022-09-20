<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/29
 * TIME: 20:51
 */

namespace App\Exception\Handler;

use App\Exception\BusinessException;
use App\Service\LogService;
use App\Utils\Log\Log;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LogLevel;
use Throwable;

class BusinessExceptionHandler extends ExceptionHandler
{
    /**
     * @var Log
     */
    protected $logger;

    public function __construct(Log $log)
    {
        $this->logger = $log::get('default','exception');
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {

        $dataArr = [
            'code'    => $throwable->getCode(),
            'message' => $throwable->getMessage(),
        ];

        // 格式化输出
        $data = json_encode($dataArr, JSON_UNESCAPED_UNICODE);

        // 阻止异常冒泡
        $this->stopPropagation();

        $this->logger->log(LogLevel::ERROR,'异常',$dataArr);

        return $response->withAddedHeader('content-type', 'application/json; charset=utf-8')->withStatus(500)->withBody(new SwooleStream($data));

    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof BusinessException;
    }
}