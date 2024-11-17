<?php

require 'vendor/autoload.php';
use Cloudinary\Cloudinary;

class ImageUploadController {
    private $pdo;
    private $cloudinary;

    function __construct($pdo) {
        $this->pdo = $pdo;
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => 'your_cloud_name',
                'api_key' => 'your_api_key',
                'api_secret' => 'your_api_secret',
            ],
        ]);
    }

    public function uploadImage($itemName, $imagePath) {
        if (!$this->authenticate()) {
            http_response_code(401);
            echo "Unauthorized";
            return;
        }

        $stmt = $this->pdo->prepare("SELECT * FROM items WHERE name = ?");
        $stmt->execute([$itemName]);
        $item = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$item) {
            http_response_code(404);
            echo "Item not found";
            return;
        }

        $result = $this->cloudinary->uploadApi()->upload($imagePath);
        $imgUrl = $result['secure_url'];

        $stmt = $this->pdo->prepare("UPDATE items SET imgUrl = ? WHERE id = ?");
        $stmt->execute([$imgUrl, $item->id]);

        echo "Image uploaded successfully";
    }

    private function authenticate() {
        if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
            return false;
        }

        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        return $username === 'your_username' && $password === 'your_password';
    }
}