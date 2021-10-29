<?php

// Включить файлы функций для этого приложения.
require_once('book_sc_fns.php');
session_start();

do_html_header("Добавление категории");
if (check_admin_user()) {
  if (filled_out($_POST))   {
    $catname = $_POST['catname'];
    if(insert_category($catname)) {
      echo "<p>Категория \"".htmlspecialchars($catname)."\" была добавлена в базу данных.</p>";
    } else {
      echo "<p>Категория \"".htmlspecialchars($catname)."\" не может быть добавлена в базу данных.</p>";
    }
  } else {
    echo "<p>Вы не заполнили форму. Пожалуйста, попробуйте заново.</p>";
  }
  do_html_url('admin.php', 'Назад в меню администрирования');
} else {
  echo "<p>Вы не авторизованы, чтобы просматривать эту страницу.</p>";
}

do_html_footer();

?>
