<?php

namespace App;

use App\Redirector;
class NisSearchHandler
{
    public function handleRequest(): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST["nis"])) {
                $nis = trim(filter_var($_POST["nis"], FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                $person = Person::findByNis($nis);

                if ($person) {

                    Redirector::redirectWithParamsEncoded('/search.php', [
                        'name' => $person->getName(),
                        'code' => $person->getCode()
                    ]);
                    exit();
                } else {
                    Redirector::redirectWithParamsEncoded('/search.php', [
                        'not_found' => true
                    ]);
                    exit();
                }
            }
        }
    }
}