<?php
// Call Database Class
require_once('./Class/DatabaseClass.php');

class CreateClass extends DatabaseClass {
    public function insertPost($post_title,$post_content) {
        $sql = 'INSERT INTO posts (title,content) VALUES (?,?)';
        $this->prepareQuery($sql);
        $data[] = $post_title;
        $data[] = $post_content;
        $return = $this->execute($sql,null,$data);
    }
}

?>