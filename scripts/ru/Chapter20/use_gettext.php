<?php
$locale="ru_RU";
putenv("LC_ALL=".$locale);
setlocale(LC_ALL, $locale);

$domain='messages';
bindtextdomain($domain, "./locale");
bind_textdomain_codeset($domain, 'UTF-8');
textdomain($domain);
?>
<!DOCTYPE html>
<html>
   <title><?php echo gettext("WELCOME_TEXT"); ?></title>
<body>
   <h1><?php echo gettext("WELCOME_TEXT"); ?></h1>
   <h2><?php echo gettext("CHOOSE_LANGUAGE"); ?></h2>
   <ul>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?lang=ru_RU";?>">ru_RU</a></li>
      <li><a href="<?php echo $_SERVER['PHP_SELF']."?lang =ja_JP";?>">ja_JP</a></li> 
   </ul>
</body>
</html>