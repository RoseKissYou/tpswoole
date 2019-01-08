<?php

namespace App\Model;

class Wx
{
    public static function wxhttpRequest($domain)
    {
        $url = 'https://wx2.qq.com/cgi-bin/mmwebwx-bin/webwxcheckurl?requrl=https%3A%2F%2F'.$domain.'&skey=%40crypt_51c9bf42_8ce2c88a62b61d65193c62bf9270c16b&deviceid=e451517101450314&pass_ticket=undefined&opcode=2&scene=1&username=@b68e1d3ba6c183cbc663de2d508fc72314b997960ef1daf5ddf963248ecb3c61';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //换网页版微信cookie
//       $cookie = 'MM_WX_NOTIFY_STATE=1; MM_WX_SOUND_STATE=1; wxuin=548327195; webwxuvid=663b505cd819d6e3329ff013c9bd39537d2f2a77edfba33ffb9afa882b917495512c011c3bd79a7bf1efd6b211ac465a; wxsid=mb8VSsXyyw7kYgug; webwx_data_ticket=gScND35SQW7YOxTf9mGvfHQ2; webwx_auth_ticket=CIsBEMeetL8DGoABT38nFrfnbQBzRTG+vw6Tsv6TMc/Oz3CFkJpaeTl2wx1T/L1aAgOPN3SB/hsHVRLz+P9RPMQOUh9dWzC2uDbWb9hg3FpCx3WMIb+SmAzjhBCi9g4G+BD1JceG2uNs05vVUp1fuLpk4EU0E+CQTmptFS9+e6PEhORRUP3ixsZSicM=; wxpluginkey=1545110418';     $user_agent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36';
        $cookie = 'mm_lang=zh_CN; webwxuvid=663b505cd819d6e3329ff013c9bd39533d12c9270e4105f277f18b38e190c17c3dc34661ab89f5d299a1972c0ea4dc71; webwx_auth_ticket=CIsBEKeqlJYIGoAB4wUCtoG+JozHK+aoaci7qP6TMc/Oz3CFkJpaeTl2wx2tk1h1iYnA8dKL9ZMxxLSSonITAqiVseuJVMHWd+tZQliXyef78xf5fGEq7I9tUnl1tXiXUgezeoTNhCm7yMBraR6tX/JIDduZ6yNvLDhkUC9+e6PEhORRUP3ixsZSicM=; wxloadtime=1545990546_expired; wxpluginkey=1545987002; wxuin=548327195; wxsid=W3MwNF8fPy7OiidV; webwx_data_ticket=gSedV1sh3BOXJ8DfBhnZ/xuJ';
        // $user_agent
        curl_setopt($ch, CURLOPT_USERAGENT, '');
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        $output = curl_exec($ch);
        // $request_header = curl_getinfo($ch,CURLINFO_HEADER_OUT);
        curl_close($ch);
        // dump($request_header);
        $output_arr = json_decode($output, true);

        if (strpos($output_arr['FullURL'], 'weixin110.qq.com')) {
            return ['status' => 2, 'errmsg' => '系统check5 new swoole sys检测域名被封', 'url' => $domain];
        } elseif (empty($output_arr['FullURL']) || $output_arr == null) {
            return ['status' => 3, 'errmsg' => '系统check5 new swoole sys检测失效,请联系管理员', 'url' => $domain];
        } else {
            // header('HTTP/1.1 301 Moved Permanently');//发出301头部
            // header("Location:https://".$domain_list['domain'].$domain_list['postfix']);//跳转到你希望的地址格式
            return ['status' => 1, 'errmsg' => '系统check5 new swoole sys检测域名正常', 'url' => $domain];
        }
    }
}
