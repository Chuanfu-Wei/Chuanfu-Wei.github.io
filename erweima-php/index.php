<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>二维码在线生成</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
//set it to writable location, a place for temp generated PNG files
$PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;

//html PNG location prefix
$PNG_WEB_DIR = 'temp/';

include "qrlib.php";

//ofcourse we need rights to create temp dir
if (!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);


$filename = $PNG_TEMP_DIR . 'test.png';

//processing form input
//remember to sanitize user input in real-life solution !!!
$errorCorrectionLevel = 'L';
if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L', 'M', 'Q', 'H')))
    $errorCorrectionLevel = $_REQUEST['level'];

$matrixPointSize = 3;
if (isset($_REQUEST['size']))
    $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


if (isset($_REQUEST['data'])) {

    //it's very important!
    if (trim($_REQUEST['data']) == '')
        die('data cannot be empty! <a href="?">back</a>');

    // user data
    $filename = $PNG_TEMP_DIR . 'test' . md5($_REQUEST['data'] . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
    QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
} else {

    //default data
    QRcode::png('http://www.xfblog.cn/', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
}
?>

<body>
    <div class="layer"></div>
    <main class="page-center">
        <article class="sign-up">
            <h1 class="sign-up__title">二维码在线生成</h1>
            <?php echo '<img src="' . $PNG_WEB_DIR . basename($filename) . '" />'; ?>
            <form class="sign-up-form form" action="ceshi.php" method="post">
                <label class="form-label-wrapper">
                    <p class="form-label">文本或网址</p>
                    <textarea class="form-textarea" name="data" cols="50" rows="5" placeholder="请输入需要转换的*文本*或*网址*；网址请包含传输协议，如：http://www.xfblog.cn/
                        页面刷新即生成二维码成功！" required><?php (isset($_REQUEST['data']) ? htmlspecialchars($_REQUEST['data']) : '默认文字') ?></textarea>
                </label>
                <!-- display generated file -->
                <label class="form-label-wrapper">
                    <p class="form-label">容错级别</p>
                    <select name="level" style="width: 100%;height: 30px;">
                        <option value="L" <?php (($errorCorrectionLevel == 'L') ? ' selected' : '') ?>>L - 最小值</option>
                        <option value="M" <?php (($errorCorrectionLevel == 'M') ? ' selected' : '') ?>>M</option>
                        <option value="Q" <?php (($errorCorrectionLevel == 'Q') ? ' selected' : '') ?>>Q</option>
                        <option value="H" <?php (($errorCorrectionLevel == 'H') ? ' selected' : '') ?>>H - 最大值</option>
                    </select>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">大小</p>
                    <select name="size" style="width: 100%;height: 30px;">
                        <?php for ($i = 1; $i <= 10; $i++)
                            echo '<option value="' . $i . '"' . (($matrixPointSize == $i) ? ' selected' : '') . '>' . $i . '</option>';
                        ?>
                    </select>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">
                        <hr>
                    </p>
                </label>
                <input type="submit" value="生   成" class="form-btn primary-default-btn transparent-btn">
                <!-- benchmark -->
                <?php QRtools::timeBenchmark(); ?>
            </form>
        </article>
    </main>
</body>

</html>