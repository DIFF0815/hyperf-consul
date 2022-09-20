# hyperf-consul
hyperf-consul 服务注册示例

## 说明
 * 先看hyperf文档，对hyperf有一定的了解 [hyperf传送门](https://hyperf.wiki/2.2/#/zh-cn/consul?id=%e5%ae%89%e8%a3%85)
 * 安装组件
 ```shell
    #
    conposer install
    composer require hyperf/consul hyperf/json-rpc hyperf/rpc hyperf/rpc-client hyperf/rpc-server hyperf/service-governance hyperf/service-governance-consul
``` 
 * 服务注册和服务消费的代码可以放一给项目也可以单独项目
 * consul集群环境 [docker-consul](https://github.com/DIFF0815/docker-consul)

## 服务注册
### 服务注册配置相关文件
```php
# server.php
      [
            'name' => 'jsonrpc-http',
            'type' => Server::SERVER_HTTP,
            'host' => '0.0.0.0',
            'port' => 9605,
            'sock_type' => SWOOLE_SOCK_TCP,
            'callbacks' => [
                Event::ON_REQUEST => [Hyperf\JsonRpc\HttpServer::class, 'onRequest'],
            ],
        ],
```
```php
# consul.php  consul集群服务的地址
return [
    'uri' => 'http://192.168.240.120:8500',
    'token' => '',
];
```
```php
# services.php 里面
    'drivers' => [
        'consul' => [
            'uri' => 'http://192.168.240.120:8500',
            'token' => '',
            'check' => [
                'deregister_critical_service_after' => '90m',
                'interval' => '1s',
            ],
        ],
    ],
```
### 服务注册代码文件
```php
#FooService.php里面注解里面@RpcService把服务注册到服务集群中
FooService.php FooServiceInterface.php
```

## 服务消费
### 服务消费配置相关文件
```php
# services.php
    'consumers' => value(function (){
        $consumers = [];
        $services = [
            //多个服务
            'FooService' => App\JsonRpc\Consumer\FooServiceConsumerInterface::class,
        ];
        foreach ($services as $name => $interface) {
            $consumers[] = [
                'name' => $name,
                'service' => $interface,
                'id' => $interface,
                'protocol' => 'jsonrpc-http',
                'load_balancer' => 'random',
                'registry' => [
                    'protocol' => 'consul',
                    'address' => 'http://192.168.240.120:8500',
                ],
                //If `registry` is missing, then you should provide the nodes configs.
                'nodes' => [
                    ['host' => '192.168.240.120', 'port' => 9605],
                ],
            ];
        }

        return $consumers;
    }),
```
### 服务消费代码文件
```php
# 
FooServiceConsumerInterface.php
```
## 服务消费调用测试
TestConsulController.php
```php
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
```
测试：http://域名地址/test/test_consul/test_consul