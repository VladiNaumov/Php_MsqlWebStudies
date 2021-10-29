<?php
// Этот файл содержит функции, используемые интерфейсом администратора
// для магазина "Буквофил".

function display_category_form($category = '') {
  // Отображает форму для категории.
  // Эта форма может использоваться для вставки и редактирования сведений о категории.
  // Для вставки не передавайте параметры. В итоге $edit
  // устанавливается в false, и форма будет вызывать insert_category.php.
  // Для обновления передайте массив, содержащий данные о категории. Форма
  // отобразит имеющиеся данные, и будет вызывать update_category.php.
  // К форме также добавляется кнопка "Удалить категорию".

  // Если переданы данные о существующей категории, тогда продолжить в режиме редактирования.
  $edit = is_array($category);

  // Большая часть формы представляет собой простую
  // HTML-разметку с небольшим объемом кода PHP.
?>
  <form method="post"
      action="<?php echo $edit ? 'edit_category.php' : 'insert_category.php'; ?>">
  <table border="0">
  <tr>
    <td>Название категории:</td>
    <td><input type="text" name="catname" size="40" maxlength="40"
          value="<?php echo htmlspecialchars($edit ? $category['catname'] : ''); ?>" /></td>
   </tr>
  <tr>
    <td <?php if (!$edit) { echo "colspan=2";} ?> align="center">
      <?php
         if ($edit) {
            echo "<input type=\"hidden\" name=\"catid\" value=\"". htmlspecialchars($category['catid'])."\" />";
         }
      ?>
      <input type="submit"
       value="<?php echo $edit ? 'Обновить' : 'Добавить'; ?> категорию" /></form>
     </td>
     <?php
        if ($edit) {
          // Разрешить удаление существующих категорий.
          echo "<td>
                <form method=\"post\" action=\"delete_category.php\">
                <input type=\"hidden\" name=\"catid\" value=\"". htmlspecialchars($category['catid'])."\" />
                <input type=\"submit\" value=\"Удалить категорию\" />
                </form></td>";
       }
     ?>
  </tr>
  </table>
<?php
}

function display_book_form($book = '') {
  // Отображает форму для книги.
  // Эта форма очень похожа на форму для категории и может
  // использоваться для вставки и редактирования сведений о книге.
  // Для вставки не передавайте параметры. В итоге $edit
  // устанавливается в false, и форма будет вызывать insert_book.php.
  // Для обновления передайте массив, содержащий данные о книге. Форма
  // отобразит имеющиеся данные, и будет вызывать update_book.php.
  // К форме также добавляется кнопка "Удалить книгу".

  // Если переданы данные о существующей книге, тогда продолжить в режиме редактирования.
  $edit = is_array($book);

  // Большая часть формы представляет собой простую
  // HTML-разметку с небольшим объемом кода PHP.
  ?>
  <form method="post"
        action="<?php echo $edit ? 'edit_book.php' : 'insert_book.php';?>">

    <table border="0">
    <tr>
      <td>ISBN:</td>
      <td><input type="text" name="isbn"
           value="<?php echo htmlspecialchars($edit ? $book['isbn'] : ''); ?>" /></td>
    </tr>
    <tr>
      <td>Название:</td>
      <td><input type="text" name="title"
           value="<?php echo htmlspecialchars($edit ? $book['title'] : ''); ?>" /></td>
    </tr>
    <tr>
      <td>Автор:</td>
      <td><input type="text" name="author"
           value="<?php echo htmlspecialchars($edit ? $book['author'] : ''); ?>" /></td>
    </tr>
    <tr>
      <td>Категория:</td>
      <td><select name="catid">
      <?php
        // Извлечь список возможных категорий из базы данных.
        $cat_array=get_categories();
        foreach ($cat_array as $thiscat) {
          echo "<option value=\"".htmlspecialchars($thiscat['catid'])."\"";
          // Если это существующая книга, то поместить ее в текущую категорию.
          if (($edit) && ($thiscat['catid'] == $book['catid'])) {
            echo " selected";
          }
          echo ">".htmlspecialchars($thiscat['catname'])."</option>";
        }
      ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Цена:</td>
      <td><input type="text" name="price"
           value="<?php echo htmlspecialchars($edit ? $book['price'] : ''); ?>" /></td>
    </tr>
    <tr>
      <td>Описание:</td>
      <td><textarea rows="3" cols="50"
        name="description"><?php echo htmlspecialchars($edit ? $book['description'] : '');?>
      </textarea></td>
    </tr>
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
      <?php
        if ($edit)
          // Если номер ISBN изменяется, то для нахождения
          // книги в базе данных нам нужен старый номер ISBN.
          echo "<input type=\"hidden\" name=\"oldisbn\"
                       value=\"".htmlspecialchars($book['isbn'])."\" />";
      ?>
      <input type="submit"
             value="<?php echo $edit ? 'Обновить' : 'Добавить'; ?> книгу" />
    </form></td>
    <?php
      if ($edit) {
        echo "<td>
              <form method=\"post\" action=\"delete_book.php\">
              <input type=\"hidden\" name=\"isbn\"
               value=\"".htmlspecialchars($book['isbn'])."\" />
              <input type=\"submit\" value=\"Удалить книгу\"/>
              </form></td>";
      }
      ?>
    </td>
  </tr>
</table>
</form>
<?php
}

