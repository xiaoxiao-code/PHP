# JavaScript简介与语句

# 1 JavaScript简介

JavaScript 是在 1995 年，由 Netscape 公司的 Brendan Eich 设计的。它是一种网页脚本语言。
尽管它的名字中带有“Java”，但它与Java语言是两种不同的语言，只是语法上非常相似。
JavaScript 代码可以很容易地嵌入到 HTML 网页中，为网页添加剧情的动态功能，为用户提供更流畅美观的浏览效果。
JavaScript具有以下特点：

- (1)脚本语言： JavaScript是一种解释型脚本语言。
- (2) 区分字母大小写： JavaScript 是一种区分字母大小写的语言。
- (3) 弱变量类型： JavaScript 中的变量为弱变量类型，即变量的类型由其所赋值的类型决定。
- (4) 跨平台性： JavaScript脚本语言不依赖于操作系统，仅需要浏览器的支持目前JavaScript已被大多数浏览器支持。
- (5)动态性： JavaScript主要用于向HTML页面添加交互行为。
JavaScript脚本可以直接嵌入HTML页面，也可以写成单独的`.js`文件。
# 2 JavaScript 语句
JavaScript 语句的语法与 PHP（和 C 语言）非常相似。
## 2.1 定义指标
- JavaScript报表报表类型。
- 格式： `var 变量名[=初始值];`
- 译文： `var a = 5;
## 2.2 if语句
- 也叫分支语句。
- 格式： `if(表达式) 语句1 [else 语句2]`
- 功能：当表达式的值为真时，就执行`语句1`，否则执行`语句2` 。
## 2.3 切换语句
- 也叫多分支语句。
- 格式：
```php
switch(表达式)
{
    case 常量1: 语句块1;
        break;
    case 常量2: 语句块2;
        break;
    ...
    [default: 语句组n+1;]
}
```
功能：计算表达式的值，并与`case`块的常量比较，如果符合则执行该语句块；如果不一致，则执行该语句`default`块。
## 2.4 循环语句
- JavaScript语言共有3种循环语句：`for`语句、`while`语句、`do-while`语句。
- 它们的语法格式与PHP相同。
## 2.5 定义函数
- JavaScript 的函数定义格式与 PHP 相同。
- 格式：
```php
function 函数名(形参表)
{
    // 函数体
}
```
## 2.6 注释语句
- JavaScript 语言的注释与 PHP 相同。
- 单行注释： `//`
- 多行注释： `/* ... */`