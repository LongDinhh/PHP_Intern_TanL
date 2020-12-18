<?php
session_start();
function product(){
    $product = array(
        array('id' => 1,
            'name' => 'Quần',
            'price' => 12000,
            'quantity' => 10,
            'order' => '0',
            'sum' => ''),
        array('id' => 2,
            'name' => 'Áo',
            'price' => 10000,
            'quantity' => 10,
            'order' => '0',
            'sum' => ''),
        array('id' => 3,
            'name' => 'Tất',
            'price' => 11000,
            'quantity' => 10,
            'order' => '0',
            'sum' => ''),
        array('id' => 4,
            'name' => 'Giày',
            'price' => 20000,
            'quantity' => 20,
            'order' => '0',
            'sum' => ''),
        array('id' => 5,
            'name' => 'Dép',
            'price' => 8000,
            'quantity' => 10,
            'order' => '0',
            'sum' => ''),
    );
//    for ($i = 0; $i < count($product); $i++) {
//        $product[$i]['sum'] = $product[$i]['price'] * $product[$i]['order'];
//    }
    return $product;
}
function main(){
    if (isset($_POST['submit'])) {
        $product = product();
        return $product;
    }
    if (isset($_POST['submit_1'])) {
        $product = sapxepGiamprice();
        return $product;
    }
    if (isset($_POST['submit_2'])) {
        $product = sapxepTangprice();
        return $product;
    }
//    if (isset($_POST['submit_3'])) {
//        $product = sapxepGiamorder();
//        return $product;
//    }
//    if (isset($_POST['submit_4'])) {
//        $product = sapxepTangorder();
//        return $product;
//    }
//    if (isset($_POST['submit_5'])) {
//        $product = sapxepTangtongtien();
//        return $product;
//    }
//    if (isset($_POST['submit_6'])) {
//        $product = sapxepGiamtongtien();
//        return $product;
//    }
    $a = validate();
    if (isset($_POST['saveOrder'])) {
        if ($a['code']!==1){
            echo $a['message'];
            return;
        }
        $product = saveOrder();
        return $product;
    }
}
function validate(){
    $product = product();
    $lenght = count($product);
    $numberOrder = $_POST['numberOrder'];
    foreach ($numberOrder as $item) {
        if ($item<0){
            return [
                'code'=>0,
                'message'=>'Phai lon hon khong'
            ];
        }
        for ($i=0;$i<$lenght;$i++){
            if ($item> $product[$i]['quantity']){
                return [
                    'code'=>0,
                    'message'=>'Phai nho hon quantity'
                ];
            }
        }
        return [
            'code'=>1,
            'message'=>''
        ];
    }
}
function saveOrder(){
    $product = product();
    $lenght = count($product);
    $numberOrder = $_POST['numberOrder'];
    for ($i=0;$i<$lenght;$i++){
        $product[$i]['order'] = $numberOrder[$i];

    }
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i]['order'] > $product[$j]['order']) {
                $tg = $product[$i];
                $product[$i] = $product[$j];
                $product[$j] = $tg;
            }
        }
    }
    return $product;
}
function sapxepGiamprice(){
    $product = product();
    $lenght = count($product);
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i]['price'] < $product[$j]['price']) {
                $tg = $product[$i];
                $product[$i] = $product[$j];
                $product[$j] = $tg;
            }
        }
    }
    return $product;
}
function sapxepTangprice(){
    $product = product();
    $lenght = count($product);
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i]['price'] > $product[$j]['price']) {
                $tg = $product[$i];
                $product[$i] = $product[$j];
                $product[$j] = $tg;
            }
        }
    }
    return $product;
}
function sapxepGiamorder(){
    $product = product();
    $lenght = count($product);
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i]['order'] < $product[$j]['order']) {
                $tg = $product[$i];
                $product[$i] = $product[$j];
                $product[$j] = $tg;
            }
        }
    }
    return $product;
}
function sapxepTangorder(){
    $product = product();
    $lenght = count($product);
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i]['order'] > $product[$j]['order']) {
                $tg = $product[$i];
                $product[$i] = $product[$j];
                $product[$j] = $tg;
            }
        }
    }
    return $product;
}
function sapxepTangtongtien(){
    $product = product();
    $lenght = count($product);
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i]['sum'] > $product[$j]['sum']) {
                $tg = $product[$i];
                $product[$i] = $product[$j];
                $product[$j] = $tg;
            }
        }
    }
    return $product;
}
function sapxepGiamtongtien(){
    $product = product();
    $lenght = count($product);
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i]['sum'] < $product[$j]['sum']) {
                $tg = $product[$i];
                $product[$i] = $product[$j];
                $product[$j] = $tg;
            }
        }
    }
    return $product;
}

?>
<head>
    <style>
        td{
            text-align: center;
        }
    </style>
</head>
<form action="" method="post">
    <table border="" cellspacing="0" cellpadding="8">
        <tr>
            <th>Product_id</th>
            <th>Product_name</th>
            <th>Product_price</th>
            <th>Product_quantity</th>
            <th>Product_order</th>
        </tr>
        <?php
        $product = main();
        for ($i = 0; $i < count($product); $i++) {
            echo '<tr>';
            echo '<td>';
            print_r($product[$i]['id']);
            echo '</td>';
            echo '<td>';
            print_r($product[$i]['name']);
            echo '</td>';
            echo '<td>';
            print_r($product[$i]['price']);
            echo '</td>';
            echo '<td>';
            print_r($product[$i]['quantity']);
            echo '</td>';
            echo '<td>';
            echo '<input type="number" name="numberOrder[]" value="'.$product[$i]['order'].'">';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    <input type="submit" name="submit" value="Ban đầu">
    <input type="submit" name="submit_1" value="sapxepGiamprice">
    <input type="submit" name="submit_2" value="sapxepTangprice">
<!--    <input type="submit" name="submit_3" value="sapxepGiamorder">-->
<!--    <input type="submit" name="submit_4" value="sapxepTangorder">-->
<!--    <input type="submit" name="submit_5" value="sapxepTangtongtien">-->
<!--    <input type="submit" name="submit_6" value="sapxepGiamtongtien">-->
    <br>
    <input type="submit" name="saveOrder" value="Lưu Order">

</form>
