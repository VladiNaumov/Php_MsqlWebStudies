<?php

// Включить файлы функций для этого приложения.
require_once('book_sc_fns.php');
session_start();

do_html_header("Добавление категории");
if (check_admin_user()) {
  display_category_form();
  do_html_url("admin.php", "Назад в меню администрирования");
} else {
  echo "<p>Вы не авторизованы для входа в административную область.</p>";
}
do_html_footer();

?>
