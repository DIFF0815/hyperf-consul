<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/21
 * TIME: 20:17
 */

namespace App\Utils\Redis;

use Hyperf\Redis\Redis;

class RedisPersist extends Redis
{

    // 重写对应的 Pool 的 key 值
    protected $poolName = 'redis_persist';

}