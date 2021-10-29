<?php
  include ('book_sc_fns.php');
  // Корзина для покупок нуждается в сеансах, поэтому запустить сеанс.
  session_start();

  $catid = $_GET['catid'];
  $name = get_category_name($catid);

  do_html_header($name);

  // Извлечь из базы данных книги категории catid.
  $book_array = get_books($catid);

  display_books($book_array);

  // Если это администратор, тогда показать ссылки
  // для добавления, удаления и редактирования книг.
  if(isset($_SESSION['admin_user'])) {
    display_button("index.php", "continue", "Продолжить покупки");
    display_button("admin.php", "admin-menu", "Меню администрирования");
    display_button("edit_category_form.php?catid=". urlencode($catid),
                   "edit-category", "Редактировать категорию");
  } else {
    display_button("index.php", "continue-shopping", "Продолжить покупки");
  }

  do_html_footer();
?>