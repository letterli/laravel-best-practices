## Redis 键值对存储系统
---

### 简介
Redis是一个开源的、高级的键值对存储系统，经常用作数据结构服务器。
支持字符串、Hash、列表、集合和有序集合等数据结构。

Laravel 中使用Redis:
1. composer require predis/predis
2. PECL 安装PHP扩展PhpRedis,扩展对重度使用Redis应用性能更好。

### 配置

```php
    // config/database.php
    'redis' => [
        'client' => 'predis',  // 使用 predis/predis
        'client' => 'phpredis' // PhpRedis 扩展

        // 默认Redis服务器配置
        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

        // 其他Redis服务器配置
        'other' => [
            'host' => env('OTHER_REDIS_HOST', '127.0.0.1'),
            'password' => env('OTHER_REDIS_PASSWORD', null),
            'port' => env('OTHER_REDIS_PORT', 6379),
            'database' => 1,       // 不同数据存储index
        ],

        // 配置集群
        'clusters' => [
            'default' => [
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'password' => env('REDIS_PASSWORD', null),
                'port' => env('REDIS_PORT', 6379),
                'database' => 0,
            ],
        ],
    ],
```

### Redis交互
通过使用Redis门面与Redis服务器进行交互。

```php
    // 存储
    Redis::set('key', 'value');
    Redis::set('key', 'value', 'EX', 60);   // 设置过期时间
    // 获取value
    Redis::get('key');
    // command方法传递命令到服务器
    // 第一个参数接受命令，第二个参数为参数值数组
    Redis::command('lrange', ['name', 5, 10]);
```

### 使用多个Redis连接

```php
    $redis = Redis::connection();  // 获取默认Redis服务器实例
    $redis = Redis::connection('other');  // 获取其他Redis服务器实例
```

### 管道命令

```php
    Redis::pipeline(function ($pipe) {
        for ($i=0; $i < 1000; $i++) {
            $pipe->set("key:$i", $i);
        }
    });
```

### 发布/订阅

Redis调用publish和subscribe命令接口，在给定“频道”发布、监听消息。

subscribe方法通过Redis在一个频道上设置监听器。
```php
    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\Redis;

    class RedisSubscribe extends Command
    {
        /**
         * 控制台命令名称
         *
         * @var string
         */
         protected $signature = 'redis:subscribe';

         /**
          * 控制台命令描述
          *
          * @var string
          */
         protected $description = 'Subscribe to a Redis channel';

         /**
          * 执行控制台命令
          *
          * @return mixed
          */
         public function handle()
         {
            Redis::subscribe(['channel_one'], function ($message) {
                echo $message;
            });
         }
```

使用publish发布消息到该频道:

```php
    Route::get('publish', function () {
        Redis::publish('channel_one', json_encode(['key' => 'value']));
    });
```

### 通配符订阅

使用psubscribe方法，订阅一个通配符定义的频道。

```php
    Redis::psubscribe(['*'], function ($message, $channel) {
        echo $message;
    });

    Redis::psubscribe(['users.*'], function ($message, $channel) {
        echo $message;
    });
```
