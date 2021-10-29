<!DOCTYPE html>
<html>
<head>
   <title>Доступная функциональность</title>
</head>
<?php
echo 'Наборы функциональности, поддерживаемые в этой установленной копии: <br />';
$extensions = get_loaded_extensions();
foreach ($extensions as $each_ext)
{
  echo $each_ext.'<br />';
  echo '<ul>';
  $ext_funcs = get_extension_funcs($each_ext);
  foreach($ext_funcs as $func)
  {
    echo '<li>'.$func.'</li>';
  }
  echo '</ul>';
}
?>