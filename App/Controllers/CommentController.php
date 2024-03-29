<?php session_start();

class CommentController extends Controller
{

    public function comments()
    {
        $commentModel = $this->model('Comment');
        $comments = $commentModel->getAllComments();
        echo $comments;
    }

    public function show()
    {
        if (!isset($_REQUEST['id'])) {
            $this->sendErrorResponse(400, "Se requiere el parámetro 'id' para mostrar un comentario.");
            return;
        }

        $commentModel = $this->model('Comment');
        $comment = $commentModel->getCommentById($_REQUEST['id']);
        if (!$comment) {
            $this->sendErrorResponse(404, "El comentario no existe.");
            return;
        }

        echo json_encode($comment);
    }

    public function create()
    {
        $requestData = file_get_contents('php://input');

        $requestDataArray = json_decode($requestData, true);

        if (!isset($requestDataArray['coment_text']) || trim($requestDataArray['coment_text']) === '') {
            $this->sendErrorResponse(400, "El campo coment_text es obligatorio.");
            return;
        }

        if (!$this->validateSesion($requestDataArray)) {
            $this->sendErrorResponse(400, "No se pudo crear el comentario");
            return;
        }

        $commentModel = $this->model('Comment');
        $commentModel->createComment($requestDataArray);

        $this->sendErrorResponse(400, $commentModel->createComment($requestDataArray));
    }

    public function update()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['id']) || empty($requestData['comment_text'])) {
            $this->sendErrorResponse(400, "Se requiere al menos un campo para actualizar (id, comment_text).");
            return;
        }

        $commentModel = $this->model('Comment');
        $commentModel->updateComment($requestData['id'], $requestData);
    }

    public function delete()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['id'])) {
            $this->sendErrorResponse(400, "Se requiere el parámetro 'id' para eliminar un comentario.");
            return;
        }

        $commentModel = $this->model('Comment');
        $commentModel->deleteComment($requestData['id']);
    }

    public function addLike()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);

        if (empty($requestData['comment_id'])) {
            $this->sendErrorResponse(400, "Se requiere el parámetro 'comment_id' para agregar un like al comentario.");
            return;
        }
        $commentModel = $this->model('Comment');
        $commentModel->addLike($requestData['comment_id']);
    }
}
