<?php

// Включить файлы функций для приложения.
require_once('book_sc_fns.php');
session_start();

do_html_header("Редактирование сведений о книге");
if (check_admin_user()) {
  if ($book = get_book_details($_GET['isbn'])) {
    display_book_form($book);
  } else {
    echo "<p>Не удалось извлечь сведения о книге.</p>";
  }
  do_html_url("admin.php", "Назад в меню администрирования");
} else {
  echo "<p>Вы не авторизованы для входа в административную область.</p>";
}
do_html_footer();

?>
