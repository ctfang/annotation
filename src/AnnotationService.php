<?php
/**
 * Created by PhpStorm.
 * User: 明月有色
 * Date: 2018/7/9
 * Time: 17:11
 */

namespace Tool\Annotation;

/**
 * Class AnnotationService
 * @package Tool\Annotation
 */
class AnnotationService
{
    private $annotation = [];
    private $bindTag = [];

    private $dirService;

    public function __construct()
    {
        $this->dirService = new Directory();
    }

    public function setScanDirectory($directory, $nameSpace)
    {
        $this->dirService->setScanDirectory($directory, $nameSpace);
    }

    public function setAnnotation($tagName, $bindClass)
    {
        $this->bindTag[$tagName] = $bindClass;
    }

    public function eachAnnotation()
    {
        foreach ($this->dirService->scanClass() as $class) {
            if( class_exists($class) ){
                $reflection = new \ReflectionClass($class);
                foreach ($reflection->getMethods() as $method) {
                    $doc = $method->getDocComment();
                    if (preg_match_all("/@\w+\([^\r\n]+/is", $doc, $match)) {
                        foreach (reset($match) as $docFun) {
                            $docFun = substr($docFun, 0, strrpos($docFun, ')'));
                            $docFun = str_replace("\"*\\", "\"*\\\\", $docFun);
                            foreach ($this->bindTag as $tabName => $annotationClass) {
                                if (strpos($docFun, "@{$tabName}(") === 0) {
                                    /** @var AnnotationAbstract $annotation */
                                    $annotation = new $annotationClass(self::getParams(str_replace("@{$tabName}(", "", $docFun)));
                                    $annotation->setClass($reflection);
                                    $annotation->setMethod($method);
                                    yield $annotation;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    protected static function getParams(string $param)
    {
        $arrParams = eval("return [{$param}];");
        return $arrParams;
    }

    /**
     * @param $key
     * @return AnnotationAbstract
     */
    public function get($key)
    {
        return $this->annotation[$key] ?? null;
    }
}