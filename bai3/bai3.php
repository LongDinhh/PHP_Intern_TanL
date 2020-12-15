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
    $start = $n / 4;
    $end = 3 * $n / 4;
    for ($i = $start; $i < $end; $i++) {
        if ($string_part = randString($i) && $int_part = randInt($i)) {
            return $string_part + $int_part;
        }
    }
//    return $arr;
}

function randInt($n)
{
    $arr = [];
    for ($i = 0; $i < $n; $i++) {
        array_push($arr, $i);
        $rand = array_rand($arr);
    }
    return $arr[$rand];
}

function randString($n)
{
    $arr1 = [];
    for ($i = 0; $i < $n; $i++) {
        array_push($arr1, $i);
        $array_1 = array_map('strval', $arr1);
        $rand = array_rand($array_1);
    }
    return $array_1[$rand];
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
