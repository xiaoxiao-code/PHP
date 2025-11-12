# final 关键字

`final`关键字用于施加限制，主要有两个目的：

1. 防止类被继承
2. 防止方法被覆盖
# 1 最终类（Final Classes）
当一个类被`final`关键字修饰时，它就成为一个“最终类”。
- 语法：
```php
final class MyUltimateClass
{
    // 类的属性和方法
}
```
- 作用： `final`类不能被任何其他类所继承（即不能被`extends`）。
- 译文：
```php
final class DatabaseConnection
{
    public function connect() {
        // ... 连接逻辑 ...
    }
}

// 试图继承一个 final 类
class MySpecificConnection extends DatabaseConnection // 致命错误！
{
    // ...
}
```
- 随后代码`extends`在此处会产生一个致命错误（Fatal error），提示“Class MySpecificConnection may not acquire from Final class (DatabaseConnection)”。
- 用途：当您设计的类功能已经非常完整和稳定，不希望（或不应该）有任何子类来或扩展其行为时，可以修改使用`final`。
# 2 最终方法（FinalMethods）
当一个方法被`final`关键字修饰时，它就成为一个“最终方法”。
- 语法：
```php
class ParentClass
{
    // final 只能用于 public 或 protected 方法
    final public function doSomething()
    {
        // ... 固定的实现逻辑 ...
    }
}
```
- 作用： `final`方法不能被子类所覆盖（Override）。
- 译文：
```php
class Car
{
    // 这个安全检查方法是最终的，不允许子类修改
    final public function checkSafetySystem()
    {
        echo "执行标准安全检查...";
    }
}

class SportCar extends Car
{
    // 试图覆盖一个 final 方法
    public function checkSafetySystem() // 致命错误！
    {
        echo "执行运动型安全检查...";
    }
}

$myCar = new SportCar();
$myCar->checkSafetySystem(); // 这行代码之前就会抛出错误
```
- 后续代码在`SportCar`类定义`checkSafetySystem`方法时就会产生一个致命错误，提示“Cannot override final method Car::checkSafetySystem()”。
- 用途：当您希望父类中的某个方法实现必须被所有子类原封不动地使用，而不允许它们提供自己的版本时，可以使用`final`。