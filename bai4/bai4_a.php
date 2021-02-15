<?php
function product()
{
    $product =
        [
            [
                'id' => 1,
                'name' => 'Quần',
                'price' => 12000,
                'quantity' => 10,
                'order' => 2,
                'sum' => ''
            ],
            [
                'id' => 2,
                'name' => 'Áo',
                'price' => 10000,
                'quantity' => 10,
                'order' => 8,
                'sum' => ''
            ],
            [
                'id' => 3,
                'name' => 'Tất',
                'price' => 11000,
                'quantity' => 10,
                'order' => 2,
                'sum' => ''
            ],
            [
                'id' => 4,
                'name' => 'Giày',
                'price' => 20000,
                'quantity' => 20,
                'order' => 10,
                'sum' => ''
            ],
            [
                'id' => 5,
                'name' => 'Dép',
                'price' => 8000,
                'quantity' => 10,
                'order' => 5,
                'sum' => ''
            ]
        ];

    $lenght = count($product);
    for ($i = 0; $i < $lenght; $i++) {
        $product[$i]['sum'] = $product[$i]['price'] * $product[$i]['order'];
    }
    return $product;
}

function main()
{
    $product = product();
    $lenght = count($product);
    if (isset($_POST['submit'])) {
        return $product;
    }
    if (isset($_POST['reductionPrice'])) {
        $product = sapxepgiam($product, $lenght, 'price');
        return $product;
    }
    if (isset($_POST['increasePrice'])) {
        $product = sapxeptang($product, $lenght, 'price');
        return $product;
    }
    if (isset($_POST['reductionOrder'])) {
        $product = sapxepgiam($product, $lenght, 'order');
        return $product;
    }
    if (isset($_POST['increaseOrder'])) {
        $product = sapxeptang($product, $lenght, 'order');
        return $product;
    }
    if (isset($_POST['increaseSum'])) {
        $product = sapxeptang($product, $lenght, 'sum');
        return $product;
    }
    if (isset($_POST['reductionSum'])) {
        $product = sapxepgiam($product, $lenght, 'sum');
        return $product;
    }
}

function sapxepgiam($product, $lenght, $column)
{
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i][$column] < $product[$j][$column]) {
                $tg = $product[$i];
                $product[$i] = $product[$j];
                $product[$j] = $tg;
            }

        }
    }
    return $product;
}

function sapxeptang($product, $lenght, $column)
{
    for ($i = 0; $i < $lenght - 1; $i++) {
        for ($j = $i + 1; $j < $lenght; $j++) {
            if ($product[$i][$column] > $product[$j][$column]) {
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
        td {
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
            <th>Product_sum</th>
        </tr>
        <?php
        $products = main();
        if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td scope="row"><?php echo($product['id']) ?></td>
                    <td><?php echo($product['name']) ?></td>
                    <td><?php echo($product['price']) ?></td>
                    <td><?php echo($product['quantity']) ?></td>
                    <td><?php echo($product['order']) ?></td>
                    <td><?php echo($product['sum']) ?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>
    <input type="submit" name="submit" value="Ban đầu">
    <input type="submit" name="reductionPrice" value="reductionPrice">
    <input type="submit" name="increasePrice" value="increasePrice">
    <input type="submit" name="reductionOrder" value="reductionOrder">
    <input type="submit" name="increaseOrder" value="increaseOrder">
    <input type="submit" name="increaseSum" value="increaseSum">
    <input type="submit" name="reductionSum" value="reductionSum">
</form>
