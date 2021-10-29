function valid_email($address) {
  // Проверяет, допустим ли адрес электронной почты.
  if (preg_match('/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/', $address))
{
    return true;
  } else {
    return false;
  }
}