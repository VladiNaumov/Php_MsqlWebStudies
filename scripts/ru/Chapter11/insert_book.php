<!DOCTYPE html>
<html>
<head>
  <title>Буквофил - Результаты занесения новой книги</title>
</head>
<body>
  <h1>Буквофил - Результаты занесения новой книги</h1>
  <?php

    if (!isset($_POST['ISBN']) || !isset($_POST['Author']) 
         || !isset($_POST['Title']) || !isset($_POST['Price'])) {
       echo "<p>Вы не ввели  все обязательные сведения.<br />
             Пожалуйста, возвратитесь на предыдущую страницу и повторите попытку.</p>";
       exit;
    }

    // создать короткие имена переменных
    $isbn=$_POST['ISBN'];
    $author=$_POST['Author'];
    $title=$_POST['Title'];
    $price=$_POST['Price'];
    $price = doubleval($price);

    @$db = new mysqli('localhost', 'bookorama', 'bookorama123', 'books');

    if (mysqli_connect_errno()) {
       echo "<p>Ошибка: не удалось подключиться к базе данных.<br/>
             Пожалуйста, повторите попытку позже.</p>";
       exit;
    }

    $query = "INSERT INTO Books VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssd', $isbn, $author, $title, $price);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo  "<p>Сведения о книге вставлены в базу данных.</p>";
    } else {
        echo "<p>Возникла ошибка.<br/>
              Элемент не был добавлен.</p>";
    }
  
    $db->close();
  ?>
</body>
</html>
