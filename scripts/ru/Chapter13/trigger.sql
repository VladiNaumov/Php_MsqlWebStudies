# Пример триггера

DELIMITER //

# Удаляет позиции заказа перед удалением заказа во избежание
# возникновения ошибки нарушения ссылочной целостности.
CREATE TRIGGER Delete_Order_Items 
BEFORE DELETE ON Orders FOR EACH ROW
BEGIN
  DELETE FROM Order_Items WHERE OLD.OrderID = OrderID;
END 
//

DELIMITER ;



