<?php

// Включить файлы функций для этого приложения.
require_once('book_sc_fns.php');
session_start();

do_html_header("Удаление книги");
if (check_admin_user()) {
  if (isset($_POST['isbn'])) {
    $isbn = $_POST['isbn'];
    if(delete_book($isbn)) {
      echo "<p>Книга ".htmlspecialchars($isbn)." была удалена.</p>";
    } else {
      echo "<p>Книга ".htmlspecialchars($isbn)." не может быть удалена.</p>";
    }
  } else {
    echo "<p>Для удаления книги нужен номер ISBN. Пожалуйста, попробуйте заново.</p>";
  }
  do_html_url("admin.php", "Назад в меню администрирования");
} else {
  echo "<p>Вы не авторизованы, чтобы просматривать эту страницу.</p>";
}

do_html_footer();

?>
