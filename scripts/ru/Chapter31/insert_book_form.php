<?php

// Включить файлы функций для приложения.
require_once('book_sc_fns.php');
session_start();

do_html_header("Добавление книги");
if (check_admin_user()) {
  display_book_form();
  do_html_url("admin.php", "Назад в меню администрирования");
} else {
  echo "<p>Вы не авторизованы для входа в административную область.</p>";
}
do_html_footer();

?>