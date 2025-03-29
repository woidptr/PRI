<?php

session_start();

class Session {
    public static function setValue(string $key, $value) {
        $_SESSION[$key] = $value;
    }
}

?>