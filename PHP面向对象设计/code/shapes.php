<?php
/**
 * 抽象形状类，定义所有形状的通用结构和行为
 */
abstract class Shape
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    // 抽象方法，子类必须实现面积计算
    abstract public function calculateArea();
}

/**
 * 矩形类
 */
class Rectangle extends Shape 
{
    private $width;
    private $height;

    public function __construct($name, $width, $height)
    {
        parent::__construct($name);
        $this->width = $width;
        $this->height = $height;
    }

    public function calculateArea()
    {
        return $this->width * $this->height;
    }
}

/**
 * 圆形类
 */
class Circle extends Shape
{
    private $radius;

    public function __construct($name, $radius)
    {
        parent::__construct($name);
        $this->radius = $radius;
    }

    public function calculateArea()
    {
        return pi() * $this->radius * $this->radius;
    }
}

// 演示代码
$rect = new Rectangle("矩形", 10, 5);
$circ = new Circle("圆形", 7);

echo $rect->getName() . " 面积: " . $rect->calculateArea() . "<br>";
echo $circ->getName() . " 面积: " . $circ->calculateArea() . "<br>";
?>