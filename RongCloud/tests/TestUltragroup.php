<?php
/**
 * 超级群模块测试用例
 */
require "./../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');

use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

$RongSDK = new RongCloud(APPKEY,APPSECRET);

function testGroup($RongSDK){
    $Group = $RongSDK->getUltragroup();
    $params = [
        'id'=> 'watergroup1',//超级群 id
        'name'=> 'watergroup',//超级群名称
        'member'=>['id'=> 'group999'],//创建人userId
    ];
    Utils::dump("创建超级群成功",$Group->create($params));

    Utils::dump("创建超级群错误",$Group->create());

    $params = [
        'id'=> 'watergroup',//超级群 id
        'member'=>['id'=> 'group999'],//群成员信息
    ];
    Utils::dump("加入超级群成功",$Group->joins($params));

    Utils::dump("加入超级群 member 错误",$Group->joins());

    $params = [
        'member'=>['id'=> 'group999'],
    ];
    Utils::dump("加入超级群 id 错误",$Group->joins($params));

    $params = [
        'id'=> 'watergroup',//超级群 id
        'member'=>['id'=> 'group999']//退出人员信息
    ];
    Utils::dump("退出超级群成功",$Group->quit($params));

    Utils::dump("退出超级群 id 错误",$Group->quit());

    $params = [
        'id'=> 'watergroup',//超级群 id
        'name'=>"watergroup"//群名称
    ];
    Utils::dump("修改群信息成功",$Group->update($params));

    $params = [
        'id'=> '',//超级群 id
        'name'=>"watergroup"//群名称
    ];
    Utils::dump("修改群信息 id 错误",$Group->update($params));

    $params = [
        'id'=> 'watergroup',//超级群 id
        'name'=>""//群名称
    ];
    Utils::dump("修改群信息 name 错误",$Group->update($params));


    $params = [
        'id'=> 'watergroup',//超级群 id
    ];
    Utils::dump("解散超级群成功",$Group->dismiss($params));

    Utils::dump("解散超级群 id 错误",$Group->dismiss());



}

testGroup($RongSDK);

function testGroupGag($RongSDK){
    $Group = $RongSDK->getUltragroup()->Gag();
    $params = [
        'id'=> 'watergroup1',//超级群 id
        'members'=>[ //禁言人员列表
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("添加超级群禁言成功",$Group->add($params));

    Utils::dump("添加超级群禁言参数错误",$Group->add());

    $params = [
        'id'=> 'watergroup1',//超级群 id
        'members'=>[ //禁言人员列表
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("解除禁言成功",$Group->remove($params));

    Utils::dump("解除禁言参数错误",$Group->remove());
    $params = [
        'id'=> 'watergroup1',
        'members'=>[]
    ];
    Utils::dump("解除禁言 members 错误",$Group->remove($params));

    $params = [
        'id'=> 'watergroup1',//超级群 id
    ];
    Utils::dump("查询禁言成员列表成功",$Group->getList($params));

    Utils::dump("查询禁言成员列表参数错误",$Group->getList());
}

testGroupGag($RongSDK);



function testGroupMuteAllMembers($RongSDK){
    $Group = $RongSDK->getUltragroup()->MuteAllMembers();
    $params = [
        'id'=> 'watergroup1',//超级群 id
        'status'=>true
    ];
    Utils::dump("添加指定超级群全部禁言成功",$Group->set($params));

    Utils::dump("添加指定超级群全部禁言参数错误",$Group->set());

    $params = [
        'id'=> 'watergroup1',//超级群 id
    ];
    Utils::dump("查询指定超级群全部禁言列表成功",$Group->get($params));
}

testGroupMuteAllMembers($RongSDK);

function testGroupMuteWhiteList($RongSDK){
    $Group = $RongSDK->getUltragroup()->MuteWhiteList();
    $params = [
        'id'=> 'watergroup1',//超级群 id
        'members'=>[ //禁言白名单人员列表
            ['id'=> 'group9994']
        ],
    ];
    Utils::dump("添加超级群禁言白名单成功",$Group->add($params));

    Utils::dump("添加超级群禁言白名单参数错误",$Group->add());

    $params = [
        'id'=> 'watergroup1',//超级群 id
        'members'=>[ //禁言白名单人员列表
            ['id'=> 'group9994']
        ]
    ];
    Utils::dump("解除禁言白名单成功",$Group->remove($params));

    Utils::dump("解除禁言白名单参数错误",$Group->remove());
    $params = [
        'id'=> 'watergroup1',
        'members'=>[]
    ];
    Utils::dump("解除禁言白名单 members 错误",$Group->remove($params));

    $params = [
        'id'=> 'watergroup1',//超级群 id
    ];
    Utils::dump("查询禁言白名单成员列表成功",$Group->getList($params));

    Utils::dump("查询禁言白名单成员列表参数错误",$Group->getList());
}

testGroupMuteWhiteList($RongSDK);
