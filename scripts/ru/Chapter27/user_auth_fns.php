<?php

require_once('db_fns.php');

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

function login($username, $password) {
// Проверяет наличие сведений о пользователе в базе данных.
// Возвращает true, если они обнаружены, и генерирует 
// исключение в противном случае.

  // Подключиться к базе данных.
  $conn = db_connect();
 
  // Проверить, уникально ли имя пользователя.
  $result = $conn->query("select * from user
                         where username='".$username."'
                         and passwd = sha1('".$password."')");
  if (!$result) {
     throw new Exception('Не удалось выполнить вход.');
  }
 
  if ($result->num_rows>0) {
     return true;
  } else {
     throw new Exception('Не удалось выполнить вход.');
  }
}

function check_valid_user() {
// Выясняет, вошел ли пользователь, и уведомляет его, если нет.
  if (isset($_SESSION['valid_user']))  {
      echo "Вход от имени пользователя ".$_SESSION['valid_user'].".<br>";
  } else {
     // Пользователь не вошел в систему.
     do_html_heading('Проблема:');
     echo 'Вы не вошли в систему.<br>';
     do_html_url('login.php', 'Вход');
     do_html_footer();
     exit;
  }
}

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

function get_random_word($min_length, $max_length) {
// Извлекает из словаря случайное слово длиной
// от min_length до max_length и возвращает его.
 
  // Сгенерировать случайное слово.
  $word = '';
  // Не забудьте привести этот путь в соответствие со своей системой.
  $dictionary = '/usr/dict/words';  // словарь ispell
  $fp = @fopen($dictionary, 'r');
  if(!$fp) {
    return false;
  }
  $size = filesize($dictionary);
 
  // Перейти к случайному местоположению в словаре.
  $rand_location = rand(0, $size);
  fseek($fp, $rand_location);
 
  // Получить из файла следующее полное слово подходящей длины.
  while ((strlen($word) < $min_length) || (strlen($word)>$max_length) || (strstr($word, "'"))) {
     if (feof($fp)) {
        fseek($fp, 0);        // если достигнут конец файла, то перейти в его начало
     }
     $word = fgets($fp, 80);  // пропустить первое слово, т.к. оно может быть неполным
     $word = fgets($fp, 80);  // потенциальное слово для пароля
  }
  $word = trim($word);        // отбросить завершающий символ \n из результата fgets()
  return $word;
}

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

?>
