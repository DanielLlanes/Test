<?php session_start();


Class LoginController extends Controller
{
    public function __construct()
    {
    }
    
    public function index()
    {
        (isset($_SESSION['active']) &&$_SESSION['active'] == true) ?  header("Location: index") : require('App/Views/login.php');
    }

    public function create()
    {
        (isset($_SESSION['active']) && $_SESSION['active'] == true) ?  header("Location: index") : require('App/Views/register.php');
    }

    public function logout(){
        session_unset();
        session_destroy();
        $this->sendErrorResponse(200, "Exito");
        die;
    }

    public function login() {
        $requestData = file_get_contents('php://input');
        $requestDataArray = json_decode($requestData, true);

        if ( empty($requestDataArray['email']) || empty($requestDataArray['pass'])) {
            $this->sendErrorResponse(400, "Los campos email y pass son obligatorios.");
            return;
        }
        $userModel = $this->model('Login');
        $userModel->login($requestDataArray);
    }
}