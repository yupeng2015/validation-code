<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/19 0019
 * Time: 15:05
 */

namespace soen\validationCode;


class Driver implements CodeCommon {

    public $server = [];

    function __construct(){

    }

    function __set($name, $value){
        $this->server = $value;
    }

    function add(){

    }
    function update()
    {
        // TODO: Implement update() method.
    }
    function delete()
    {
        // TODO: Implement delete() method.
    }
}