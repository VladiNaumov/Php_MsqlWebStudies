<?php
  include_once 'book_sc_fns.php';
  // Корзина для покупок нуждается в сеансах, поэтому запустить сеанс.
  session_start();
  do_html_header("Добро пожаловать в магазин Буквофил");

  echo "<p>Пожалуйста, выберите категорию:</p>";

  // Извлечь категории из базы данных.
  $cat_array = get_categories();

  // Отобразить в виде ссылок на страницы категорий.
  display_categories($cat_array);

  // Если это администратор, тогда показать ссылки 
  // для добавления, удаления и редактирования категорий.
  if(isset($_SESSION['admin_user'])) {
    display_button("admin.php", "admin-menu", "Меню администрирования");
  }
  do_html_footer();
?>