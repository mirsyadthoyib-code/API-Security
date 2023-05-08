<?php

/**
 * User: Irsyad
 * Date: 3/5/2023
 */

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtSecurity
{

    function generateToken($username, $expire = 30)
    {
        $secret_Key  = $_ENV['JWT_SECRET'];
        $date   = new DateTimeImmutable();
        $expire_at     = $date->modify('+' . $expire . ' minutes')->getTimestamp();      // Add 30 minutes

        // Create the token as an array
        $request_data = [
            'exp'  => $expire_at,                      // Expire
            'userName' => $username,                // User name
        ];

        $token = JWT::encode(
            $request_data,      //Data to be encoded in the JWT
            $secret_Key, // The signing key
            'HS256'
        );

        // Encode the array to a JWT string.
        // echo json_encode(array(
        //     'status' => 'success',
        //     'token' => $token
        // ));
        return $token;
    }

    function validateToken($auth)
    {
        if (!isset($auth)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Token not found in request"
            ));
            return false;
        }

        if (!preg_match('/Bearer\s(\S+)/', $auth, $matches)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Token not found in request"
            ));
            return false;
        }

        $jwt = $matches[1];
        if (!$jwt) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Token not found in request"
            ));
            return false;
        }

        $secretKey  = $_ENV['JWT_SECRET'];
        try {
            $token = JWT::decode((string)$jwt, new Key($secretKey, 'HS256'));
        } catch (Exception $e) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Unauthorized user"
            ));
            return false;
        }
        $now = new DateTimeImmutable();

        if ($token->exp < $now->getTimestamp()) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Token Invalid"

            ));
            return false;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Authorized user",
        //     'token' => $auth
        // ));
        return true;
    }
}
