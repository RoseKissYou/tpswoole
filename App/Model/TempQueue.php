<?php
/**
 * 模板消息封装队列.
 */

namespace App\Model;

use App\Utility\Db\Redis;

class TempQueue
{
    const QUEUE_NAME = 'template_list';

    public static function set(TaskBean $taskBean)
    {
        return Redis::getInstance()->rPush(self::QUEUE_NAME, $taskBean);
    }

    public static function pop()
    {
        return Redis::getInstance()->lPop(self::QUEUE_NAME);
    }
}
