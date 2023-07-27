<?php

namespace App;

use App\Database\Database;

class RegistrationHandler
{
    public Person $person;
    private Database $database;

    public function handleRequest(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim(filter_var($_POST["name"],FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $code = $this->generateRandomCode();

            $validator = new Validator();
            if (!$validator->validateRequiredString($name)) {
                die("Erro: Nome inválido.");
            }

            $person = new Person($name, $code);

            $this->saveData($person);

            $data = ['name' => $person->getName(), 'code' => $person->getCode()];

            Redirector::redirectWithParamsEncoded('/registration.php', $data);
            exit();
        }
    }

    private function generateRandomCode(): string
    {
        $code = '';
        for ($i = 0; $i < 11; $i++) {
            $code .= rand(0, 9);
        }

        return $code;
    }

    private function saveData(Person $person): void
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("INSERT INTO persons (name, nis) VALUES (:name, :nis)");
        $name = $person->getName();
        $stmt->bindParam(":name", $name);
        $code = $person->getCode();
        $stmt->bindParam(":nis", $code);

        $stmt->execute();
    }

    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }

}
