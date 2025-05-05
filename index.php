<?php
require('autoload.php');

$db = new Database('mydatabase.sqlite');

// Таблица которую используем для записи и удаления
$table = 'order_product';

//Установка дата и времени для записи продаж
$date_str = "2025-05-21 15:20:00";
$order_date = date('Y-m-d H:i:s', strtotime($date_str));


// Через массив добавляем данные 
$data = [
    'order_id' => 3,
    'product_id' => 2,
    'quantity' => 1,
    'price_at_order' => 15000,
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
?>

<!-- HTML форма для отправки данных -->
<form method="POST">
    <input type="hidden" name="name" value="Macbook">
    <input type="hidden" name="price" value="150000">
    <input type="hidden" name="count" value="2">
    <button type="submit">Добавить товар</button>
</form>






