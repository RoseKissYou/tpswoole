<?php

namespace App\Model;

class TaskBean
{
    /*
     * 仅仅做示例，curl opt 选项请自己写
     */
    protected $url;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    protected function initialize()
    {
        // TODO: Implement initialize() method.
    }
}
