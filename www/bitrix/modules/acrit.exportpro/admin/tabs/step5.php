<?php
IncludeModuleLangFile(__FILE__);

//$options = $profileUtils->createFieldset();
//$iblockList = array();
//$dbIblock = CIBlock::GetList();
//while($arIBlock = $dbIblock->Fetch())
//    $iblockList[] = $arIBlock['ID'];
$options = $profileUtils->createFieldset2($arProfile['IBLOCK_ID'], true);


$fieldType = array(
    'none' => GetMessage('ACRIT_EXPORTPRO_NE_VYBRANO'),
    'field' => GetMessage('ACRIT_EXPORTPRO_FIELDSET_FIELD'),
    'const' => GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONST')
);

$idCnt = 0;
?>
<tr class="heading" align="center">
    <td colspan="2"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_HEADER')?></td>
</tr>
<tr align="center">
    <td colspan="2">
        <?=BeginNote();?>
        <?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_DESCRIPTION')?>
        <?=EndNote();?>
    </td>
</tr>
<tr>
    <td colspan="2" align="center">
        <table id="fieldset-container" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
        <?foreach($arProfile['XMLDATA'] as $id => $field):?>
        <?
            $useCondition = $field['USE_CONDITION'] == 'Y' ? 'checked="checked"' : '';
            $hideCondition = $useCondition ? '' : 'hide';
            $hideConstBlock = $field['TYPE'] == 'const' ? '' : 'hide';
            $hideFieldBlock = (($field['TYPE'] != 'field') && !$hideConstBlock) || $field['TYPE'] == 'none' || !$field['TYPE'] ? 'hide' : '';
            $required = $field['REQUIRED'] == 'Y' ? 'checked="checked"' : '';
            $deleteOnEmpty = $field['DELETE_ONEMPTY'] == 'N' ? '' : 'checked="checked"';
            $htmlEncode = $field['HTML_ENCODE'] == 'N' ? '' : 'checked="checked"';
            $htmlToTxt = $field['HTML_TO_TXT'] == 'N' ? '' : 'checked="checked"';
            $urlEncode = $field['URL_ENCODE'] == 'Y' ? 'checked="checked"' : '';
            $convertCase = $field['CONVERT_CASE'] == 'Y' ? 'checked="checked"' : '';
        ?>
        <tr class="fieldset-item" data-id="<?=$idCnt++?>">
            <td>
                <label for="PROFILE[XMLDATA][<?=$id?>]"><?=$field['NAME']?></label>
                <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][NAME]" value="<?=$field['NAME']?>" />
            </td>
            <td colspan="2" style="position: relative" class="adm-detail-content-cell-r">
                <input type="text" name="PROFILE[XMLDATA][<?=$id?>][CODE]" value="<?=$field['CODE']?>" />
                <select name="PROFILE[XMLDATA][<?=$id?>][TYPE]" onchange="ShowConvalueBlock(this)" data-id="<?=$id?>">
                    <?foreach($fieldType as $typeId => $typeName):?>
                        <? $selected = $typeId == $field['TYPE'] ? 'selected="selected"' : ''; ?>
                        <option value="<?=$typeId?>" <?=$selected?>><?=$typeName?></option>
                    <?endforeach?>
                </select>
                <select id="field-block" name="PROFILE[XMLDATA][<?=$id?>][VALUE]" class="<?=$hideFieldBlock?>">
                    <option value="">--<?=GetMessage("ACRIT_EXPORTPRO_NE_VYBRANO")?>--</option>
                    <?
                        if($field['TYPE'] == 'field')
                        {
                            $opt = $profileUtils->selectFieldset2($options, $field['VALUE']);
                            echo implode("\n", $opt);
                            unset($opt);
                        }
                    ?>                                    
                </select>                                 
                <div id="const-block" class="<?=$hideConstBlock?>" >
                    <? $hideContvalueFalse = !$useCondition ? 'hide' : ''; ?>
                    <? $showPlaceholder = !$hideContvalueFalse ? 'placeholder' : 'data-placeholder'; ?>
                    <textarea name="PROFILE[XMLDATA][<?=$id?>][CONTVALUE_TRUE]" <?=$showPlaceholder?>="<?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONDITION_TRUE')?>"><?=$field['CONTVALUE_TRUE']?></textarea>
                    <textarea name="PROFILE[XMLDATA][<?=$id?>][CONTVALUE_FALSE]" placeholder="<?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONDITION_FALSE')?>" class="<?=$hideContvalueFalse?>"><?=$field['CONTVALUE_FALSE']?></textarea>
                </div>
                <span class="fieldset-item-delete">&times</span>
                <div style="margin: 10px 0px 10px 15px;">
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][REQUIRED]" value="Y" <?=$required?> />
                    <label for="PROFILE[XMLDATA][<?=$id?>][REQUIRED]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_REQUIRED')?></label>
                    
                    <div style="height: 5px;">&nbsp;</div>
                    
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][USE_CONDITION]" <?=$useCondition?> value="Y" data-id="<?=$id?>" onclick="ShowConditionBlock(this, <?=$idCnt?>)"/>
                    <label for="PROFILE[XMLDATA][<?=$id?>][USE_CONDITION]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONDITION')?></label>
                    
                    <div style="height: 5px;">&nbsp;</div>
                    
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY]" <?=$deleteOnEmpty?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_DELETE_ONEMPTY')?></label>
                    
                    <div style="height: 5px;">&nbsp;</div>
                    
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][URL_ENCODE]" <?=$urlEncode?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][URL_ENCODE]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_URL_ENCODE')?></label>
                    
                    <div style="height: 5px;">&nbsp;</div>
                                        
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][CONVERT_CASE]" <?=$convertCase?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][CONVERT_CASE]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONVERT_CASE')?></label>
                    
                    <div style="height: 5px;">&nbsp;</div>
                    
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][HTML_ENCODE]" <?=$htmlEncode?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][HTML_ENCODE]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_HTML_ENCODE')?></label>
                    
                    <div style="height: 5px;">&nbsp;</div>
                    
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][HTML_TO_TXT]" <?=$htmlToTxt?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][HTML_TO_TXT]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_HTML_TO_TXT')?></label>
                </div>
                <div id="PROFILE_XMLDATA_<?=$id?>_CONDITION" class="condition-block <?=$hideCondition?>">
                <?
                    if( $field["USE_CONDITION"] == "Y" && CModule::IncludeModule( "catalog" ) ){
                        $obCond = new CAcritExportproCatalogCond();
                        CAcritExportproProps::$arIBlockFilter = $profileUtils->PrepareIBlock($arProfile['IBLOCK_ID'], $arProfile['USE_SKU']);
                        $boolCond = $obCond->Init(0, 0, array(
                            'FORM_NAME' => 'exportpro_form',
                            'CONT_ID' => 'PROFILE_XMLDATA_'.$id.'_CONDITION',
                            'JS_NAME' => 'JSCatCond_field_'.$idCnt, 'PREFIX' => 'PROFILE[XMLDATA]['.$id.'][CONDITION]')
                        );
                        if (!$boolCond){
                            if ($ex = $APPLICATION->GetException()){
                                echo $ex->GetString() . "<br>";
                            }
                        }
                        $obCond->Show($field['CONDITION']);
                    }
                ?>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr style="opacity: 0.2;">
            </td>
        </tr>
        <?endforeach?>
        </tbody>
        </table>
    </td>
</tr>
<tr>
    <td colspan="2" align="center" id="fieldset-item-add-button">
        <button class="adm-btn" onclick="FieldsetAdd(this); return false;">
            <?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONDITION_ADD')?>
        </button>
    </td>
</tr>


