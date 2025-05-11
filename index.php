<?php
require('autoload.php');

$db = new Database('mydatabase.sqlite');

// Таблица которую используем для записи и удаления
$table = 'order_product';

//Установка дата и времени для записи продаж
$date_str = "2025-05-21 15:20:00";
$order_date = date('Y-m-d H:i:s', strtotime($date_str));


//Примеры создания таблиц

/*$sqlClient = ' 
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    phone TEXT NOT NULL

sqlOrder = ' 
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    shop_id INTEGER NOT NULL,
    client_id INTEGER NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES client(id),
    FOREIGN KEY (shop_id) REFERENCES shop(id)';

sqlOrderProduct = '
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    order_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    price_at_order REAL NOT NULL,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES "order"(id),
    FOREIGN KEY (product_id) REFERENCES product(id)';

sqlProduct = ' 
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price REAL NOT NULL,
    count INTEGER NOT NULL,
    FOREIGN KEY (shop_id) REFERENCES shop(id)

sqlShop = ' 
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    address TEXT NOT NULL;


$db->createTable('product', $sql);*/


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

$data = [
    'order_id' => 4,
    'product_id' => 9,
    'quantity' => 1,
    'price_at_order' => 1700
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
//$db->delete($table, 11);

?>

<!-- HTML форма для отправки данных -->
<form method="POST">
    <input type="hidden" name="name" value="Macbook">
    <input type="hidden" name="price" value="150000">
    <input type="hidden" name="count" value="2">
    <button type="submit">Добавить товар</button>
</form>






