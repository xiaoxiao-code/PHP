# URL编码与解码

如果URL参数中含有汉字，为防止在发货过程中出现乱码，就需要对URL进行编码。

# 1 URL编码
- 定义：编码就是将URL中除字母、数字、、、`_`之外的所有字符（如、、空格、汉字）都替换为一个以开头后跟2位十六进制数的3位字符串`-``.``/``:``%`。
- 函数： `urlencode(URL)`
```php
<?php
$url = "http://www.php.net";
echo urlencode($url);

// 输出: "http%3A%2F%2Fwww.php.net"
// (":" 被编码为 %3A, "/" 被编码为 %2F)
?>
```
# 2 URL解码
- 定义： URL编码后，在接收端需要使用解码函数将其还原。
- 函数： `urldecode(URL)`
- 功能：将URL中所有以`%`开头后跟2位十六进制数的3位字符串进行解码，并返回解码后的字符串。
```php
<?php
$url = "http%3A%2F%2Fwww.php.net";
echo urldecode($url);

// 输出: "http://www.php.net"
?>
```