<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/22
 * TIME: 9:56
 */

namespace App\Controller\Test;

use App\Amqp\Producer\DemoProducer;
use App\Controller\AbstractController;
use Hyperf\Amqp\Producer;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\Utils\ApplicationContext;

/**
 * @AutoController()
 */
class TestMqController extends AbstractController
{

    //测试发生mq数据
    public function test_mq_send_data(){
        $data = [
            'code' => 1,
            'msg' => '测试mq数据',
            'data' => 1111111111111111112,
        ];

        //第一种方式
        /*$message = new DemoProducer($data);
        $producer = ApplicationContext::getContainer()->get(Producer::class);
        $result = $producer->produce($message);
        $data['result'] = $result;*/

        //第二种方式
        $message = new DemoProducer($data);
        $producer = $this->container->get(Producer::class);
        $result = $producer->produce($message);
        $data['result'] = $result;



        return $this->response->json($data);

    }

}