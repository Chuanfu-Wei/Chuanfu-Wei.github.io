<?php

$all = [$_POST["stuid"], $_POST["sex"], $_POST["nation"], $_POST["idcard"], $_POST["birth"], $_POST["home"], $_POST["phone"], $_POST["class"]];

// ******************校验身份证号*******************开始

function idcard($idcard)
{
    $arr1 = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
    $arr2 = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
    $sum = 0;

    for ($i = 0; $i < strlen($idcard) - 1; $i++) {
        $sum += $idcard[$i] * $arr1[$i];
    }

    $result = $sum % 11;
    if ($idcard[strlen($idcard) - 1] == $arr2[$result]) {
        return true;
    }
    return false;
}

// ******************校验身份证号*******************结束



// ******************通过身份证验证出生日期和性别*******************开始

function checkbs($idcard, $birth, $sex)
{
    $age = substr($idcard, 6, 8);
    $s = null;
    if (substr($idcard, 16, 1) % 2 == 1) {
        $s = "男";
    } else {
        $s = "女";
    }
    if ($age == $birth && $s == $sex) {
        return true;
    }
    return false;
}

// ******************通过身份证验证出生日期和性别*******************结束



// ******************验证所有输入是否为空*******************开始

function tri($arr)
{
    $mark = 1;
    for ($i = 0; $i < 8; $i++) {
        if (trim($arr[$i]) == null) {
            $mark = 0;
        }
    }
    if ($mark == 0) {
        return false;
    }
    return true;
}

// ******************只要有一个空就返回false，否则返回true*******************结束



// ******************校验学号*******************开始

function stuid($stuid)
{
    if (is_numeric($stuid) && strlen($stuid) == 9) {
        return true;
    }
    return false;
}

// ******************校验学号*******************结束



// *********************调试代码***********************
echo stuid($all[0]);
echo checkbs($all[3], $all[4], $all[1]);
echo idcard($all[3]);
echo tri($all);
