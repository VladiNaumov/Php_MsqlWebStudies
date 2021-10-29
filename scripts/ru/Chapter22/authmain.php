<?php
session_start();
 
if (isset($_POST['userid']) && isset($_POST['password']))
{
  // Если пользователь как раз пытается войти.
  $userid = $_POST['userid'];
  $password = $_POST['password'];
 
  $db_conn = new mysqli('localhost', 'webauth', 'webauth', 'auth');
 
  if (mysqli_connect_errno()) {
    echo 'Отказ подключения к базе данных:'.mysqli_connect_error();
    exit();
  }
 
  $query = "select * from authorized_users where 
            name='".$userid."' and 
            password=sha1('".$password."')";
 
  $result = $db_conn->query($query);
  if ($result->num_rows)
  {
    // Если пользователь найден в базе данных, то зарегистрировать его идентификатор.
    $_SESSION['valid_user'] = $userid;
  }
  $db_conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Домашняя страница</title>
    <style type="text/css">
      fieldset {
         width: 50%;
         border: 2px solid #ff0000;
      }
      legend {
         font-weight: bold;
         font-size: 125%;
      }
      label {
         width: 125px;
         float: left;
         text-align: left;
         font-weight: bold;
      }
      input {
         border: 1px solid #000;
         padding: 3px;
      }
      button {
         margin-top: 12px;
      }
    </style>
</head>
<body>
<h1>Домашняя страница</h1>
<?php
  if (isset($_SESSION['valid_user']))
  {
    echo '<p>Вы вошли как пользователь '.$_SESSION['valid_user'].' <br />';
    echo '<a href="logout.php">Выход</a></p>';
  }
  else
  {
    if (isset($userid))
    {
      // Если попытка входа была неудачной.
      echo '<p>Вы не смогли войти на сайт.</p>';
    }
    else
    {
      // Пользователь пока еще не пытался войти или вышел.
      echo '<p>Вы не вошли на сайт.</p>';
    }
 
    // Предоставить форму для входа.
    echo '<form action="authmain.php" method="post">';
    echo '<fieldset>';
    echo '<legend>Вход на сайт!</legend>';
    echo '<p><label for="userid">Имя:</label>';
    echo '<input type="text" name="userid" id="userid" size="30"/></p>';
    echo '<p><label for="password">Пароль:</label>';
    echo '<input type="password" name="password" id="password" size="30"/></p>';    
    echo '</fieldset>';
    echo '<button type="submit" name="login">Войти</button>';
    echo '</form>';
 
  }
?>
<p><a href="members_only.php">Перейти в раздел для членов</a></p>
 
</body>
</html>