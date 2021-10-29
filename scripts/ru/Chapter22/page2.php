<?php
session_start();

echo 'Содержимое $_SESSION[\'session_var\']: '
     .$_SESSION['session_var'].'<br />';

unset($_SESSION['session_var']);
?>
<p><a href="page3.php">Следующая страница</a></p>