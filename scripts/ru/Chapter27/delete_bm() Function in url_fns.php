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