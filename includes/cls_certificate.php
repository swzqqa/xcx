<?php



if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

class certificate
{

    /**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function __construct(){
        include_once(ROOT_PATH."admin/includes/oauth/oauth2.php");
        $openapi_key = array('key'=>OPENAPI_KEY,'secret'=>OPENAPI_SECRET,'site'=>OPENAPI_SITE,'oauth'=>OPENAPI_OAUTH);
        $openapi_key_old = array('key'=>OPENAPI_KEY_OLD,'secret'=>OPENAPI_SECRET_OLD,'site'=>OPENAPI_SITE,'oauth'=>OPENAPI_OAUTH);
        $this->oauth = isset($_COOKIE['use_oldkey'])?new oauth2($openapi_key):new oauth2($openapi_key_old);
        include_once(ROOT_PATH."includes/cls_transport.php");
        $this->transport = new transport();
    }

    /**
     * 获得网店 certificate 信息
     *
     * @access  public
     *
     * @return  array
     */


    /**
    * 设置 certificate 信息
    */


    /**
    * 功能： 设置云起收银账号
    * @param  array $data
    * @return bool
    */
    function set_yunqi_account($data){
        $data['status'] = true;
        $sql = "insert into ".$GLOBALS['ecs']->table('shop_config')." set parent_id=2,code='yunqi_account',type='hidden',value='".serialize($data)."'";
        $GLOBALS['db']->query($sql,SILENT);
    }

    /**
    * 功能： 获取云起收银账号
    * @return array
    */
    function get_yunqi_account(){
        $sql = "select value from ".$GLOBALS['ecs']->table('shop_config')." where code='yunqi_account'";
        $row = $GLOBALS['db']->getOne($sql);
        return $row?unserialize($row):false;
    }

    /**
    * 功能： 删除证书
    * @return array
    */
    

    /**
     * 功能：生成certi_ac验证字段
     * @param   string     POST传递参数
     * @param   string     证书token
     * @return  string
     */
  

    /**
     * 功能：oauth根据token获取证书
     *
     * @param   string     $token
     * @return  array
     */


     /**
     * 功能：oauth根据token验证证书
     *
     * @param   string     $token
     * @return  array
     */
   

    /**
    * 功能：oauth根据token获取物流和短信的永久token
    *
    * @param   strint     $token
    * @return  array
    */
    function get_yunqi_code($token){
        $r = $this->oauth->request()->get('api/platform/timestamp');
        $time = $r->parsed();
        $type = OAUTH_API_PATH.'/auth/auth.gettoken';
        $params['product_code'] = PRODUCT_CODE;
        $rall = $this->oauth->request($token)->post($type,$params,$time);
        $response = $rall->parsed();
        return $response;
    }

    /**
    * 功能：oauth获取token
    *
    * @param   string     $code
    * @return  string
    */
    function get_token($code){
        return $this->oauth->get_token($code);
    }

    function logout_url($callback=''){
        !$callback and $callback = $GLOBALS['ecs']->url()."admin/privilege.php?act=logout&type=yunqi";
        return $this->oauth->logout_url($callback);
    }

     /**
     * 功能：oauth的登录地址
     *
     * @param   string     $callback
     * @return  string
     */
     function get_authorize_url($callback){
        return $this->oauth->authorize_url($callback)."&view=auth_ecshop";
     }

    /**
     * 功能：中心授权地址
     *
     * @return  string
     */


    /**
    * 功能：矩阵申请绑定节点接口
    *
    * @param   array     $params   
    * @param   string    $node_type 绑定类型
    * @return  array
    */
    function applyNodeBind($params,$node_type='shopex'){
        $base_url = $GLOBALS['ecs']->url();
        $post = array(
                'app'=>'app.applyNodeBind',
                'node_id'=>$params['node_id'],
                'from_certi_id'=>$params['certi_id'],
                'callback'=>$base_url."matrix_callback.php",
                'api_url'=>$base_url."api.php",
                'node_type'=>$node_type,
                'to_node'=>$params['to_node'],
                'to_token'=>$params['to_token'],
                'shop_name'=>$params['shop_name']
            );
        $post['certi_ac'] = $this->make_shopex_ac($post,$params['token']);
        return $this->read_shopex_applyNodeBind($post);
    }

