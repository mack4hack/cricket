<?php
echo phpinfo();
$num = 9;
$num1 = 15;
$num2 = 155;

echo "Str : ".substr('PUNE', 0, 3);

$paddedNum = sprintf("%04d", $num);
echo "<br>4 digit 9 -> ".$paddedNum;

$paddedNum1 = sprintf("%04d", $num1);
echo "<br>4 digit 15 -> ".$paddedNum1;

$paddedNum2 = sprintf("%04d", $num2);
echo "<br>4 digit 155 -> ".$paddedNum2;

$num = 9;
$num1 = 15;
$num2 = 155;

$paddedNum = sprintf("%03d", $num);
echo "<br>3 digit 9 -> ".$paddedNum;

$paddedNum1 = sprintf("%03d", $num1);
echo "<br>3 digit 15 -> ".$paddedNum1;

$paddedNum2 = sprintf("%03d", $num2);
echo "<br>3 digit 155 -> ".$paddedNum2;
       


?>   