function notify_password($username, $password) {
// Уведомляет пользователя о том, что его пароль был изменен.
 
    $conn = db_connect();
    $result = $conn->query("select email from user
                            where username='".$username."'");
    if (!$result) {
      throw new Exception('Не удалось найти адрес электронной почты.');
    } else if ($result->num_rows == 0) {
      throw new Exception('Не удалось найти адрес электронной почты.');
      // Имя пользователя отсутствует в базе данных.
    } else {
      $row = $result->fetch_object();
      $email = $row->email;
      $from = "From: support@phpbookmark \r\n";
      $mesg = "Ваш пароль для входа в систему PHPBookmark был изменен на ".$password."\r\n".
              "Пожалуйста, смените пароль при следующем входе.\r\n";
 
      if (mail($email, 'Информация о входе в систему PHPBookmark', $mesg, $from)) {
        return true;
      } else {
        throw new Exception('Не удалось отправить электронную почту.');
      }
    }
}