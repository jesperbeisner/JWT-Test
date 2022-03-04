<?php

declare(strict_types=1);

namespace App;

class JsonResponse
{
    public function __construct(
      private array $data,
      private int $statusCode = 200,
    ) {}

    public function send(): void
    {
        header("Access-Control-Allow-Origin: http://localhost:8081");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Credentials: true");
        header('Content-Type: application/json');

        http_response_code($this->statusCode);

        echo json_encode($this->data);
    }
}
