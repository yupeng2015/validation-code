<?php
namespace soen\validationCode\redis;

use soen\validationCode\codeCommon;
use soen\validationCode\Driver;

class RedisServer extends Driver {

    public $host;
    public $port;
    public $password;
    public $database;
    protected $_redisServer;
    protected $expire_time = 1800;

    function __construct(){
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
}