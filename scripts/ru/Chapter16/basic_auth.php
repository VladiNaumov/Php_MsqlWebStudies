<?php
if ((!isset($_SERVER['PHP_AUTH_USER'])) &&
    (!isset($_SERVER['PHP_AUTH_PW'])) &&
    (substr($_SERVER['HTTP_AUTHORIZATION'], 0, 6) == 'Basic ')
   ) {

  list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) =
    explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}

// замените этот оператор if запросом к базе данных или чем-нибудь подобным
if (($_SERVER['PHP_AUTH_USER'] != 'user') ||
   ($_SERVER['PHP_AUTH_PW'] != 'pass')) {

   // посетитель пока не предоставил сведения либо 
   // комбинация его имени и пароля не корректна

  header('WWW-Authenticate: Basic realm="Realm-Name"');
  header('HTTP/1.0 401 Unauthorized');
} else {
?>
<!DOCTYPE html>
<html>
<head>
   <title>Секретная страница</title>
</head>
<body>
<?php

echo '<h1>Вот она!</h1>
      <p>Бьемся об заклад, что вы безумно рады возможности видеть эту секретную страницу.</p>';
}
?>
</body>
</html>