# window 对象的方法

# 1 alert 方法

- 格式： 
```javascript
window.alert(字符串);
```
- 功能：产生一个对话框，用于显示`字符串`信息，只包含一个“确定”按钮。
# 2 confirm 方法
- 格式： 
```javascript
x = window.confirm(字符串);
```
- 功能：产生一个对话框，含“确定”和“取消”两个按钮。
    - 当单击用户“确定”按钮时，`confirm`方法返回`true` 。
    - 当单击用户“取消”按钮时，返回`false` 。
# 3 prompt 方法
- 格式： 
```php
x = window.prompt(提示信息[, 默认值]);
```
- 功能：产生一个输入框，让用户输入数据用户输入的内容将作为一个字符串返回，并赋予变量`x` 。
# 4 open 方法
- 格式：
```javascript
window.open("网页文件名"[,"窗口名称"][,"窗口风格"]);
```

```javascript
对象名 = window.open(...);
```
- 功能：打开一个新的浏览器窗口，用于指定的网页，并可以返回这个新闻的对象。
- 说明： “窗口风格”选项用于控制新闻的外观，例如`width=n`、`height=n`等，选项间用分隔分隔。
# 5 close 方法
- 格式1： 
```php
window.close();
```
- 功能：关闭当前窗口。
- 格式2： 

```php
窗口对象名.close();
```
- 功能：关闭由`window.open()`返回的指定窗口对象。
# 6 print 方法
- 格式： 
```php
window.print();
```
- 功能：打印当前窗口的内容。
# 7 setTimeout 方法
- 格式：
```php
window.setTimeout("函数名()", 延时时间);
```

```php
对象名 = window.setTimeout(...);
```
- 功能：设置一个计时器，在指定的`延时时间`（单位为毫秒）之后，调用一次指定的函数此方法会返回一个计时器标识（ID），可用于取消计时。
# 8 clearTimeout 方法
- 格式： 
```php
window.clearTimeout(计时器标识);
```
- 功能：清除（取消）由`setTimeout`方法设置的计时器指定标识。