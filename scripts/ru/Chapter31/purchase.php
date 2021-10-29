<?php

  include ('book_sc_fns.php');

  // Корзина для покупок нуждается в сеансах, поэтому запустить сеанс.
  session_start();

  do_html_header("Оформление заказа");

  // Создать короткие имена переменных.
  $name = $_POST['name'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $zip = $_POST['zip'];
  $country = $_POST['country'];

  // Если форма заполнена:
  if (($_SESSION['cart']) && ($name) && ($address) && ($city)
        && ($zip) && ($country)) {
    // то можно вставить запись в базу данных.
    if(insert_order($_POST) != false ) {
      // Отобразить корзину, не разрешая вносить в нее изменения и без изображений.
      display_cart($_SESSION['cart'], false, 0);

      display_shipping(calculate_shipping_cost());

      // Получить сведения о кредитной карте.
      display_card_form($name);

      display_button("show_cart.php", "continue-shopping", "Продолжить покупки");
    } else {
      echo "<p>Не удалось сохранить данные. Пожалуйста, повторите попытку.</p>";
      display_button('checkout.php', 'back', 'Назад');
    }
  } else {
    echo "<p>Вы не заполнили все поля. Пожалуйста, повторите попытку.</p><hr />";
    display_button('checkout.php', 'back', 'Назад');
  }

  do_html_footer();
?>