<?php
$http = new swoole_http_server('127.0.0.1', 9501);

$http->set([
    'worker_num' => 8,
    'max_request' => 5000,
//    'document_root' => '/Users/apple/Code/Teacher_Project/swoole_live/resources/live/',
//    'enable_static_handler' => true,
]);

//工作进程启动
$http->on('WorkerStart', function ($serv, $worker_id) {
    //加载index文件的内容
    require __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../bootstrap/app.php';
});

//监听http请求
$http->on('request', function ($request, $response) {

    //server信息
    if (isset($request->server)) {
        foreach ($request->server as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }

    //header头信息
    if (isset($request->header)) {
        foreach ($request->header as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }

    //get请求
    if (isset($request->get)) {
        foreach ($request->get as $k => $v) {
            $_GET[$k] = $v;
        }
    }

    //post请求
    if (isset($request->post)) {
        foreach ($request->post as $k => $v) {
            $_POST[$k] = $v;
        }
    }

    //文件请求
    if (isset($request->files)) {
        foreach ($request->files as $k => $v) {
            $_FILES[$k] = $v;
        }
    }

    //cookies请求
    if (isset($request->cookie)) {
        foreach ($request->cookie as $k => $v) {
            $_COOKIE[$k] = $v;
        }
    }

    ob_start();//启用缓存区

    //加载laravel请求核心模块
    $kernel = app()->make(Illuminate\Contracts\Http\Kernel::class);
    $laravelResponse = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    $laravelResponse->send();
    $kernel->terminate($request, $laravelResponse);

    $res = ob_get_contents();//获取缓存区的内容
    ob_end_clean();//清除缓存区

    //输出缓存区域的内容
    $response->end($res);
});

$http->start();