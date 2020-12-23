<?php
session_start();
function product()
{
    $product =
        [
            [
                'id' => 1,
                'name' => 'Quần',
                'price' => 12000,
                'quantity' => 10,
                'order' => '',
            ],
            [
                'id' => 2,
                'name' => 'Áo',
                'price' => 10000,
                'quantity' => 10,
                'order' => '',
            ],
            [
                'id' => 3,
                'name' => 'Tất',
                'price' => 11000,
                'quantity' => 10,
                'order' => '',
            ],
            [
                'id' => 4,
                'name' => 'Giày',
                'price' => 20000,
                'quantity' => 20,
                'order' => '',
            ],
            [
                'id' => 5,
                'name' => 'Dép',
                'price' => 8000,
                'quantity' => 10,
                'order' => '',
            ]
        ];

    return $product;
}
function validate($product,$lenght,$numberOrder){
    for ($i=0;$i<$lenght;$i++){
        if(!isset($numberOrder[$product[$i]['id']])){
            return [
                'code'=>0,
                'message'=>'Không tồn tại'
            ];
        }
        if ($numberOrder[$product[$i]['id']]<0){
            return [
                'code'=>0,
                'message'=>'Phai lon hon khong'
            ];
        }
        if ($numberOrder[$product[$i]['id']] > $product[$i]['quantity']){
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
function main(){
    $product = product();
    $lenght = count($product);
    if (isset($_POST['submit'])) {
        return $product;
    }
    if (isset($_POST['clickOrder'])) {
        $numberOrder = $_POST['numberOrder'];
        $a = validate($product,$lenght,$numberOrder);
        if ($a['code']!==1){
            echo $a['message'];
            return $product;
        }
        $product  = clickOrder($product,$lenght,$numberOrder);
        return $product;
    }

}

function saveOrder($product,$lenght,$numberOrder){
    for ($i=0;$i<$lenght;$i++){
        if (isset($numberOrder[$product[$i]['id']])){
            $product[$i]['order'] = $numberOrder[$product[$i]['id']];
        }
    }
    return $product;
}

function clickOrder($product,$lenght,$numberOrder){
    $product = saveOrder($product,$lenght,$numberOrder);
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i]['order'] > $product[$j]['order']) {
                $tg = $product[$i];
                $product[$i] = $product[$j];
                $product[$j] = $tg;
            }
            if ($product[$i]['order'] === $product[$j]['order'] && $product[$i]['id'] > $product[$j]['id']) {
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
        $products = main();
        if(!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td scope="row"><?php echo($product['id']) ?></td>
                    <td><?php echo($product['name']) ?></td>
                    <td><?php echo($product['price']) ?></td>
                    <td><?php echo($product['quantity']) ?></td>
                    <td>
                        <input type="number" name="<?php echo 'numberOrder['.$product['id'].']' ?>" value="<?php echo ($product['order'])?>">
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>
    <input type="submit" name="submit" value="Ban đầu">
    <br>
    <!--    <input type="submit" name="saveOrder" value="Lưu Order">-->
    <input type="submit" name="clickOrder" value="Sắp xếp Order">

</form>