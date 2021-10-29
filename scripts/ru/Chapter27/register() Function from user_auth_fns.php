function register($username, $email, $password) {
// Регистрирует нового пользователя в базе данных.
// Возвращает true или генерирует исключение.
 
  // Подключиться к базе данных.
  $conn = db_connect();
 
  // Проверить, уникально ли имя пользователя.
  $result = $conn->query("select * from user where username='".$username."'");
  if (!$result) {
    throw new Exception('Не удалось выполнить запрос.');
  }
 
  if ($result->num_rows>0) {
    throw new Exception('Такое имя пользователя уже выдано - вернитесь назад и выберите другое имя.');
  }
 
  // Если все в порядке, то поместить сведения в базу данных.
  $result = $conn->query("insert into user values
                         ('".$username."', sha1('".$password."'), '".$email."')");
  if (!$result) {
    throw new Exception('Не удалось зарегистрировать пользователя в базе данных - пожалуйста, повторите попытку позже.');
  }
 
  return true;
}