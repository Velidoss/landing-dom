<?php

require_once 'app/core/Dbh.php';

class ModelPosts extends Dbh
{
    public function showPostlist()
    {
        $sql = "SELECT postAuthor, postDateTime, postTitle, postContent from posts;";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function createPost($postTitle,  $postText, $postDateTime, $postCategory, $postAuthor ){
        $sql = "INSERT INTO posts (postTitle, postContent , postDateTime , postCategory , postAuthor ) VALUES (?,?,?,?,?);";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$postTitle, $postText, $postDateTime, $postCategory, $postAuthor]);
        header("Location: /posts/makepost");
        exit();
        
    }
    
    
}
