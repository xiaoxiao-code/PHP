# 解析URL

在PHP中，可以使用`parse_url()`函数来解析一个URL，将其划分为各个组成部分。

# 1 将URL解析为备份
```php
数组名 = parse_url(URL)
```
- 功能：将URL的各个组成部分（如协议、主机、路径、查询参数等）分开，并分别存入一个关联阵列中。
- URL的组成部分包括：
    - `scheme`(协议，如http)
    - `host`（主机，如 www.php.net）
    - `port`(端口号)
    - `user`(用户名)
    - `pass`（密码）
    - `path`(路径,如/index.php)
    - `query`(查询字符串,在问号?后面的内容)
    - `fragment`（片段，在井号#后续的内容）
```php
<?php
$url = "http://username:password@www.php.net/index.php?arg=value#anchor";

// 将 URL 解析到数组 $a 中
$a = parse_url($url);

print_r($a);
/*
输出:
Array
(
    [scheme] => http
    [host] => www.php.net
    [user] => username
    [pass] => password
    [path] => /index.php
    [query] => arg=value
    [fragment] => anchor
)
*/
?>
```
# 2 获取URL的特定组成部分
```php
变量名 = parse_url(URL, 参数)
```
- 功能：仅获取URL中的某个指定部分。
- **`参数`**：使用 PHP 预定义的常量来指定需要的部分，例如：
    - `PHP_URL_SCHEME`
    - `PHP_URL_HOST`
    - `PHP_URL_PATH`
    - `PHP_URL_QUERY`
    - `PHP_URL_FRAGMENT`
    - (以及`PHP_URL_PORT`,, `PHP_URL_USER`)`PHP_URL_PASS`
```php
<?php
$url = "http://username:password@www.php.net/index.php?arg=value#anchor";

// 仅获取 URL 中的 "path" (路径) 部分
$a = parse_url($url, PHP_URL_PATH);

echo $a;
// 输出: "/index.php"
?>
```