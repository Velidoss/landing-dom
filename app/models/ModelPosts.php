<?php

require_once 'app/core/Dbh.php';

class ModelPosts extends Dbh
{
    public function showPostlist()
    {
        $sql = 'SELECT * from posts order by postDateTime DESC ;';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function showPost($postId)
    {
        $sql = 'SELECT * from posts where postId=? ;';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        $result = $stmt->fetch();
        return $result;
    }

    public function createPost($params = [])
    {
        $sql = 'INSERT INTO posts (postTitle, postContent , postDateTime , postCategory , postAuthor , postAuthorId, postimg ) VALUES (:postTitle, :postContent , :postDateTime , :postCategory , :postAuthor , :postAuthorId, :postimg);';
        $this->query($sql, $params);
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
        $sql = 'SELECT commentAuthor , commentText , commentToPost, commentDate , commentAuthorName FROM comments WHERE commentToPost=?;';
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
        return $totalLikes-$totalDisLikes;
    }
}
