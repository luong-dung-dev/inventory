<?php

use PHPUnit\Framework\TestCase;

class WolfServiceTest extends TestCase {
    private $pdo;
    private $wolfService;

    protected function setUp(): void {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->exec("CREATE TABLE items (id INTEGER PRIMARY KEY AUTOINCREMENT, name TEXT UNIQUE, sellIn INTEGER, quality INTEGER, imgUrl TEXT)");
        $this->wolfService = new WolfService($this->pdo);
    }

    public function testUpdateQuality() {
        $this->pdo->exec("INSERT INTO items (name, sellIn, quality) VALUES ('Apple AirPods', 10, 20)");
        $this->wolfService->updateQuality();

        $stmt = $this->pdo->query("SELECT * FROM items WHERE name = 'Apple AirPods'");
        $item = $stmt->fetch(PDO::FETCH_OBJ);

        $this->assertEquals(9, $item->sellIn);
        $this->assertEquals(21, $item->quality);
    }
}