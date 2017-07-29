# mandarinbank_ModXRevo

%домен%/manager/index.php

В левой части админки Элементы - Сниппеты, на Сниппеты правой кнопкой мыши - новый сниппет

Имя - mandarin, описание - Платёжная система, код ниже (merchant-id и secret вписываем свои, кавычки аккуратно оставляем):
<?php
$output = '';

$mid="merchant-id";
$msec='secret';

require_once $modx->getOption('core_path')."components/mandarin.php";

return $output;

// конец кода

Ресурсы - Спасибо! (12)

В тексте ресурса в самом начале добавляем одну строку:

[[!mandarin]]

Сохраняем ресурс "Спасибо!"


Приложения - Управление заказами - гамбургер меню (четыре полоски горизонтальных, справа от кнопки "Удалить") - "Настройки"
Выбрать "Методы оплаты", Добавить, название "MandarinBank", значение "mandarin", "Сохранить"

callback - %домен%/payment-mandarin.php
returnURL - %домен%/spasibo.html
