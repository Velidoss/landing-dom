<?php

require_once 'app/models/ModelPosts.php';

class Controllerposts extends Controller
{

    public function __construct()
    {
        $this->model = new ModelPosts;
        $this->view = new View;
    }

    public function actionPostlist()
    {
        if (isset($_SESSION['userId'])) {
            $data = [];

            $data['posts'] = $this->model->showPostlist();
            $this->view->generate('Postlist.php', 'Postslayout.php', $data);
        } else {
            header("Location: /");
        }
    }
}
