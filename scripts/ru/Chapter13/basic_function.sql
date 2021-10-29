# Базовый синтаксис для создания функции

DELIMITER //

CREATE FUNCTION Add_Tax (Price FLOAT) RETURNS FLOAT NO SQL
  RETURN Price*1.1;

//

DELIMITER ;
