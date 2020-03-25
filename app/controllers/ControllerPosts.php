<?php

require_once 'app/models/ModelPosts.php';
require_once "app/models/ModelUser.php";

use app\core\View;
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
            $modelUser = new ModelUser();
            $data = [];
            $data['posts'] = $this->model->showPostlist();
            for($i=0; $i <count($data['posts']); $i++){
                if ($modelUser->checkImg($data['posts'][$i]['postAuthorId'])){
                    $data['posts'][$i]['userImg'] = "/img/userimage/".$data['posts'][$i]['postAuthorId'].".jpg";
                }else{
                    $data['posts'][$i]['userImg'] = "/img/userimage/anon.png";
                }
            }
            $this->view->generate('Postlist.php', 'Postslayout.php', $data);
        } else {
            header("Location: /");
        }
    }

    public function actionPost($postId)
    {
        if(isset($_SESSION['userId'])){
            $modelUser = new ModelUser();
            $data = [];
            $data['post'] = $this->model->showPost($postId);
            $data['comments'] =$this->model->showComments($postId);
            if ($modelUser->checkImg($data['post']['postAuthorId'])){
                $data['post']['userImg'] = "/img/userimage/".$data['post']['postAuthorId'].".jpg";
            }else{
                $data['post']['userImg'] = "/img/userimage/anon.png";
            }
            if(isset($data['comments'])){
                for($i=0; $i<count($data['comments']); $i++){
                    if($modelUser->checkImg($data['comments'][$i]['commentAuthor'])){
                        $data['comments'][$i]['commentAuthorImg'] = "/img/userimage/".$data['comments'][$i]['commentAuthor'].".jpg";
                    }else{
                        $data['comments'][$i]['commentAuthorImg'] = "/img/userimage/anon.png";
                    }
                }
            }

            $this->view->generate('Post.php', 'Postslayout.php', $data);
        }
        else {
            header("Location: /");
        }
    }

    public function actionMakecomment($postId)
    {
        if(isset($_POST['comment-submit'])){
            if(empty($_POST['comment-text'])){
                header('Location:/posts/post/'.$postId);
                exit();
            }else{
                $commentAuthor = $_SESSION['userId'];
                $commentText = $_POST['comment-text'];
                $commentDate = date("Y-m-d H:i:s");
                $commentPost = $postId;
                $modelUser = new ModelUser();
                $commentAuthorName = $modelUser->selectUserData($_SESSION['userId'])[0]['userName'];
                $this->model->makeComment($commentAuthor , $commentText , $commentPost , $commentDate, $commentAuthorName );
                $this->view->redirect("/posts/post/".$postId); 
            }
        }
    }


    public function actionMakepost(){
        if (isset($_SESSION['userId'])) {
        $this->view->generate('Makepost.php', 'Postslayout.php');
    }else {
        header("Location: /posts/postlist");
        }
    }

    public function actionSearchpost(){
        if (isset($_SESSION['userId'])) {
            $data = [];
            if(isset($_POST['post-searchpost'])){
                if(empty($_POST['searchpost-query'])){
                    header('Location:/posts/searchpost');
                    exit();
                }else{
                    $query = htmlspecialchars($_POST['searchpost-query']);
                    $postsFound = $this->model->findPost($query);
                    if ($postsFound){
                        $data['postsfound'] =  $postsFound;
                        $this->view->generate('Searchpost.php', 'Postslayout.php', $data);
                        exit();
                    }else{
                        header("Location: /");
                    }
                }
            }else{
                $this->view->generate('Searchpost.php', 'Postslayout.php', $data);
            }
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
                $postAuthorId = $_SESSION['userId'];
                $postImg = $_FILES['post-img']['tmp_name'];
                $this->model->createPost($postTitle,  $postText, $postDateTime, $postCategory, $postAuthor,
                    $postAuthorId,$postImg);
                $this->view->redirect("/posts/postlist");            }

        }
    }
    public function actionPostlike($postId)
    {
        $likeFrom = $_SESSION['userId'];
        $check = $this->model->checkLike($likeFrom);
        if(isset($check)){
            $this->model->makeLike($postId, $likeFrom);
            $this->view->redirect('/posts/post/'.$postId);  
        }else{
            $this->view->redirect('/posts/postlist');
        }
    }

}
