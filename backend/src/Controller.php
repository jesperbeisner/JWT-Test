<?php

declare(strict_types=1);

namespace App;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Throwable;

class Controller
{
    private const KEY = 'secret-key-123';

    private ?Throwable $exception = null;

    public function authAction(): JsonResponse
    {
        $body = file_get_contents('php://input');

        if (!empty($body)) {
            $data = json_decode($body, true);

            if ($data['username'] === 'root' && $data['password'] === 'password') {
                $payload = ["iat" => time(), "exp" => time() + 15, "id" => 100];

                $jwt = JWT::encode($payload, self::KEY, 'HS256');
                setcookie('Auth', $jwt, time() + 60 * 60 * 24 * 14, '/', 'localhost', false, true);

                return new JsonResponse(['message' => 'Login success']);
            }
        }

        return new JsonResponse(['message' => 'Login failure'], 400);
    }

    public function usersAction(): JsonResponse
    {
        if ($this->userIsAuthenticated()) {
            $users = [
                'users' => [
                    ['id' => 1, 'firstName' => 'Max', 'lastName' => 'Mustermann'],
                    ['id' => 2, 'firstName' => 'Jane', 'lastName' => 'Doe'],
                ],
            ];

            if ($this->exception !== null) {
                $users['errors'] = ['message' => $this->exception->getMessage()];
            }

            return new JsonResponse($users);
        }

        return new JsonResponse(['message' => 'User not authenticated'], 401);
    }

    public function logoutAction(): JsonResponse
    {
        if (isset($_COOKIE['Auth'])) {
            unset($_COOKIE['Auth']);
        }

        setcookie('Auth', '', time() - 3600, '/', 'localhost', false, true);

        return new JsonResponse(['message' => 'Logout successful']);
    }

    private function userIsAuthenticated(): bool
    {
        if (isset($_COOKIE['Auth']) && !empty($_COOKIE['Auth'])) {
            $jwt = $_COOKIE['Auth'];

            // Just a test to better see the different exception messages without server error
            try {
                $decoded = JWT::decode($jwt, new Key(self::KEY, 'HS256'));
            } catch (Throwable $exception) {
                $this->exception = $exception;
            }

            return true;
        }

        return false;
    }
}
