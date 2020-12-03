## 项目来源

公司项目一直用的 [Laravel-Admin](https://laravel-admin.org/ "Laravel-Admin") 作为后台，可是在某些特殊需求下，扩展十分麻烦，于是自己就决定做个简易的后台模板出来，供以后使用。

后台的前端模板是基于 [Antd Pro Vue](https://pro.antdv.com/ "Antd Pro Vue") 开发，配合 [Laravel](https://laravel.com "Laravel") 框架进行接口交互。

## 项目主要技术

- 后端：PHP / Laravel / JWT
- 前端：Vue / Ant Design Vue / Webpack

## 项目功能

- 角色权限控制
- 动态菜单加载
- 列表字段排序
- 列表批量操作
- 风格配色切换
- ......待完善

## 项目预览

[http://demo.dcynsd.cn/admin](http://demo.dcynsd.cn/admin "http://demo.dcynsd.cn/admin")

![](https://www.dcynsd.cn/storage/markdown/images/c49ecbc921a498f555d90f31845d5a055fc89821420c1.jpg)

## 安装

```
git clone https://github.com/dcynsd/larantd.git 
```

```
cd larantd
```

### 后端部分

```
composer install
```

```
cp .env.example .env
```

note: 注意修改 .env 文件里面数据库等配置信息

```
php artisan key:generate
```

```
php artisan jwt:secret
```

```
php artisan storage:link
```

```
php artisan migrate
```

```
php artisan admin:init
```

### 前端部分

```
cd resources/admin
```

```
yarn install
```

```
yarn run watch	// 开发模式下使用
```

```
yarn run build	// 编译上线使用
```

## 开源地址

[larantd](https://github.com/dcynsd/larantd "larantd")
