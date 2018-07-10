<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/7/10
 * Time: 11:03
 */
if( isset($_ENV['test_main']) ) return;
$_ENV['test_main'] = true;

/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require '../vendor/autoload.php';
$loader->setPsr4("", __DIR__);

$directory = new \Tool\Annotation\AnnotationService();
// 设置遍历目录
$scanDir = realpath(__DIR__);
$directory->setScanDirectory($scanDir,"");
// 设置注解标签
$directory->setAnnotation('TestBase',TestBase::class);

foreach ($directory->eachAnnotation() as $annotation){
    if( $annotation instanceof TestBase){
        // 是TestBase注解
    }
}
