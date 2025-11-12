# 字符串与HTML

在Web开发中，PHP脚本经常需要处理包含HTML标记的字符串。PHP提供了一些函数来帮助在“原始HTML代码”和“希望在浏览器中显示的文本”之间进行转换。

# 1 HTML特殊字符
在HTML中，一些字符具有特殊的含义（例如 `<` 和 `>` 用于定义标签）。如果希望在浏览器中**显示这些字符本身**（例如，显示 `<p>` 这三个字符，而不是渲染一个段落），就必须将它们转换为对应的HTML实体代码。

| **特殊字符** | **字符名称** | **转换后的HTML代码** |
| :------: | :------: | :------------: |
|   `&`    |  and 符号  |    `&amp;`     |
|   `"`    |   双引号    |    `&quot;`    |
|   `'`    |   单引号    |    `&#039;`    |
|   `<`    |   小于号    |     `&lt;`     |
|   `>`    |   大于号    |     `&gt;`     |
# 2 将特殊字符转换为HTML代码

## 2.1 `htmlspecialchars()` 函数
- **功能：** 此函数用于将字符串中的HTML特殊字符（如 `<` 和 `>`）编码，使其转换为HTML实体代码（如 `&lt;` 和 `&gt;`）。
- **用途：**
    1. **安全（防范XSS）：** （教程第9章会详细讲）防止用户在表单中输入恶意的HTML或JavaScript代码并执行。
    2. **显示代码：** 使浏览器能够**显示HTML标记本身**，而不是将其作为网页结构进行渲染 。
- **语法：** 
```php
htmlspecialchars(字符串)
```
示例 ：
```php
<?php
// 原始字符串（包含HTML标记）
$new = '<a href = "test">test</a>';

// 将特殊字符编码
$str = htmlspecialchars($new);

// $str 现在的值是 "&lt;a href = &quot; test&quot; &gt; test&lt;/a&gt;"
echo $str; 
// 浏览器会显示文本： <a href = "test">test</a>
?>
```
# 3 将HTML代码转换为特殊字符
## 3.1 `htmlspecialchars_decode()` 函数
- **功能：** 此函数执行与 `htmlspecialchars()` 相反的操作 。它将字符串中的HTML实体代码（如 `&lt;`）转换回其对应的特殊字符（如 `<`）。
- **语法：** 
```php
htmlspecialchars_decode(字符串)
```
示例 ：
```php
<?php
// 包含HTML实体代码的字符串
$str = "&lt;a href = &quot; test&quot; &gt; test&lt;/a&gt;";

// 将HTML代码解码回特殊字符
echo htmlspecialchars_decode($str); 

// 浏览器会将这个输出渲染为一个可点击的链接： test
?>
```