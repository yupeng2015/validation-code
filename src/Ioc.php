<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/19 0019
 * Time: 16:44
 */

namespace soen\validationCode;


/**
 * 控制反转类
 */
class Ioc {
    /**
     * @var array 注册的依赖数组
     */
    protected static $item = array();

    /**
     * 添加一个 resolve （匿名函数）到 registry 数组中
     *
     * @param string  $name    依赖标识
     * @param Closure $resolve 一个匿名函数，用来创建实例
     * @return void
     */
    public static function register($name, \Closure $resolve) {
        static::$item[$name] = $resolve;
    }

    /**
     * 返回一个实例
     *
     * @param string $name 依赖的标识
     * @return mixed
     * @throws \Exception
     */
    public static function resolve($name) {
        if (static::registered($name)) {
            $name = static::$item[$name];
            return $name();
        }

        throw new \Exception("Nothing registered with that name");
    }

    /**
     * 查询某个依赖实例是否存在
     *
     * @param string $name
     * @return bool
     */
    public static function registered($name) {
        return array_key_exists($name, static::$item);
    }
}