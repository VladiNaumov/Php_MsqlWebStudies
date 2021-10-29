<?php

require_once('db_fns.php');

function login($username, $password) {
// Проверяет имя пользователя и пароль по базе данных.
// Если они найдены, тогда возвращает true, а иначе false.

  // Подключиться к базе данных.
  $conn = db_connect();
  if (!$conn) {
    return 0;
  }

  // Проверить уникальность имени пользователя.
  $result = $conn->query("select * from admin
                         where username='". $conn->real_escape_string($username)."'
                         and password = sha1('". $conn->real_escape_string($password)."')");
  if (!$result) {
     return 0;
  }

  if ($result->num_rows>0) {
     return 1;
  } else {
     return 0;
  }
}

function check_admin_user() {
// Выясняет, вошел ли кто-то в систему, и уведомляет, если нет.

  if (isset($_SESSION['admin_user'])) {
    return true;
  } else {
    return false;
  }
}

function change_password($username, $old_password, $new_password) {
// Изменяет пароль для username/old_password на new_password.
// return true or false

  // Если старый пароль указан правильно, тогда изменить
  // пароль пользователя на новый и возвратить true.
  // В противном случае возвратить false.
  if (login($username, $old_password)) {

    if (!($conn = db_connect())) {
      return false;
    }

    $result = $conn->query("update admin
                            set password = sha1('". $conn->real_escape_string($new_password)."')
                            where username = '". $conn->real_escape_string($username) ."'");
    if (!$result) {
      return false;  // не изменился
    } else {
      return true;  // изменился успешно
    }
  } else {
    return false; // старый пароль указан некорректно
  }
}

?>