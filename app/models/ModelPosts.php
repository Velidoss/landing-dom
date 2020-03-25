<?php

require_once 'app/core/Dbh.php';

class ModelPosts extends Dbh
{
    public function showPostlist()
    {
        $sql = "SELECT * from posts order by postDateTime DESC ;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function showPost($postId)
    {
        $sql = "SELECT * from posts where postId=? ;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);
        $result = $stmt->fetch();
        return $result;
    }

    public function createPost($postTitle,  $postText, $postDateTime, $postCategory, $postAuthor, $postAuthorId,
                               $postImg ){
        $sql = "INSERT INTO posts (postTitle, postContent , postDateTime , postCategory , postAuthor , postAuthorId, postimg ) VALUES (?,?,?,?,?,?,?);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postTitle, $postText, $postDateTime, $postCategory, $postAuthor, $postAuthorId,$postImg]);
    }
    public function findPost($query){
        $sql = "SELECT postAuthor, postDateTime, postTitle, postContent FROM posts WHERE postAuthor like '%$query%' or postTitle like '%$query%' or postContent like '%$query%';";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$query]);
        $result = $stmt->fetchAll();
       
        if($result) {
            return $result;
        }else{
            return null;
        }
    }

    public function makeComment($commentAuthor , $commentText , $commentPost , $commentDate , $commnetAuthorName)
    {
        $sql = "INSERT INTO comments ( commentAuthor , commentText , commentToPost, commentDate, commentAuthorName) VALUES (?,?,?,?,?);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$commentAuthor , $commentText , $commentPost, $commentDate , $commnetAuthorName ]);
    }

    public function showComments($postId)
    {
        $sql = "SELECT commentAuthor , commentText , commentToPost, commentDate , commentAuthorName FROM comments WHERE commentToPost=?;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId]);

        $result = $stmt->fetchAll();

        if($result){
            return $result;
        }
    }

    public function makeLike($postId, $userId)
    {
        $sql = "INSERT INTO postlikes( postId , likeFrom ) VALUES (?,?);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postId, $userId]);
    }

    public function checkLike($userId)
    {
        $sql = "SELECT postId , likeFrom FROM postlikes WHERE likeFrom=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
        $result = $stmt->fetchAll();
        file_put_contents('content1.json' , $result);
        if(!isset($result)){
            return true;
        }else{
            return false;
        }
    }

 
}
