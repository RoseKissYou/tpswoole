<?php
/**
 * 封装队列.
 */

namespace App\Model;

use App\Utility\Db\Redis;

class Queue
{
    const QUEUE_NAME = 'task_list_lzr';

    public static function set(TaskBean $taskBean)
    {
        return Redis::getInstance()->rPush(self::QUEUE_NAME, $taskBean);
    }

    public static function pop()
    {
        return Redis::getInstance()->lPop(self::QUEUE_NAME);
    }
}
