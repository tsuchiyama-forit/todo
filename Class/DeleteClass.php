<?php
// Call Database Class
require_once('./Class/DatabaseClass.php');

class DeleteClass extends DatabaseClass {

    // WhereIDで削除する
    public function deletePost($post_id) {
        $sql = 'DELETE FROM posts WHERE id = ?';
        $data[] = $post_id;
        $this->prepareQuery($sql);
        $this->execute($sql,null,$data);
    }
    
}

?>