<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [

    //标准输出写入日志
    \Hyperf\Contract\StdoutLoggerInterface::class => \App\Utils\Log\StdoutLoggerFactory::class,

];
