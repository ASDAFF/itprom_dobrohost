<?php
IncludeModuleLangFile(__FILE__);

$profileTypes['optional'] = array(
	"CODE" => "optional",
	"NAME" => GetMessage("ACRIT_EXPORTPRO_OPTIONAL"),
	"DESCRIPTION" => GetMessage("ACRIT_EXPORTPRO_OPTIONAL_DESCR"),
	"REG" => "/",
	"HELP" => "/",
	"FIELDS" => array(
		array(
			"CODE" => "ID",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_ID"),
            "VALUE" => "ID",
			"REQUIRED" => 'Y',
            "TYPE" => 'field',
		),
		array(
			"CODE" => "AVAILABLE",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_AVAILABLE"),
			"VALUE" => "",
            'TYPE' => 'const',
            "CONDITION" => array(
                "CLASS_ID" => "CondGroup",
                "DATA" => array(
                    "All" => "AND",
                    "True" => "True"
                ),
                "CHILDREN" => array(
                    array(
                        "CLASS_ID" => "CondCatQuantity",
                        "DATA" => array(
                                "logic" => "EqGr",
                                "value" => "1"
                        )
                    )
                )
            ),
            'USE_CONDITION' => 'Y',
            'CONTVALUE_TRUE' => 'true',
            'CONTVALUE_FALSE' => 'false',
		),
		array(
			"CODE" => "URL",
			"NAME" => "URL ".GetMessage("ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_URL"),
			"VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => 'field',
		),
		array(
			"CODE" => "NAME",
			"NAME" => GetMessage("ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_NAME"),
			"REQUIRED" => 'Y',
            'VALUE' => 'NAME',
            "TYPE" => 'field',
		),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_UTM_SOURCE" ),
            "REQUIRED" => 'Y',
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => 'Y',
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_MARKET_AUDIOBOOK_FIELD_UTM_CAMPAIGN" ),
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
);

$profileTypes['optional']['EXAMPLE'] = '';


$profileTypes['optional']['CURRENCIES'] =
    "<currency id='#CURRENCY#' rate='#RATE#' plus='#PLUS#'></currency>" . PHP_EOL;

$profileTypes['optional']['SECTIONS'] =
    "<category id='#ID#'>#NAME#</category>" . PHP_EOL;

$profileTypes['optional']['ITEMS_FORMAT'] = '
    <offer id="#ID#" available="#AVAILABLE#">
    <id>#ID#</id>
    <available>#AVAILABLE#</available>
    <url>#SITE_URL##URL#?utm_source=#UTM_SOURCE#&amp;utm_medium=#UTM_MEDIUM#&amp;utm_term=#UTM_TERM#&amp;utm_content=#UTM_CONTENT#&amp;utm_campaign=#UTM_CAMPAIGN#</url>
    <name>#NAME#</name>
</offer>';
    
$profileTypes['optional']['LOCATION'] = array(
    'yandex' => array(
		'name' => GetMessage("ACRIT_EXPORTPRO_ANDEKS"),
		'sub' => array(
			'market' => array(
				'name' => GetMessage("ACRIT_EXPORTPRO_VEBMASTER"),
				'sub' => '',
			)
		)
	),
);