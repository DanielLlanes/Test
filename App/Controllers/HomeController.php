<?php session_start();

//'$2y$10$';

class HomeController extends Controller
{

    public function index()
    {
        if (isset($_SESSION['active']) && $_SESSION['active'] == true) {
            require('App/Views/home.php');
            return;
        }
        header("Location: login");
    }
}
