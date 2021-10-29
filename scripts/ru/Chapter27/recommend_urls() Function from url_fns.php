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