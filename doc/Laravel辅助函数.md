### Laravel辅助函数

### tap()
tap函数接收两个参数：任意的$value和一个闭包。
$value会被传递到闭包然后通过tap函数返回。闭包返回值和函数返回值不相关。

```php
    // tap 函数代码
    function tap($value, $callback)
    {
        $callback($value);

        return $value;
    }

    // 执行中间操作
    $response = $next($request);
    $this->storePasswordHashInSession($request);
    return $response;

    return tap($next($request), function () use ($request) {
        $this->storePasswordHashInSession($request);
    });

    // Model 操作
    $user = tap(User::first(), function ($user) {
        $user->name = 'taylor';
        $user->save();
    });

    // Collection
    public function monthOptions()
    {
        return collect(range(1, 12))
            ->tap(function () {
                // do something
            })
            ->map(function ($month) {
                return spritf('%02d - %s', $month, Carbon::now()->month($month)->formatLocalized('%B'));
            })
            -tap(function () {
                // do something
            });
    }

```
