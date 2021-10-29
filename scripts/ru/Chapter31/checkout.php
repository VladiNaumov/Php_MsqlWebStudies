<?php
  // Включить наш набор функций.
  include ('book_sc_fns.php');

  // Корзина для покупок нуждается в сеансах, поэтому запустить сеанс.
  session_start();

  do_html_header("Оформление заказа");

  if(($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
    display_cart($_SESSION['cart'], false, 0);
    display_checkout_form();
  } else {
    echo "<p>Корзина пуста.</p>";
  }

  display_button("show_cart.php", "continue-shopping", "Продолжить покупки");

  do_html_footer();
?>