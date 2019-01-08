<?php
/**
 * Created by PhpStorm.
 * User: tioncico
 * Date: 2018/7/19
 * Time: 17:53
 */
return [
    'resultset_type' => '\think\Collection',
    // 数据库类型
    'type' => 'mysql',
    // 服务器地址
    'hostname' => '127.0.0.1', //百度统计阿里云外网链接
    // 数据库名
    'database' => 'think_wechat2', //统计数据库名
    // 用户名
    'username' => 'root', //统计数据库名
    // 密码
    'password' => 'myroot123',
    // 端口
    'hostport' => '3306',
    // 数据库表前缀
    'prefix' => 'think_',
    // 是否需要断线重连
    'break_reconnect' => true,
];