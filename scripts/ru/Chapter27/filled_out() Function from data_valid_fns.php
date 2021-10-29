function filled_out($form_vars) {
// Проверяет, что каждая переменная имеет значение.
  foreach ($form_vars as $key => $value) {
     if ((!isset($key)) || ($value == '')) {
        return false;
     }
  }
  return true;
}