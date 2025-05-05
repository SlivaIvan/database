<?php

class Database {
    private $pdo;

    public function __construct(string $dbPath)
    {

    try {
            $this->pdo = new PDO("sqlite:$dbPath");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo "Подключение к базе данных успешно установлено!";
        } catch (PDOException $e) {
            die('Ошибка в подключении к базе данных'. $e->getMessage());
        }
        
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }

    public function createTable($reqHeader, $reqBody) {
        $sql = "CREATE TABLE $reqHeader($reqBody)";
        try {
            $this->pdo->exec($sql);
            echo "Таблица успешно создана!";
        } catch (PDOException $e) {
            die("Ошибка при создании таблицы: " . $e->getMessage());
        }
    }

    public function insert($table, $data) {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data)); 
            
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->pdo->prepare($sql);
            echo "Запись успешно добавлена в базу";
            return $stmt->execute($data); // Выполняем запрос с данными
        } catch (PDOException $e) {
            throw new PDOException("Insert failed: " . $e->getMessage());
        }
    }

public function delete($table, $id){
    try {
        // Подготовка SQL-запроса с плейсхолдером
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE id = :id");

        // Привязка параметра и выполнение запроса
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "Запись с ID $id успешно удалена.";
    } catch (PDOException $e) {
        echo "Ошибка при удалении: " . $e->getMessage();
    }
}

    public function disconnect() {
        $this->pdo = null;
    }

    /**
     * Деструктор класса (автоматически отключается при уничтожении объекта)
     */
    public function __destruct() {
        $this->disconnect();
    }
}