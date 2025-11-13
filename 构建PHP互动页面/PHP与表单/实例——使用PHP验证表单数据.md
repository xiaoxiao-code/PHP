# 实例——使用PHP验证表单数据

# 1 核心思想：同页提交与服务器端验证

1. 表单 ( `EX5-1a.php`)：包含HTML表单，其`action`属性指向它自己（`action="EX5-1a.php"`）。
2. PHP逻辑（在`EX5-1a.php`顶部）：包含PHP脚本，用于检查表单是否被提交。
3. 错误显示：在 HTML 表单的每个输入框旁边，都有一段 PHP 代码（例如）`<?php echo @$XH1; ?>`，用于显示对应的错误信息。
4. 成功页面 ( `EX5-1b.php`)：仅在所有验证都通过后，才跳转到此页面。
# 2 PHP 脚本验证表单数据的步骤
以下是`EX5-1a.php`文件中PHP脚本的主要逻辑和步骤：
## 2.1 设置“哨兵”检查
所有验证逻辑都必须放在一个`if`语句块中，该语句用于检查表单是否已被提交。
```php
<?php
// 检查 "BUTTON1"（提交按钮的 name）是否存在
if (isset($_REQUEST["BUTTONI"]))
{
    // 只有当用户点击提交后，这里的代码才会执行
    // ... 验证逻辑 ...
}
?>
```
## 2.2 设置验证标志
在`if`语句块内部，首先定义一个“标志”变量，用于跟踪验证是否成功。
```php
$test = 1; // 1 表示通过，0 表示失败
```
## 2.3 获取并验证数据
接下来，从`$_REQUEST`(或`$_POST`)中获取每个表单的值，并逐一进行验证。如果验证失败，就设置错误信息标记，并将`$test`标记设为状态`0`。
### 2.3.1 验证“学号”（空值检查+正则表达式）
```php
$XH = $_REQUEST["XH"];
if ($XH == "") {
    $XH1 = "必须输入学号!"; // 设置错误信息
    $test = 0; // 标记验证失败
} elseif (preg_match('/^\d{6}$/', $XH) == 0) { 
    $XH1 = "学号必须为6位数字!"; 
    $test = 0;
}
```
### 2.3.2 验证“姓名”（空值检查）
```php
$XM = $_REQUEST["XM"];
if ($XM == "") {
    $XM1 = "必须输入姓名!";
    $test = 0;
}
```
### 2.3.3 验证“性别”（单选按钮）
```php
// @ 符号用于抑制错误，防止在未选择时产生 "Undefined index" 提示
$XB = @$_REQUEST["SEX"]; 
if ($XB == "") {
    $XB1 = "必须选择性别!";
    $test = 0;
}
```
### 2.3.4 验证“出生日期”（空值检查 + 复杂正则）
```php
$CSSJ = $_REQUEST["Birthday"];
// 检查 yyyy-mm-dd 格式的正则表达式
$checkbirthday = preg_match('/^\d{4}-(0?\d|1?[012])-(0?\d|[12]\d|3[01])$/', $CSSJ);
if ($CSSJ == "") {
    $CSSJ1 = "必须输入日期!";
    $test = 0;
} elseif ($checkbirthday == 0) { 
    $CSSJ1 = "日期必须为yyyy-mm-dd!";
    $test = 0;
}
```
### 2.3.5 验证“兴趣”（复选框广场）
```php
$XQ = @$_REQUEST["XQ"]; // $XQ 是一个数组 
if (count($XQ) == 0) { // 
    $XQ1 = "必须选择兴趣!";
    $test = 0;
}
```
## 2.4 根据验证结果进行跳转
在所有验证检查之后，检查`$test`标志的值。
```php
if ($test == 1) {
    // 验证全部通过
    
    // 如果有数组（如复选框），先将其转换为字符串
    $XQ2 = implode(",", $XQ); 
    
    // 使用 header() 函数实现页面跳转到 EX5-1b.php 
    header("Location: EX5-1b.php?XH=$XH&XM=$XM&SEX=$XB&XQ=$XQ2");
}
// 如果 $test == 0，脚本会继续向下执行，
// PHP 将重新渲染 EX5-1a.php 的 HTML，
// 此时 $XH1, $XM1 等错误信息变量会被 echo 语句显示在表单旁。
```
# 3 EX5-1a.php
```php
<?php
// PHP 脚本验证逻辑
if (isset($_POST["BUTTONI"])) {
    $test = 1; // 验证标志

    // 1. 获取所有表单数据
    $XH = isset($_POST["XH"]) ? $_POST["XH"] : "";
    $XM = isset($_POST["XM"]) ? $_POST["XM"] : "";
    $XB = isset($_POST["SEX"]) ? $_POST["SEX"] : "";
    $CSSJ = isset($_POST["Birthday"]) ? $_POST["Birthday"] : "";
    $ZY = isset($_POST["ZY"]) ? $_POST["ZY"] : "";
    $BZ = isset($_POST["BZ"]) ? $_POST["BZ"] : "";
    $XQ = isset($_POST["XQ"]) ? $_POST["XQ"] : array();

    // 2. 验证 "学号" (非空 和 6位数字)
    if ($XH == "") {
        $XH1 = "必须输入学号!";
        $test = 0;
    } elseif (!preg_match('/^\d{6}$/', $XH)) {
        $XH1 = "学号必须为6位数字!";
        $test = 0;
    }

    // 3. 验证 "姓名" (非空)
    if ($XM == "") {
        $XM1 = "必须输入姓名!";
        $test = 0;
    }

    // 4. 验证 "性别" (非空)
    if ($XB == "") {
        $XB1 = "必须选择性别!";
        $test = 0;
    }

    // 5. 验证 "出生日期" (非空 和 yyyy-mm-dd 格式)
    $checkbirthday = preg_match('/^\d{4}-(0?[1-9]|1[0-2])-(0?[1-9]|[12]\d|3[01])$/', $CSSJ);
    if ($CSSJ == "") {
        $CSSJ1 = "必须输入日期!";
        $test = 0;
    } elseif (!$checkbirthday) {
        $CSSJ1 = "日期必须为yyyy-mm-dd格式!";
        $test = 0;
    }

    // 6. 验证 "所学专业" (非空)
    if ($ZY == "") {
        $ZY1 = "必须选择专业!";
        $test = 0;
    }

    // 7. 验证 "兴趣" (至少选一个)
    if (count($XQ) == 0) {
        $XQ1 = "必须选择兴趣!";
        $test = 0;
    }

    // 8. 检查最终验证标志
    if ($test == 1) {
        // 全部通过，将数组转换为字符串
        $XQ2 = implode(",", $XQ);
        
        // 构建URL参数
        $params = http_build_query(array(
            'XH' => $XH,
            'XM' => $XM,
            'SEX' => $XB,
            'Birthday' => $CSSJ,
            'ZY' => $ZY,
            'BZ' => $BZ,
            'XQ' => $XQ2
        ));
        
        // 使用 header() 跳转到成功页面
        header("Location: EX5-1b.php?" . $params);
        exit; // 跳转后立即停止脚本
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>学生个人信息</title>
    <style type="text/css">
        table { width: 400px; margin: 0 auto; background: #CCFFCC; }
        div { text-align: center; }
        /* 用于显示错误信息 */
        .error { color: red; font-size: 0.9em; }
        textarea { width: 95%; height: 60px; }
    </style>
</head>
<body>

    <form method="post" action="">
        <table width="720" border="1" cellspacing="0">
            <tr>
                <td height="25" colspan="2"><div>学生个人信息</div></td>
            </tr>
            <tr>
                <td width="180" height="25" align="center">学号:</td>
                <td width="540" height="25">
                    <input name="XH" type="text" value="<?php echo htmlspecialchars($XH ?? ''); ?>"> 
                    &nbsp; <span class="error"><?php echo $XH1 ?? ''; ?></span>
                </td>
            </tr>
            <tr>
                <td width="180" height="25" align="center">姓名:</td>
                <td width="540" height="25">
                    <input name="XM" type="text" value="<?php echo htmlspecialchars($XM ?? ''); ?>">
                    &nbsp; <span class="error"><?php echo $XM1 ?? ''; ?></span>
                </td>
            </tr>
            <tr>
                <td width="180" height="25" align="center">性别:</td>
                <td width="540" height="25">
                    <input name="SEX" type="radio" value="男" <?php if (($XB ?? '') == '男') echo 'checked'; ?>>男
                    <input name="SEX" type="radio" value="女" <?php if (($XB ?? '') == '女') echo 'checked'; ?>>女
                    &nbsp; <span class="error"><?php echo $XB1 ?? ''; ?></span>
                </td>
            </tr>
            <tr>
                <td width="180" height="25" align="center">出生日期:</td>
                <td width="540" height="25">
                    <input name="Birthday" type="text" value="<?php echo htmlspecialchars($CSSJ ?? ''); ?>">
                    &nbsp; <span class="error"><?php echo $CSSJ1 ?? ''; ?></span>
                </td>
            </tr>
            <tr>
                <td width="180" height="25" align="center">所学专业:</td>
                <td width="540" height="25">
                    <select name="ZY">
                        <option value="">请选择专业</option>
                        <option value="计算机科学与技术" <?php if (($ZY ?? '') == '计算机科学与技术') echo 'selected'; ?>>计算机科学与技术</option>
                        <option value="网络工程" <?php if (($ZY ?? '') == '网络工程') echo 'selected'; ?>>网络工程</option>
                        <option value="软件工程" <?php if (($ZY ?? '') == '软件工程') echo 'selected'; ?>>软件工程</option>
                    </select>
                    &nbsp; <span class="error"><?php echo $ZY1 ?? ''; ?></span>
                </td>
            </tr>
            <tr>
                <td width="180" height="25" align="center">备注:</td>
                <td width="540" height="25">
                    <textarea name="BZ"><?php echo htmlspecialchars($BZ ?? ''); ?></textarea>
                </td>
            </tr>
            <tr>
                <td width="180" height="25" align="center">兴趣:</td>
                <td width="540" height="25">
                    <input name="XQ[]" type="checkbox" value="游泳" <?php if (isset($XQ) && in_array('游泳', $XQ)) echo 'checked'; ?>>游泳
                    <input name="XQ[]" type="checkbox" value="看电视" <?php if (isset($XQ) && in_array('看电视', $XQ)) echo 'checked'; ?>>看电视
                    <input name="XQ[]" type="checkbox" value="上网" <?php if (isset($XQ) && in_array('上网', $XQ)) echo 'checked'; ?>>上网
                    &nbsp; <span class="error"><?php echo $XQ1 ?? ''; ?></span>
                </td>
            </tr>
            <tr>
                <td height="25" colspan="2" align="center">
                    <input type="submit" name="BUTTONI" value="提交">
                    <input type="reset" name="BUTTON2" value="重置">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
```
# 4 EX5-1b.php
```php
<?php
// 1. 安全获取通过 URL (GET) 传递过来的数据
$XH = isset($_GET["XH"]) ? htmlspecialchars($_GET["XH"]) : '';
$XM = isset($_GET["XM"]) ? htmlspecialchars($_GET["XM"]) : '';
$XB = isset($_GET["SEX"]) ? htmlspecialchars($_GET["SEX"]) : '';
$CSSJ = isset($_GET["Birthday"]) ? htmlspecialchars($_GET["Birthday"]) : '';
$ZY = isset($_GET["ZY"]) ? htmlspecialchars($_GET["ZY"]) : '';
$BZ = isset($_GET["BZ"]) ? htmlspecialchars($_GET["BZ"]) : '';
$XQ = isset($_GET["XQ"]) ? htmlspecialchars($_GET["XQ"]) : '';

// 2. 验证必要字段是否存在（可选，根据需求）
if (empty($XH) || empty($XM)) {
    // 可以添加重定向回表单页面的逻辑
    // header("Location: EX5-1a.php");
    // exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>学生信息确认</title>
    <style>
        /* 使用与 EX5-1a.php 相同的表格样式 */
        table { 
            width: 400px; 
            margin: 20px auto; 
            background: #CCFFCC; 
            border-collapse: collapse; 
            font-family: sans-serif;
        }
        td { 
            border: 1px solid #999; 
            height: 30px; 
            padding: 5px;
        }
        .label { 
            width: 150px; 
            text-align: center; 
            font-weight: bold;
            background: #e0ffe0;
        }
        .value { 
            padding-left: 10px; 
            background: white;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            text-align: center;
            margin-top: 20px;
        }
        .back-btn {
            padding: 8px 16px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .back-btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <h1>学生信息确认</h1>
    
    <table>
        <tr>
            <td class="label">学号</td>
            <td class="value"><?php echo $XH; ?></td>
        </tr>
        <tr>
            <td class="label">姓名</td>
            <td class="value"><?php echo $XM; ?></td>
        </tr>
        <tr>
            <td class="label">性别</td>
            <td class="value"><?php echo $XB; ?></td>
        </tr>
        <tr>
            <td class="label">出生日期</td>
            <td class="value"><?php echo $CSSJ; ?></td>
        </tr>
        <tr>
            <td class="label">所学专业</td>
            <td class="value"><?php echo $ZY; ?></td>
        </tr>
        <tr>
            <td class="label">备注</td>
            <td class="value"><?php echo !empty($BZ) ? $BZ : '无'; ?></td>
        </tr>
        <tr>
            <td class="label">兴趣</td>
            <td class="value"><?php echo !empty($XQ) ? $XQ : '无'; ?></td>
        </tr>
    </table>
    
    <div class="container">
        <button class="back-btn" onclick="window.history.back()">返回修改</button>
        <button class="back-btn" onclick="window.print()">打印信息</button>
    </div>
</body>
</html>
```