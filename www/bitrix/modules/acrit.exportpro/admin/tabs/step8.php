<?
IncludeModuleLangFile(__FILE__);
?>
<div id="PROFILE_CONDITION">
<?
    $obCond = new CAcritExportproCatalogCond();
    CAcritExportproProps::$arIBlockFilter = $profileUtils->PrepareIBlock($arProfile['IBLOCK_ID'], $arProfile['USE_SKU']);
    $boolCond = $obCond->Init(0, 0, array(
        'FORM_NAME' => 'exportpro_form',
        'CONT_ID' => 'PROFILE_CONDITION',
        'JS_NAME' => 'JSCatCond', 'PREFIX' => 'PROFILE[CONDITION]')
    );
    if (!$boolCond){
        if ($ex = $APPLICATION->GetException()){
            echo $ex->GetString() . "<br>";
        }
    }
    $obCond->Show($arProfile['CONDITION']);
?>
</div>