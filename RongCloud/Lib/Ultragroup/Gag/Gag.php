<?php
/**
 * 超级群禁言
 * @author hejinyu
 */
namespace RongCloud\Lib\Ultragroup\Gag;

use RongCloud\Lib\Request;
use RongCloud\Lib\Utils;
class Gag
{
    /**
     * 超级群模块路径
     *
     * @var string
     */
    private $jsonPath = 'Lib/Ultragroup/Gag/';

    /**
     * 请求配置文件
     *
     * @var string
     */
    private $conf = "";

    /**
     * 校验配置文件
     *
     * @var string
     */
    private $verify = "";

    /**
     * Conversation constructor.
     */
    function __construct()
    {
        $this->conf = Utils::getJson($this->jsonPath.'api.json');
        $this->verify = Utils::getJson($this->jsonPath.'../verify.json');
    }

    /**
     * 添加超级群禁言
     *
     * @param $Group array 添加超级群禁言 参数
     * @param
     * $Group = [
                'id'=> 'ujadk90ha',//超级群 id
                'members'=>[ //禁言人员列表
                     ['id'=> 'ujadk90ha']
                ]
                ,
                'minute'=>50  //	禁言时长
         ];
     * @return array
     */
    public function add(array $Group=[]){
        $conf = $this->conf['add'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'members'=>$verify['members']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'members'=> 'userIds'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 解除禁言
     *
     * @param $Group array 解除禁言 参数
     * @param
     * $Group = [
                'id'=> 'ujadk90ha',//超级群 id
                'members'=>[ //解除禁言人员列表
                    ['id'=> 'ujadk90ha']
                ]
            ];
     * @return array
     */
    public function remove(array $Group=[]){
        $conf = $this->conf['remove'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id'], 'members'=>$verify['members']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        foreach ($Group['members'] as &$v){
            $v = $v['id'];
        }
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
            'members'=> 'userIds'
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        return $result;
    }

    /**
     * 查询禁言成员列表
     *
     * @param $Group array 解除禁言 参数
     * @param
     * $Group = [
            'id'=> 'ujadk90ha',//超级群 id
         ];
     * @return array
     */
    public function getList(array $Group=[]){
        $conf = $this->conf['getList'];
        $verify = $this->verify['group'];
        $verify = ['id'=>$verify['id']];
        $error = (new Utils())->check([
            'api'=> $conf,
            'model'=> 'group',
            'data'=> $Group,
            'verify'=> $verify
        ]);
        if($error) return $error;
        $Group = (new Utils())->rename($Group, [
            'id'=> 'groupId',
        ]);
        $result = (new Request())->Request($conf['url'],$Group);
        $result = (new Utils())->responseError($result, $conf['response']['fail']);
        if($result['code'] == 200){
            $result = (new Utils())->rename($result,['users'=>'members']);
            foreach ($result['members']?:[] as $k=>&$v){
                $v = (new Utils())->rename($v,['userId'=>'id']);
            }
        }
        return $result;
    }

}
