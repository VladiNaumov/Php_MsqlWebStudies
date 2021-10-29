# Базовый синтаксис для создания функции

DELIMITER //

CREATE FUNCTION Add_Tax (Price FLOAT) RETURNS FLOAT NO SQL
BEGIN
  DECLARE Tax FLOAT DEFAULT 0.10;
  RETURN Price*(1+Tax);
END
//

DELIMITER ;
