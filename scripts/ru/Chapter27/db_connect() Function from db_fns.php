<?php

function db_connect() {
   $result = new mysqli('localhost', 'bm_user', 'password', 'bookmarks');
   if (!$result) {
     throw new Exception('Не удалось подключиться к серверу базы данных.');
   } else {
     return $result;
   }
}

?>