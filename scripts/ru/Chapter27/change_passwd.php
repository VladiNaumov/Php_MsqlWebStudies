<?php
  require_once('bookmark_fns.php');
  session_start();
  do_html_header('Изменение пароля');

  // создать короткие имена переменных
  $old_passwd = $_POST['old_passwd'];
  $new_passwd = $_POST['new_passwd'];
  $new_passwd2 = $_POST['new_passwd2'];

  try {
    check_valid_user();
    if (!filled_out($_POST)) {
      throw new Exception('Вы не заполнили форму полностью. Пожалуйста, попробуйте заново.');
    }

    if ($new_passwd != $new_passwd2) {
       throw new Exception('Введенные пароли не совпадают. Пароль не изменен.');
    }

    if ((strlen($new_passwd) > 16) || (strlen($new_passwd) < 6)) {
       throw new Exception('Новый пароль должен содержать от 6 до 16 символов. Пожалуйста, попробуйте заново.');
    }

    // попытаться обновить
    change_password($_SESSION['valid_user'], $old_passwd, $new_passwd);
    echo 'Пароль изменен.';
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  display_user_menu();
  do_html_footer();
?>
