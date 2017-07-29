## Установка

1. Авторизовываемся в **protocol://domain:port/manager/index.php**
2. В левой части админки Элементы - Сниппеты, на Сниппеты правой кнопкой мыши - новый сниппет
3. Имя - mandarin, описание - Платёжная система, код ниже (merchant-id и secret вписываем свои, кавычки аккуратно оставляем):
```php
<?php
$output = '';
$mid="merchant-id";
$msec='secret';

require_once $modx->getOption('core_path')."components/mandarin.php";
return $output;
?>
```
4. Переходим в Ресурсы - Спасибо! (12)
5. В тексте ресурса в самом начале добавляем одну строку: `[[!mandarin]]`
6. Сохраняем ресурс "Спасибо!"
7. Переходим в Приложения - Управление заказами
8. Нажимаем на гамбургер меню(четыре полоски горизонтальных, справа от кнопки "Удалить") - "Настройки"
9. Выбрать "Методы оплаты", Добавить, название "MandarinBank", значение "mandarin", "Сохранить"
10. В системе MandarinPay указываем
- callbackURL - **protocol://domain:port/payment-mandarin.php**
- returnURL - **protocol://domain:port/spasibo.html**
