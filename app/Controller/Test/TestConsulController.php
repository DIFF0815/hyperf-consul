<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/27
 * TIME: 11:00
 */

namespace App\Controller\Test;

use App\Controller\AbstractController;
use App\JsonRpc\Consumer\FooServiceConsumerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use App\Service\LogService;

/**
 * @AutoController()
 */
class TestConsulController extends AbstractController
{
    /**
     * @Inject()
     * @var FooServiceConsumerInterface
     */
    protected FooServiceConsumerInterface $fooService;

    //consul
    public function test_consul(){
        $a = 100;
        $b = 27;

        $cu = $this->fooService->sum($a,$b);
        $di = $this->fooService->diff($a,$b);

        $data = [
            'code' => 1,
            'msg' => 'consul成功',
            "consul:{$a}+{$b}" => $cu,
            "consul:{$a}-{$b}" => $di,
        ];
        LogService::info('consul成功',$data);

        return $this->response->json($data);

    }

}