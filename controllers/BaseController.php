<?php
require_once 'models/User.php';

class BaseController
{
    public $get_user;

    public function __construct()
    {
        if (isset($_SESSION['user']['id'])) {
            $Usermodel = new User();
            $this->get_user = $Usermodel->get_user();
        }
    }
}
