<?php
declare(strict_types=1);

namespace Source\App;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHandler
{
    public static function makeJWT(string $userName): string
    {
        $secretKey = Registry::get('secretKey');
        $date = new \DateTimeImmutable();
        $expireAt = $date->modify('+10 minutes')->getTimestamp();
        $domainName = Registry::get('domain');
        $alg = Registry::get('jwtAlg');
        $requestData = [
            'iat' => $date->getTimestamp(),         // Issued at: time when the token was generated
            'iss' => $domainName,                       // Issuer
            'nbf' => $date->getTimestamp(),         // Not before
            'exp' => $expireAt,                           // Expire
            'userName' => $userName,                     // User name
        ];
        return JWT::encode(
            $requestData,
            $secretKey,
            $alg
        );
    }

    public static function checkJwt(?string $authorizedString): array
    {
        $secretKey = Registry::get('secretKey');
        $alg = Registry::get('jwtAlg');
        if (!$authorizedString || !preg_match('/Bearer\s(\S+)/', $authorizedString, $matches)) {
            return [false, 'Token not found in request'];
        }
        $jwt = $matches[1];
        if (!$jwt) {
            return [false, 'Bad request'];
        }
        try
        {
        $token = JWT::decode($jwt, new Key($secretKey, $alg));
        }
        catch (\Throwable) {
            return [false, 'Unauthorized'];
        }
        $now = new \DateTimeImmutable();
        $serverName = Registry::get('domain');
        if ($token->iss !== $serverName ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp()) {
            return [false, 'Unauthorized'];
        }
        return [true, 'success'];
    }
}