<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/19 0019
 * Time: 14:53
 */

namespace soen\validationCode;

class SetCode {
    use Config;
    protected $prefix = "soencode";
    public $currentDeriver;
    protected $itemKey;
    protected $itemValue;
    protected $expire_time = '1600';

    function __construct($currentDeriver="redis"){
        $config = $this->getConfig()['drivers'];
        $this->currentDeriver = new $config[$currentDeriver]['class']($config[$currentDeriver]['host']);
    }

    public function addItem(array $item,$ttl=0){
        $this->itemKey = $this->prefix.$item['account'].$item['type'];
        $this->itemValue = $item['value'];
        if($ttl){
            $this->expire_time = $ttl;
        }
        return $this;
     }

     public function putIn(){
         return $this->currentDeriver->add($this->itemKey,$this->itemValue,$this->expire_time);
     }

    /**
     * 获取当前item key的value
     * @return mixed
     */
     public function getItem(){
         return $this->currentDeriver->get($this->itemKey);
     }

    /**
     * 验证 验证码
     * @param $account
     * @param $type
     * @param $value
     * @return bool
     */
     public function checkItem($account,$type,$value){
         $this->itemKey = $this->prefix.$account.$type;
         $isStatus = $this->getItem() == $value;
         if(!$isStatus){
          return false;
         }
         $this->currentDeriver->delete($this->itemKey);
         return true;
     }
}