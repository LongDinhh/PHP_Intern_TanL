<?php
session_start();
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
        $_SESSION['arr'] = $createTbl;

    }
    if (isset($_POST['submit_2'])) {
        $a = sliptTbl($_SESSION['arr']);
        echo '<pre>';
//                echo($createTbl);
        var_dump($a[0]);
        echo '</pre>';
        echo '<pre>';
//                echo($createTbl);
        var_dump($a[1]);
        echo '</pre>';
    }
}

function createTbl($n)
{
    $arr = [];
    for ($j = 0; $j < $n; $j++) {
        $number = mt_rand(0,1);
        if ($number ===0  ) {
            array_push($arr,randInt($n) );
        }else{
            array_push($arr,randString($n));
        }

    }
    return $arr;

}
function randString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $copMin = ceil($n / 4);
    $copMax = floor(3 * $n / 4);
    $lenght = mt_rand($copMin, $copMax);
    for ($i=0;$i<$lenght;$i++){
        $randomString .= $characters[mt_rand(0,strlen($characters)-1)];
    }
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
    $characters = '0123456789';
    $randomInt = '';
    $copMin = ceil($n / 4);
    $copMax = floor(3 * $n / 4);
    $lenght = mt_rand($copMin, $copMax);
    for ($i=0;$i<$lenght;$i++){
        $randomInt .= $characters[mt_rand(0,strlen($characters)-1)];
    }
    $randomInt = (int)$randomInt;
    return $randomInt;
}

function sliptTbl($arr){
    $arr_int = [];
    $arr_string = [];
    $lenght = count($arr);
    for ($i=0;$i<$lenght;$i++){
        if (!is_numeric($arr[$i])){
            array_push($arr_int,$arr[$i]);
        }
        else{
            array_push($arr_string,$arr[$i]);
        }
    }
    $arr1 = [$arr_int,$arr_string];
    return $arr1;
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
