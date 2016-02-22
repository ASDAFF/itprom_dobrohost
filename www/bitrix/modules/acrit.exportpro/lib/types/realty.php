<?php
IncludeModuleLangFile(__FILE__);

$profileTypes["y_realty"] = array(
    "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_NAME" ),
    "DESCRIPTION" => GetMessage( "ACRIT_EXPORTPRO_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://realty.yandex.ru/",
    "HELP" => "http://yandex.ru/support/realty/partners/requirements.xml",
    "FIELDS" => array(
        array(
            "CODE" => "ID",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => 'Y',
            "TYPE" => 'field',
        ),
        array(
            "CODE" => "TYPE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_TYPE" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "PROPERTY_TYPE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_PROPERTY_TYPE" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "CATEGORY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_CATEGORY" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "URL",
            "NAME" => "URL ".GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_URL" ),
            "VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "CREATION_DATE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_CREATION_DATE" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "LAST_UPDATE_DATE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LAST_UPDATE_DATE" ),
        ),
        
        array(
            "CODE" => "EXPIRE_DATE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_EXPIRE_DATE" ),
        ),
        
        array(
            "CODE" => "PAYED_ADV",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_PAYED_ADV" ),
        ),
        
        array(
            "CODE" => "MANUALLY_ADDED",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_MANUALLY_ADDED" ),
        ),
        
        array(
            "CODE" => "LOCATION",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_MANUALLY_LOCATION" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "COUNTRY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_COUNTRY" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "REGION",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_REGION" ),
        ),
        
        array(
            "CODE" => "DISTRICT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_DISTRICT" ),
        ),
        array(
            "CODE" => "LOCALITY_NAME",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LOCALITY_NAME" ),
        ),
        
        array(
            "CODE" => "SUB_LOCALITY_NAME",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SUB_LOCALITY_NAME" ),
        ),
        
        array(
            "CODE" => "NON_ADMIN_SUB_LOCALITY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_NON_ADMIN_SUB_LOCALITY" ),
        ),
        
        array(
            "CODE" => "ADDRESS",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_MANUALLY_ADDRESS" ),
        ),
        
        array(
            "CODE" => "DIRECTION",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_MANUALLY_DIRECTION" ),
        ),
        
        array(
            "CODE" => "DISTANCE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_DISTANCE" ),
        ),
        
        array(
            "CODE" => "LATITUDE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LATITUDE" ),
        ),
        
        array(
            "CODE" => "LONGITUDE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LONGITUDE" ),
        ),
        
        array(
            "CODE" => "METRO",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_METRO" ),
        ),
        
        array(
            "CODE" => "METRO_NAME",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_METRO_NAME" ),
        ),
        
        array(
            "CODE" => "TIME_ON_TRANSPORT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_TIME_ON_TRANSPORT" ),
        ),
        
        array(
            "CODE" => "TIME_ON_FOOT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_TIME_ON_FOOT" ),
        ),
        
        array(
            "CODE" => "RAILWAY_STATION",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_RAILWAY_STATION" ),
        ),
        
        array(
            "CODE" => "SALES_AGENT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "SALES_AGENT_NAME",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT_NAME" ),
        ),
        
        array(
            "CODE" => "SALES_AGENT_PHONE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT_PHONE" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "SALES_AGENT_CATEGORY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT_CATEGORY" ),
        ),
        
        array(
            "CODE" => "SALES_AGENT_ORGANIZATION",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT_ORGANIZATION" ),
        ),
        
        array(
            "CODE" => "SALES_AGENT_AGENCY_ID",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT_AGENCY_ID" ),
        ),
        
        array(
            "CODE" => "SALES_AGENT_URL",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT_URL" ),
        ),
        
        array(
            "CODE" => "SALES_AGENT_EMAIL",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT_EMAIL" ),
        ),
        
        array(
            "CODE" => "SALES_AGENT_PHOTO",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT_PHOTO" ),
        ),
        
        array(
            "CODE" => "SALES_AGENT_PARTNER",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_SALES_AGENT_PARTNER" ),
        ),
        
        array(
            "CODE" => "PRICE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_PRICE" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "PRICE_VALUE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_PRICE_VALUE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        
        array(
            "CODE" => "PRICE_CURRENCY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_PRICE_CURRENCY" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUR",
        ),
        
        array(
            "CODE" => "PRICE_PERIOD",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_PRICE_PERIOD" ),
        ),
        
        array(
            "CODE" => "PRICE_UNIT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_PRICE_UNIT" ),
        ),
        
        array(
            "CODE" => "NOT_FOR_AGENTS",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_NOT_FOR_AGENTS" ),
        ),
        
        array(
            "CODE" => "HAGGLE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_HAGGLE" ),
        ),
        
        array(
            "CODE" => "MORTGAGE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_MORTGAGE" ),
        ),
        
        array(
            "CODE" => "PREPAYMENT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_PREPAYMENT" ),
        ),
        
        array(
            "CODE" => "RENT_PLEDGE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_RENT_PLEDGE" ),
        ),
        
        array(
            "CODE" => "AGENT_FEE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_AGENT_FEE" ),
        ),
        
        array(
            "DEAL_STATUS" => "PRICE_UNIT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_DEAL_STATUS" ),
        ),
        
        array(
            "CODE" => "WITH_PETS",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_WITH_PETS" ),
        ),
        
        array(
            "CODE" => "WITH_CHILDREN",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_WITH_CHILDREN" ),
        ),
        
        array(
            "CODE" => "OBJECT_AREA",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_AREA" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "OBJECT_IMAGE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_IMAGE" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "OBJECT_RENOVATION",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_RENOVATION" ),
        ),
        
        array(
            "CODE" => "OBJECT_QUALITY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_QUALITY" ),
        ),
        
        array(
            "CODE" => "OBJECT_DESCRIPTION",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_DESCRIPTION" ),
        ),
        
        array(
            "CODE" => "OBJECT_LIVING_SPACE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_LIVING_SPACE" ),
        ),
        
        array(
            "CODE" => "OBJECT_ROOM_SPACE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_ROOM_SPACE" ),
        ),
        
        array(
            "CODE" => "OBJECT_KITCHEN_SPACE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_KITCHEN_SPACE" ),
        ),
        
        array(
            "CODE" => "OBJECT_VALUE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_VALUE" ),
        ),
        
        array(
            "CODE" => "OBJECT_UNIT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OBJECT_UNIT" ),
        ),
        
        array(
            "CODE" => "LOT_AREA",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LOT_AREA" ),
        ),
        
        array(
            "CODE" => "LOT_TYPE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LOT_TYPE" ),
        ),
        
        array(
            "CODE" => "LEAVING_NEW_FLAT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_NEW_FLAT" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "LEAVING_ROOMS",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_ROOMS" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "LEAVING_ROOMS_OFFERED",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_ROOMS_OFFERED" ),
            "REQUIRED" => "Y",
        ),
        
        array(
            "CODE" => "LEAVING_OPEN_PLAN",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_OPEN_PLAN" ),
        ),
        
        array(
            "CODE" => "LEAVING_ROOMS_TYPE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_ROOMS_TYPE" ),
        ),
        
        array(
            "CODE" => "LEAVING_PHONE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_PHONE" ),
        ),
        
        array(
            "CODE" => "LEAVING_INTERNET",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_INTERNET" ),
        ),
        
        array(
            "CODE" => "LEAVING_ROOM_FURNITURE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_ROOM_FURNITURE" ),
        ),
        
        array(
            "CODE" => "LEAVING_KITCHEN_FURNITURE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_KITCHEN_FURNITURE" ),
        ),
        
        array(
            "CODE" => "LEAVING_TELEVISION",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_TELEVISION" ),
        ),
        
        array(
            "CODE" => "LEAVING_WASHING_MASHINE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_WASHING_MASHINE" ),
        ),
        
        array(
            "CODE" => "LEAVING_REFRIGERATOR",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_REFRIGERATOR" ),
        ),
        
        array(
            "CODE" => "LEAVING_BALCONY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_BALCONY" ),
        ),
        
        array(
            "CODE" => "LEAVING_BATHROOM_UNIT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_BATHROOM_UNIT" ),
        ),
        
        array(
            "CODE" => "LEAVING_FLOOR_COVERING",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_FLOOR_COVERING" ),
        ),
        
        array(
            "CODE" => "LEAVING_WINDOW_VIEW",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_WINDOW_VIEW" ),
        ),
        
        array(
            "CODE" => "LEAVING_FLOOR",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_LEAVING_FLOOR" ),
        ),
        
        array(
            "CODE" => "BUILDING_FLOORS_TOTAL",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_FLOORS_TOTAL" ),
        ),
        
        array(
            "CODE" => "BUILDING_NAME",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_NAME" ),
        ),
        
        array(
            "CODE" => "BUILDING_YANDEX_BUILDING_ID",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_YANDEX_BUILDING_ID" ),
        ),
        
        array(
            "CODE" => "BUILDING_TYPE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_TYPE" ),
        ),
        
        array(
            "CODE" => "BUILDING_SERIES",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_SERIES" ),
        ),
        
        array(
            "CODE" => "BUILDING_PHASE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_PHASE" ),
        ),
        
        array(
            "CODE" => "BUILDING_SECTION",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_SECTION" ),
        ),
        
        array(
            "CODE" => "BUILDING_STATE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_STATE" ),
        ),
        
        array(
            "CODE" => "BUILDING_BUILT_YEAR",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_BUILT_YEAR" ),
        ),
        
        array(
            "CODE" => "BUILDING_READY_QUARTER",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_READY_QUARTER" ),
        ),
        
        array(
            "CODE" => "BUILDING_LIFT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_LIFT" ),
        ),
        
        array(
            "CODE" => "BUILDING_RUBBISH_CHUTE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_RUBBISH_CHUTE" ),
        ),
        
        array(
            "CODE" => "BUILDING_IS_ELITE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_IS_ELITE" ),
        ),
        
        array(
            "CODE" => "BUILDING_PARKING",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_PARKING" ),
        ),
        
        array(
            "CODE" => "BUILDING_ALARM",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_ALARM" ),
        ),
        
        array(
            "CODE" => "BUILDING_CEILING_HEIGHT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_CEILING_HEIGHT" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_PMG",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_BUILDING_OUT_OF_TOWN_PMG" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_TOILET",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_TOILET" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_SHOWER",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_SHOWER" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_KITCHEN",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_KITCHEN" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_POOL",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_POOL" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_BILLIARD",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_BILLIARD" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_SAUNA",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_SAUNA" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_HEATING_SUPPLY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_HEATING_SUPPLY" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_WATER_SUPPLY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_WATER_SUPPLY" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_SEWERAGE_SUPPLY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_SEWERAGE_SUPPLY" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_ELECTRICITY_SUPPLY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_ELECTRICITY_SUPPLY" ),
        ),
        
        array(
            "CODE" => "OUT_OF_TOWN_GAS_SUPPLY",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_OUT_OF_TOWN_GAS_SUPPLY" ),
        ),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_UTM_SOURCE" ),
            "REQUIRED" => 'Y',
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => 'Y',
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "ACRIT_EXPORTPRO_REALTY_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
    ),
    "FORMAT" => '<?xml version="1.0" encoding="#ENCODING#"?>
<realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
<generation-date>#DATE#</generation-date>
#ITEMS#
</realty-feed>',
    "DATEFORMAT" => "Y-m-d_h:i",
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;
    
    $profileTypes['y_realty']["FIELDS"][38] = array(
        "CODE" => "PRICE_VALUE",
        "NAME" => GetMessage("ACRIT_EXPORTPRO_REALTY_FIELD_PRICE_VALUE"),
        "REQUIRED" => 'Y',
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["y_realty"]["PORTAL_REQUIREMENTS"] = GetMessage( "ACRIT_EXPORTPRO_TYPE_REALTY_PORTAL_REQUIREMENTS" );
$profileTypes["y_realty"]["EXAMPLE"] = GetMessage( "ACRIT_EXPORTPRO_TYPE_REALTY_EXAMPLE" );

$profileTypes["y_realty"]["ITEMS_FORMAT"] = "
<offer internal-id=\"#ID#\">
    <type>#TYPE#</type>
    <property-type>#PROPERTY_TYPE#</property-type>
    <category>#PROPERTY_TYPE#</category>
    <url>#SITE_URL##URL#?utm_source=#UTM_SOURCE#&amp;utm_medium=#UTM_MEDIUM#&amp;utm_term=#UTM_TERM#&amp;utm_content=#UTM_CONTENT#&amp;utm_campaign=#UTM_CAMPAIGN#</url>
    <payed-adv>#PAYED_ADV#</payed-adv>
    <manually-added>#MANUALLY_ADDED#</manually-added>
    <creation-date>#CREATION_DATE#</creation-date>
    <expire-date>#EXPIRE_DATE#</expire-date>
    <last-update-date>#LAST_UPDATE_DATE#</last-update-date>
    <location>
        <country>#COUNTRY#</country>
        <region>#REGION#</region>
        <district>#DISTRICT#</district>
        <locality-name>#LOCALITY_NAME#</locality-name>
        <railway-station>#RAILWAY_STATION#</railway-station>
    </location>
    <sales-agent>
        <name>#SALES_AGENT_NAME#</name>
        <phone>#SALES_AGENT_PHONE#</phone>
        <category>#SALES_AGENT_CATEGORY#</category>
        <organization>#SALES_AGENT_ORGANIZATION#</organization>
        <url>#SALES_AGENT_URL#</url>
        <email>#SALES_AGENT_EMAIL#</email>
    </sales-agent>
    <price>
        <value>#PRICE_VALUE#</value>
        <currency>#PRICE_CURRENCY#</currency>
    </price>
    <haggle>#HAGGLE#</haggle>
    <mortgage>#MORTGAGE#</mortgage>
    <image>#OBJECT_IMAGE#</image>
    <image>#OBJECT_IMAGE#</image>
    <description>#OBJECT_DESCRIPTION#</description>
    <quality>#OBJECT_QUALITY#</quality>
    <area>
        <value>#OBJECT_AREA#</value>
        <unit>#OBJECT_UNIT#</unit>
    </area>
    <lot-area>
        <value>#LOT_AREA#</value>
        <unit>#OBJECT_UNIT#</unit>
    </lot-area>
    <living-space>
        <value>#OBJECT_LIVING_SPACE#</value>
        <unit>#OBJECT_UNIT#</unit>
    </living-space>
    <kitchen-space>
        <value>#OBJECT_KITCHEN_SPACE#</value>
        <unit>#OBJECT_UNIT#</unit>
    </kitchen-space>
    <lot-type>#LOT_TYPE#</lot-type>
    <rooms>#LEAVING_ROOMS#</rooms>
    <kitchen-furniture>#LEAVING_KITCHEN_FURNITURE#</kitchen-furniture>
    <balcony>#LEAVING_BALCONY#</balcony>
    <bathroom-unit>#LEAVING_BATHROOM_UNIT#</bathroom-unit>
    <floors-total>#BUILDING_FLOORS_TOTAL#</floors-total>
    <building-type>#BUILDING_TYPE#</building-type>
    <pmg>#OUT_OF_TOWN_PMG#</pmg>
    <is-elite>#BUILDING_IS_ELITE#</is-elite>
    <toilet>#OUT_OF_TOWN_TOILET#</toilet>
    <shower>#OUT_OF_TOWN_SHOWER#</shower>
    <kitchen>#OUT_OF_TOWN_KITCHEN#</kitchen>
    <heating-supply>#OUT_OF_TOWN_HEATING_SUPPLY#</heating-supply>
    <water-supply>#OUT_OF_TOWN_WATER_SUPPLY#</water-supply>
    <electricity-supply>#OUT_OF_TOWN_ELECTRICITY_SUPPLY#</electricity-supply>
    <sewerage-supply>#OUT_OF_TOWN_SEWERAGE_SUPPLY#</sewerage-supply>
    <gas-supply>#OUT_OF_TOWN_GAS_SUPPLY#</gas-supply>
    <parking>#BUILDING_PARKING#</parking>
    <alarm>#BUILDING_ALARM#</alarm>
    <pool>#OUT_OF_TOWN_POOL#</pool>
    <sauna>#OUT_OF_TOWN_SAUNA#</sauna>
</offer>
";
    
/*$profileTypes["y_realty"]["LOCATION"] = array(
    "yandex" => array(
        "name" => GetMessage( "ACRIT_EXPORTPRO_ANDEKS" ),
        "sub" => array(
            "market" => array(
                "name" => GetMessage( "ACRIT_EXPORTPRO_VEBMASTER" ),
                "sub" => "",
            )
        )
    ),
);*/