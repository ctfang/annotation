<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/7/9
 * Time: 17:27
 */

/**
 * Class TestClass
 */
class TestClass
{
    /**
     * @TestBase(1)
     * @param null $time
     */
    public function testFunc($time=null)
    {
        var_dump($time);
    }

    /**
     * @TestMapping($route="/user","/test")
     * @param string $route
     * @param string $middleware
     */
    public static function testStatic($route='',$middleware)
    {
        var_dump($route,$middleware);
    }

    /**
     * @TestMapping($route="/user","/test")
     * @isBase
     * @param string $route
     * @param string $middleware
     */
    public static function testBase($route='',$middleware)
    {
        var_dump($route,$middleware);
    }
}