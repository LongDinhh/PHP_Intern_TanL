<?php
function validate($number)
{
    $array = (explode('-', $number));
    if ($number != $array['0'] . '-' . $array['1']) {
        return [
            'code' => 0,
            'message' => 'Khong dung dinh dang'
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
        $number = $_POST['number'];
//            echo $number.'<br>';
//            $array = (explode('-',$number));
//            echo '<br>';
//            echo $array['0'];
        $numberValidate = validate($number);
        $checkValidate = showPrime($number);
        if ($numberValidate['code'] !== 1) {
            echo $numberValidate['message'];
            return;
        }
        echo $checkValidate;
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
    $array = (explode('-', $number));
    $a = $array['0'];
    $b = $array['1'];
    for ($i = $a; $i <= $b; $i++) {
        if (checkPrime($i))
            echo $i, '<br>';
    }
}

?>
<form action="" method="post">
    <input type="text" name="number" value="">
    <input type="submit" name="submit" value="Ket qua">
</form>
<?php
main();
?>
