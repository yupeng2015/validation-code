<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/19 0019
 * Time: 14:53
 */

namespace soen\validationCode;


use soen\validationCode\redis\RedisServer;

class SetCode{
    use Config;
    protected $prefix = "soencode";
    public $currentDeriver;
    protected $itemKey;
    protected $itemValue;
    protected $expire_time = '1600';

    function __construct(Driver $driver,$currentDeriver){
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

     public function checkItem($mobile,$type,$value){
         $this->itemKey = $this->prefix.$mobile.$type;
         return $this->getItem();
     }
}