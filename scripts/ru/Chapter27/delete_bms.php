<?php
  require_once('bookmark_fns.php');
  session_start();
 
  // Создать короткие имена переменных.
  $del_me = $_POST['del_me'];
  $valid_user = $_SESSION['valid_user'];
 
  do_html_header('Удаление закладок');
  check_valid_user();
 
  if (!filled_out($_POST)) {
    echo '<p>Вы не выбрали ни одной закладки для удаления.<br>
          Пожалуйста, попробуйте заново.</p>';
    display_user_menu();
    do_html_footer();
    exit;
  } else {
    if (count($del_me) > 0) {
      foreach($del_me as $url) {
        if (delete_bm($valid_user, $url)) {
          echo 'Удалена закладка '.htmlspecialchars($url).'.<br>';
        } else {
          echo 'Не удалось удалить '.htmlspecialchars($url).'.<br>';
        }
      }
    } else {
      echo 'Не выбраны закладки для удаления.';
    }
  }
 
  // Получить закладки, которые сохранил этот пользователь.
  if ($url_array = get_user_urls($valid_user)) {
    display_user_urls($url_array);
  }
 
  display_user_menu();
  do_html_footer();
?>