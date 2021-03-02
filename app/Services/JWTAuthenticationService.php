<?php

namespace App\Services;

use Firebase\JWT\JWT;

class JWTAuthenticationService {
    public const FAILED_MESSAGE = "Unable to continue, authentication failed";

    public function getAuthenticatedUserId(?string $token): ?string {
        try {
            if(!$token || $token == "") $this->throwFailedError();

            $data = JWT::decode($token, config("app.key"), array("HS256"));
            
            return $data->sub;
        } catch (\Exception $e) {
            $this->throwFailedError();
        }
    }

    public function createToken(string $userId): string {
        $key = config("app.key");

        return JWT::encode([
            'iss' => $key,
            'iat' => time(),
            'nbf' => time(),
            'exp' => time() + (60 * 60 * 24 * 7),
            'sub' => $userId
        ], $key);
    }

    private function throwError(string $message) {
        throw new \Exception($message);
    }

    private function throwFailedError() {
        $this->throwError(self::FAILED_MESSAGE);
    }

    // public function getAuthenticatedUser(?string $token): ?User {
    //     try {
    //         if(!$token) return null;
            
    //         return User::find($this->getAuthenticatedUserId($token));
    //     } catch (\Exception $e) {
    //         $this->throwFailedError();
    //     }
    // }
}