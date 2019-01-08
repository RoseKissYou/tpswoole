<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 2018/12/30
 * Time: 16:42
 */

namespace App\HttpController\Index;

use think\Db;
use EasySwoole\Core\Swoole\Task\TaskManager;
use EasySwoole\Core\Swoole\Process\ProcessManager;
use App\Model\Runner;
use App\Model\Queue;
use App\Model\TaskBean;
use App\Utility\Db\Redis;
use App\Process\Custom;
use EasySwoole\Core\Http\AbstractInterface\Controller;

// 微信检查系统
class Check extends Controller
{
    public function index()
    {
        // TODO: Implement index() method.
    }

    public function checkWorkder(){
        $name = ProcessManager::getInstance()->getProcessByName('custom');
        $name->addTick(2 * 1000, function () {
            TaskManager::async(Runner::class);
            if (!Redis::getInstance()->lSize('task_list_lzr')) {
                self::addtask();
            }
        });
        $this->response()->withHeader('Content-type', 'text/html;charset=utf-8');
        $this->response()->write('check5 run ok启动成功,请关闭页面');
    }

    public function addtask(){
        TaskManager::async(function (){
           $bean = new TaskBean();
           $map = ['pid'=>3,'status'=>1];
           $chekDomainList = Db::name('wxurls')->field('id,pid,domain,postfix,admin,type')
               ->where($map)->order('id desc')->select();
            foreach ($chekDomainList as $domain) {
                $bean->setUrl($domain);
                Queue::set($bean);
           }
        });
    }

}