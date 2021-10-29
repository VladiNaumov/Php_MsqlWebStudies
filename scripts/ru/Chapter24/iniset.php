<?php
$old_max_execution_time = ini_set('max_execution_time', 120);
echo 'старый таймаут: '.$old_max_execution_time.'<br />';
 
$max_execution_time = ini_get('max_execution_time');
echo 'новый таймаут: '.$max_execution_time.'<br />';
?>