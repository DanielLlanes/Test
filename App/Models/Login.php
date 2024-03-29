<?php


class Login extends Model
{
    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre
    }
    public function login($requestDataArray)
    {
        $user_pass = json_encode($requestDataArray);
        $user = $this->query->query("SELECT * FROM user WHERE email = :email", ['email' => $requestDataArray['email']])->single();
        if (!$user) {
            $this->sendErrorResponse(400, "El usuario no existe.");
            return;
        }


        $user_pass = json_decode($user, true);

        if (password_verify($requestDataArray['pass'], $user_pass['pass'])) {
            $data = [
                'token' => substr(password_hash($user_pass['email'], PASSWORD_DEFAULT), 7)
            ];
            unset($user_pass['pass']);
            $_SESSION['user'] = $user_pass;
            $_SESSION['active'] = true;
            $this->sendSuccessResponse(201, $data);
        } else {
            // Contraseña incorrecta
            $this->sendErrorResponse(500, "Estas credenciales no se encuentran registradas.");
        }
    }
    private function sendErrorResponse($statusCode, $error)
    {
        http_response_code($statusCode);
        echo json_encode(array("error" => $error));
    }
    private function sendSuccessResponse($statusCode, $message)
    {
        http_response_code($statusCode);
        echo json_encode(array("message" => $message));
    }
}
