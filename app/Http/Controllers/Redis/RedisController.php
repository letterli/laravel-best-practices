<?php

namespace App\Http\Controllers\Redis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function store(Request $request)
    {
        $validations = [
            'username' => 'required|string:123',
            'email' => 'required|email'
        ];
        $this->validate($request, $validations);
        $data = $request->only(array_keys($validations));

        // 通过调用Redis门面方法与Redis进行交互
        // 存储key value
        Redis::set('data_json', json_encode($data), 'EX', 600);
        Redis::set('data_serialize', serialize($data), 'EX', 600);
        Redis::set('keys', 'value');

        // 使用其他redis服务器
        Redis::connection('others')->hset('other', 'username', 'admin');

        // 获取value
        $data = json_decode(Redis::get('data_json'));          // stdClass object
        $data = unserialize(Redis::get('data_serialize'));     // array

        // 管道命令
        // 将所有 Redis 命令发送到这个 Redis 实例，然后这些命令会在一次操作中被执行
        Redis::pipeline(function ($pipe) {
            for ($i=0; $i < 1000; $i++) {
                $pipe->set("key:$i", $i, 'EX', 60);
            }
        });

        return response()->json(Redis::connection('others')->hget('othera', 'username'));
    }

    public function publish()
    {
        Redis::publish('channel_one', json_encode(['username' => 'admin', 'email' => 'example@infzm.com']));
    }

}
