<?php
// require_once 'models/User.php';  // Example model

class DashboardController
{
    public function index()
    {
        require_once 'views/css.php';
        require_once 'views/dashboard/dashboard.php';
        require_once 'views/js.php';
    }

    
}
