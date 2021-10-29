<?php
  include ('book_sc_fns.php');
  // Корзина для покупок нуждается в сеансах, поэтому запустить сеанс.
  session_start();

  $isbn = $_GET['isbn'];

  // Извлечь книгу из базы данных.
  $book = get_book_details($isbn);
  do_html_header($book['title']);
  display_book_details($book);

  // Установить URL для кнопки "Продолжить".
  $target = "index.php";
  if($book['catid']) {
    $target = "show_cat.php?catid=". urlencode($book['catid']);
  }

  // Если это администратор, тогда показать
  // ссылку для редактирования книги.
  if(check_admin_user()) {
    display_button("edit_book_form.php?isbn=". urlencode($isbn), "edit-item", "Редактировать книгу");
    display_button("admin.php", "admin-menu", "Меню администрирования");
    display_button($target, "continue", "Продолжить");
  } else {
    display_button("show_cart.php?new=". urlencode($isbn), "add-to-cart",
                   "Добавить ". htmlspecialchars($book['title']) ." в мою корзину для покупок");
    display_button($target, "continue-shopping", "Продолжить покупки");
  }

  do_html_footer();
?>