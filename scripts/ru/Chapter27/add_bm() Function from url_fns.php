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