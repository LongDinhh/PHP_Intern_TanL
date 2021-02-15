<?php
function validate($n)
{
    if (!$n > 0) {
        return [
            'code' => 0,
            'message' => 'Phai lon hon khong'
        ];
    }
    if (empty($n)) {
        return [
            'code' => 0,
            'message' => 'Khong duoc de trong'
        ];
    }
    if (!is_numeric($n)) {
        return [
            'code' => 0,
            'message' => 'Phai la so'
        ];
    }
    return [
        'code' => 1,
        'messge' => ''
    ];
}

function main()
{
    if (isset($_POST['submit_1'])) {
        $n = $_POST['number'];
        $numberValidate = validate($n);
        if ($numberValidate['code'] !== 1) {
            echo $numberValidate['message'];
            return;
        }
        $createTbl = createTbl($n);

        echo '<pre>';
//                echo($createTbl);
        var_dump($createTbl);
        echo '</pre>';

    }
    if (isset($_POST['submit_2'])) {
        $n = $_POST['number'];
        $numberValidate = validate($n);
        if ($numberValidate['code'] !== 1) {
            echo $numberValidate['message'];
            return;
        }
        $sliptIntTbl = sliptInttTbl($n);
        echo '<pre>';
//                echo($createTbl);
        var_dump($sliptIntTbl );
        echo '</pre>';
        $slipteStringTbl = sliptStringTbl($n);

        echo '<pre>';
//                echo($createTbl);
        var_dump($slipteStringTbl);
        echo '</pre>';
    }
}

function createTbl($n)
{
    $arr = [];
    for ($j = 0; $j < $n; $j++) {
        if ($int_part = randInt($n)) {
            array_push($arr, $int_part);
        }
        if ($int_part = randString($n)) {
            array_push($arr, $int_part);
        }
    }
    return $arr;

}
function checkLenght($n){
    $copMin = ceil($n / 4);
    $copMax = floor(3 * $n / 4);
    $lenght = mt_rand($copMin, $copMax);
    return [
            'lenght'=>$lenght
    ];

}
function randString($n)
{
    $a = checkLenght($n);
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $index = mt_rand($a['lenght'], strlen($characters) - 1);
    $randomString .= $characters[$index];
    return $randomString;
}

//function randNumber(int $n): int{
//    $min = pow(10,$n - 1);
//    $max = pow(10,$n)-1;
//    $max = min($max,PHP_INT_MAX);
//
//    return mt_rand($min,$max);
//}
function randInt($n)
{
    $a = checkLenght($n);
    $min = pow(10, $a['lenght'] - 1);
    $max = pow(10, $a['lenght']) - 1;
    $max = min($max, PHP_INT_MAX);
    return mt_rand($min, $max);
}

function sliptInttTbl($n)
{
    $arr = [];
    for ($j = 0; $j < $n; $j++) {
        if ($int_part = randInt($n)) {
            array_push($arr, $int_part);
        }
    }
    return $arr;
}

function sliptStringTbl($n)
{
    $arr = [];
    for ($j = 0; $j < $n; $j++) {
        if ($int_part = randString($n)) {
            array_push($arr, $int_part);
        }
    }
    return $arr;
}

?>
<form action="" method="post">
    <table>
        <tr>
            <td>Số N:</td>
            <td>
                <input type="text" name="number" value="">
            </td>
        </tr>
        <tr>
            <input type="submit" name="submit_1" value="Tạo bảng">
            <input type="submit" name="submit_2" value="Chia bảng">
        </tr>
    </table>
</form>
<?php
main();
//echo randString(5);
?>
