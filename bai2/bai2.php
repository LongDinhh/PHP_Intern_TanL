<?php
function validate($number)
{
    $array = (explode(',', $number));
    for ($j = 0; $j < count($array); $j++) {
        $array_1 = explode('-', $array[$j]);
        if (!is_numeric($array_1['0']) || !is_numeric($array_1['1'])) {
            return [
                'code' => 0,
                'message' => 'Khong dung dinh dang'
            ];
        }
    }
    return [
        'code' => 1,
        'message' => ''
    ];
}

function main()
{
    if (isset($_POST['submit'])) {
        $number = $_POST['number'];
        $numberValidate = validate($number);

        if ($numberValidate['code'] !== 1) {
            echo $numberValidate['message'];
            return;
        }
        $checkValidate = showPrime($number);

        echo '<pre>';
        print_r($checkValidate);
        echo '</pre>';
    }
}

function checkPrime($n)
{
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}

function showPrime($number)
{
    $array = (explode(',', $number));
    $arr = [];
    for ($j = 0; $j < count($array); $j++) {
        $array_1 = explode('-', $array[$j]);

        $array_1 = array_map('intval', $array_1);

        $a_1 = max($array_1);
        $a_2 = min($array_1);

        for ($i = $a_2; $i <= $a_1; $i++) {
            if (checkPrime($i))
                array_push($arr, $i);
        }
    }
    return ($arr);
}

?>
<form action="" method="post">
    <input type="text" name="number" value="">
    <input type="submit" name="submit" value="Ket qua">
</form>
<?php
main();
?>
