<?php
session_start();

$_SESSION['session_var'] = "Добро пожаловать!";

echo 'Содержимое $_SESSION[\'session_var\']: '
     .$_SESSION['session_var'].'<br />';
?>
<p><a href="page2.php">Следующая страница</a></p>