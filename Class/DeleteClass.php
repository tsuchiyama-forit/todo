<?php
// Call Database Class
require_once('./Class/DatabaseClass.php');

class DeleteClass extends DatabaseClass {
    public function deletePost($post_id) {
        $sql = 'DELETE FROM posts WHERE id = ?';
        $this->prepareQuery($sql);
        $data[] = $post_id;
        $this->execute($sql,null,$data);
    }
}

?>