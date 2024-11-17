<?php

declare(strict_types=1);

namespace WolfShop;

final class WolfService
{
    private $pdo;

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function updateQuality() {
        $stmt = $this->pdo->query("SELECT * FROM items");
        $items = $stmt->fetchAll(PDO::FETCH_OBJ);

        foreach ($items as $item) {
            $this->updateItemQuality($item);
            $this->saveItem($item);
        }
    }

    private function updateItemQuality($item) {
        switch ($item->name) {
            case 'Apple AirPods':
                $this->updateAppleAirPods($item);
                break;
            case 'Samsung Galaxy S23':
                // Legendary item, quality does not change
                break;
            case 'Apple iPad Air':
                $this->updateAppleIPadAir($item);
                break;
            case 'Xiaomi Redmi Note 13':
                $this->updateConjuredItem($item);
                break;
            default:
                $this->updateNormalItem($item);
                break;
        }

        // Ensure quality is within bounds
        if ($item->quality < 0) {
            $item->quality = 0;
        } elseif ($item->quality > 50 && $item->name != 'Samsung Galaxy S23') {
            $item->quality = 50;
        }
    }

    private function updateNormalItem($item) {
        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality -= 2;
        } else {
            $item->quality--;
        }
    }

    private function updateAppleAirPods($item) {
        $item->sellIn--;
        $item->quality++;

        if ($item->sellIn < 0) {
            $item->quality++;
        }
    }

    private function updateAppleIPadAir($item) {
        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality = 0;
        } elseif ($item->sellIn <= 5) {
            $item->quality += 3;
        } elseif ($item->sellIn <= 10) {
            $item->quality += 2;
        } else {
            $item->quality++;
        }
    }

    private function updateConjuredItem($item) {
        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality -= 4;
        } else {
            $item->quality -= 2;
        }
    }

    private function saveItem($item) {
        $stmt = $this->pdo->prepare("UPDATE items SET sellIn = ?, quality = ? WHERE id = ?");
        $stmt->execute([$item->sellIn, $item->quality, $item->id]);
    }
}
