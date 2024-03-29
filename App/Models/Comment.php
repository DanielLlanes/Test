<?php

class Comment extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function createComment($commentData)
    {
        $query = "INSERT INTO user_comment (user, coment_text, creation_date, update_date) 
                  VALUES (:user, :coment_text, :creation_date, :update_date)";

        $params = array(
            ':user' => 1,
            ':coment_text' => $commentData['coment_text'],
            ':creation_date' => date("Y-m-d H:i:s"),
            ':update_date' => date("Y-m-d H:i:s")
        );


        $result = $this->query->query($query, $params)->create();


        if (!$result) {
            $this->sendErrorResponse(500, "No se pudo crear el comentario.");
            die;
        } else {
            $query = "SELECT uc.*, u.fullname AS user_fullname, u.email AS user_email, u.id AS user_id  FROM user_comment uc JOIN user u ON uc.user = u.id WHERE uc.id = $result";
            $result = $this->query->query($query)->single();
            $data =  ["comment" => json_decode($result, true)];
            $this->sendSuccessResponse(201, $data);
            die;
        }
    }

    public function updateComment($commentId, $commentData)
    {
        if (empty($commentData['coment_text'])) {
            $this->sendErrorResponse(400, "El texto del comentario no puede estar vacío.");
            return;
        }

        $comment = $this->getCommentById($commentId);
        if (!$comment) {
            $this->sendErrorResponse(400, "El comentario no existe.");
            return;
        }

        $query = "UPDATE user_comment 
                  SET coment_text = :coment_text, update_date = :update_date 
                  WHERE id = :id";

        $params = array(
            ':coment_text' => $commentData['coment_text'],
            ':update_date' => date("Y-m-d H:i:s"),
            ':id' => $commentId
        );

        $result = $this->query->query($query, $params)->execute();

        if ($result) {
            $this->sendSuccessResponse(200, "Comentario actualizado correctamente.");
        } else {
            $this->sendErrorResponse(500, "No se pudo actualizar el comentario.");
        }
    }

    public function deleteComment($commentId)
    {
        $comment = $this->getCommentById($commentId);
        if (!$comment) {
            $this->sendErrorResponse(400, "El comentario no existe.");
            return;
        }

        $query = "DELETE FROM user_comment WHERE id = :id";
        $params = array(':id' => $commentId);

        $result = $this->query->query($query, $params)->execute();

        if ($result) {
            $this->sendSuccessResponse(200, "Comentario eliminado correctamente.");
        } else {
            $this->sendErrorResponse(500, "No se pudo eliminar el comentario.");
        }
    }

    public function getCommentById($commentId)
    {
        $query = "SELECT * FROM user_comment WHERE id = :id";
        $params = array(':id' => $commentId);
        return $this->query->query($query, $params)->single();
    }

    public function getCommentsByUserId($userId)
    {
        $userModel = $this->model('User');
        if (!$userModel->getUserById($userId)) {
            $this->sendErrorResponse(400, "El usuario no existe.");
            return;
        }

        $query = "SELECT * FROM user_comment WHERE user = :user";
        $params = array(':user' => $userId);
        return $this->query->query($query, $params)->resultSet();
    }

    public function getAllComments()
    {
        $query = "SELECT uc.*, u.fullname AS user_fullname, u.email AS user_email, u.id AS user_id  FROM user_comment uc JOIN user u ON uc.user = u.id";
        $this->sendSuccessResponse(201, json_decode($this->query->query($query)->resultSet()));
    }

    public function addLike($commentId)
    {
        // Obtener el número actual de likes del comentario
        $currentLikes = $this->getLikesCount($commentId);

        // Incrementar el número de likes en 1
        $newLikes = $currentLikes + 1;

        // Actualizar el número de likes en la base de datos
        $query = "UPDATE user_comment SET likes = :likes WHERE id = :comment_id";
        $params = array(':likes' => $newLikes, ':comment_id' => $commentId);
        $result = $this->query->query($query, $params)->execute();

        // Verificar si la actualización fue exitosa
        if ($result) {
            $this->sendSuccessResponse(200, "Se agregó un like al comentario.");
        } else {
            $this->sendErrorResponse(500, "No se pudo agregar el like al comentario.");
        }
    }

    private function getUserById($userId)
    {
        return json_decode($this->query->query("SELECT * FROM user WHERE id = :id", ['id' => $userId])->single());
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
    private function getLikesCount($commentId)
    {
        // Consulta para obtener el número actual de likes del comentario
        $query = "SELECT likes FROM user_comment WHERE id = :comment_id";
        $params = array(':comment_id' => $commentId);
        $result = $this->query->query($query, $params)->single();

        // Obtener el número de likes del resultado
        $likes = json_decode($result, true);
        return $likes['likes'];
    }
}
