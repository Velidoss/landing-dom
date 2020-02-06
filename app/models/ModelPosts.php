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
}
