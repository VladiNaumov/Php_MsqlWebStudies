<?php

function do_html_header($title = '') {
  // Выводит верхний колонтитул HTML.

  // Объявить переменные сеанса, к которым необходим доступ внутри функции.
  if (empty($_SESSION['items'])) {
    $_SESSION['items'] = '0';
  }
  if (empty($_SESSION['total_price'])) {
    $_SESSION['total_price'] = '0.00';
  }
?>
  <html>
  <head>
    <title><?php echo htmlspecialchars($title); ?></title>
    <style>
      h2 { font-family: Arial, Helvetica, sans-serif; font-size: 22px; color: red; margin: 6px }
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #FF0000; width=70%; text-align=center}
      a { color: #000000 }
    </style>
  </head>
  <body>
  <table width="100%" border="0" cellspacing="0" bgcolor="#cccccc">
  <tr>
  <td rowspan="2">
  <a href="index.php"><img src="images/Book-O-Rama.gif" alt="Буквофил" border="0"
       align="left" valign="bottom" height="55" width="325"/></a>
  </td>
  <td align="right" valign="bottom">
  <?php
     if(isset($_SESSION['admin_user'])) {
       echo "&nbsp;";
     } else {
       echo "Всего книг = " . htmlspecialchars($_SESSION['items']);
     }
  ?>
  </td>
  <td align="right" rowspan="2" width="135">
  <?php
     if(isset($_SESSION['admin_user'])) {
       display_button('logout.php', 'log-out', 'Выход');
     } else {
       display_button('show_cart.php', 'view-cart', 'Просмотреть корзину для покупок');
     }
  ?>
  </tr>
  <tr>
  <td align="right" valign="top">
  <?php
     if(isset($_SESSION['admin_user'])) {
       echo "&nbsp;";
     } else {
       echo "Общая сумма = $".number_format($_SESSION['total_price'],2);
     }
  ?>
  </td>
  </tr>
  </table>
<?php
  if($title) {
    do_html_heading($title);
  }
}

function do_html_footer() {
  // Выводит нижний колонтитул HTML.
?>
  </body>
  </html>
<?php
}

function do_html_heading($heading) {
  // Выводит заголовок.
?>
  <h2><?php echo htmlspecialchars($heading); ?></h2>
<?php
}

function do_html_URL($url, $name) {
  // Выводит URL в виде ссылки.
?>
  <a href="<?php echo htmlspecialchars($url); ?>"><?php echo htmlspecialchars($name); ?></a><br />
<?php
}

function display_categories($cat_array) {
  if (!is_array($cat_array)) {
     echo "<p>В текущий момент нет доступных категорий.</p>";
     return;
  }
  echo "<ul>";
  foreach ($cat_array as $row)  {
    $url = "show_cat.php?catid=".urlencode($row['catid']);
    $title = $row['catname'];
    echo "<li>";
    do_html_url($url, $title);
    echo "</li>";
  }
  echo "</ul>";
  echo "<hr />";
}

function display_books($book_array) {
  // Отображает все книги из переданного массива.
  if (!is_array($book_array)) {
    echo "<p>В текущий момент нет доступных книг в этой категории.</p>";
  } else {
    // Создать таблицу.
    echo "<table width=\"100%\" border=\"0\">";

    // Создать строку таблицы для каждой книги.
    foreach ($book_array as $row) {
      $url = "show_book.php?isbn=" . urlencode($row['isbn']);
      echo "<tr><td>";
      if (@file_exists("images/{$row['isbn']}.jpg")) {
        $title = "<img src=\"images/". htmlspecialchars($row['isbn']) . ".jpg\"
                  style=\"border: 1px solid black\"/>";
        do_html_url($url, $title);
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $title = htmlspecialchars($row['title']) . " авторства " . htmlspecialchars($row['author']);
      do_html_url($url, $title);
      echo "</td></tr>";
    }

    echo "</table>";
  }

  echo "<hr />";
}

function display_book_details($book) {
  // Отображает сведения о данной книге.
  if (is_array($book)) {
    echo "<table><tr>";
    // Вывести изображение при его наличии.
    if (@file_exists("images/{$book['isbn']}.jpg"))  {
      $size = GetImageSize("images/{$book['isbn']}.jpg");
      if(($size[0] > 0) && ($size[1] > 0)) {
        echo "<td><img src=\"images/".htmlspecialchars($book['isbn']).".jpg\"
              style=\"border: 1px solid black\"/></td>";
      }
    }
    echo "<td><ul>";
    echo "<li><strong>Автор:</strong> ";
    echo htmlspecialchars($book['author']);
    echo "</li><li><strong>ISBN:</strong> ";
    echo htmlspecialchars($book['isbn']);
    echo "</li><li><strong>Цена:</strong> ";
    echo number_format($book['price'], 2);
    echo "</li><li><strong>Описание:</strong> ";
    echo htmlspecialchars($book['description']);
    echo "</li></ul></td></tr></table>";
  } else {
    echo "<p>В текущий момент отобразить сведения о данной книге невозможно.</p>";
  }
  echo "<hr />";
}

function display_checkout_form() {
  // Отображает форму, которая заправшивает у пользователя имя и адрес.
?>
  <br />
  <table border="0" width="100%" cellspacing="0">
  <form action="purchase.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Сведения о вас</th></tr>
  <tr>
    <td>Имя</td>
    <td><input type="text" name="name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Адрес</td>
    <td><input type="text" name="address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Город/пригород</td>
    <td><input type="text" name="city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Штат/провинция</td>
    <td><input type="text" name="state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Почтовый индекс</td>
    <td><input type="text" name="zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td>Страна</td>
    <td><input type="text" name="country" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr><th colspan="2" bgcolor="#cccccc">Адрес доставки (оставьте поля пустыми, если он такой же, как выше)</th></tr>
  <tr>
    <td>Имя</td>
    <td><input type="text" name="ship_name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Адрес</td>
    <td><input type="text" name="ship_address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Город/пригород</td>
    <td><input type="text" name="ship_city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Штат/провинция</td>
    <td><input type="text" name="ship_state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Почтовый индекс</td>
    <td><input type="text" name="ship_zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td>Страна</td>
    <td><input type="text" name="ship_country" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><p><strong>Пожалуйста, щелкните на Купить, чтобы подтвердить
         покупку, или на Продолжить покупки, чтобы добавить или удалить книги.</strong></p>
     <?php display_form_button("purchase", "Купить выбранные книги"); ?>
    </td>
  </tr>
  </form>
  </table><hr />
<?php
}

function display_shipping($shipping) {
  // Отображает строку таблицы со стоимостью доставки и общей суммой, включая доставку.
?>
  <table border="0" width="100%" cellspacing="0">
  <tr><td align="left">Доставка</td>
      <td align="right"> <?php echo number_format($shipping, 2); ?></td></tr>
  <tr><th bgcolor="#cccccc" align="left">ВСЕГО, ВКЛЮЧАЯ ДОСТАВКУ</th>
      <th bgcolor="#cccccc" align="right">$ <?php echo number_format($shipping+$_SESSION['total_price'], 2); ?></th>
  </tr>
  </table><br />
<?php
}

function display_card_form($name) {
  // Отображает форму, запрашивающую у пользователя сведения о кредитной карте.
?>
  <table border="0" width="100%" cellspacing="0">
  <form action="process.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Сведения о кредитной карте</th></tr>
  <tr>
    <td>Тип</td>
    <td><select name="card_type">
        <option value="VISA">VISA</option>
        <option value="MasterCard">MasterCard</option>
        <option value="American Express">American Express</option>
        </select>
    </td>
  </tr>
  <tr>
    <td>Номер</td>
    <td><input type="text" name="card_number" value="" maxlength="16" size="40"></td>
  </tr>
  <tr>
    <td>Код AMEX (если требуется)</td>
    <td><input type="text" name="amex_code" value="" maxlength="4" size="4"></td>
  </tr>
  <tr>
    <td>Дата истечения действия</td>
    <td>Месяц
       <select name="card_month">
       <option value="01">01</option>
       <option value="02">02</option>
       <option value="03">03</option>
       <option value="04">04</option>
       <option value="05">05</option>
       <option value="06">06</option>
       <option value="07">07</option>
       <option value="08">08</option>
       <option value="09">09</option>
       <option value="10">10</option>
       <option value="11">11</option>
       <option value="12">12</option>
       </select>
       Год
       <select name="card_year">
       <?
       for ($y = date("Y"); $y < date("Y") + 10; $y++) {
         echo "<option value=\"".$y."\">".$y."</option>";
       }
       ?>
       </select>
  </tr>
  <tr>
    <td>Владелец карты</td>
    <td><input type="text" name="card_name" value = "<?php echo $name; ?>" maxlength="40" size="40"></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <p><strong>Пожалуйста, щелкните на Купить, чтобы подтвердить покупку, 
      или на Продолжить покупки, чтобы добавить или удалить книги.</strong></p>
     <?php display_form_button('purchase', 'Купить выбранные книги'); ?>
    </td>
  </tr>
  </table>
<?php
}

function display_cart($cart, $change = true, $images = 1) {
  // Отображает книги в корзине для покупок.
  // Дополнительно разрешает вносить изменения ($change = true или false).
  // Дополнительно включает изображения ($images = 1 - да, 0 - нет).

   echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\">
         <form action=\"show_cart.php\" method=\"post\">
         <tr><th colspan=\"".(1 + $images)."\" bgcolor=\"#cccccc\">Книга</th>
         <th bgcolor=\"#cccccc\">Цена</th>
         <th bgcolor=\"#cccccc\">Количество</th>
         <th bgcolor=\"#cccccc\">Итого</th>
         </tr>";

  // Отобразить каждую книгу в виде строки таблицы.
  foreach ($cart as $isbn => $qty)  {
    $book = get_book_details($isbn);
    echo "<tr>";
    if($images == true) {
      echo "<td align=\"left\">";
      if (file_exists("images/{$isbn}.jpg")) {
         $size = GetImageSize("images/{$isbn}.jpg");
         if(($size[0] > 0) && ($size[1] > 0)) {
           echo "<img src=\"images/".htmlspecialchars($isbn).".jpg\"
                  style=\"border: 1px solid black\"
                  width=\"".($size[0]/3)."\"
                  height=\"".($size[1]/3)."\"/>";
         }
      } else {
         echo "&nbsp;";
      }
      echo "</td>";
    }
    echo "<td align=\"left\">
          <a href=\"show_book.php?isbn=".urlencode($isbn)."\">".htmlspecialchars($book['title'])."</a>
          авторства ".htmlspecialchars($book['author'])."</td>
          <td align=\"center\">\$".number_format($book['price'], 2)."</td>
          <td align=\"center\">";

    // Если разрешено вносить изменения, тогда представить количества в виде текстовых полей.
    if ($change == true) {
      echo "<input type=\"text\" name=\"".htmlspecialchars($isbn)."\" value=\"".htmlspecialchars($qty)."\" size=\"3\">";
    } else {
      echo $qty;
    }
    echo "</td><td align=\"center\">\$".number_format($book['price']*$qty,2)."</td></tr>\n";
  }
  // Отобразить строку с общим количеством и суммой.
  echo "<tr>
        <th colspan=\"".(2+$images)."\" bgcolor=\"#cccccc\">&nbsp;</td>
        <th align=\"center\" bgcolor=\"#cccccc\">".htmlspecialchars($_SESSION['items'])."</th>
        <th align=\"center\" bgcolor=\"#cccccc\">
            \$".number_format($_SESSION['total_price'], 2)."
        </th>
        </tr>";

  // Отобразить кнопку для сохранения изменений.
  if($change == true) {
    echo "<tr>
          <td colspan=\"".(2+$images)."\">&nbsp;</td>
          <td align=\"center\">
             <input type=\"hidden\" name=\"save\" value=\"true\"/>
             <input type=\"image\" src=\"images/save-changes.gif\"
                    border=\"0\" alt=\"Save Changes\"/>
          </td>
          <td>&nbsp;</td>
          </tr>";
  }
  echo "</form></table>";
}

function display_login_form() {
  // Отображает форму, запрашивающую у пользователя имя и пароль.
?>
 <form method="post" action="admin.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Имя пользователя:</td>
     <td><input type="text" name="username"/></td></tr>
   <tr>
     <td>Пароль:</td>
     <td><input type="password" name="passwd"/></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Вход"/></td></tr>
   <tr>
 </table></form>
<?php
}

function display_admin_menu() {
?>
<br />
<a href="index.php">Перейти на главный сайт</a><br />
<a href="insert_category_form.php">Добавить категорию</a><br />
<a href="insert_book_form.php">Добавить книгу</a><br />
<a href="change_password_form.php">Изменить пароль администратора</a><br />
<?php
}

function display_button($target, $image, $alt) {
  echo "<div align=\"center\"><a href=\"".htmlspecialchars($target)."\">
          <img src=\"images/".htmlspecialchars($image).".gif\"
           alt=\"".htmlspecialchars($alt)."\" border=\"0\" height=\"50\"
           width=\"135\"/></a></div>";
}

function display_form_button($image, $alt) {
  echo "<div align=\"center\"><input type=\"image\"
           src=\"images/".htmlspecialchars($image).".gif\"
           alt=\"".htmlspecialchars($alt)."\" border=\"0\" height=\"50\"
           width=\"135\"/></div>";
}

?>