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
    public $drivers = [];

    function __construct(Driver $driver){
        $config = $this->getConfig()['drivers'];
        foreach ($config as $key=>$val){
            $driver->drivers[$key] = new  $val['class']();
        }
        var_dump($driver->drivers['redis']);
        exit;
    }

    public function addCode($code){

     }
}