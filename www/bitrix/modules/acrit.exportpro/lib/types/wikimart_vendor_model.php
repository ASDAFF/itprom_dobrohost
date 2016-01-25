<?php
IncludeModuleLangFile(__FILE__);

$profileTypes['wikimart_vendormodel'] = array(
	"CODE" => 'wikimart_vendormodel',
    "NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_NAME"),
	"DESCRIPTION" => GetMessage("ACRIT_EXPORTPRO_PODDERJIVAETSA_ANDEK"),
	"REG" => "http://market.yandex.ru/",
	"HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
	"FIELDS" => array(
		array(
			"CODE" => "ID",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_ID"),
            "VALUE" => "ID",
			"REQUIRED" => 'Y',
            "TYPE" => 'field',
		),
		array(
			"CODE" => "AVAILABLE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_AVAILABLE"),
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
			"CODE" => "BID",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_BID"),
		),
		array(
			"CODE" => "URL",
			"NAME" => "URL ".GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_URL"),
			"VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => 'field',
		),
		array(
			"CODE" => "PRICE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_PRICE"),
			"REQUIRED" => 'Y',
		),
		array(
			"CODE" => "CURRENCYID",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_CURRENCY"),
			"REQUIRED" => 'Y',
		),
		array(
			"CODE" => "CATEGORYID",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_CATEGORY"),
			"VALUE" => "IBLOCK_SECTION_ID",
			"REQUIRED" => 'Y',
            "TYPE" => 'field',
		),
		array(
			"CODE" => "PICTURE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_PICTURE"),
		),
        array(
			"CODE" => "STORE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_STORE"),
		),
        array(
			"CODE" => "TYPEPREFIX",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_TYPEPREFIX"),
		),
        array(
			"CODE" => "VENDOR",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_VENDOR"),
		),
		array(
			"CODE" => "MODEL",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_MODEL"),
		),
		array(
			"CODE" => "DESCRIPTION",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_DESCRIPTION"),
		),
		array(
			"CODE" => "ADULT",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_ADULT"),
		),
        array(
			"CODE" => "AGE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_AGE"),
		),
		array(
			"CODE" => "CPA",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_CPA"),
		),
        array(
			"CODE" => "REC",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_REC"),
		),
        array(
			"CODE" => "EXPIRY",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_EXPIRY"),
		),
        array(
			"CODE" => "WEIGHT",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_WEIGHT"),
		),
        array(
			"CODE" => "DIMENSIONS",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_DIMENSIONS"),
		),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_UTM_SOURCE" ),
            "REQUIRED" => 'Y',
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => 'Y',
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_WIKIMART_VENDORMODEL_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
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
);

$profileTypes['wikimart_vendormodel']['EXAMPLE'] = GetMessage('ACRIT_EXPORTPRO_TYPE_WIKIMART_VENDORMODEL_EXAMPLE');

$profileTypes['wikimart_vendormodel']['CURRENCIES'] =
    "<currency id='#CURRENCY#' rate='#RATE#' plus='#PLUS#'></currency>" . PHP_EOL;

$profileTypes['wikimart_vendormodel']['SECTIONS'] =
    "<category id='#ID#'>#NAME#</category>" . PHP_EOL;

$profileTypes['wikimart_vendormodel']['ITEMS_FORMAT'] = "
<offer id=\"#ID#\" available=\"#AVAILABLE#\" bid=\"#BID#\">
    <url>#SITE_URL##URL#?utm_source=#UTM_SOURCE#&amp;utm_medium=#UTM_MEDIUM#&amp;utm_term=#UTM_TERM#&amp;utm_content=#UTM_CONTENT#&amp;utm_campaign=#UTM_CAMPAIGN#</url>
    <price>#PRICE#</price>
    <currencyId>#CURRENCYID#</currencyId>
    <categoryId>#CATEGORYID#</categoryId>
    <market_category>#MARKET_CATEGORY#</market_category>
    <picture>#SITE_URL##PICTURE#</picture>
    <store>#STORE#</store>
    <typePrefix>#TYPEPREFIX#</typePrefix>
    <vendor>#VENDOR#</vendor>
    <model>#MODEL#</model>
    <description>#DESCRIPTION#</description>
    <adult>#ADULT#</adult>
    <age>#AGE#</age>
    <cpa>#CPA#</cpa>
    <rec>#REC#</rec>
    <expiry>#EXPIRY#</expiry>
    <weight>#WEIGHT#</weight>
    <dimensions>#DIMENSIONS#</dimensions>
</offer>
";
    
$profileTypes['wikimart_vendormodel']['LOCATION'] = array(
	'yandex' => array(
		'name' => GetMessage("ACRIT_EXPORTPRO_WIKIMART"),
		'sub' => array(
		)
	),
);