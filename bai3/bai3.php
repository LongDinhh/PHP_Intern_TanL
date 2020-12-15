<?php
function validate($n){
    if (empty($n)){
        return [
            'code'=>0,
            'message'=>'Khong duoc de'
        ];
    }
    if (!is_numeric($n)){
        return [
            'code'=>0,
            'message'=>'Phai la so'
        ];
    }
    return [
        'code'=>1,
        'messge'=>''
    ];
}
function main(){
    if (isset($_POST['submit_1'])){
        $n = $_POST['number'];
        $numberValidate = validate($n);
        if ($numberValidate['code']!==1){
            echo $numberValidate['message'];
        }
        $createTbl = createTbl($n);

//        print_r($createTbl);
        var_dump($createTbl);

    }
    if (isset($_POST['submit_2'])){
        $n = $_POST['number'];
        echo $n;
        $numberValidate = validate($n);
        if ($numberValidate['code']!==1){
            echo $numberValidate['message'];
        }

    }
}
function createTbl($n){
    $arr = [];
    $arr2= [];
    $start = $n / 4;
    $end = 3*$n / 4;
    for ($i=$start;$i<$end;$i++){
//        array_push($arr,$i);
        array_push($arr,$i);
        $rand = array_rand($arr);
        array_push($arr2,$rand);
    }
    return $arr2;
}
function sliptTbl(){
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
