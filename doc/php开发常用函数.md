### PHP开发常用函数
---
#### http_build_query()
自动拼接生成URL参数字符串。

```php
    $data = [
        'user_id' => 123,
        'order' => 'desc'
        'pages' => 10,
        'limit' => 20
    ];

    http_build_query($data)   // output: user_id=123&order=desc&pages=10&limit=20

```

#### array_push(array $arr, $value1, $value2)
数组尾部添加一个或多个元素。

```php
    $arr = [];
    array_push($arr, 'value1', 'value2');
```

#### array_merge(array $arr1, array $arr2)
把一个或多个数组合并为一个数组。

```php
    $arr1 = ['red', 'green'];
    $arr2 = ['blue', 'yellow'];

    array_merge($arr1, $arr2);
```

#### mb_strlen() and strlen()
求字符串长度函数。

```php
    $str = '中文字符串1';

    strlen($str);       // output: 16
    mb_strlen($str);    // output: 6
```

#### mb_substr() and substr()
截取字符串函数。mb_substr(string $str, int $start, int $length, string $encoding)

```php
    $str = 'this is 中文字符串';
    mb_substr($str, 0, 6, 'UTF-8');
```

#### 类型转换 intval() floatval() strval()

``` php
    $str = '456.7PHP';

    $int = intval($str);       // output: 456
    $float = floatval($str);   // output: 456.7
    $string = strval($str);    // output: 456.7PHP
```

#### strip_tags()
从字符串中去除HTML和PHP标记。

```php
    $text = '<p>string</p><!-- Comment --> <a href="">Link</a> Hello <p>other</p>';
    strip_tags($text);
```

#### list()
用于一次操作中给一组变量赋值。

```php
    $array = ['Dog', 'Cat', 'Horse'];
    list($dog, $cat, $hourse) = $array;
```

#### is_callable()
检测参数是否为合法可调用结构。


#### array_unique()
移除数组中重复的值。

```php
    $array = [
        'a' => 'red',
        'b' => 'blue',
        'c' => 'red'
    ];

    array_unique($array);   // output: ['a' => 'red', 'b' => 'green']
```

#### join($array, $separator) implode($separator, $array)
返回由数组元素组合成的字符串。

```php
    $array = ['Hello', 'World', '!'];
    join($array, ' ');       // output: Hello World !

    implode(' ', $array);
```

#### explode()
分割字符串，返回数组。

```php
    $str = "Hello World !";
    explode(' ', $str);    // output: ['Hello', 'World', '!'];
```

#### array_filter()
使用回调函数过滤数组中的值。

```php
    function odd($var)
    {
        return $var & 1;
    }

    function even($var)
    {
        return !($var & 1);
    }

    $array = ['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4];
    $array2 = [5, 6, 7, 8, 9];
    array_filter($array, 'filter');      // output:  ['a' => 1, 'c' => 3]
    array_filter($array2, 'filter');      // output:  ['1' => 6, '3' => 8]

    $entry = ['foo', false, -1, null, ''];
    array_filter($entry);         // output: [ '0' => 'foo', '2' => -1]

```
