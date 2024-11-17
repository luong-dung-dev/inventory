<?php

class ImportItemsCommand {
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function execute() {
        $json = file_get_contents('https://api.restful-api.dev/objects');
        $items = json_decode($json, true);

        foreach ($items as $itemData) {
            $this->importItem($itemData);
        }
    }

    private function importItem($itemData) {
        $stmt = $this->pdo->prepare("SELECT * FROM items WHERE name = ?");
        $stmt->execute([$itemData['name']]);
        $item = $stmt->fetch(PDO::FETCH_OBJ);

        if ($item) {
            $stmt = $this->pdo->prepare("UPDATE items SET quality = ? WHERE id = ?");
            $stmt->execute([$itemData['quality'], $item->id]);
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO items (name, sellIn, quality) VALUES (?, ?, ?)");
            $stmt->execute([$itemData['name'], $itemData['sellIn'], $itemData['quality']]);
        }
    }
}