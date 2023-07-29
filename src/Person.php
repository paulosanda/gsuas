<?php

namespace App;

use App\Database\Database;
use PDO;

class Person
{
    public function __construct(private string  $name, private string $code)
    {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public static function findByNis($nis): ?Person
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT * FROM persons WHERE nis = :nis");
        $stmt->bindParam(":nis", $nis);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new self($result['name'], $result['nis']);
        }

        return null;
    }
}
