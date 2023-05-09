<?php

/**
 * User: Irsyad
 * Date: 3/5/2023
 */

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtSecurity
{
    /**
     * Generate JWT Token and put username inside the payload
     * @param string $username - Username of the user
     * @param integer $expire - How long token will expire by days
     * @return string - The generated token
     */
    function generateToken($username, $expire = 7)
    {
        // Set Token expiry date
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+' . $expire . ' days')->getTimestamp();      // Add 7 days

        // Set Token payload
        $request_data = [
            'exp'  => $expire_at,       // Expire
            'userName' => $username,    // User name
        ];

        $secret_Key  = $_ENV['JWT_SECRET'];
        $token = JWT::encode(
            $request_data,  // Data to be encoded in the JWT
            $secret_Key,    // The signing key
            'HS256'
        );
        return $token;
    }

    /**
     * Validate token
     * @param string $token - Generated token from login endpoint
     * @return bool - The validation status
     */
    function validateToken($token)
    {
        // Check Token availability
        if (!isset($token)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Token not found in request"
            ));
            return false;
        }
        if (!preg_match('/Bearer\s(\S+)/', $token, $matches)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Token not found in request"
            ));
            return false;
        }

        // Extract Token from Bearer
        $jwt = $matches[1];
        if (!$jwt) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Token not found in request"
            ));
            return false;
        }

        // Decode Token using secret key from environment
        $secretKey  = $_ENV['JWT_SECRET'];
        try {
            $encodedToken = JWT::decode((string)$jwt, new Key($secretKey, 'HS256'));
        } catch (Exception $e) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Unauthorized user"
            ));
            return false;
        }

        // Check Token expiry date
        $now = new DateTimeImmutable();
        if ($encodedToken->exp < $now->getTimestamp()) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Token Invalid"

            ));
            return false;
        }
        return true;
    }
}
