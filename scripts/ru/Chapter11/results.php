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
    $searchterm=trim($_POST['searchterm']);
 
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
 
    $db = new mysqli('localhost', 'bookorama', 
          'bookorama123', 'books');
    if (mysqli_connect_errno()) {
       echo '<p>Ошибка: не удалось подключиться к базе данных.<br/>
       Пожалуйста, повторите попытку позже.</p>';
       exit;
    }
 
    $query = "SELECT ISBN, Author, Title, Price 
              FROM Books WHERE $searchtype = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $searchterm);  
    $stmt->execute();
    $stmt->store_result();
  
    $stmt->bind_result($isbn, $author, $title, $price);
 
    echo "<p>Количество найденных книг: ".$stmt->num_rows."</p>";
 
    while($stmt->fetch()) {
      echo "<p><strong>Название: ".$title."</strong>";
      echo "<br />Автор: ".$author;
      echo "<br />ISBN: ".$isbn;
      echo "<br />Цена: \$".number_format($price,2)."</p>";
    }
 
    $stmt->free_result();
    $db->close();
  ?>
</body>
</html>
