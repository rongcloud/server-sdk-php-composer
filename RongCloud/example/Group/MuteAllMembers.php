<?php
/**
 * Specify the group-wide ban instance
 */


require "./../../RongCloud.php";
define("APPKEY", '');
define('APPSECRET','');
use RongCloud\RongCloud;
use RongCloud\Lib\Utils;

/**
 * Add group ban
 */
function add()
{
    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// group id
    ];
    $result = $RongSDK->getGroup()->MuteAllMembers()->add($group);
    Utils::dump("添加指定群组全部禁言",$result);
}
add();
/**
 * Query the list of banned members
 */
function getList()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [

    ];
    $result = $RongSDK->getGroup()->MuteAllMembers()->getList($group);
    Utils::dump("查询指定群组全部禁言列表",$result);
}
getList();
/**
 * Remove ban
 */
function remove()
{

    $RongSDK = new RongCloud(APPKEY,APPSECRET);
    $group = [
        'id'=> 'php group1',// group id
    ];
    $result = $RongSDK->getGroup()->MuteAllMembers()->remove($group);
    Utils::dump("解除指定群组全部禁言",$result);
}
remove();


