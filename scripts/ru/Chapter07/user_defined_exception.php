<?php

class myException extends Exception
{
  function __toString() 
  {
       return "<strong>Исключение ".$this->getCode()
       ."</strong>: ".$this->getMessage()."<br />"
       ."в файле ".$this->getFile().", строка ".$this->getLine()."<br/>";
   }
}

try
{
  throw new myException("Возникла очень серьезная ошибка", 42);
}
catch (myException $m)
{
   echo $m;
}

?>
