<?php
session_start();

if (isset($_POST['userid']))
{
  echo 'Содержимое $_SESSION[\'session_var\']: '
       .$_SESSION['session_var'].'<br />';
}
else
{
  echo 'Значение $_SESSION[\'session_var\'] больше не доступно.';
}

session_destroy();
?>