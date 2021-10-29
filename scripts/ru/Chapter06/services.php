<?php
  require ("page.php");

  class ServicesPage extends Page
  {
    private $row2buttons = array(
                           "Реинжениринг" => "reengineering.php",
                           "Соответствие стандартам" => "standards.php",
                           "Соответствие жаргону" => "buzzword.php",
                           "Заявление о миссии" => "mission.php"
                           );

    public function Display()
    {
      echo "<html>\n<head>\n";
      $this->DisplayTitle();
      $this->DisplayKeywords();
      $this->DisplayStyles();
      echo "</head>\n<body>\n";
      $this->DisplayHeader();
      $this->DisplayMenu($this->buttons);
      $this->DisplayMenu($this->row2buttons);
      echo $this->content;
      $this->DisplayFooter();
      echo "</body>\n</html>\n";
    }
  }

  $services = new ServicesPage();

  $services -> content ="<p>В компании TLA Consulting мы предлагаем несколько услуг.
  Возможно, продуктивность ваших сотрудников улучшится, если мы проведем реинжениринг
  вашего дела. Может быть, все ваше дело нуждается в свежем заявлении о миссии или 
  в новом пакете жаргона.</p>";

  $services->Display();
?>
