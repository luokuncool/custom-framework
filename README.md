### 介绍
此项目是通过整合一些开源组件来构成一个web框架。主要是帮助学习使用各个扩展包。只是做抛砖引玉的作用，感兴趣的朋友可以根据自己的喜好，加入自己喜欢用的扩展包来实现想要的功能。

### 快速开始

* 环境要求
  * PHP >= 5.6
  * Apache或者Nginx

* 代码准备

```bash
git clone https://github.com/luokuncool/custom-framework.git
cd custom-framework
composer install -vvv
php bin/doctrine-migrations migrations:migrate
```

* 配置站点

把此项目的 `web` 目录配置为网站根目录。


### 主要构成

* 使用 [php-di/php-di](http://php-di.org) 作为依赖注入容器
* 使用 [monolog/monolog](https://github.com/Seldaek/monolog) 记录日志
* 使用 [hassankhan/config](https://github.com/hassankhan/config) 加载配置文件
* 使用 [doctrine/dbal](https://github.com/doctrine/dbal) 访问数据库
* 模板引擎选用 [twig/twig](https://github.com/twigphp/Twig)
* 路由组件选用 [symfony/routing](https://symfony.com/doc/current/routing.html)
* 使用 [symfony/http-foundation](https://github.com/symfony/http-foundation) 来处理基本的http请求响应等操作
* 用 [symfony/debug](https://symfony.com/doc/4.1/components/debug.html) 帮助调试
