# Larva Admin

基于 `owl-admin` 定制的后台框架。

## 特点: 快速且灵活
- 基于 amis 以 json 的方式构建页面，减少前端开发工作量，提升开发效率。
- 在 amis 100多个组件都不满足的情况下, 可自行开发前端。
- 框架为前后端分离 (不用再因为框架而束手束脚~)。

## 文档

- [《Laravel 10 中文文档》](https://learnku.com/docs/laravel/10.x)
- [《amis》](https://aisuda.bce.baidu.com/amis/zh-CN/docs/index)

## 功能

- 基础后台功能
    - 后台用户管理
    - 角色管理
    - 权限管理
    - 菜单管理
- **代码生成器**
    - 创建数据迁移文件
    - 创建数据表
    - 创建模型
    - 创建基础控制器代码
    - 创建Service
- `Amis` 全组件封装
- 扩展管理

## 环境

- PHP >= 8.0
- Laravel 9/10

## 一分钟跑起来

1. 安装 `Laravel`

```php
composer create-project laravel/laravel example-app
```

2. 配置 `.env`

```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larva_admin
DB_USERNAME=root
DB_PASSWORD=
```

3. 获取 `Larva Admin`

```php
composer require larva/larva-admin
```

4. 发布资源

```php
php artisan admin:publish
```

5. 安装

```php
php artisan admin:install
```

6. 运行项目

> 在你的环境把代码跑起来 <br>
> 或者在 `laravel` 目录执行 `php artisan serve` <br>
> 在浏览器打开 `http://localhost/admin` 即可访问 <br>
> 初始账号密码都是 `admin`
