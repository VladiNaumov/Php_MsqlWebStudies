<?php

function do_html_header($title) {
// Выводит верхний колонтитул HTML.
?>
<!doctype html>
  <html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <style>
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #3333cc;}
      a { color: #000 }
      div.formblock
         { background: #ccc; width: 300px; padding: 6px; border: 1px solid #000;}
    </style>
  </head>
  <body>
  <div>
    <img src="bookmark.gif" alt="Логотип PHPbookmark" height="55" width="57" style="float: left; padding-right: 6px;" />
      <h1>PHPbookmark</h1>
  </div>
  <hr />
<?php
  if($title) {
    do_html_heading($title);
  }
}

function do_html_footer() {
// Выводит нижний колонтитул HTML.
?>
  </body>
  </html>
<?php
}

function do_html_heading($heading) {
// Выводит заголовок.
?>
  <h2><?php echo $heading;?></h2>
<?php
}

function do_html_URL($url, $name) {
// Выводит URL в виде ссылки и символ новой строки.
?>
  <br><a href="<?php echo $url;?>"><?php echo $name;?></a><br>
<?php
}

function display_site_info() {
// Выводит маркетинговую информацию.
?>
  <ul>
  <li>Храните онлайновые закладки вместе с нами!</li>
  <li>Смотрите, какие веб-сайты посещают другие пользователи!</li>
  <li>Делитесь своими избранными ссылками с другими!</li>
  </ul>
<?php
}

function display_login_form() {
?>
  <p><a href="register_form.php">Еще не зарегистрированы?</a></p>
  <form method="post" action="member.php">

  <div class="formblock">
    <h2>Вход для членов</h2>

    <p><label for="username">Имя пользователя:</label><br/>
    <input type="text" name="username" id="username" /></p>

    <p><label for="passwd">Пароль:</label><br/>
    <input type="password" name="passwd" id="passwd" /></p>

    <button type="submit">Войти</button>

    <p><a href="forgot_form.php">Забыли пароль?</a></p>
  </div>

 </form>
<?php
}

function display_registration_form() {
?>
 <form method="post" action="register_new.php">

 <div class="formblock">
    <h2>Регистрация</h2>

    <p><label for="email">Адрес электронной почты:</label><br/>
    <input type="email" name="email" id="email" 
      size="30" maxlength="100" required /></p>

    <p><label for="username">Имя пользователя <br>(максимум 16 символов):</label><br/>
    <input type="text" name="username" id="username" 
      size="16" maxlength="16" required /></p>

    <p><label for="passwd">Пароль <br>(от 6 до 16 символов):</label><br/>
    <input type="password" name="passwd" id="passwd" 
      size="16" maxlength="16" required /></p>

    <p><label for="passwd2">Подтверждение пароля:</label><br/>
    <input type="password" name="passwd2" id="passwd2" 
      size="16" maxlength="16" required /></p>


    <button type="submit">Зарегистрироваться</button>

   </div>

  </form>
<?php

}

function display_user_urls($url_array) {
// Отображает таблицу со списком URL.

  // Установить глобальную переменную, чтобы позже можно было проверить, присутствует ли таблица закладок на странице.
  global $bm_table;
  $bm_table = true;
?>
  <br>
  <form name="bm_table" action="delete_bms.php" method="post">
  <table width="300" cellpadding="2" cellspacing="0">
  <?php
  $color = "#cccccc";
  echo "<tr bgcolor=\"".$color."\"><td><strong>Закладка</strong></td>";
  echo "<td><strong>Удалить?</strong></td></tr>";
  if ((is_array($url_array)) && (count($url_array) > 0)) {
    foreach ($url_array as $url)  {
      if ($color == "#cccccc") {
        $color = "#ffffff";
      } else {
        $color = "#cccccc";
      }
      // При отображении пользовательских данных не забыть вызвать htmlspecialchars().
      echo "<tr bgcolor=\"".$color."\"><td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td>
            <td><input type=\"checkbox\" name=\"del_me[]\"
                value=\"".$url."\"></td>
            </tr>";
    }
  } else {
    echo "<tr><td>Закладки отсутствуют.</td></tr>";
  }
?>
  </table>
  </form>
<?php
}

function display_user_menu() {
// Отображение меню действий на данной странице.
?>
<hr>
<a href="member.php">Домой</a> &nbsp;|&nbsp;
<a href="add_bm_form.php">Добавить закладку</a> &nbsp;|&nbsp;
<?php
  // Предлагать действие удаления, только если таблица закладок на этой странице.
  global $bm_table;
  if ($bm_table == true) {
    echo "<a href=\"#\" onClick=\"bm_table.submit();\">Удалить закладку</a> &nbsp;|&nbsp;";
  } else {
    echo "<span style=\"color: #cccccc\">Удалить закладку</span> &nbsp;|&nbsp;";
  }
?>
<a href="change_passwd_form.php">Изменить пароль</a><br>
<a href="recommend.php">Порекомендовать мне URL</a> &nbsp;|&nbsp;
<a href="logout.php">Выход</a>
<hr>

<?php
}

function display_add_bm_form() {
// Отображение HTML-формы для ввода новой закладки.
?>
<form name="bm_table" action="add_bms.php" method="post">

 <div class="formblock">
    <h2>Новая закладка</h2>

    <p>
    <input type="text" name="new_url" id="new_url" 
      size="40" maxlength="255" value="http://" required /></p>

    <button type="submit">Добавить закладку</button>

   </div>

</form>
<?php
}

function display_password_form() {
// Отображение HTML-формы для изменения пароля.
?>
   <br>
   <form action="change_passwd.php" method="post">

 <div class="formblock">
    <h2>Изменение пароля</h2>

    <p><label for="old_passwd">Старый пароль:</label><br/>
    <input type="password" name="old_passwd" id="old_passwd" 
      size="16" maxlength="16" required /></p>

    <p><label for="passwd2">Новый пароль:</label><br/>
    <input type="password" name="new_passwd" id="new_passwd" 
      size="16" maxlength="16" required /></p>

    <p><label for="passwd2">Подтверждение нового пароля:</label><br/>
    <input type="password" name="new_passwd2" id="new_passwd2" 
      size="16" maxlength="16" required /></p>


    <button type="submit">Изменить пароль</button>

   </div>
   <br>
<?php
}

function display_forgot_form() {
// Отображение HTML-формы для переустановки пароля и его отправки по электронной почте.
?>
   <br>
   <form action="forgot_passwd.php" method="post">

 <div class="formblock">
    <h2>Забыли пароль?</h2>

    <p><label for="username">Введите свое имя пользователя:</label><br/>
    <input type="text" name="username" id="username" 
      size="16" maxlength="16" required /></p>

    <button type="submit">Переустановить пароль</button>

   </div>
   <br>
<?php
}

function display_recommended_urls($url_array) {
// По выводу похожа на display_user_urls().
// Вместо отображения закладок пользователя выводит рекомендации.
?>
  <br>
  <table width="300" cellpadding="2" cellspacing="0">
<?php
  $color = "#cccccc";
  echo "<tr bgcolor=\"".$color."\">
        <td><strong>Рекомендуемые URL</strong></td></tr>";
  if ((is_array($url_array)) && (count($url_array)>0)) {
    foreach ($url_array as $url) {
      if ($color == "#cccccc") {
        $color = "#ffffff";
      } else {
        $color = "#cccccc";
      }
      echo "<tr bgcolor=\"".$color."\">
            <td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td></tr>";
    }
  } else {
    echo "<tr><td>Сегодня рекомендаций нет.</td></tr>";
  }
?>
  </table>
<?php
}

?>