<?php                                                                           
switch ($_POST['gender']) {                                                     
   case 'мужчина':                                                                 
   case 'женщина':                                                               
   case 'секрет':                                                                
                                                                                
      echo "<h1>Поздравляем!<br/>                               
           Вы - ".$_POST['gender']. ".</h1>";                                
   break;                                                                       
                                                                                
   default:                                                                     
                                                                                
      echo "<h1><span style=\"color:  red;\">ПРЕДУПРЕЖДЕНИЕ:</span><br/>                         
           Указано недопустимое входное значение.</h1>";                      
   break;                                                                       
}                                                                               
?>
