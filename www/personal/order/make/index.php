<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>
    <div class="wrapper">
        <div class="container">
            <div class="container-hold">
                <? $APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	"itprom", 
	array(
		"PAY_FROM_ACCOUNT" => "N",
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"ALLOW_AUTO_REGISTER" => "Y",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"DELIVERY_NO_AJAX" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"PROP_1" => "",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/order/",
		"PATH_TO_PAYMENT" => SITE_DIR."personal/order/payment/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"SET_TITLE" => "Y",
		"DELIVERY2PAY_SYSTEM" => "",
		"SHOW_ACCOUNT_NUMBER" => "Y",
		"DELIVERY_NO_SESSION" => "N",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"USE_PREPAYMENT" => "N",
		"PROP_2" => "",
		"ALLOW_NEW_PROFILE" => "N",
		"SHOW_PAYMENT_SERVICES_NAMES" => "N",
		"SHOW_STORES_IMAGES" => "Y",
		"PATH_TO_AUTH" => SITE_DIR."auth/",
		"DISABLE_BASKET_REDIRECT" => "N",
		"PRODUCT_COLUMNS" => "",
		"COMPONENT_TEMPLATE" => "itprom",
		"COMPATIBLE_MODE" => "Y",
		"USE_PRELOAD" => "Y",
		"PRODUCT_COLUMNS_VISIBLE" => array(
		),
		"ADDITIONAL_PICT_PROP_3" => "-",
		"ADDITIONAL_PICT_PROP_4" => "-",
		"BASKET_IMAGES_SCALING" => "standard",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
); ?>
            </div>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>