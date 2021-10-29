<!DOCTYPE html>
<html>
<head>
  <title>Буквофил - Результаты поиска</title>
</head>
<body>
  <h1>Буквофил - Результаты поиска</h1>
  <?php
    // создать короткие имена переменных
    $searchtype=$_POST['searchtype'];
    $searchterm="%{$_POST['searchterm']}%";

    if (!$searchtype || !$searchterm) {
       echo '<p>Вы не ввели информацию для поиска.<br/>
       Пожалуйста, возвратитесь на предыдущую страницу и повторите попытку.</p>';
       exit;
    }

    // допустимые типы поиска
    switch ($searchtype) {
      case 'Title':
      case 'Author':
      case 'ISBN':   
        break;
      default: 
        echo '<p>Недопустимый тип поиска.<br/>
        Пожалуйста, возвратитесь на предыдущую страницу и повторите попытку.</p>';
        exit; 
    }

    // настройка для использования PDO
    $user = 'bookorama';
    $pass = 'bookorama123';
    $host = 'localhost';
    $db_name = 'books';

    // настройка DSN
    $dsn = "mysql:host=$host;dbname=$db_name";

    // подключиться к базе данных
    try {
      $db = new PDO($dsn, $user, $pass); 

      // выполнить запрос
      $query = "SELECT ISBN, Author, Title, Price FROM Books WHERE $searchtype like :searchterm";  
      $stmt = $db->prepare($query);  
      $stmt->bindParam(':searchterm', $searchterm);
      $stmt->execute(); 

      // получить количество возвращенных строк
      echo "<p>Количество найденных книг: ".$stmt->rowCount()."</p>"; 

      // отобразить каждую возвращенную строку
      while($result = $stmt->fetch(PDO::FETCH_OBJ)) {                                                       
        echo "<p><strong>Название: ".$result->Title."</strong>";                               
        echo "<br />Автор: ".$result->Author;                                              
        echo "<br />ISBN: ".$result->ISBN;                                                  
        echo "<br />Цена: \$".number_format($result->Price, 2)."</p>";                                         
      }         

      // отключиться от базы данных
      $db = NULL;
    } catch (PDOException $e) {
      echo "Ошибка: ".$e->getMessage();
      exit;
    }
  ?>
</body>
</html>
