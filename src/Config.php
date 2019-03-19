<?php
namespace soen\validationCode;

use soen\validationCode\redis\RedisServer;

trait Config{

    function __construct(){
        return new self();
    }

    function getConfig(){
        return [
            'drivers'    =>  [
                'redis' =>  [
                    'class' =>  RedisServer::class,
                    'host'  =>  '192.168.1.27',
                    'port'  =>  6379
                ]
            ]
        ];
    }
}