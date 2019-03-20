<?php
namespace soen\validationCode\redis;

use soen\validationCode\Driver;

class RedisServer extends Driver {

    public $host;
    public $port = "6379";
    public $password;
    public $database;
    protected $_redisServer;
    protected $expire_time = 1800;

    function __construct($host){
        $this->host = $host;
        //$this->host = $config['port'];
        $this->_redisServer = $this->createConnection();
    }

    // 创建连接
    protected function createConnection()
    {
        $redis = new \Redis();
        // connect 这里如果设置timeout，是全局有效的，执行brPop时会受影响
        if (!$redis->connect($this->host, $this->port)) {
            throw new \RuntimeException('redis connection failed.');
        }
        $redis->auth($this->password);
        $redis->select($this->database);
        return $redis;
    }

    function add($key,$value,$expire_time=1800){
        return $this->_redisServer->setex($key,$expire_time,$value);
    }
    function delete($key){
        return $this->_redisServer->delete($key);
    }

    function get($key){
        return $this->_redisServer->get($key);
    }

    function check($key)
    {
        return $this->get($key);
    }

}