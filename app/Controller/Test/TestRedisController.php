<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/20
 * TIME: 18:34
 */

namespace App\Controller\Test;

use App\Controller\AbstractController;
use App\Service\TestTableService;
use App\Utils\Redis\RedisPersist;
use Hyperf\HttpServer\Annotation\AutoController;
use Psr\SimpleCache\CacheInterface;

/**
 * @AutoController()
 */
class TestRedisController extends AbstractController
{

    /**
     * 做redis缓存
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function test_redis_cache(){

        $funcName = 'test_redis_cache';
        $cache = $this->container->get(CacheInterface::class);

        $data = [
            'code' => 1,
            'funcName' => $funcName,
            'path' => $this->request->getPathInfo(),
        ];

        $cache->set($funcName,$data);

        return $this->response->json($data);

    }

    /**
     * 测试普通缓存-缓存mysql table数据
     */
    public function test_redis_cache_mysqlTable(){
        $funcName = 'test_redis_cache_mysqlTable';
        //缓存
        $ret = make(TestTableService::class)->testTable();
        $data = [
            'code' => 1,
            'funcName' => $funcName,
            'path' => $this->request->getPathInfo(),
            'cache_mysqlTable_ret' => $ret,
        ];
        return $this->response->json($data);
    }

    /**
     * 测试redis做持久化数据库
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function test_redis_persist(){

        $funcName = 'test_redis_persist';

        $redisPersist = $this->container->get(RedisPersist::class);

        $data = [
            'code' => 1,
            'funcName' => $funcName,
            'path' => $this->request->getPathInfo(),
        ];
        $redisPersist->set($funcName,$data);

        return $this->response->json($data);

    }


    /**
     * 测试session
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function test_redis_session(){

        $funcName = 'test_redis_session';

        $data = [
            'code' => 1,
            'funcName' => $funcName,
            'path' => $this->request->getPathInfo(),
        ];
        $this->session->set($funcName,$data);

        $all = $this->session->all();

        return $this->response->json($all);
    }
    public function test_redis_session2(){

        $funcName = 'test_redis_session2';
        $data = [
            'code' => 1,
            'funcName' => $funcName,
            'path' => $this->request->getPathInfo(),
        ];
        $this->session->set($funcName,$data);

        for ($i=0;$i<10;$i++){
            $str = 'str'.$i;
            $this->session->set($str,$i);
        }

        $all = $this->session->all();

        return $this->response->json($all);
    }
    public function test_redis_session3(){

        $funcName = 'test_redis_session2';

        $all = $this->session->get($funcName);

        return $this->response->json($all);
    }

}