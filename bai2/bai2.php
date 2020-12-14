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
//            $array = (explode(',',$number));
//            $array1 = explode('-',$array['0']);
//            $array2 = explode('-',$array['1']);
//            echo '<br>';
//            echo $array1['0'];
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
    $array = (explode(',',$number));
//    echo count($array);
    for ($j=0;$j<count($array);$j++){
        $array_1 = explode('-',$array[$j]);
        $a_1 = $array_1['0'];
        $a_2 = $array_1['1'];
        for ($i = $a_1; $i <= $a_2; $i++) {
            if (checkPrime($i))
                echo $i, '<br>';
        }
    }
//    $array1 = explode('-',$array['0']);
//    $array2 = explode('-',$array['1']);
//    $a = $array1['0'];
//    $b = $array1['1'];
//    for ($i = $a; $i <= $b; $i++) {
//        if (checkPrime($i))
//            echo $i, '<br>';
//    }
//    $c = $array2['0'];
//    $d = $array2['1'];
//    for ($i = $c; $i <= $d; $i++) {
//        if (checkPrime($i))
//            echo $i, '<br>';
//    }
}

?>
<form action="" method="post">
    <input type="text" name="number" value="">
    <input type="submit" name="submit" value="Ket qua">
</form>
<?php
main();
?>
