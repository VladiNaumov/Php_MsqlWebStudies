<?php
// Включить файлы с функциями для этого приложения.
require_once('bookmark_fns.php');
session_start();

// Начать вывод HTML-разметки.
do_html_header('Добавление закладок');

check_valid_user();
display_add_bm_form();

display_user_menu();
do_html_footer();

?>
