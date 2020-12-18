<?php
function product(){
    $product = array(
        array('id' => 1,
            'name' => 'Quần',
            'price' => 12000,
            'quantity' => 10,
            'order' => 2,
            'sum' => ''),
        array('id' => 2,
            'name' => 'Áo',
            'price' => 10000,
            'quantity' => 10,
            'order' => 8,
            'sum' => ''),
        array('id' => 3,
            'name' => 'Tất',
            'price' => 11000,
            'quantity' => 10,
            'order' => 2,
            'sum' => ''),
        array('id' => 4,
            'name' => 'Giay',
            'price' => 20000,
            'quantity' => 20,
            'order' => 10,
            'sum' => ''),
        array('id' => 5,
            'name' => 'Dép',
            'price' => 8000,
            'quantity' => 10,
            'order' => 5,
            'sum' => '')

    );
    for ($i = 0; $i < count($product); $i++) {
        $product[$i]['sum'] = $product[$i]['price'] * $product[$i]['order'];
    }
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
    if (isset($_POST['submit_3'])) {
        $product = sapxepGiamorder();
        return $product;
    }
    if (isset($_POST['submit_4'])) {
        $product = sapxepTangorder();
        return $product;
    }
    if (isset($_POST['submit_5'])) {
        $product = sapxepTangtongtien();
        return $product;
    }
    if (isset($_POST['submit_6'])) {
        $product = sapxepGiamtongtien();
        return $product;
    }
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
<form action="" method="post">
    <table cellspacing="0" cellpadding="8">
        <tr>
            <th>Product_id</th>
            <th>Product_name</th>
            <th>Product_price</th>
            <th>Product_quantity</th>
            <th>Product_order</th>
            <th>Product_sum</th>
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
            print_r($product[$i]['order']);
            echo '</td>';
            echo '<td>';
            print_r($product[$i]['sum']);
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>
    <input type="submit" name="submit" value="Ban đầu">
    <input type="submit" name="submit_1" value="sapxepGiamprice">
    <input type="submit" name="submit_2" value="sapxepTangprice">
    <input type="submit" name="submit_3" value="sapxepGiamorder">
    <input type="submit" name="submit_4" value="sapxepTangorder">
    <input type="submit" name="submit_5" value="sapxepTangtongtien">
    <input type="submit" name="submit_6" value="sapxepGiamtongtien">
</form>
