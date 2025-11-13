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