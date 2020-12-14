<?php

function validate($a, $b, $c)
{
    if(!is_numeric($a) && !is_numeric($b) && !is_numeric($c)){
//        $error = "Phai la so";
        return [
            'code' => 0,
            'message' => 'Phai la so'
        ];
    }
    return [
        'code' => 1,
        'message' => ''
    ];
}

function main()
{
    if (isset($_POST['submit'])){

        $a = $_POST['number_a'];
        $b = $_POST['number_b'];
        $c = $_POST['number_c'];
        $statusValidate = validate($a, $b, $c);
        $deltaValidate = ptb($a,$b,$c);
        if ($statusValidate['code'] !== 1) {
            echo $statusValidate['message'];

        } else {
            if($deltaValidate['number']==0){
                echo $deltaValidate['message'];
            }else if($deltaValidate['number']==1){
                echo $deltaValidate['message'].'<br>'.$deltaValidate['x'];
            }else if($deltaValidate['number']==2){
                echo $deltaValidate['message'].'<br>'.$deltaValidate['x1'].'<br>'.$deltaValidate['x2'];
            }
//            echo $deltaValidate['result'];
        }
    }
}

function ptb($a,$b,$c)
{
    if ($a==0){
        return false;
    }
    $delta = ($b * $b) - (4 * $a * $c);
    $x = -$b /(2*$a);
    $x1 = (-$b - sqrt($delta))/2*$a;
    $x2 = (-$b+sqrt($delta))/2*$a;
    if ($delta<0){
        return [
            'number'=>0,
            'message'=>'Phuong trinh vo nghiem'
        ];
//        $result =  "Phuong trinh vo nghiem";
    }else if($delta==0){
        return[
            'number'=>1,
            'x'=>$x,
            'message'=>'Phuong trinh co nghiem kep'
        ];

    }else{
        return[
            'number'=>2,
            'message'=>'Phuong trinh co 2 nghiem',
            'x1'=>$x1,
            'x2'=>$x2
        ];
//        $result = "Phuong trinh co hai nghiem <br> x1 = $x1 <br> x2 = $x2";
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
//    echo "$a.X^2+$b.X+$c==0.<br>";
//    echo $result;
main();
?>
</body>
</html>
