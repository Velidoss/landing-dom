<?php

require_once 'app/models/ModelPosts.php';
require_once 'app/models/ModelUser.php';
require_once 'app/lib/Paginationtest.php';

use app\core\View;
use app\core\Controller;
use app\lib\Paginationtest;
use app\models\ModelPosts;

class ControllerPosts extends Controller
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
            $total = $this->model->countPosts();
            $page = isset($_GET['page']) ? (int)$_GET['page'] :1;
            $perpage =5 ;
            $pagination = new Paginationtest($page, $perpage, $total);
            $start = $pagination->getStart();
            $data = [];
            $data['posts'] = $this->model->showPostlist(['start'=>(int)$start, 'perpage'=>(int)$perpage]);
            $data['pagination'] = $pagination;
            $data['total'] = $total;
            for ($i = 0; $i < count($data['posts']); $i++) {
                $data['posts'][$i]['postLikeCount'] = $this->model->showLikes(['postId' => $data['posts'][$i]['postId']]);
                if ($modelUser->checkImg(['Id' => $data['posts'][$i]['postAuthorId']])) {
                    $data['posts'][$i]['userImg'] = '/img/userimage/' . $data['posts'][$i]['postAuthorId'] . '.jpg';
                } else {
                    $data['posts'][$i]['userImg'] = '/img/userimage/anon.png';
                }
            }
            $this->view->generate('Postlist.php', 'Postslayout.php', $data);
        } else {
            header('Location: /');
        }
    }

    public function actionPost($postId)
    {
        if (isset($_SESSION['userId'])) {
            $modelUser = new ModelUser();
            $data = [];
            $data['post'] = $this->model->showPost($postId);
            $data['comments'] = $this->model->showComments($postId);
            $data['post']['likecount'] = $this->model->showLikes(['postId' => $postId]);
            if ($modelUser->checkImg(['Id' => $data['post']['postAuthorId']])) {
                $data['post']['userImg'] = '/img/userimage/' . $data['post']['postAuthorId'] . '.jpg';
            } else {
                $data['post']['userImg'] = '/img/userimage/anon.png';
            }
            if (isset($data['comments'])) {
                for ($i = 0; $i < count($data['comments']); $i++) {
                    $data['comments'][$i]['commentLikeCount'] = $this->model->showCommentLikes(['commentId' => $data['comments'][$i]['commentId']]);
                    if ($modelUser->checkImg(['Id' => $data['comments'][$i]['commentAuthor']])) {
                        $data['comments'][$i]['commentAuthorImg'] = '/img/userimage/' . $data['comments'][$i]['commentAuthor'] . '.jpg';
                    } else {
                        $data['comments'][$i]['commentAuthorImg'] = '/img/userimage/anon.png';
                    }
                }
            }
            $this->view->generate('Post.php', 'Postslayout.php', $data);
        } else {
            header('Location: /');
        }
    }

    public function actionMakecomment($postId)
    {
        if (isset($_POST['comment-submit'])) {
            if (empty($_POST['comment-text'])) {
                header('Location:/posts/post/' . $postId);
                exit();
            } else {
                $modelUser = new ModelUser();
                $params = [
                    'commentAuthor' => $_SESSION['userId'],
                    'commentText' => $_POST['comment-text'],
                    'commentDate' => date('Y-m-d H:i:s'),
                    'commentToPost' => $postId,
                    'commentAuthorName' => $modelUser->selectUserData(['userId' => $_SESSION['userId']])[0]['userName'],
                ];
                $this->model->makeComment($params);
                $this->view->redirect('/posts/post/' . $postId);
            }
        }
    }

    public function actionMakepost()
    {
        if (isset($_SESSION['userId'])) {
            $this->view->generate('Makepost.php', 'Postslayout.php');
        } else {
            header('Location: /posts/postlist');
        }
    }

    public function actionSearchpost()
    {
        if (isset($_SESSION['userId'])) {
            $data = [];
            if (isset($_POST['post-searchpost'])) {
                if (empty($_POST['searchpost-query'])) {
                    header('Location:/posts/searchpost');
                    exit();
                } else {
                    $query = htmlspecialchars($_POST['searchpost-query']);
                    $postsFound = $this->model->findPost($query);
                    if ($postsFound) {
                        $data['postsfound'] = $postsFound;
                        $this->view->generate('Searchpost.php', 'Postslayout.php', $data);
                        exit();
                    } else {
                        header('Location: /');
                    }
                }
            } else {
                $this->view->generate('Searchpost.php', 'Postslayout.php', $data);
            }
        } else {
            header('Location: /');
        }
    }

    public function actionMakepostact()
    {
        if (isset($_POST['post-create'])) {
            if (empty($_POST['posttile']) || empty($_POST['postcategory']) || empty($_POST['posttext'])) {
                header('Location:/posts/makepost?emptyfields');
                exit();
            } else {
                file_put_contents('check_file.json', json_encode($_FILES));
                $params = [
                    'postTitle' => htmlspecialchars($_POST['posttile']),
                    'postContent' => htmlspecialchars($_POST['posttext']),
                    'postCategory' => htmlspecialchars($_POST['postcategory']),
                    'postDateTime' => date('Y-m-d H:i:s'),
                    'postAuthor' => $_SESSION['userUid'],
                    'postAuthorId' => $_SESSION['userId'],
                ];
                $file = $_FILES;
                $this->model->createPost($params, $file);
                $this->view->redirect('/posts/postlist');
            }
        }
    }

    public function actionPostlike($postId)
    {
        $likeFrom = $_SESSION['userId'];
        $params = [
            'postId' => $postId,
            'From' => $likeFrom,
        ];
        $checkLike = $this->model->checkLike($params);
        $checkDisLike = $this->model->checkDisLike($params);
        if (empty($checkLike) and empty($checkDisLike)) {
            $this->model->makeLike($params);
        } elseif (!empty($checkLike)) {
            $this->model->deleteLike($params);
        } elseif (!empty($checkDisLike)) {
            $this->model->deleteDisLike($params);
        };
        $this->view->redirect('/posts/post/' . $postId);
    }

    public function actionPostDislike($postId)
    {
        $disLikeFrom = $_SESSION['userId'];
        $params = [
            'postId' => $postId,
            'From' => $disLikeFrom,
        ];
        $checkLike = $this->model->checkLike($params);
        $checkDisLike = $this->model->checkDisLike($params);
        if (empty($checkLike) and empty($checkDisLike)) {
            $this->model->makeDisLike($params);
        } elseif (!empty($checkLike)) {
            $this->model->deleteLike($params);
        } elseif (!empty($checkDisLike)) {
            $this->model->deleteDisLike($params);
        };
        $this->view->redirect('/posts/post/' . $postId);
    }

    public function actionCommentlike($commentId)
    {
        $likeFrom = $_SESSION['userId'];
        $params = [
            'commentId' => $commentId,
            'fromUser' => $likeFrom,
        ];
        $checkLike = $this->model->checkCommentLike($params);
        $checkDisLike = $this->model->checkCommentDisLike($params);
        if (empty($checkLike) and empty($checkDisLike)) {
            $this->model->makeCommentLike($params);
        } elseif (!empty($checkLike)) {
            $this->model->deleteCommentLike($params);
        } elseif (!empty($checkDisLike)) {
            $this->model->deleteCommentDisLike($params);
        };
        $this->view->redirect('/posts/postlist');
    }

    public function actionCommentDislike($commentId)
    {
        $likeFrom = $_SESSION['userId'];
        $params = [
            'commentId' => $commentId,
            'fromUser' => $likeFrom,
        ];
        $checkLike = $this->model->checkCommentLike($params);
        $checkDisLike = $this->model->checkCommentDisLike($params);
        if (empty($checkLike) and empty($checkDisLike)) {
            $this->model->makeCommentLike($params);
        } elseif (!empty($checkLike)) {
            $this->model->deleteCommentLike($params);
        } elseif (!empty($checkDisLike)) {
            $this->model->deleteCommentDisLike($params);
        };
        $this->view->redirect('/posts/postlist');
    }
}
