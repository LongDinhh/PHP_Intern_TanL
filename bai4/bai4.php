<?php
function product()
{

    $product =
        [
            'id' => 1,
            'name' => 'Quần',
            'price' => 12000,
            'quantity' => 10,
            'order' => 2,
            'sum'=>''
        ];
    $product1 =
        [
            'id' => 2,
            'name' => 'Áo',
            'price' => 10000,
            'quantity' => 10,
            'order' => 8,
            'sum'=>''
        ];
    $product2 =
        [
            'id' => 3,
            'name' => 'Tất',
            'price' => 11000,
            'quantity' => 10,
            'order' => 2,
            'sum'=>''
        ];
    $product3 =
        [
            'id' => 4,
            'name' => 'Giay',
            'price' => 20000,
            'quantity' => 20,
            'order' => 10,
            'sum'=>''
        ];
    $product4 =
        [
            'id' => 5,
            'name' => 'Dép',
            'price' => 8000,
            'quantity' => 10,
            'order' => 5,
            'sum'=>''
        ];
    $product5 =
        [
            'id' => 6,
            'name' => 'Balo',
            'price' => 15000,
            'quantity' => 15,
            'order' => 10,
            'sum'=>''
        ];
    $product6 =
        [
            'id' => 7,
            'name' => 'Quần Jean',
            'price' => 5000,
            'quantity' => 5,
            'order' => 2,
            'sum'=>''
        ];
    $product7 =
        [
            'id' => 8,
            'name' => 'Áo cổ lọ',
            'price' => 10000,
            'quantity' => 10,
            'order' => 7,
            'sum'=>''

        ];
    $product8 =
        [
            'id' => 9,
            'name' => 'Tất tay',
            'price' => 3000,
            'quantity' => 30,
            'order' => 15,
            'sum'=>''
        ];
    $product9 =
        [
            'id' => 10,
            'name' => 'Giay cao got',
            'price' => 20000,
            'quantity' => 20,
            'order' => 10,
            'sum'=>''
        ];

    $arr = [$product, $product1, $product2, $product3, $product4, $product5, $product6, $product7, $product8, $product9];
    for ($k=0;$k<count($arr);$k++){
        $arr[$k]['sum'] = $arr[$k]['price'] * $arr[$k]['order'];
    }
    return $arr;
}
function main()
{
    echo '<pre>';
    print_r(product());
    echo '</pre>';
    if (isset($_POST['sapxepGiam'])) {
        echo "Giảm theo price.<br>";
        echo '<pre>';
        print_r(sapxepGiamprice());
        echo '</pre>';
        echo "Giảm theo order.<br>";
        echo '<pre>';
        print_r(sapxepGiamorder());
        echo '</pre>';
    }
    if (isset($_POST['sapxepTang'])) {
        echo "Tang theo price.<br>";
        echo '<pre>';
        print_r(sapxepTangprice());
        echo '</pre>';
        echo "Tang theo order.<br>";
        echo '<pre>';
        print_r(sapxepTangorder());
        echo '</pre>';
    }
//    if (isset($_POST['sapxepTientang'])) {
//        echo "Tang theo tong tien.<br>";
//        echo '<pre>';
//        print_r(tongtienTang());
//        echo '</pre>';
//    }
//    if (isset($_POST['sapxepTiengiam'])) {
//        echo "Giam theo tong tien.<br>";
//        echo '<pre>';
//        print_r(tongtienGiam());
//        echo '</pre>';
//    }
}

function sapxepGiamprice()
{
    $b = product();
    $lenght1 = count($b);
    $arr = [];
    for ($i = 0; $i < $lenght1 - 1; $i++) {
        for ($j = $i + 1; $j < $lenght1; $j++) {
            if ($b[$i]['price'] < $b[$j]['price']) {
                $tg = $b[$i]['price'];
                $b[$i]['price'] = $b[$j]['price'];
                $b[$j]['price'] = $tg;
            }
        }
    }
    return $b;
}
function sapxepTangprice()
{
    $b = product();
    $lenght1 = count($b);
    $arr = [];
    for ($i = 0; $i < $lenght1 - 1; $i++) {
        for ($j = $i + 1; $j < $lenght1; $j++) {
            if ($b[$i]['price'] > $b[$j]['price']) {
                $tg = $b[$i]['price'];
                $b[$i]['price'] = $b[$j]['price'];
                $b[$j]['price'] = $tg;
            }
        }
    }
    return $b;
}
function sapxepGiamorder()
{
    $b = product();
    $lenght1 = count($b);
    for ($i = 0; $i < $lenght1 - 1; $i++) {
        for ($j = $i + 1; $j < $lenght1; $j++) {
            if ($b[$i]['order'] < $b[$j]['order']) {
                $tg = $b[$i]['order'];
                $b[$i]['order'] = $b[$j]['order'];
                $b[$j]['order'] = $tg;
            }
        }
    }
    return $b;
}
function sapxepTangorder()
{
    $b = product();
    $lenght1 = count($b);
    for ($i = 0; $i < $lenght1 - 1; $i++) {
        for ($j = $i + 1; $j < $lenght1; $j++) {
            if ($b[$i]['order'] > $b[$j]['order']) {
                $tg = $b[$i]['order'];
                $b[$i]['order'] = $b[$j]['order'];
                $b[$j]['order'] = $tg;
            }
        }
    }
    return $b;
}
//function tongtienGiam(){
//    $b = product();
//    $lenght1 = count($b);
//    for ($i=0;$i<$lenght1-1;$i++){
//        for ($j=$i+1;$j<$lenght1;$j++){
//            if ( $b[$i]['tongtien'] <  $b[$j]['tongtien']){
//                $tg = $b[$i]['tongtien'];
//                $b[$i]['tongtien'] = $b[$j]['tongtien'];
//                $b[$j]['tongtien'] = $tg;
//            }
//        }
//    }
//    return $b;
//
//}
function tongtienTang(){
    $b = product();
    $lenght1 = count($b);
    for ($i=0;$i<$lenght1-1;$i++){
        for ($j=$i+1;$j<$lenght1;$j++){
            if ( $b[$i]['sum'] <  $b[$j]['sum']){
                $tg = $b[$i]['sum'];
                $b[$i]['sum'] = $b[$j]['sum'];
                $b[$j]['sum'] = $tg;
            }
        }
    }
    return $b;

}
?>
<?php
//main();

echo '<pre>';
print_r(tongtienTang());
echo '</pre>';

?>
<form action="" method="post">
    <input type="submit" name="sapxepTang" value="Sắp xếp price, order tăng">
    <input type="submit" name="sapxepGiam" value="Sắp xếp price, order giảm">
    <input type="submit" name="sapxepTientang" value="Sắp xếp tổng tiền tăng">
    <input type="submit" name="sapxepTiengiam" value="Sắp xếp tổng tiền giảm">
</form>
