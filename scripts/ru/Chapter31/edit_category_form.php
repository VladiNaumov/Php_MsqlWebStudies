<?php

// Включить файлы функций для приложения.
require_once('book_sc_fns.php');
session_start();

do_html_header("Редактирование категории");
if (check_admin_user()) {
  if ($catname = get_category_name($_GET['catid'])) {
    $catid = $_GET['catid'];
    $cat = compact('catname', 'catid');
    display_category_form($cat);
  } else {
    echo "<p>Не удалось извлечь сведения о категории.</p>";
  }
  do_html_url("admin.php", "Назад в меню администрирования");
} else {
  echo "<p>Вы не авторизованы для входа в административную область.</p>";
}
do_html_footer();

?>
