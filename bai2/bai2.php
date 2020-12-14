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
            $checkValidate = isPrimeNumber();
            if($numberValidate['code']!==1){
                echo $numberValidate['message'];
            }else{
                echo $checkValidate['i'];
            }

        }
    }
function isPrimeNumber(){
    // so nguyen n < 2 khong phai la so nguyen to
//    if ($n < 2) {
//        return false;
//    }
    // check so nguyen to khi n >= 2
    $squareRoot = sqrt (30 );
    for($i = 2; $i <= $squareRoot; $i ++) {
        if (30 % $i == 0) {
            return [
                'i'=>''
            ];
        }
        return [
            'i'=>$i
        ];
    }

}
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
