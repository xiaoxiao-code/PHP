<?php
/**
 * 日志接口，要求实现类必须记录访问日志
 */
interface ILoggable 
{
    function logAccess();
}

/**
 * 用户基础类
 */
class User
{
    protected $username;
    protected $email;

    public function __construct($username, $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function getProfile()
    {
        return "用户名: {$this->username}, 邮箱: {$this->email}";
    }
}

/**
 * 学生类 - 继承用户类并实现日志接口
 */
class Student extends User implements ILoggable 
{
    private $studentID;

    public function __construct($username, $email, $studentID)
    {
        parent::__construct($username, $email);
        $this->studentID = $studentID;
    }

    // 重写父类方法，扩展学生信息
    public function getProfile()
    {
        $parentProfile = parent::getProfile();
        return $parentProfile . ", 学号: {$this->studentID}";
    }

    // 实现接口方法
    public function logAccess()
    {
        echo "日志：学生 '{$this->username}' 在 " . date('Y-m-d H:i:s') . " 访问了系统。<br>";
    }
}

// 使用示例
$student = new Student("zhangsan", "zhang@example.com", "S1001");

echo "<h3>学生档案:</h3>";
echo $student->getProfile(); 

echo "<hr>";

echo "<h3>访问日志:</h3>";
$student->logAccess();
?>