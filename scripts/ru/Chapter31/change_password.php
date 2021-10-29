<?php
 require_once('book_sc_fns.php');
 session_start();
 do_html_header('Смена пароля');
 check_admin_user();
 if (!filled_out($_POST)) {
   echo "<p>Вы не заполнили форму полностью.<br/>
         Пожалуйста, попробуйте заново.</p>";
   do_html_url("admin.php", "Назад в меню администрирования");
   do_html_footer();
   exit;
 } else {
   $new_passwd = $_POST['new_passwd'];
   $new_passwd2 = $_POST['new_passwd2'];
   $old_passwd = $_POST['old_passwd'];
   if ($new_passwd != $new_passwd2) {
      echo "<p>Введенные пароли не совпадают. Пароль не изменен.</p>";
   } else if ((strlen($new_passwd)>16) || (strlen($new_passwd)<6)) {
      echo "<p>Новый пароль должен содержать от 6 до 16 символов. Пожалуйста, попробуйте заново.</p>";
   } else {
      // Попытаться обновить.
      if (change_password($_SESSION['admin_user'], $old_passwd, $new_passwd)) {
         echo "<p>Пароль изменен.</p>";
      } else {
         echo "<p>Не удалось изменить пароль.</p>";
      }
   }
 }
 do_html_url("admin.php", "Назад в меню администрирования");
 do_html_footer();
?>
