<?php

namespace app\index\controller;

use think\Controller;
use think\Request;


class Test extends Controller
{
    public function index()
    {
        return __FILE__;
    }
    public function test(){
        $c = new TopClient;
        $c->appkey = $appkey;
        $c->secretKey = $secret;
        $req = new OpensecurityIsvUidGetRequest;
        $req->setOpenUid("AAHrb-fwAAgOrLpFIt9ATdjc");
        $resp = $c->execute($req);
    }
}
