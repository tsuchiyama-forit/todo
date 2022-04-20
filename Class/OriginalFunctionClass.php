<?php

// こちらは好きなファンクションを書き込んでも良い

class OriginalFunction {

        // bind関数の$typeを取得するため
        public function getBindType($value) {
            $type = null;
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default : 
                    $type = PDO::PARAM_STR;
            }
            return $type;
        }
        
}

?>