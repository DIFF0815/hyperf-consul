<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/7/4
 * TIME: 17:41
 */

namespace App\Service;

use App\Model\Test;
use Hyperf\Cache\Annotation\Cacheable;

class TestTableService
{
    /**
     * @Cacheable(prefix="test", ttl=300)
     */
    public function testTable(){
        $ret = Test::query()->select()->first();

        if($ret){
            return $ret->toArray();
        }
        return null;
    }
}