<?php
  include ('book_sc_fns.php');
  // Корзина для покупок нуждается в сеансах, поэтому запустить сеанс.
  session_start();

  do_html_header('Оформление заказа');

  $card_type = $_POST['card_type'];
  $card_number = $_POST['card_number'];
  $card_month = $_POST['card_month'];
  $card_year = $_POST['card_year'];
  $card_name = $_POST['card_name'];

  if(($_SESSION['cart']) && ($card_type) && ($card_number) && ($card_month) &&
     ($card_year) && ($card_name)) {
    // Отобразить корзину, не разрешая вносить в нее изменения и без изображений.
    display_cart($_SESSION['cart'], false, 0);

    display_shipping(calculate_shipping_cost());

    if(process_card($_POST)) {
      // Пустая корзина для покупок.
      session_destroy();
      echo "<p>Благодарим вас за покупки в нашем магазине. Ваш заказ размещен.</p>";
      display_button("index.php", "continue-shopping", "Продолжить покупки");
    } else {
      echo "<p>Не удалось обработать вашу карту. Пожалуйста, свяжитесь с эмитентом или повторите попытку.</p>";
      display_button("purchase.php", "back", "Назад");
    }
  } else {
    echo "<p>Вы не заполнили все поля. Пожалуйста, повторите попытку.</p><hr />";
    display_button("purchase.php", "back", "Назад");
  }

  do_html_footer();
?>