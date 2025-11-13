# 在JavaScript脚本中实现页面跳转

在PHP网页中，JavaScript脚本在客户端（浏览器）运行，它提供了另一种实现页面的方式。
# 1 语法格式
```php
location.replace("文件名")
```
`window.location.replace()`：这是一个JavaScript语句，用于在浏览器中加载一个新的页面，并用新页面替换掉历史记录中的当前页面。这意味着用户将无法使用浏览器的“后退”浏览按钮返回到跳转前的页面。
# 2 JavaScript 语句的存放位置
1. 直接放在`<script>`标记中
    - 当 JavaScript 语句被直接放在`<script>`标记中时，浏览器会在解析到该行时代码立即执行跳转。
```php
<script language="javascript">
    window.location.replace("index.php?no=1&name=张三");
</script>
```
2. 放置HTML控件的事件中
- 这是更常见的用法，例如放在按钮的`onclick`事件中。
- 跳转页面只有在用户特定执行操作（如点击按钮）时才会被触发。
```php
<input type="button" value="打开" name="B1" onclick="window.location.replace('index.php')">
```
# 3 实例
## 3.1 触发跳转 (在`EX5-3a.php`中)
这段代码创建了一个按钮，当用户点击该按钮时，会触发`onclick`事件，执行`window.location.replace()`到跳转到`EX5-3b.php`，并通过URL提交参数。
```html
<input type="button" name="button3"
       value="执行" 
       onclick="window.location.replace('EX53b.php?no=1&name=张三')" />
```
## 3.2 返回页面(在`EX5-3b.php`中)
这段代码创建了一个“返回”按钮，当用户点击时，会触发`onclick`事件，跳转回`EX53a.php`页面。
```php
<input type="button" name="button" value="返回"
       onclick="window.location.replace('EX53a.php')" />
```