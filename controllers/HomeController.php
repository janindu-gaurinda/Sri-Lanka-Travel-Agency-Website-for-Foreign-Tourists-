<?php
require_once 'models/Pakage.php';  // Example model
require_once 'models/Gallery.php';  // Example model
require_once 'models/Destination.php';  // Example model     
require_once 'models/User.php';  // Example model     
require_once 'models/Blog.php';  // Example model     
require_once 'models/Feedback.php';  // Example model     
require_once 'BaseController.php';

class HomeController extends BaseController
{
    public function index()
    {
        $pkg_Model = new Pakage();
        $Get_pkg = $pkg_Model->getAll_pkg_top3();
        // =========================================================================
        $dest_model = new Destination();
        $Get_dest = $dest_model->getAll_dest_top3();
        // =========================================================================
        $Images_Model = new Gallery();
        $Get_images = $Images_Model->getAll_Images();
        // =========================================================================‍
        $get_user = $this->get_user;
        // =========================================================================‍
        $blogs_Model = new Blog();
        $Get_blogs = $blogs_Model->getAll_blog_top3();
        // =========================================================================‍
        $feedbacl_Model = new Feedback();
        $Get_fd = $feedbacl_Model->getAll_feedbk_top3();
        // =========================================================================‍

        require_once 'views/header.php';
        require_once 'views/home.php';
        require_once 'views/footer.php';
    }
}
