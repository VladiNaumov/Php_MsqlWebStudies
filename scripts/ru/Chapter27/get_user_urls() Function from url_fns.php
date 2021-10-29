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