<?php

namespace app\models;

use app\core\Dbh;

require_once 'app/core/Dbh.php';

class ModelPosts extends Dbh
{
    public function showPostlist($limit=[])
    {
        if(empty($limit)){
            $sql = 'SELECT * from posts order by postDateTime DESC ;';
        }else{
            $sql = 'SELECT * from posts order by postDateTime DESC LIMIT :start,:perpage';
        }
        
        return $this->getRow($sql, $limit);
    }

    public function countPosts()
    {
        $sql = 'SELECT COUNT(postId) FROM posts';
        return $this->getColumn($sql);
    }

    public function countComments()
    {
        $sql = 'SELECT COUNT(commentId) FROM comments';
        return $this->getColumn($sql);
    }

    public function countAuthorPosts($data)
    {
        $sql = 'SELECT COUNT(postId) FROM posts where postAuthorId=:postAuthorId';
        return $this->getColumn($sql, $data);
    }

    public function countAuthorComments($data)
    {
        $sql = 'SELECT COUNT(commentId) FROM comments where commentAuthor=:commentAuthor';
        return $this->getColumn($sql, $data);
    }

    public function showPost($postId)
    {
        $sql = 'SELECT * from posts where postId=? ;';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        $result = $stmt->fetch();
        return $result;
    }

    public function createPost($params = [], $file = null)
    {
        $sql = 'INSERT INTO posts (postTitle, postContent , postDateTime , postCategory , postAuthor , postAuthorId) VALUES (:postTitle, :postContent , :postDateTime , :postCategory , :postAuthor , :postAuthorId);';
        $this->query($sql, $params);
        $postId = $this->db->lastInsertId();
        file_put_contents('check_file.json', json_encode($file));
        $allowed_types = ['image/jpg', 'image/png', 'image/jpeg'];
        $uploadDir = 'img/postimages/';
        if ($file['post-img']['size'] < 5000000) {
            if (in_array($file['post-img']['type'], $allowed_types)) {
                if ($file['post-img']['tmp_name']) {
                    move_uploaded_file($file['post-img']['tmp_name'], $uploadDir . $postId . '.jpg');
                    $sql = 'UPDATE posts SET postImg=:postImg WHERE postId=:lastInsertedId;';
                    $this->query($sql, $params = ['postImg' => '/' . $uploadDir . $postId . '.jpg', 'lastInsertedId' => $postId]);
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findPost($query)
    {
        $sql = "SELECT postAuthor, postDateTime, postTitle, postContent FROM posts WHERE postAuthor like '%$query%' or postTitle like '%$query%' or postContent like '%$query%';";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$query]);
        $result = $stmt->fetchAll();

        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function makeComment($params = [])
    {
        $sql = 'INSERT INTO comments(commentAuthor, commentText, commentToPost, commentDate, commentAuthorName ) VALUES ( :commentAuthor, :commentText, :commentToPost, :commentDate, :commentAuthorName);';
        $this->query($sql, $params);
    }

    public function showComments($postId)
    {
        $sql = 'SELECT * FROM comments WHERE commentToPost=?;';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);

        $result = $stmt->fetchAll();

        if ($result) {
            return $result;
        }
    }

    public function makeLike($params = [])
    {
        $sql = 'INSERT INTO postlikes( postId , likeFrom ) VALUES (:postId , :From);';
        $this->query($sql, $params);
    }

    public function deleteLike($params = [])
    {
        $sql = 'DELETE FROM postlikes WHERE postId=:postId AND likeFrom=:From';
        $this->query($sql, $params);
    }

    public function makeDisLike($params = [])
    {
        $sql = 'INSERT INTO postdislikes( postId , disLikeFrom ) VALUES (:postId , :From);';
        $this->query($sql, $params);
    }

    public function deleteDisLike($params = [])
    {
        $sql = 'DELETE FROM postdislikes WHERE postId=:postId AND disLikeFrom=:From';
        $this->query($sql, $params);
    }

    public function checkLike($params = [])
    {
        $sql = 'SELECT postId , likeFrom FROM postlikes WHERE postId=:postId AND likeFrom=:From';
        $result = $this->getRow($sql, $params);
        return $result;
    }

    public function checkDisLike($params = [])
    {
        $sql = 'SELECT postId , disLikeFrom FROM postdislikes WHERE postId=:postId AND disLikeFrom=:From';
        $result = $this->getRow($sql, $params);
        return $result;
    }

    public function showLikes($params = [])
    {
        $sql = 'SELECT COUNT(postId) FROM postlikes WHERE postId=:postId';
        $totalLikes = $this->getRow($sql, $params)[0]['COUNT(postId)'];
        $sql = 'SELECT COUNT(postId) FROM postdislikes WHERE postId=:postId';
        $totalDisLikes = $this->getRow($sql, $params)[0]['COUNT(postId)'];
        return $totalLikes - $totalDisLikes;
    }

    public function makeCommentLike($params = [])
    {
        $sql = 'INSERT INTO commentlikes( commentId , fromUser ) VALUES (:commentId , :fromUser);';
        $this->query($sql, $params);
    }

    public function deleteCommentLike($params = [])
    {
        $sql = 'DELETE FROM commentlikes WHERE commentId=:commentId AND fromUser=:fromUser';
        $this->query($sql, $params);
    }

    public function makeCommentDisLike($params = [])
    {
        $sql = 'INSERT INTO commentdislikes( commentId , fromUser ) VALUES (:commentId , :fromUser);';
        $this->query($sql, $params);
    }

    public function deleteCommentDisLike($params = [])
    {
        $sql = 'DELETE FROM commentdislikes WHERE commentId=:commentId AND fromUser=:fromUser';
        $this->query($sql, $params);
    }

    public function checkCommentLike($params = [])
    {
        $sql = 'SELECT commentId , fromUser FROM commentlikes WHERE commentId=:commentId AND fromUser=:fromUser';
        $result = $this->getRow($sql, $params);
        return $result;
    }

    public function checkCommentDisLike($params = [])
    {
        $sql = 'SELECT commentId , fromUser FROM commentdislikes WHERE commentId=:commentId AND fromUser=:fromUser';
        $result = $this->getRow($sql, $params);
        return $result;
    }

    public function showCommentLikes($params = [])
    {
        $sql = 'SELECT COUNT(commentId) FROM commentlikes WHERE commentId=:commentId';
        $totalLikes = $this->getRow($sql, $params)[0]['COUNT(commentId)'];
        $sql = 'SELECT COUNT(commentId) FROM commentdislikes WHERE commentId=:commentId';
        $totalDisLikes = $this->getRow($sql, $params)[0]['COUNT(commentId)'];
        return $totalLikes - $totalDisLikes;
    }
}
