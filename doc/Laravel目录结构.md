### Laravel 开发规范
---

#### 根目录
---
> * app目录包含应用的核心代码
> * bootstrap目录用于框架启动和自动载入配置，cache包含路由和服务缓存文件
> * config目录应用所有配置文件
> * database目录包含数据库迁移文件及填充文件
> * public目录包含应用入口文件index.php和前端资源文件
> * resources目录包含应用视图文件和未编译的原生前端资源文件
> * routes目录包含应用定义的所有路由
    web.php 支持Seesion、CSRF保护以及Cookie加密功能
    api.php 提供无状态的RESTful API,需要通过token进行认证
    console.php 所有基于闭包的控制台命令
    channels.php 注册应用支持的所有事件广播频道
> * storage目录包含编译后的Blade模板、基于文件的Session、文件缓存
    public目录用于存放应用生成的文件
    framework目录用于存放框架生成的文件和缓存
    logs目录存放应用的日志文件
> * tests目录包含自动化测试文件
> * vendor目录包含应用所有通过Composer加载的依赖

---
#### App目录结构
> * Console目录包含应用所有自定义的Artisan命令
> * Events目录用于存放事件类
> * Exceptions目录包含应用的异常处理器，处理应用抛出的任何异常
> * Http目录包含控制器、中间件以及表单请求
> * Jobs目录用于存放队列任务
> * Listeners目录包含事件监听器，接收一个事件并提供对该事件发生后的响应逻辑
> * Mail目录包含应用所有邮件相关类
> * Models目录用于存放与数据库交互的模型
> * Notifications目录包含应用发送的所有通知
> * Policies目录包含应用所有的授权策略类，用于判断某个用户是否有权限去访问指定资源
> * Proviedes目录包含应用的所有服务提供者
> * Rules目录包含应用的自定义验证规则对象
> * Services目录用于存放业务逻辑相关
> * Traits目录用于存放通用方法类


