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
//                print_r($createTbl);
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
    }
}

function createTbl($n)
{
    $arr = [];
    for ($i = 0; $i < $n; $i++) {
        if ($string_part = randString($i) && $part_int = randInt($i)) {
            return $string_part + $part_int;
        }
    }
    return $arr;
}

function randInt($n)
{
    $strings = [];
//    $numRand = random_int(0, count($strings)-1);
    $start = $n / 4;
    $end = 3 * $n / 4;
    $check1 = '';
    for($i=$start;$i<$end;$i++){
        $numRand = random_int($start, count($strings)-1);
        $check1 .= $strings[$numRand];
    }
    return $check1;
}

function randString($n)
{
    $strings = [];
//    $max = count($strings);
//    $numRand = mt_rand(0, count($strings));
    $start = $n / 4;
    $end = 3 * $n / 4;
    $check = '';
    for($i=$start;$i<$end;$i++){
        $numRand = mt_rand($start, count($strings)-1);
        $check .= $strings[$numRand];
    }
    return $check;

}
function sliptTbl()
{
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
?>
