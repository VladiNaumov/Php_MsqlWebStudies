<?php

// Включить файлы функций для этого приложения.
require_once('book_sc_fns.php');
session_start();

do_html_header("Обновление книги");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    $oldisbn = $_POST['oldisbn'];
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if(update_book($oldisbn, $isbn, $title, $author, $catid, $price, $description)) {
      echo "<p>Книга была обновлена.</p>";
    } else {
      echo "<p>Книга не может быть обновлена.</p>";
    }
  } else {
    echo "<p>Вы не заполнили форму. Пожалуйста, попробуйте заново.</p>";
  }
  do_html_url("admin.php", "Назад в меню администрирования");
} else {
  echo "<p>Вы не авторизованы, чтобы просматривать эту страницу.</p>";
}

do_html_footer();

?>
