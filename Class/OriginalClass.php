<?php

// Original Functions will be Written here

class OriginalClass {

    // Function for htmlspecialchars
    public function specialCharCheck($text) {
        return htmlspecialchars($text,ENT_QUOTES,'UTF-8');
    }

    // タイトルは５０文字超えるとDBに保存しない
    public function newTitleLengthCheck($post_title) {
        if (strlen($post_title) > 50) { return true; }
    }

    // タイトルと内容が空欄の場合
    public function checkEmpty($value) {
        if ($value == ' ') { return true; }
    }

}

?>