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
    public function actionMakepost(){
        if (isset($_SESSION['userId'])) {
        $this->view->generate('Makepost.php', 'Postslayout.php');
    }else {
        header("Location: /");
        }
    }
    public function actionMakepostact(){
        if (isset ($_POST['post-create'])){
            if (empty($_POST['posttile']) || empty($_POST['postcategory']) || empty($_POST['posttext']) ){
                header('Location:/posts/makepost?emptyfields');
                exit();
            }else{
                $postTitle = htmlspecialchars($_POST['posttile']);
                $postText = htmlspecialchars($_POST['posttext']);
                $postCategory = htmlspecialchars($_POST['postcategory']);
                $postDateTime = date("Y-m-d H:i:s");
                $postAuthor = $_SESSION['userUid'];
                $this->model->createPost($postTitle,  $postText, $postDateTime, $postCategory, $postAuthor);
            }

        }
    }
}
