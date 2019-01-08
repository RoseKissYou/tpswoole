<?php
/**
 * 自定义进程.
 */

namespace App\Process;

use EasySwoole\Core\Swoole\Process\AbstractProcess;
use Swoole\Process;

class Custom extends AbstractProcess
{
    //进程start的时候会执行的事件
    public function run(Process $process)
    {
        // TODO: Implement run() method.
    }

    //当进程关闭的时候会执行该事件
    public function onShutDown()
    {
        // TODO: Implement onShutDown() method.
    }

    //当有信息发给该进程的时候，会执行此进程
    public function onReceive(string $str, ...$args)
    {
        // TODO: Implement onReceive() method.
        var_dump('process rec'.$str);
    }
}
