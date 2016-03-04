<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>
    <div class="wrapper">
        <div class="container">
            <div class="container-hold">
                <? $APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "itprom", Array(
	"PAY_FROM_ACCOUNT" => "Y",	// Позволять оплачивать с внутреннего счета
		"COUNT_DELIVERY_TAX" => "N",	// Рассчитывать налог для доставки
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",	// Позволять оплачивать с внутреннего счета только в полном объеме
		"ALLOW_AUTO_REGISTER" => "Y",	// Оформлять заказ с автоматической регистрацией пользователя
		"SEND_NEW_USER_NOTIFY" => "Y",	// Отправлять пользователю письмо, что он зарегистрирован на сайте
		"DELIVERY_NO_AJAX" => "N",	// Рассчитывать стоимость доставки сразу
		"TEMPLATE_LOCATION" => "popup",	// Шаблон местоположения
		"PROP_1" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",	// Страница корзины
		"PATH_TO_PERSONAL" => SITE_DIR."personal/order/",	// Страница персонального раздела
		"PATH_TO_PAYMENT" => SITE_DIR."personal/order/payment/",	// Страница подключения платежной системы
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"DELIVERY2PAY_SYSTEM" => "",
		"SHOW_ACCOUNT_NUMBER" => "Y",
		"DELIVERY_NO_SESSION" => "N",	// Проверять сессию при оформлении заказа
		"DELIVERY_TO_PAYSYSTEM" => "p2d",	// Последовательность оформления
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"PROP_2" => "",	// Не показывать свойства для типа плательщика "Юридическое лицо" (s1)
		"ALLOW_NEW_PROFILE" => "Y",	// Разрешить множество профилей покупателей
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",	// Отображать названия платежных систем
		"SHOW_STORES_IMAGES" => "N",	// Показывать изображения складов в окне выбора пункта выдачи
		"PATH_TO_AUTH" => SITE_DIR."auth/",	// Страница авторизации
		"DISABLE_BASKET_REDIRECT" => "N",	// Оставаться на странице, если корзина пуста
		"PRODUCT_COLUMNS" => "",	// Дополнительные колонки таблицы товаров заказа
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
); ?>
            </div>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>