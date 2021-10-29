<?php
function calculate_shipping_cost() {
  // Раз уж мы доставляем товары по всему миру с помощью
  // телепортации, стоимость доставки является фиксированной.
  return 20.00;
}

function get_categories() {
  // Запросить у базы данных список категорий.
  $conn = db_connect();
  $query = "select catid, catname from categories";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }
  $num_cats = @$result->num_rows;
  if ($num_cats == 0) {
    return false;
  }
  $result = db_result_to_array($result);
  return $result;
}

function get_category_name($catid) {
  // Запросить в базе данных название категории по ее идентификатору.
  $conn = db_connect();
  $query = "select catname from categories
            where catid = '".$conn->real_escape_string($catid)."'";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }
  $num_cats = @$result->num_rows;
  if ($num_cats == 0) {
    return false;
  }
  $row = $result->fetch_object();
  return $row->catname;
}

function get_books($catid) {
   // Запрашивает в базе данных книги для категории.
   if ((!$catid) || ($catid == '')) {
     return false;
   }

   $conn = db_connect();
   $query = "select * from books where catid = '".$conn->real_escape_string($catid)."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_books = @$result->num_rows;
   if ($num_books == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_book_details($isbn) {
  // Запрашивает в базе данных сведения об указанной книге.
  if ((!$isbn) || ($isbn=='')) {
     return false;
  }
  $conn = db_connect();
  $query = "select * from books where isbn='".$conn->real_escape_string($isbn)."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = @$result->fetch_assoc();
  return $result;
}

function calculate_price($cart) {
  // Подсчитывает общую сумму всех книг в корзине для покупок.
  $price = 0.0;
  if(is_array($cart)) {
    $conn = db_connect();
    foreach($cart as $isbn => $qty) {
      $query = "select price from books where isbn='".$conn->real_escape_string($isbn)."'";
      $result = $conn->query($query);
      if ($result) {
        $item = $result->fetch_object();
        $item_price = $item->price;
        $price +=$item_price*$qty;
      }
    }
  }
  return $price;
}

function calculate_items($cart) {
  // Подсчитывает количество книг в корзине для покупок.
  $items = 0;
  if(is_array($cart))   {
    foreach($cart as $isbn => $qty) {
      $items += $qty;
    }
  }
  return $items;
}
?>
