<?php

class PostMethod {
    public static function get($key, $def = '') {
        return $_POST[$key] ?? $def;
    }
}

?>