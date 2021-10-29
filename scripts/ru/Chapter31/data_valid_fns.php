<?php

function filled_out($form_vars) {
  // Проверяет, что каждая переменная имеет значение.
  foreach ($form_vars as $key => $value) {
     if ((!isset($key)) || ($value == '')) {
        return false;
     }
  }
  return true;
}

function valid_email($address) {
  // Проверяет допустимость адреса электронной почты.
  return filter_var($address, FILTER_VALIDATE_EMAIL);
}

?>
