## Установка

1. Авторизовываемся в **protocol://domain:port/manager/index.php**
2. В левой части админки `Элементы` - `Сниппеты`, нажимаем на Сниппеты правой кнопкой мыши - новый сниппет
3. Имя - `mandarin`, описание - `Платёжная система`
4. Заменяем `merchant-id` на ваш ID мерчанта, `secret` на Ваш секретный ключ(ковычки оставляем):
```php
<?php
$output = '';
$mid="merchant-id";
$msec='secret';

require_once $modx->getOption('core_path')."components/mandarin.php";
return $output;
?>
```
5. Переходим в `Ресурсы` - `Спасибо!`
5. В тексте ресурса в самом начале добавляем одну строку: `[[!mandarin]]`
6. Сохраняем ресурс `Спасибо!`
7. Переходим в `Приложения` - `Управление заказами`
8. Нажимаем на гамбургер меню(четыре полоски горизонтальных, справа от кнопки `Удалить`) - `Настройки`
9. Выбрать "Методы оплаты", Добавить, название "MandarinBank", значение "mandarin", "Сохранить"
10. В системе MandarinPay указываем
- callbackURL - **protocol://domain:port/payment-mandarin.php**
- returnURL - **protocol://domain:port/spasibo.html**
