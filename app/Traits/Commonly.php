<?php

Trait Commonly
{
    /*
     * 随机生成国内ip地址 (64bit系统)
     * http://freeapi.ipip.net/ip  (免费查询ip接口)
     *
     */
    public function ip()
    {
        $ipPool = [
            [607649792, 608174079],    // 36.56.0.0-36.63.255.255
            [1038614528, 1039007743],  // 61.232.0.0-61.237.255.255
            [1783627776, 1784676351],  // 106.80.0.0-106.95.255.255
            [2035023872, 2035154943],  // 121.76.0.0-121.77.255.255
            [2078801920, 2079064063],  // 123.232.0.0-123.235.255.255
            [2344878080, 2346188799],  // 139.196.0.0-139.215.255.255
            [2869428224, 2869952511],  // 171.8.0.0-171.15.255.255
            [3058696192, 3059548159],  // 182.80.0.0-182.92.255.255
            [3524853760, 3526361087],  // 210.25.0.0-210.47.255.255
            [3725590528, 3730833407]   // 222.16.0.0-222.95.255.255
        ];

        $randKey = mt_rand(0, 9);
        $ip = long2ip(mt_rand($randKey[0], $randKey[1]));

        return $ip;
    }

}