function display_password_form() {
// Отображает HTML-форму для изменения пароля.
?>
   <br />
   <form action="change_password.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Старый пароль:</td>
       <td><input type="password" name="old_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>Новый пароль:</td>
       <td><input type="password" name="new_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>Повтор нового пароля:</td>
       <td><input type="password" name="new_passwd2" size="16" maxlength="16" /></td>
   </tr>
   <tr><td colspan=2 align="center"><input type="submit" value="Изменить пароль">
   </td></tr>
   </table>
   <br />
<?php
}

function insert_category($catname) {
// Вставляет в базу данных новую категорию.

   $conn = db_connect();

   // Проверить, существует ли данная категория.
   $query = "select *
             from categories
             where catname='".$conn->real_escape_string($catname)."'";
   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // Вставить новую категорию.
   $query = "insert into categories values
            ('', '".$conn->real_escape_string($catname)."')";
   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function insert_book($isbn, $title, $author, $catid, $price, $description) {
// Вставляет в базу данных новую книгу.

   $conn = db_connect();

   // Проверить, существует ли данная книга.
   $query = "select *
             from books
             where isbn='".$conn->real_escape_string($isbn)."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // Вставить новую книгу.
   $query = "insert into books values
            ('".$conn->real_escape_string($isbn) ."', '". $conn->real_escape_string($author) . 
             "', '". $conn->real_escape_string($title) ."', '". $conn->real_escape_string($catid) . 
              "', '". $conn->real_escape_string($price) ."', '" . $conn->real_escape_string($description) ."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_category($catid, $catname) {
// Изменяет в базе данных название категории с идентификатором catid.

   $conn = db_connect();

   $query = "update categories
             set catname='".$conn->real_escape_string($catname) ."'
             where catid='".$conn->real_escape_string($catid) ."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_book($oldisbn, $isbn, $title, $author, $catid,
                     $price, $description) {
// Заменяет в базе данных сведения о книге, хранящейся под $oldisbn,
// новыми деталями, переданными в аргументах.

   $conn = db_connect();

   $query = "update books
             set isbn= '".$conn->real_escape_string($isbn)."',
             title = '".$conn->real_escape_string($title)."',
             author = '".$conn->real_escape_string($author)."',
             catid = '".$conn->real_escape_string($catid)."',
             price = '".$conn->real_escape_string($price)."',
             description = '".$conn->real_escape_string($description)."'
             where isbn = '".$conn->real_escape_string($oldisbn)."'";

   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function delete_category($catid) {
// Удаляет из базы данных категорию с идентификатором catid.
// Если в категории имеются книги, тогда она не удаляется,
// а функция возвращает false.

   $conn = db_connect();

   // Проверить, имеются ли книги в категории,
   // чтобы избежать аномалий удаления.
   $query = "select *
             from books
             where catid='".$conn->real_escape_string($catid)."'";

   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
     return false;
   }

   $query = "delete from categories
             where catid='".$conn->real_escape_string($catid)."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}


function delete_book($isbn) {
// Удаляет из базы данных книгу, идентифицируемую $isbn.

   $conn = db_connect();

   $query = "delete from books
             where isbn='".$conn->real_escape_string($isbn)."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

?>
