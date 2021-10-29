function reset_password($username) {
// Устанавливает пароль для имени пользователя в случайное значение.
// Возвращает новый пароль или false в случае неудачи.
  // Получить случайное слово из словаря длиной от 6 до 13 символов.
  $new_password = get_random_word(6, 13);
 
  if($new_password == false) {
    // Установить стандартный пароль.
    $new_password = "changeMe!";
  }
 
  // Добавить к нему число между 0 и 999, чтобы
  // получить несколько улучшенный пароль.
  $rand_number = rand(0, 999);
  $new_password .= $rand_number;
 
  // Обновить пароль пользователя в базе данных или возвратить false.
  $conn = db_connect();
  $result = $conn->query("update user
                          set passwd = sha1('".$new_password."')
                          where username = '".$username."'");
  if (!$result) {
    throw new Exception('Не удалось изменить пароль.');  // пароль не изменен
  } else {
    return $new_password;  // пароль успешно изменен
  }
}