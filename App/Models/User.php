<?php

class User extends Model
{

    public function __construct()
    {
        parent::__construct(); // Llama al constructor de la clase padre
    }

    public function getUsers()
    {
        return $this->query->query("SELECT * FROM user")->resultSet();
    }

    public function getUser($userId)
    {
        $user = $this->getUserById($userId);
        if (!$user) {
            $this->sendErrorResponse(400, "El usuario no existe.");
            return;
        }
        return $user;
    }

    public function createUser($userData)
    {
        if ($this->isUniqueEmail($userData['email'])) {
            $this->sendErrorResponse(400, "El correo electrónico proporcionado ya está en uso.");
            return;
        }

        $query = "INSERT INTO user (fullname, email, pass, openid, creation_date, update_date) 
                  VALUES (:fullname, :email, :pass, :openid, :creation_date, :update_date)";

        $params = array(
            ':fullname' => $userData['fullname'],
            ':email' => $userData['email'],
            ':pass' => password_hash($userData['pass'], PASSWORD_DEFAULT),
            ':openid' => isset($userData['openid']) ? $userData['openid'] : $this->generarCadenaOpenid(20),
            ':creation_date' => date("Y-m-d H:i:s"),
            ':update_date' => date("Y-m-d H:i:s")
        );

        $result = $this->query->query($query, $params)->create();

        if ($result) {
            $data = [
                'token' => substr(password_hash($userData['email'], PASSWORD_DEFAULT), 7)
            ];
            $user = json_decode(json_encode($this->getUserById($result)), true);
            unset($user['pass']);
            $_SESSION['user'] = $user;
            $_SESSION['active'] = true;
            $this->sendSuccessResponse(201, $data);
        } else {
            $this->sendErrorResponse(500, "No se pudo crear el usuario.");
        }
    }

    public function updateUser($userId, $userData)
    {
        $user = $this->getUserById($userId);
        if (!$user) {
            $this->sendErrorResponse(400, "El usuario no existe.");
            return;
        }

        // Construir la consulta SQL base para actualizar el usuario
        $query = "UPDATE user SET ";
        $params = [];

        // Inicializar un array para almacenar los campos a actualizar
        $updateFields = [];

        // Verificar y agregar los campos que se van a actualizar
        if (!empty($userData['fullname'])) {
            $updateFields[] = "fullname = :fullname";
            $params[':fullname'] = $userData['fullname'];
        }

        if (!empty($userData['email'])) {
            $updateFields[] = "email = :email";
            $params[':email'] = $userData['email'];
        }

        if (!empty($userData['pass'])) {
            $updateFields[] = "pass = :pass";
            $params[':pass'] = $userData['pass'];
        }

        if (!empty($userData['openid'])) {
            $updateFields[] = "openid = :openid";
            $params[':openid'] = $userData['openid'];
        }

        // Comprobar si hay campos para actualizar
        if (empty($updateFields)) {
            $this->sendErrorResponse(400, "No se proporcionaron campos para actualizar.");
            return;
        }

        // Combinar los campos para formar la parte SET de la consulta SQL
        $query .= implode(", ", $updateFields);

        // Agregar la condición WHERE para el ID del usuario
        $query .= " WHERE id = :id";
        $params[':id'] = $userId;

        // Ejecutar la consulta SQL
        $result = $this->query->query($query, $params)->execute();

        // Enviar la respuesta adecuada según el resultado de la ejecución
        if ($result) {
            $this->sendSuccessResponse(200, "Usuario actualizado correctamente.");
        } else {
            $this->sendErrorResponse(500, "No se pudo actualizar el usuario.");
        }
    }

    public function deleteUser($userId)
    {
        $user = $this->getUserById($userId);
        if (!$user) {
            $this->sendErrorResponse(400, "El usuario no existe.");
            return;
        }

        $query = "DELETE FROM user WHERE id = :id";
        $params = array(':id' => $userId);

        $result = $this->query->query($query, $params)->execute();

        if ($result) {
            $this->deleteUserComments($userId);
            $this->sendSuccessResponse(200, "Usuario eliminado correctamente.");
        } else {
            $this->sendErrorResponse(500, "No se pudo eliminar el usuario.");
        }
    }

    private function getUserById($userId)
    {
        return json_decode($this->query->query("SELECT * FROM user WHERE id = :id", ['id' => $userId])->single());
    }

    private function isUniqueEmail($email, $excludeId = null)
    {
        $query = ($excludeId !== null) ?
            "SELECT COUNT(*) AS count FROM user WHERE id != :id AND email = :email" :
            "SELECT COUNT(*) AS count FROM user WHERE email = :email";

        $params = ($excludeId !== null) ?
            [':id' => $excludeId, ':email' => $email] :
            [':email' => $email];

        $result = $this->query->query($query, $params)->single();
        $rowCount = json_decode($result, true);

        return ($rowCount['count'] === 0) ? false : true;
    }

    private function sendSuccessResponse($statusCode, $message)
    {
        http_response_code($statusCode);
        echo json_encode(array("message" => $message));
    }

    private function sendErrorResponse($statusCode, $error)
    {
        http_response_code($statusCode);
        echo json_encode(array("error" => $error));
    }
    private function deleteUserComments($userId)
    {
        // Eliminar todos los comentarios asociados al usuario
        $query = "DELETE FROM user_comment WHERE user = :user_id";
        $params = array(':user_id' => $userId);
        $this->query->query($query, $params)->execute();
    }

    private function generarCadenaOpenid($longitud = 20)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $cadenaAleatoria = '';

        for ($i = 0; $i < $longitud; $i++) {
            $indiceAleatorio = rand(0, strlen($caracteres) - 1);
            $cadenaAleatoria .= $caracteres[$indiceAleatorio];
        }

        return $cadenaAleatoria;
    }

    
}
