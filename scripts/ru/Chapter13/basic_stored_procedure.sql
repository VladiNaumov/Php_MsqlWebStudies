# Пример базовой хранимой процедуры

DELIMITER //

CREATE PROCEDURE Total_Orders (OUT Total FLOAT)
BEGIN
 SELECT SUM(Amount) INTO Total FROM Orders;
END
//

DELIMITER ;


