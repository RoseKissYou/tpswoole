<?php
/**
 * 封装异步执行模型.
 */

namespace App\Model;

use EasySwoole\Core\Swoole\Task\AbstractAsyncTask;
use think\Db;

class Runner extends AbstractAsyncTask
{
    /**
     * 执行任务的内容.
     *
     * @param mixed $taskData     任务数据
     * @param int   $taskId       执行任务的task编号
     * @param int   $fromWorkerId 派发任务的worker进程号
     *
     * @author : evalor <master@evalor.cn>
     */
    public function run($taskData, $taskId, $fromWorkerId)
    {
        // 需要注意的是task编号并不是绝对唯一
        // 每个worker进程的编号都是从0开始
        // 所以 $fromWorkerId + $taskId 才是绝度唯一的编号
        // !!! 任务完成需要 return 结果
        // var_dump($taskData);
        // while (true) {
        $task = Queue::pop();
        if ($task instanceof TaskBean) {
            $urlData = $task->getUrl();
            $return = Wx::wxhttpRequest($urlData['domain'].'/'.$urlData['postfix']);
            Db::name('wxurlscheck5')->insert(['json_str' => json_encode($return, JSON_UNESCAPED_UNICODE), 'check_time' => date('Y-m-d H:i:s')]);
            if ($return['status'] == 2) {
                Db::name('wxurls')->where('id', $urlData['id'])->update(['status' => 0, 'seal_time' => time()]);
                Curl::httpRequest('https://ae.shangning.org.cn/api/other/batchSendMsg', 'POST', ['id' => 4, 'openid' => [
                    'o5eJs0TvNxdE0T5ABf1jjOkLXOOg',
                    'o5eJs0cHYvLyLACGG30Yqnq02ngw',
                    'o5eJs0ceePyPjhBJ-F9yD-ERAcmY',
                    'o5eJs0RZl8tf-yCdpTLUA2KSAaaM',
                    'o5eJs0bS_ua371awfcd0pkP8mtLc',
                    'o5eJs0T49hHqPrcjSCHvgTZdBrYs',
                    'o5eJs0exJQ0-SrGWzPrt5BQ398h4',
                    'o5eJs0exJQ0-SrGWzPrt5BQ398h4',
                    'o5eJs0T34OQiJDrP5SI16xBt8lss',
                    'o5eJs0QrE_BUNz-Pi2pSC0TiSldk'
                ], 'content' => '['.date('Y-m-d H:i:s')."]\n项目ID:".$urlData['id'].'内1外2部'.$urlData['pid'].'广告名称'.$urlData['admin'].'一二跳'.$urlData['type'].'域名'.$urlData['domain']."\n发现域名已被封,请马上处理!!check68dj本地测试\n为保证正常接收消息,收到请回复~谢谢!!"]);
            //微信提醒
            } elseif ($return['status'] == 3) {
                //系统失效
                Curl::httpRequest('https://ae.shangning.org.cn/api/other/batchSendMsg', 'POST', ['id' => 4, 'openid' => [
                    'o5eJs0TvNxdE0T5ABf1jjOkLXOOg',
                    'o5eJs0cHYvLyLACGG30Yqnq02ngw',
                    'o5eJs0ceePyPjhBJ-F9yD-ERAcmY',
                    'o5eJs0RZl8tf-yCdpTLUA2KSAaaM',
                    'o5eJs0bS_ua371awfcd0pkP8mtLc',
                    'o5eJs0exJQ0-SrGWzPrt5BQ398h4',
                    'o5eJs0T49hHqPrcjSCHvgTZdBrYs',], 'content' => '['.date('Y-m-d H:i:s')."]\n检测系统check68dj本地测试版疑似失效,请管理员检查!!为保证正常接收消息,收到请回复~谢谢!!"]);
            }
        }
        // }
    }

    /**
     * 任务执行完的回调.
     *
     * @param mixed $result  任务执行完成返回的结果
     * @param int   $task_id 执行任务的task编号
     *
     * @author : evalor <master@evalor.cn>
     */
    public function finish($result, $task_id)
    {
        // 任务执行完的处理
    }
}
