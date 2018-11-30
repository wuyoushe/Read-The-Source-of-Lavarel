<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SwooleStart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '启动 swoole';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $serv = new \swoole_server('127.0.0.1', 9501);

        //监听连接进入事件
        $serv->on('connect', function($serv, $fd) {
            echo "Client: connect.\n";
        });

        // 监听数据接收事件
        $serv->on('receive', function($serv, $fd, $from_id, $data){
            $serv->send($fd, "Server: ".$data);
        });

        //监听连接关闭事件
        $serv->on('close', function ($serv, $fd) {
            echo "Client: Close.\n";
        });

        //启动服务器
        $serv->start();

    }
}
