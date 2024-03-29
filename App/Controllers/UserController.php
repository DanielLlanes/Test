<?php session_start();

class UserController extends Controller
{

    public function users()
    {
        $userModel = $this->model('User');
        $users = $userModel->getUsers();
        echo $users;
    }

    public function show($params)
    {
        if (!isset($params['id'])) {
            $this->sendErrorResponse(400, "Se requiere el parámetro 'id' para mostrar un usuario.");
            return;
        }

        $userModel = $this->model('User');
        $user = $userModel->getUser($params['id']);
        if (!$user) {
            $this->sendErrorResponse(404, "El usuario no existe.");
            return;
        }

        echo json_encode($user);
    }

    public function create()
    {

        $requestData = file_get_contents('php://input');
        $requestDataArray = json_decode($requestData, true);
        if (empty($requestDataArray['fullname']) || empty($requestDataArray['email']) || empty($requestDataArray['pass'])) {
            $this->sendErrorResponse(400, "Los campos fullname, email y pass son obligatorios.");
            return;
        }

        $userModel = $this->model('User');
        $userModel->createUser($requestDataArray);
    }

    public function update($params)
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($params['id']) || (empty($requestData['fullname']) && empty($requestData['email']))) {
            $this->sendErrorResponse(400, "Se requiere al menos un campo para actualizar (fullname, email, id).");
            return;
        }

        $userModel = $this->model('User');
        $userModel->updateUser($params['id'], $requestData);
    }

    public function delete()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['id'])) {
            $this->sendErrorResponse(400, "Se requiere el parámetro 'id' para eliminar un usuario.");
            return;
        }

        $userModel = $this->model('User');
        $userModel->deleteUser($requestData['id']);
    }
}
