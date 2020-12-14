<?php

function validate($a, $b, $c)
{
    if (!is_numeric($a) || $a === 0 || empty($a)) {
        return [
            'code' => 0,
            'message' => 'a phai la so khac khong va khong duoc trong'
        ];
    }
    if (!is_numeric($b) || empty($b)) {
        return [
            'code' => 0,
            'message' => 'b phai la so va khong duoc de trong'
        ];
    }
    if (!is_numeric($c) || empty($c)) {
        return [
            'code' => 0,
            'message' => 'c phai la so va khong duoc de trong'
        ];
    }
    return [
        'code' => 1,
        'message' => ''
    ];
}

function main()
{
    if (isset($_POST['submit'])) {

        $a = $_POST['number_a'];
        $b = $_POST['number_b'];
        $c = $_POST['number_c'];

        //
        $statusValidate = validate($a, $b, $c);


        $deltaValidate = ptb($a, $b, $c);

        if ($statusValidate['code'] !== 1) {
            echo $statusValidate['message'];
            return;
        }
        if ($deltaValidate['number'] === 0) {
            echo $deltaValidate['message'];
            return;
        }
        if ($deltaValidate['number'] === 1) {
            echo $deltaValidate['message'] . '<br>' . 'x1 = ' . $deltaValidate['x1'] . '<br>' . 'x2 = ' . $deltaValidate['x2'];
            return;
        }
        if ($deltaValidate['number'] === 2) {
            echo $deltaValidate['message'] . '<br>' . 'x1 = ' . $deltaValidate['x1'] . '<br>' . 'x2 = ' . $deltaValidate['x2'];
            return;
        }

    }
}

function ptb($a, $b, $c)
{
    $delta = ($b * $b) - (4 * $a * $c);
    if ($delta < 0) {
        return [
            'number' => 0,
            'message' => 'Phuong trinh vo nghiem',
            'x1' => null,
            'x2' => null
        ];
    }
    $x = -$b / (2 * $a);
    if ($delta === 0) {
        return [
            'number' => 1,
            'message' => 'Phuong trinh co nghiem kep',
            'x1' => $x,
            'x2' => $x
        ];
    }
    $x1 = (-$b - sqrt($delta)) / 2 * $a;
    $x2 = (-$b + sqrt($delta)) / 2 * $a;
    if ($delta > 0) {
        return [
            'number' => 2,
            'message' => 'Phuong trinh co 2 nghiem',
            'x1' => $x1,
            'x2' => $x2
        ];
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <table>
        <tr>
            <td>
                Nhap a:
            </td>
            <td>
                <input type="text" name="number_a" value="">
            </td>
        </tr>
        <tr>
            <td>
                Nhap b:
            </td>
            <td>
                <input type="text" name="number_b" value="">
            </td>
        </tr>
        <tr>
            <td>
                Nhap c:
            </td>
            <td>
                <input type="text" name="number_c" value="">
            </td>
        </tr>
        <input type="submit" value="Ket qua" name="submit">
    </table>
</form>
<?php
main();
?>
</body>
</html>
