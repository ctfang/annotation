# BaseAnnotation
php注解实现

基础使用
~~~~
$directory = new \Tool\Annotation\AnnotationService();
// 设置遍历目录
$scanDir = realpath(__DIR__);
$directory->setScanDirectory($scanDir,"");
// 设置注解标签，绑定注解tag到类
$directory->setAnnotation('TestBase',TestBase::class);
$directory->setAnnotation('TestBase2',TestBase2::class);

foreach ($directory->eachAnnotation() as $annotation){
    if( $annotation instanceof TestBase){
        // 是TestBase注解
    }
}
~~~~

定义TestBase注解
~~~~
class TestBase extends \Tool\Annotation\AnnotationAbstract
{
    public $one;

    function init(...$params)
    {
        // @TestBase("参数1","参数2") 注解的参数将会传入这里
        $this->one = $params[0];
    }
}
~~~~

逻辑中使用注解

~~~~
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
~~~~