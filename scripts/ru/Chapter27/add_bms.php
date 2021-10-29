<?php
 require_once('bookmark_fns.php');
 session_start();
 
  // Создать короткие имена переменных.
  $new_url = $_POST['new_url'];
 
  do_html_header('Добавление закладок');
 
  try {
    check_valid_user();
    if (!filled_out($_POST)) {
      throw new Exception('Форма не была заполнена.');
    }
    // Проверить формат URL.
    if (strstr($new_url, 'http://') === false) {
       $new_url = 'http://'.$new_url;
    }
 
    // Проверить допустимость URL.
    if (!(@fopen($new_url, 'r'))) {
      throw new Exception('Недопустимый URL.');
    }
 
    // Попытаться добавить закладку.
    add_bm($new_url);
    echo 'Закладка добавлена.';
 
    // Получить закладки, сохраненные этим пользователем.
    if ($url_array = get_user_urls($_SESSION['valid_user'])) {
      display_user_urls($url_array);
    }
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  display_user_menu();
  do_html_footer();
?>