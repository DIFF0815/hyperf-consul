<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/24
 * TIME: 17:18
 */

namespace App\Controller\Test;

use App\Constants\ErrorCode;
use App\Constants\TestCode;
use App\Controller\AbstractController;
use Hyperf\HttpServer\Annotation\AutoController;

/**
 * @AutoController()
 */
class TestTransController extends AbstractController
{
    //测试国际化翻译
    public function test_trans(){
        $data = [
            'code' => 1,
            'msg' => trans('messages.welcome'),//用的  storage/languages/语言目录/messages.php 的枚举
        ];

        return $this->response->json($data);


    }

    //测试国际化翻译和枚举错误结合
    public function test_trans2(){

        $data = [
            'code' => 1,
            //用的  storage/languages/语言目录/messages.php 的枚举  结合 app/Constants/TestCode枚举
            'msg' => TestCode::getMessage(TestCode::TEST_PARAMS_INVALID_ERROR,['param' => 'user_id']),
        ];

        return $this->response->json($data);
    }

}