<?php
IncludeModuleLangFile(__FILE__);

$profileTypes['tiu_simple'] = array(
	"CODE" => 'tiu_simple',
    "NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_NAME"),
	"DESCRIPTION" => GetMessage("ACRIT_EXPORTPRO_PODDERJIVAETSA_ANDEK"),
	"REG" => "http://market.yandex.ru/",
	"HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
	"FIELDS" => array(
		array(
			"CODE" => "ID",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_ID"),
            "VALUE" => "ID",
			"REQUIRED" => 'Y',
            "TYPE" => 'field',
		),
		array(
			"CODE" => "AVAILABLE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_AVAILABLE"),
			"VALUE" => "",
            'TYPE' => 'const',
            "CONDITION" => array(
                'CLASS_ID' => 'CondGroup',
                'DATA' => array(
                    'All' => 'AND',
                    'True' => 'True'
                ),
                'CHILDREN' => array(
                    array(
                        'CLASS_ID' => 'CondIBActive',
                        'DATA' => array(
                                'logic' => 'Equal',
                                'value' => 'Y'
                        )
                    )
                )
            ),
            'USE_CONDITION' => 'Y',
            'CONTVALUE_TRUE' => 'true',
            'CONTVALUE_FALSE' => 'false',
		),
		array(
			"CODE" => "GROUP_ID",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_GROUP_ID"),
			"REQUIRED" => 'Y',
		),
        array(
            'CODE' => 'SELLING_TYPE',
            'NAME' => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_SELLINGTYPE"),
        ),
		array(
			"CODE" => "NAME",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_NAME"),
			"VALUE" => "NAME",
            "TYPE" => 'field',
            'REQUIRED' => 'Y',
		),
		array(
			"CODE" => "PRICE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_PRICE"),
		),
        array(
			"CODE" => "OLDPRICE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_PRICE"),
		),
        array(
			"CODE" => "DISCOUNT",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_DISCOUNT"),
		),
        array(
			"CODE" => "OPTPRICE1",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_OPTPRICE1"),
		),
        array(
			"CODE" => "OPTQUANTITY1",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_OPTQUANTITY1"),
		),
        array(
			"CODE" => "MINIMUM_ORDER_QUANTITY",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_MINIMUM_ORDER_QUANTITY"),
		),
		array(
			"CODE" => "CURRENCYID",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_CURRENCY"),
			"REQUIRED" => 'Y',
		),
		array(
			"CODE" => "CATEGORYID",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_CATEGORY"),
			"VALUE" => "IBLOCK_SECTION_ID",
			"REQUIRED" => 'Y',
            "TYPE" => 'field',
		),
		array(
			"CODE" => "PICTURE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_PICTURE"),
		),
        array(
			"CODE" => "TYPEPREFIX",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_TYPEPREFIX"),
		),
        array(
			"CODE" => "VENDOR",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_VENDOR"),
		),
		array(
			"CODE" => "VENDORCODE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_VENDORCODE"),
		),
        array(
			"CODE" => "BARCODE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_BARCODE"),
		),
		array(
			"CODE" => "MODEL",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_MODEL"),
		),
		array(
			"CODE" => "DESCRIPTION",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_DESCRIPTION"),
		),
        array(
			"CODE" => "COUNTRY",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_COUNTRYOFORIGIN"),
		),
        array(
			"CODE" => "PARAM",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_PARAM"),
		),
        array(
			"CODE" => "KEYWORDS",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_TIU_SIMPLE_FIELD_KEYWORDS"),
		),

	),
	"FORMAT" => '<?xml version="1.0" encoding="#ENCODING#"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="#DATE#">
    <shop>
        <name>#SHOP_NAME#</name>
        <company>#COMPANY_NAME#</company>
        <url>#SITE_URL#</url>
        <currencies>#CURRENCY#</currencies>
        <categories>#CATEGORY#</categories>
        <offers>
            #ITEMS#
        </offers>
    </shop>
</yml_catalog>',

	"DATEFORMAT" => "Y-m-d_h:i",
    "ENCODING" => 'utf8',
);

$profileTypes['tiu_simple']['EXAMPLE'] = GetMessage('ACRIT_EXPORTPRO_TYPE_TIU_SIMPLE_EXAMPLE');

$profileTypes['tiu_simple']['CURRENCIES'] =
    "<currency id='#CURRENCY#' rate='#RATE#' plus='#PLUS#'></currency>" . PHP_EOL;

$profileTypes['tiu_simple']['SECTIONS'] =
    "<category id='#ID#'>#NAME#</category>" . PHP_EOL;

$profileTypes['tiu_simple']['ITEMS_FORMAT'] = "
<offer id=\"#ID#\" available=\"#AVAILABLE#\" group_id=\"#GROUP_ID#\" selling_type=\"#SELLING_TYPE#\">
    <name>#NAME#</name>
    <typePrefix>#TYPEPREFIX#</typePrefix>
    <price>#PRICE#</price>
    <oldprice>#OLDPRICE#</oldprice>
    <discount>#DISCOUNT#</discount>
    <minimum_order_quantity>#MINIMUM_ORDER_QUANTITY#</minimum_order_quantity>
    <discount>#DISCOUNT#</discount>
    <currencyId>#CURRENCYID#</currencyId>
    <categoryId>#CATEGORYID#</categoryId>
    <picture>#SITE_URL##PICTURE#</picture>
    <vendor>#VENDOR#</vendor>
    <vendorCode>#VENDORCODE#</vendorCode>
    <barcode>#BARCODE#</barcode>
    <country>#COUNTRY#</country>
    <param>#PARAM#</param>
    <description>#DESCRIPTION#</description>
    <available>#AVAILABLE#</available>
    <model>#MODEL#</model>
    <keywords>#KEYWORDS#</keywords>
</offer>
";

$profileTypes['tiu_simple']['LOCATION'] = array(
	'tiu' => array(
		'name' => GetMessage("ACRIT_EXPORTPRO_TIU"),
		'sub' => array(
		)
	),
);