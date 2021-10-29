<?php
require_once('db_fns.php');

function get_user_urls($username) {
// Извлекает из базы данных все URL, которые сохранил этот пользователь.
 
  $conn = db_connect();
  $result = $conn->query("select bm_URL
                          from bookmark
                          where username = '".$username."'");
  if (!$result) {
    return false;
  }
 
  // Создать массив URL.
  $url_array = array();
  for ($count = 1; $row = $result->fetch_row(); ++$count) {
    $url_array[$count] = $row[0];
  }
  return $url_array;
}

function add_bm($new_url) {
// Добавляет новую закладку в базу данных.
 
  echo "Попытка добавления ".htmlspecialchars($new_url)."<br />";
  $valid_user = $_SESSION['valid_user'];
 
  $conn = db_connect();
 
  // Проверить, не повторяется ли закладка.
  $result = $conn->query("select * from bookmark
                         where username='$valid_user'
                         and bm_URL='".$new_url."'");
  if ($result && ($result->num_rows>0)) {
    throw new Exception('Закладка уже существует.');
  }
 
  // Вставить новую закладку.
  if (!$conn->query("insert into bookmark values
     ('".$valid_user."', '".$new_url."')")) {
    throw new Exception('Не удалось вставить закладку.');
  }
 
  return true;
} 

function delete_bm($user, $url) {
// Удаляет один URL из базы данных.
  $conn = db_connect();
 
  // Удалить закладку.
  if (!$conn->query("delete from bookmark where
                    username='".$user."' 
                    and bm_url='".$url."'")) {
     throw new Exception('Не удалось удалить закладку.');
  }
  return true;
}

function recommend_urls($valid_user, $popularity = 1) {
// Мы будем предоставлять людям полуинтеллектуальные рекомендации.
// Если они имеют URL, присутствующий у других пользователей, тогда
// им может понравиться то, что нравится другим пользователям.
  $conn = db_connect();
 
  // Найти других пользователей, у которых есть URL, 
  // совпадающий с URL текущего пользователя. 
  // В качестве простого способа исключения личных страниц пользователей
  // и повышения шансов порекомендовать привлекательные URL мы указываем
  // минимально необходимый уровень популярности.
  // Если $popularity = 1, то более одного пользователя 
  // должны иметь URL, чтобы он был рекомендован.

  $query = "select bm_URL
            from bookmark
            where username in
              (select distinct(b2.username)
               from bookmark b1, bookmark b2
               where b1.username='".$valid_user."'
               and b1.username != b2.username
               and b1.bm_URL = b2.bm_URL)
            and bm_URL not in
               (select bm_URL
                from bookmark
                where username='".$valid_user."')
            group by bm_url
            having count(bm_url)>".$popularity;
 
  if (!($result = $conn->query($query))) {
     throw new Exception('Не удалось найти закладки для рекомендации.');
  }
 
  if ($result->num_rows==0) {
     throw new Exception('Не удалось найти закладки для рекомендации.');
  }
 
  $urls = array();
  // Построить массив подходящих URL.
  for ($count=0; $row = $result->fetch_object(); $count++) {
     $urls[$count] = $row->bm_URL;
  }
 
  return $urls;
}

?>