# 在HTML标记中实现页面跳转

# 1 提交表单

- 机制：通过`<form>`标记的`action`属性来指定要跳转的页面。
- 触发：当用户点击表单内的`<input type="submit">`按钮时，浏览器将跳转到`action`属性指定的URL。
- 语法示例：
```html
<form name="form1" method="post" action="index.php">
    <input type="text" name="no" />
    <input type="submit" name="button" value="提交" />
</form>
```
# 2 文件超链接
- 机制：使用`<a>`（某个点）标记的`href`属性来指定要跳转的页面。
- 触发：用户单击该超链接时，浏览器将跳转到`href`属性指定的 URL。
- 语法示例：
```php
<a href="index.php?no=1&name=张三">单击</a>
```