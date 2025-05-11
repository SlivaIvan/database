<?php
require('autoload.php');

$db = new Database('mydatabase.sqlite');

// Таблица которую используем для записи и удаления
$table = 'order_product';

//Установка дата и времени для записи продаж
$date_str = "2025-05-21 15:20:00";
$order_date = date('Y-m-d H:i:s', strtotime($date_str));


//Примеры создания таблиц

$sql = ' id SERIAL PRIMARY KEY,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    client_id INTEGER REFERENCES client(id),
    shop_id INTEGER REFERENCES shop(id)';

$db->createTable('product', $sql);


// Примеры данных запысываемых в таблицу
$dataClient = [
    'name' => 'Петр',
    'phone' => '89016365452',
];

$dataOrder = [
    'shop_id' => 3,
    'client_id' => 2,
    'created_at' => $order_date,
];

$dataOrdedProd = [
    'order_id' => 3,
    'product_id' => 2,
    'quantity' => 1,
    'price_at_order' => 15000,
];

$dataProduct = [
    'name' => 'Пирожки',
    'price' => 2000,
    'count' => 1,
];

$dataShop = [
    'name' => 'Пятёрочка',
    'address' => 'Москва, пр-кт Мира д 18',
];
// Проверка на POST-запрос
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Вставка в базу данных
    $db->insert($table, $data);
    // Редирект, чтобы избежать повторной вставки при обновлении страницы
    header('Location: http://localhost:8000/index.php');
    exit;
}
//Метод удаления из таблицы
//$db->delete($table, 7);

$db->insert('client', $data);
?>

<!-- HTML форма для отправки данных -->
<form method="POST">
    <input type="hidden" name="name" value="Macbook">
    <input type="hidden" name="price" value="150000">
    <input type="hidden" name="count" value="2">
    <button type="submit">Добавить товар</button>
</form>






