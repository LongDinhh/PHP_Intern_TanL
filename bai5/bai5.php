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
//    $lenght = count($product);
//    for ($i = 0; $i < $lenght; $i++) {
//        $product[$i]['sum'] = $product[$i]['price'] * $product[$i]['order'];
//    }
    return $product;
}
function validate($numberOrder ){
    $product = product();
    $lenght = count($product);
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
function main(){
    if (isset($_POST['submit'])) {
        $product = product();
        return $product;
    }
    if (isset($_POST['saveOrder'])) {
        $numberOrder = $_POST['numberOrder'];
        $a = validate($numberOrder );
        if ($a['code']!==1){
            echo $a['message'];
            return;
        }
        $product = saveOrder($numberOrder );
        return $product;
    }
}

function saveOrder($numberOrder ){
    $product = product();
    $lenght = count($product);
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
        $lenght = count($product);
        for ($i = 0; $i < $lenght; $i++) {
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
    <br>
    <input type="submit" name="saveOrder" value="Lưu Order">

</form>
