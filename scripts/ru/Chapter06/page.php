<?php
class Page
{
  // атрибуты класса Page
  public $content;
  public $title = "TLA Consulting Pty Ltd";
  public $keywords = "TLA Consulting, Three Letter Abbreviation, 
                     поисковые механизмы - наши лучшие друзья";
public $buttons = array( "Домой"       => "home.php",
                         "Контакт"     => "contact.php",
                         "Услуги"      => "services.php",
                         "Карта сайта" => "map.php"
                       );

  // операции класса Page
  public function __set($name, $value)
  {
    $this->$name = $value;
  }
 
  public function Display()
  {
    echo "<html>\n<head>\n";
    $this -> DisplayTitle();
    $this -> DisplayKeywords();
    $this -> DisplayStyles();
    echo "</head>\n<body>\n";
    $this -> DisplayHeader();
    $this -> DisplayMenu($this->buttons);
    echo $this->content;
    $this -> DisplayFooter();
    echo "</body>\n</html>\n";
  }
 
  public function DisplayTitle()
  {
    echo "<title>".$this->title."</title>";
  }
 
  public function DisplayKeywords()
  {
    echo "<meta name='keywords' content='".$this->keywords."'/>";
  }
 
  public function DisplayStyles()
  { 
    ?>   
    <link href="styles.css" type="text/css" rel="stylesheet">
    <?php
  }
 
  public function DisplayHeader()
  { 
    ?>   
    <!-- верхний колонтитул страницы -->
    <header>    
      <img src="logo.gif" alt="TLA logo" height="70" width="70" /> 
      <h1>TLA Consulting</h1>
    </header>
    <?php
  }
 
  public function DisplayMenu($buttons)
  {
    echo "<!-- меню -->
    <nav>";
 
    while (list($name, $url) = each($buttons)) {
      $this->DisplayButton($name, $url, 
               !$this->IsURLCurrentPage($url));
    }
    echo "</nav>\n";
  }
 
  public function IsURLCurrentPage($url)
  {
    if(strpos($_SERVER['PHP_SELF'],$url)===false)
    {
      return false;
    }
    else
    {
      return true;
    }
  }
 
  public function DisplayButton($name,$url,$active=true)
  {
    if ($active) { ?>
      <div class="menuitem">
        <a href="<?=$url?>">
        <img src="s-logo.gif" alt="" height="20" width="20" />
        <span class="menutext"><?=$name?></span>
        </a>
      </div>
      <?php
    } else { ?>
      <div class="menuitem">
      <img src="side-logo.gif">
      <span class="menutext"><?=$name?></span>
      </div>
      <?php
    }  
  }
 
  public function DisplayFooter()
  {
    ?>
    <!-- нижний колонтитул страницы -->
    <footer>
      <p>&copy; TLA Consulting Pty Ltd.<br />
      Пожалуйста, просмотрите нашу 
      <a href="legal.php"> страницу с юридической информацией</a>.</p>
    </footer>
    <?php
  }
}
?>
