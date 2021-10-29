function change_password($username, $old_password, $new_password) {
// Изменяет пароль для пары username/old_password на new_password.
// Возвращает true или false.
 
  // Если старый пароль указан правильно, тогда изменить
  // пароль пользователя на new_password и возвратить true.
  // Иначе сгенерировать исключение.
  login($username, $old_password);
  $conn = db_connect();
  $result = $conn->query("update user
                          set passwd = sha1('".$new_password."')
                          where username = '".$username."'");
  if (!$result) {
    throw new Exception('Пароль изменить не удалось.');
  } else {
    return true;  // пароль успешно изменен
  }
}