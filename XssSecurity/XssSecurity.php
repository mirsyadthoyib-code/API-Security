<?php

/**
 * User: Irsyad
 * Date: 3/5/2023
 */

class XssSecurity
{
    /**
     * Sanitize and Validate a string
     * @param string $data - Data to be sanitized and validated
     * @param integer $minLength - Minimum data length
     * @param integer $maxLength - Maximum data length
     * @return mixed - Null / Sanitized data
     */
    function stringValidation($data, $minLength = 4, $maxLength = 30)
    {
        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        // echo 'original : ' . $data, PHP_EOL;
        $data = trim(filter_var($data, FILTER_SANITIZE_STRING));
        // echo 'sanitized : ' . $data, PHP_EOL;

        if (!(preg_match('/^[A-Za-z0-9_.+!*\'(),{}|\\^~[\]`<>#%";\/?:@&=. -]{0,}$/', $data) && $minLength <= strlen($data) && strlen($data) <= $maxLength)) { // \w equals "[0-9A-Za-z_]"
            // valid data, alphanumeric, special character, longer than minlenght & shorter than maxlength
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return $data;
    }

    /**
     * Sanitize and Validate an integer
     * @param integer $data - Data to be sanitized and validated
     * @param integer $minLength - Minimum data length
     * @param integer $maxLength - Maximum data length
     * @return mixed - Null / Sanitized data
     */
    function integerValidation($data, $minLength = 1, $maxLength = 20)
    {
        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        // echo 'original : ' . $data, PHP_EOL;
        $data = trim(filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        // echo 'sanitized : ' . $data, PHP_EOL;

        if (filter_var($data, FILTER_VALIDATE_INT) === false && $minLength <= strlen($data) && strlen($data) <= $maxLength) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return $data;
    }

    /**
     * Sanitize and Validate a float
     * @param float $data - Data to be sanitized and validated
     * @param integer $minLength - Minimum data length
     * @param integer $maxLength - Maximum data length
     * @return mixed - Null / Sanitized data
     */
    function floatValidation($data, $minLength = 1, $maxLength = 20)
    {
        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        // echo 'original : ' . $data, PHP_EOL;
        $data = trim(filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        // echo 'sanitized : ' . $data, PHP_EOL;

        if (filter_var($data, FILTER_VALIDATE_FLOAT) === false && $minLength <= strlen($data) && strlen($data) <= $maxLength) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return $data;
    }

    /**
     * Sanitize and Validate an url
     * @param string $data - Data to be sanitized and validated
     * @param integer $minLength - Minimum data length
     * @param integer $maxLength - Maximum data length
     * @return mixed - Null / Sanitized data
     */
    function urlValidation($data, $minLength = 12, $maxLength = 50)
    {
        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        // echo 'original : ' . $data, PHP_EOL;
        $data = trim(filter_var($data, FILTER_SANITIZE_URL));
        // echo 'sanitized : ' . $data, PHP_EOL;

        if (filter_var($data, FILTER_VALIDATE_URL) === false && $minLength <= strlen($data) && strlen($data) <= $maxLength) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return $data;
    }

    /**
     * Sanitize and Validate an Indonesian phone number
     * @param string $data - Data to be sanitized and validated
     * @return mixed - Null / Sanitized data
     */
    function phoneNumberValidation($data)
    {
        $minLength = 3;
        $maxLength = 15;

        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        // echo 'original : ' . $data, PHP_EOL;
        $data = trim(filter_var($data, FILTER_SANITIZE_NUMBER_INT));
        // echo 'sanitized : ' . $data, PHP_EOL;

        if (!(preg_match('/^(\+62|62|0)8[1-9][0-9]*$/', $data) && $minLength <= strlen($data) && strlen($data) <= $maxLength)) { // \w equals "[0-9A-Za-z_]"
            // valid data, alphanumeric, special character, longer than minlenght & shorter than maxlength
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return $data;
    }

    /**
     * Sanitize and Validate an Indonesian location
     * @param string $data - Data to be sanitized and validated
     * @param integer $minLength - Minimum data length
     * @param integer $maxLength - Maximum data length
     * @return mixed - Null / Sanitized data
     */
    function locationValidation($latitude, $longitude)
    {
        $minLength = 1;
        $maxLength = 9;

        if (!(isset($latitude) && isset($longitude))) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        // echo 'original : ' . $latitude . ' ' . $longitude, PHP_EOL;
        $latitude = trim(filter_var($latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $longitude = trim(filter_var($longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        // echo 'sanitized : ' . $latitude . ' ' . $longitude, PHP_EOL;

        if (-11 <= $latitude && $latitude <= 6 && 95 <= $longitude && $longitude <= 141) {
            if (filter_var($latitude, FILTER_VALIDATE_FLOAT) === false && $minLength <= strlen($latitude) && strlen($latitude) <= $maxLength) {
                echo json_encode(array(
                    'status' => 'failure',
                    'message' => "Data is invalid"
                ));
                return NULL;
            }

            if (filter_var($longitude, FILTER_VALIDATE_FLOAT) === false && $minLength <= strlen($longitude) && strlen($longitude) <= $maxLength) { // \w equals "[0-9A-Za-z_]"
                // valid data, alphanumeric, special character, longer than minlenght & shorter than 9
                echo json_encode(array(
                    'status' => 'failure',
                    'message' => "Data is invalid"
                ));
                return NULL;
            }
        } else {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Location is not in our region"
            ));
            return NULL;
        }


        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return [$latitude, $longitude];
    }

    /**
     * Sanitize and Validate an ip address
     * @param string $data - Data to be sanitized and validated
     * @return mixed - Null / Sanitized data
     */
    function ipAddressValidation($data)
    {
        $minLength = 7;
        $maxLength = 15;

        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        // echo 'original : ' . $data, PHP_EOL;
        $data = trim(filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        // echo 'sanitized : ' . $data, PHP_EOL;

        if (filter_var($data, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false && $minLength <= strlen($data) && strlen($data) <= $maxLength) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return $data;
    }

    /**
     * Sanitize image name and Validate image name and mimetype
     * @param array $data - Data to be sanitized and validated
     * @return mixed - Null / Sanitized data
     */
    function imageValidation($data)
    {
        $minLength = 4;

        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        $image_name = $data['name'];
        $image_mime_type = mime_content_type($data['tmp_name']);

        // echo 'original : ' . $image_name, PHP_EOL;
        $image_name = trim(filter_var($image_name, FILTER_SANITIZE_STRING));
        // echo 'sanitized : ' . $image_name, PHP_EOL;
        // echo 'mime type : ' . $image_mime_type, PHP_EOL;

        if (!(preg_match('/([^\\s]+(\\.(?i)(jpe?g|png|gif|bmp))$)/', $image_name) && $minLength <= strlen($image_name))) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        $data['name'] = $image_name;
        $image_type = array("image/png", "image/jpg", "image/jpeg", "image/gif", "image/bmp");

        if (!in_array($image_mime_type, $image_type)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return $data;
    }

    function emailValidation($data, $maxLength = 30)
    {
        $minLength = 8;
        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        echo 'original : ' . $data, PHP_EOL;
        $data = trim(filter_var($data, FILTER_SANITIZE_EMAIL));
        echo 'sanitized : ' . $data, PHP_EOL;

        if (filter_var($data, FILTER_VALIDATE_EMAIL) === false && $minLength <= strlen($data) && strlen($data) <= $maxLength) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        echo json_encode(array(
            'status' => 'success',
            'message' => "Data is valid"
        ));
        return $data;
    }

    function boolValidation($data)
    {
        $minLength = 1;
        $maxLength = 1;

        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        // echo 'original : ' . $data, PHP_EOL;
        $data = trim(filter_var($data, FILTER_SANITIZE_NUMBER_INT));
        // echo 'sanitized : ' . $data, PHP_EOL;

        if (filter_var($data, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) === NULL && $minLength <= strlen($data) && strlen($data) <= $maxLength) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return $data;
    }

    function dateValidation($data, $format = 'Y-m-d H:i:s')
    {
        if (!isset($data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data not found in request"
            ));
            return NULL;
        }

        // echo 'original : ' . $data, PHP_EOL;
        $data = trim(filter_var($data, FILTER_SANITIZE_STRING));
        // echo 'sanitized : ' . $data, PHP_EOL;

        $d = DateTime::createFromFormat($format, $data);
        if (!($d && $d->format($format) == $data)) {
            echo json_encode(array(
                'status' => 'failure',
                'message' => "Data is invalid"
            ));
            return NULL;
        }

        // echo json_encode(array(
        //     'status' => 'success',
        //     'message' => "Data is valid"
        // ));
        return $data;
    }
}
