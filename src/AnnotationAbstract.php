<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/7/9
 * Time: 17:02
 */

namespace Tool\Annotation;


abstract class AnnotationAbstract
{
    /**
     * @var \ReflectionClass
     */
    protected $atClass;
    /**
     * @var \ReflectionFunctionAbstract
     */
    protected $atMethod;


    public final function __construct(array $arrData)
    {
        call_user_func_array([$this,'init'],$arrData);
    }

    public final function setClass(\ReflectionClass $atClass)
    {
        $this->atClass = $atClass;
    }

    public final function setMethod(\ReflectionFunctionAbstract $atMethod)
    {
        $this->atMethod = $atMethod;
    }

    public function getTitle($strLen=null)
    {
        $title = $this->atMethod->getDocComment();
        $arr   = explode("@",$title);
        $title = reset($arr);
        $title = str_replace(['*',"\n","\r","/"],'',$title);
        $title = trim($title);
        if( $strLen ){
            return mb_substr($title,0,$strLen);
        }
        return $title;
    }

    public function getKey()
    {

    }

    public function call(...$params)
    {
        try{
            $class = $this->atClass->getName();
            $func  = $this->atMethod->getName();
            call_user_func_array([$class,$func],$params);
        }catch (\Exception $exception){

        }
    }

    abstract function init(...$params);
}