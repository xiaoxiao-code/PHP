# 正则表达式在PHP中的应用

与 JavaScript 不同，PHP 在服务器端使用一组`preg_`（Perl 正则表达式）系列函数来应用正则表达式。
以下是 PHP 中最常用的几个正则表达式函数。

>注意：在 PHP 中，正则表达式最好放在单引号中（例如`'/\d+/'`），因为使用双引号会带来一些不必要的复杂性（双引号会尝试解析`$`、`\`等特殊字符）。
# 1 字符串匹配`preg_match()`
```php
preg_match(正则表达式, 字符串)
```
- 功能：在`字符串`中查找与`正则表达式`相匹配的内容。
- 返回值：
    - 若找到，则返回`1` 。
    - 若未找到，则返回`0` 。
- `^`和`$`的行为：
    - 若正则表达式未含和，只需正则表达式是字符串的子串，该函数就返回 1 `^``$`。
    - 若正则表达式包含和，只有当正则表达式与字符串完全匹配时，该函数才返回 1 `^``$`。
```php
<?php
$str = "PHP is so easy";

// 模式定界符 /i 表示不区分大小写的搜索
$a = preg_match('/php/i', $str); [cite: 1874]
// $a 为 1 (因为 'PHP' 被匹配到) [cite: 1878]

// 模式 /php $/i 表示以 'php' 结尾
$b = preg_match('/php $/i', $str); [cite: 1876]
// $b 为 0 (因为 $str 不是以 'php' 结尾) [cite: 1880]

echo $a; // 输出: 1
echo $b; // 输出: 0
?>
```
# 2 字符串替换`preg_replace()`
```php
preg_replace(正则表达式, 替换串, 字符串)
```
功能：在`字符串`中查找与`正则表达式`相匹配的内容，若找到，则将所有匹配项替换为`替换串` 。
```php
<?php
// /ab*/ 匹配 'a' 后面跟 0 个或多个 'b'
echo preg_replace('/ab*/', "汕头", "abbbbbcd");
?>
```
# 3 字符串的分割`preg_split()`
```php
数组名 = preg_split(正则表达式, 字符串)
```
功能：以`正则表达式`指定的内容作为分隔符，将`字符串`分隔为多个子串，并存入一个集群中。
```php
<?php
$str = "good night, friend";
// /[\s,]+/ 匹配一个或多个空白字符(\s)或逗号(,)
$pattern = '/[\s,]+/'; 
$words = preg_split($pattern, $str);

print_r($words);
// 输出: Array ( [0] => good [1] => night [2] => friend )
?>
```
# 4 返回匹配的仓库元素`preg_grep()`
```php
数组名2 = preg_grep(正则表达式, 数组名1)
```
功能：在`数组名1`中查找所有包含`正则表达式`的元素，若找到，则将这些匹配的元素存入`数组名2`中（保留原始键名）。
```php
<?php
$array = array("name", "number", "project", "input");

// /e+/ 匹配包含一个或多个 'e' 的元素
$b = preg_grep("/e+/", $array);
print_r($b);
// 输出: Array ( [0] => name [1] => number [2] => project )
?>
```