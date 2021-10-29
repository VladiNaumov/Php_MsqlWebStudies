<?php

try  {
  throw new Exception("Возникла очень серьезная ошибка", 42);
}
catch (Exception $e) {
  echo "Исключение ". $e->getCode(). ": ". $e->getMessage()."<br />".
  " в файле ". $e->getFile(). ", строка ". $e->getLine(). "<br />";
}

?>
