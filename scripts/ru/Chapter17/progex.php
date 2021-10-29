<?php
 
chdir('/path/to/uploads/');
 
// версия exec
echo '<h1>Использование exec()</h1>';
echo '<pre>';
 
// unix
exec('ls -la', $result);
 
// windows
// exec('dir', $result);
 
foreach ($result as $line)
{
   echo $line.PHP_EOL;
}
 
echo '</pre>';
echo '<hr />';
 
// версия passthru
echo '<h1>Использование passthru()</h1>';
echo '<pre>';
 
// unix
passthru('ls -la') ;
 
// windows
// passthru('dir');
 
echo '</pre>';
echo '<hr />';
 
// версия system
echo '<h1>Использование system()</h1>';
echo '<pre>';
 
// unix
$result = system('ls -la');
 
// windows
// $result = system('dir');
 
echo '</pre>';
echo '<hr />';
 
// версия обратных одинарных кавычек
echo '<h1>Использование обратных одинарных кавычек</h1>';
echo '<pre>';
 
// unix
$result = `ls -al`;
 
// windows 
// $result = `dir`;
 
echo $result;
echo '</pre>';
 
?>