<?php
namespace App\Helpers;
use GuzzleHttp\Client;
class HelperFunctions
{
    static function sendSmsMessage($num, $msg, $from = 'W-EVOLUTION')
    {
        /*$url = 'sendmsg.php?';
        $url .= 'user=magmatel2';
        $url .= '&password=SMSmagmatel2@2015';
        $url .= '&from=' . urlencode(trim($from));
        $url .= '&to= ' . $num;
        $url .= '&text=' . urlencode($msg);
        $url .= '&api=14265';*/
        $client = new Client();
        $res = $client->request('GET', 'http://74.207.224.67/api/http/sendmsg.php', [
                'query' => [
                    'user' => 'magmatel2',
                    'password' => 'SMSmagamatelys2@2017',
                    'from' => urlencode(trim($from)),
                    'to' => $num,
                    'text' => urlencode($msg),
                    'api' => '14265'
                    ]
                ]);
        //echo $res->getStatusCode();
        // "200"
        //echo $res->getHeader('content-type')[0];
        // 'application/json; charset=utf8'
        return $res->getBody();
    }

}
