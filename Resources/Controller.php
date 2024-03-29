<?php

class Controller
{

    public static function model($model)
    {
        $modelClassName = ucfirst($model);
        $modelFilePath = "App/models/{$modelClassName}.php";

        if (file_exists($modelFilePath)) {
            require_once $modelFilePath;
            return new $modelClassName;
        } else {
            self::sendJsonResponse(404, array("error" => "Modelo no encontrado"));
            die();
        }
    }

    private static function sendJsonResponse($statusCode, $data)
    {
        if (!headers_sent()) {
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
        }
        http_response_code($statusCode);
        echo json_encode($data);
    }

    public static function validateSesion($requestData)
    {
        return true;
        $hash = '$2y$10$' . $requestData['hash'];

        $user_data = $_SESSION['user'];
        if (password_verify($user_data['email'], $hash)) {
            return true;
        } else {
            return false;
        }
    }

    public function sendErrorResponse($statusCode, $message)
    {
        http_response_code($statusCode);
        echo json_encode(array("error" => $message));
    }
}
