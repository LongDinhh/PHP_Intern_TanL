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
//function isPrimeNumber(){
//    // so nguyen n < 2 khong phai la so nguyen to
////    if ($n < 2) {
////        return false;
////    }
//    // check so nguyen to khi n >= 2
//    $squareRoot = sqrt (30 );
//    for($i = 11; $i <= $squareRoot; $i ++) {
//        if (30 % $i == 0) {
//            return [
//                'i'=>''
//            ];
//        }
//
//    }
//    return [
//        'i'=>$i
//    ];
//
//}
//    function check(){
//        for($i=11;$i<=30;$i++){
//            echo $i;
//            if(30%$i==0){
//                return [
//                    'number'=>0,
//                    'message'=>''
//                ];
//            }
//            return [
//              'number'=>1,
//               'i'=>$i
//            ];
//        }
//    }
?>
<form action="" method="post">
    <input type="text" name="number" value="">
    <input type="submit" name="submit" value="Ket qua">
</form>
<?php
main();
?>
