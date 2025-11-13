# window 对象的子对象

`window`对象（浏览器窗口）包含了多个子对象，这些子对象用于控制网页的不同方面，例如页面内容、URL位置和浏览历史。

# 1 document 子对象
`document`对象代表当前网页页面本身。
- **`bgColor`属性**
    - 功能：用于设置页面背景颜色。
    - 译文：`document.bgColor = "blue";`
- **`fgColor`属性**
    - 功能：用于设置页面前景颜色（通常指文本颜色）。
    - 译文：`document.fgColor = "red";`
- **`title`属性**
    - 功能：用于设置页面的标题（显示在浏览器标签页上）。
    - 译文：`document.title = "与时俱进";`
- **`write`方法**
    - 格式：`document.write(表达式表);`
    - 功能：向页面输出一个或多个表达式的值。
# 2 location 子对象
`location`对象包含有关当前页面 URL（位置）的信息，并可用于导航到新页面。
- `window.location.replace()`方法
```php
window.location.replace("文件名");
```
- 功能：转去执行（加载）指定的网页文件。
# 3 history 子对象
`history`对象包含浏览器的浏览历史，允许脚本在用户的历史记录中前进和后退。
- **`forward`方法**
    - 格式：`window.history.forward();`
    - 功能：前进至当前页面之后访问过的页面，相当于浏览器工具栏上的“前进”按钮。
- **`back`方法**
    - 格式：`window.history.back();`
    - 功能：后退至当前页面之前访问过的页面，相当于浏览器工具栏上的“后退”按钮。