    /**
    * 功能：请求矩阵
    *
    * @param   array     $post
    * @return  array
    */
    function read_shopex_applyNodeBind($post){
        $url = MATRIX_HOST."/api.php";
        $response = $this->transport->request($url,$post);
        return json_decode($response['body'],1);
    }

    /**
    * 功能：oauth 获取云起开通的产品列表
    *
    * @param   string     $token
    * @param   array      $params
    * @return  array
    */
    function getsnlistoauth($token,$params){
        $r = $this->oauth->request()->get('api/platform/timestamp');
        $time = $r->parsed();
        $type = OAUTH_API_PATH.'/online/getsnlistoauth';
        $rall = $this->oauth->request($token)->post($type,$params,$time);
        $response = $rall->parsed();
        return $response;
    }

    /**
    * 功能：保存云起开通的产品列表
    *
    * @param   array     $data
    */
    function save_snlist($data){
        foreach($data as $value){
            $_data[] = $value['goods_code'];
        }
        $_data['time'] = date("Y-m-d",time());
        $sql = "insert into ".$GLOBALS['ecs']->table('shop_config')." set parent_id=2,code='snlist',type='hidden',value='".json_encode($_data)."'";
        $GLOBALS['db']->query($sql,SILENT);
    }

    function get_snlist(){
        $row = $this->shop_config('snlist');
        return $row['value'];
    }

    function shop_config($code){
        if(is_array($code)){
            $where  =  " where code in (".implode(',', $code).")";
        }else{
            $where  = " where code = '".$code."'";
        }
        $sql = "select code,value from ".$GLOBALS['ecs']->table('shop_config').$where;
        if(is_array($code)){
            return $GLOBALS['db']->getAll($sql);
        }else{
            return $GLOBALS['db']->getRow($sql);
        }
    }

    /**
    * 功能：检测是否开通云起产品
    *
    * @param   string     $goods_name  产品名：erp
     * @return  bool
    */
    function is_open_sn($goods_name){
        $sql = "select `value` from ".$GLOBALS['ecs']->table('shop_config')." where code='snlist'";
        $row = $GLOBALS['db']->getRow($sql);
        if(empty($row)) return false;
        $snlist = json_decode($row['value'],1);

        $sql = "select `value` from ".$GLOBALS['ecs']->table('shop_config')." where code='snlist_code'";
        $row = $GLOBALS['db']->getRow($sql);
        if(empty($row)) return false;
        $snlist_code = json_decode($row['value'],1);

        if(in_array($snlist_code[$goods_name],$snlist)){
            return true;
        }
        return false;
    }


    /**
     * 功能：是否绑定检测云起产品
     *
     * @param   string     $name  产品名or绑定类型
     * @return  bool
     */
    function is_bind_sn($name,$type='bind_type'){
        $sql = "select `value` from ".$GLOBALS['ecs']->table('shop_config')." where code='bind_list'";
        $row = $GLOBALS['db']->getRow($sql);
        if(empty($row)) return false;
        $bind_list=json_decode($row['value'],1);
        $bind_type = $name;
        if($type=='goods_name') $bind_type = $this->bind_sn($goods_name);
        if(in_array($bind_type,$bind_list)){
            return true;
        }
        return false;
    }

    /**
     * 功能：获取产品对应的矩阵绑定类型
     *
     * @param   string     $goods_name  产品名：erp
     * @return  string     bind_type 矩阵绑定类型
     */
    function bind_sn($goods_name){
        $bind_sn = array(
                'taoda'=>'taodali',
                'erp'=>'ecos.ome',
                'crm'=>'ecos.taocrm'
            );
        return $bind_sn[$goods_name];
    }

    function oauth_set_callback($code,&$res){
        $res = $this->get_token($code);
        if($res['token'] and $res['params']){
            if (isset($res['params']['data']) && $res['params']['data']) {
                foreach ($res['params']['data'] as $d_key => $d_value) {
                    $res['params'][$d_key] = $d_value;
                }
                unset($res['params']['data']);
            }
            include_once(ROOT_PATH.'includes/lib_passport.php');
            $result = set_yunqi_passport($res['params']['passport_uid']);

            $this->check_certi($res);
            return true;
        }
    }







}
?>