<?php
    function validate($number){

        if ($number != '11-30'){
            return[
                'code'=>0,
                'message'=>'Khong dung dinh dang'
            ];
        }
        return[
            'code'=>1,
            'message'=>''
        ];
    }
    function main(){
        if (isset($_POST['submit'])){
            $number = $_POST['number'];
            $numberValidate = validate($number);
            $checkValidate = show_prime(11,30);
            if($numberValidate['code']!==1){
                echo $numberValidate['message'];
            }else{
                echo $checkValidate;
            }

        }
    }
function check_prime($n)
{
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0){
            return false;
        }
    }
    return true;
}
function show_prime($a, $b){
    for ($i = $a; $i <= $b; $i++){
        if(check_prime($i))
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
