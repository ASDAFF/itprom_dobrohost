<?php
include ($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if(!check_bitrix_sessid())
    die();

IncludeModuleLangFile(__FILE__);

CModule::IncludeModule('acrit.exportpro');
CModule::IncludeModule('iblock');
CModule::IncludeModule('catalog');

$ajax_action();

function unlock_export()
{
    global $APPLICATION, $profileID;
    if(file_exists($_SERVER['DOCUMENT_ROOT']."/bitrix/tools/acrit.exportpro/export_{$profileID}_run.lock"))
    {
        require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
        unlink($_SERVER['DOCUMENT_ROOT']."/bitrix/tools/acrit.exportpro/export_{$profileID}_run.lock");
        ob_start();
        echo '<td colspan="2" align="center">';
        CAdminMessage::ShowMessage(array(
            'MESSAGE' => GetMessage('ACRIT_EXPORTPRO_EXPORT_UNLOCK'),
            'TYPE' => 'OK',
            'HTML' => 'TRUE'
        ));
        echo '</td>';
        $data = ob_get_clean();
        $APPLICATION->RestartBuffer();

        echo Bitrix\Main\Web\Json::encode(
            array(
                'result' => 'ok',
                'blocks' => array(
                    array(
                        'id' => '#unlock-container',
                        'html' => $data
                    ),
                )
        )); 
    }
    die();
}

function update_log()
{
    global $APPLICATION, $profileID;
    $dbProfile = new CExportproProfileDB;
    $arProfile = $dbProfile->GetById($profileID);
    ob_start();
    ?>
    <td colspan="2" align="center">
        <table width="30%" border="1">
            <tbody>
                <tr>
                    <td colspan="2" align="center"><b><?=GetMessage('ACRIT_EXPORTPRO_LOG_ALL')?></b></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage('ACRIT_EXPORTPRO_LOG_ALL_IB')?></td>
                    <td width="50%"><?=$arProfile['LOG']['IBLOCK']?></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage('ACRIT_EXPORTPRO_LOG_ALL_SECTION')?></td>
                    <td width="50%"><?=$arProfile['LOG']['SECTIONS']?></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage('ACRIT_EXPORTPRO_LOG_ALL_OFFERS')?></td>
                    <td width="50%"><?=$arProfile['LOG']['PRODUCTS']?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><b><?=GetMessage('ACRIT_EXPORTPRO_LOG_EXPORT')?></b></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage('ACRIT_EXPORTPRO_LOG_OFFERS_EXPORT')?></td>
                    <td width="50%"><?=$arProfile['LOG']['PRODUCTS_EXPORT']?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><b><?=GetMessage('ACRIT_EXPORTPRO_LOG_ERROR')?></b></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage('ACRIT_EXPORTPRO_LOG_ERR_OFFERS')?></td>
                    <td width="50%"><?=$arProfile['LOG']['PRODUCTS_ERROR']?></td>
                </tr>
            </tbody>
        </table>
    </td>
    <?
    $data1 = ob_get_clean();
    ob_start();
    if(file_exists($_SERVER['DOCUMENT_ROOT'].$arProfile['LOG']['FILE']))
    {
        ?>
        <td width="50%" class="adm-detail-content-cell-l" style="padding: 15px 0;"><b><?=GetMessage('ACRIT_EXPORTPRO_LOG_FILE')?></b></td>
        <td width="50%" class="adm-detail-content-cell-r"><a href="<?=$arProfile['LOG']['FILE']?>" download="export_log"><?=$arProfile['LOG']['FILE']?></a></td>
        <?
    }
    $data2 = ob_get_clean();
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'blocks' => array(
            array(
                'id' => '#log_detail',
                'html' => $data1
            ),
            array(
                'id' => '#log_detail_file',
                'html' => $data2
            ),
        )
    ));
    die();
}

function get_condition_block()
{
    global $fId, $fCnt, $PROFILE, $APPLICATION;
    $profileUtils = new CExportproProfile;
    $obCond = new CAcritExportproCatalogCond();
    CAcritExportproProps::$arIBlockFilter = $profileUtils->PrepareIBlock($PROFILE['IBLOCK_ID'], $PROFILE['USE_SKU']);
    $boolCond = $obCond->Init(0, 0, array(
        'FORM_NAME' => 'exportpro_form',
        'CONT_ID' => 'PROFILE_XMLDATA_'.$fId.'_CONDITION',
        'JS_NAME' => 'JSCatCond_field_'.$fCnt, 'PREFIX' => 'PROFILE[XMLDATA]['.$fId.'][CONDITION]')
    );
    ob_start();
    $obCond->Show($field['CONDITION']);
    $data = ob_get_clean();
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'blocks' => array(
            array(
                'id' => '#PROFILE_XMLDATA_'.$fId.'_CONDITION',
                'html' => $data
            ),
        )
    ));
    die();
}

function fieldset_field_select()
{
    global $PROFILE, $APPLICATION, $marketId, $data_id;
    $profileUtils = new CExportproProfile;
    $options = $profileUtils->createFieldset2($PROFILE['IBLOCK_ID'], true);
    $opt = $profileUtils->selectFieldset2($options, '');
    ob_start();
    echo implode("\n", $opt);
    unset($opt);
    $data = ob_get_clean();
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'blocks' => array(
            array(
                'id' => 'select[name="PROFILE[XMLDATA]['.$data_id.'][VALUE]"]',
                'html' => $data
            ),
        )
    ));
    die();
}

function change_market_category()
{
    global $PROFILE, $APPLICATION, $marketId;
    $marketCategory = new CExportproMarketDB;
    $marketCategory = $marketCategory->GetByID($marketId);
    $marketCategory = explode(PHP_EOL, $marketCategory['data']);

    $profileUtils = new CExportproProfile();
    $categories = $profileUtils->GetSections($PROFILE['IBLOCK_ID'], true);
    $categoriesNew = array();
    foreach($categories as $depth)
    {
        $categoriesNew = array_merge($categoriesNew, $depth);
    }
    $categories = $categoriesNew;
    unset($categoriesNew);
    asort($categories);

    ob_start();
    ?>
    <table width="100%">
        <?foreach($categories as $cat):?>
            <?
            if($PROFILE['CHECK_INCLUDE'] == 'Y')
            {
                if(!in_array($cat['ID'], $PROFILE['CATEGORY']))
                    continue;
            }
            else
            {
                if(!in_array($cat['PARENT_1'], $PROFILE['CATEGORY']))
                    continue;
            }
            ?>
            <tr>
                <td width="40%">
                    <label form="PROFILE[MARKET_CATEGORY][CATEGORY_LIST][<?=$cat['ID']?>]"><?=$cat['NAME']?></label>
                </td>
                <td>
                    <input type="text" value="" name="PROFILE[MARKET_CATEGORY][CATEGORY_LIST][<?=$cat['ID']?>]" />
                    <span class="field-edit" onclick="ShowMarketCategoryList(<?=$cat['ID']?>)" style="cursor: pointer"></span>
                </td>
            </tr>
            <?endforeach?>
    </table>
    <?
    $data = ob_get_clean();

    ob_start();
    ?>
    <input onkeyup="FilterMarketCategoryList(this)">
    <select onchange="SetMarketCategory(this.value)" size="25">
        <option></option>
        <?foreach($marketCategory as $marketCat):?>
            <option data-search="<?=strtolower($marketCat)?>"><?=$marketCat?></option>
            <?endforeach?>
    </select>
    <?
    $data1 = ob_get_clean();
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'blocks' => array(
            array(
                'id' => '#market_category_data',
                'html' => $data
            ),
            array(
                'id' => '#market_category_list',
                'html' => $data1
            ),
        )
    ));
    die();
}

function market_save()
{
    global $APPLICATION, $PROFILE, $marketId, $marketData, $marketName, $current, $DB;
    if(strtoupper(SITE_CHARSET) == "WINDOWS-1251")
    {
        $marketData = mb_convert_encoding($marketData, 'cp1251', 'utf8');
        $marketName = mb_convert_encoding($marketName, 'cp1251', 'utf8');
    }
    CModule::IncludeModule('acrit.exportpro');
    $marketCategory = new CExportproMarketDB;

    $arFields = array(
        'name' => $marketName,
        'data' => $marketData
    );

    if($marketId)
        $boolRes = $marketCategory->Update($marketId, $arFields);
    else
        $boolRes = $marketCategory->Add($arFields);
    if($boolRes)
        $boolRes = 'ok';

    $marketCategory = $marketCategory->GetList();
    ob_start();
    ?>
    <select name="PROFILE[MARKET_CATEGORY][CATEGORY]" onchange="ChangeMarketCategory(this.value)">
        <?foreach($marketCategory as $cat):?>
            <? $selected = $cat['id'] == $current ? 'selected="selected"' : '' ?>
            <option value="<?=$cat['id']?>" <?=$selected?>><?=$cat['name']?></option>
            <?endforeach?>
    </select>
    <?
    $data = ob_get_clean();
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'blocks' => array(
            array(
                'id' => '#market_category_select',
                'html' => $data
            ),
        )
    ));
    die();
}

function market_edit()
{
    global $APPLICATION, $PROFILE, $marketId;
    CModule::IncludeModule('acrit.exportpro');
    $marketCategory = new CExportproMarketDB;
    $marketCategory = $marketCategory->GetByID($marketId);
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'id' => $marketCategory['id'],
        'name' => $marketCategory['name'],
        'data' => $marketCategory['data'],
    ));
    die();
}

function fieldset_add()
{
    global $APPLICATION, $PROFILE, $id;
    $id++;
    $useCondition = '';
    $hideCondition = 'hide';
    $hideConstBlock = 'hide';

    $profileUtils = new CExportproProfile;
    $options = $profileUtils->createFieldset2($PROFILE['IBLOCK_ID'], true);

    $fieldType = array(
        'none' => GetMessage('ACRIT_EXPORTPRO_NE_VYBRANO'),
        'field' => GetMessage('ACRIT_EXPORTPRO_FIELDSET_FIELD'),
        'const' => GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONST')
    );
    ob_start();
    ?>
    <tr class="fieldset-item" data-id="<?=$id?>">
        <td >
            <label for="PROFILE[XMLDATA][<?=$id?>]"></label>
            <input type="text" name="PROFILE[XMLDATA][<?=$id?>][NAME]" placeholder="<?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_NAME_DESCR')?>"/>
        </td>
        <td colspan="2">
            <input type="text" name="PROFILE[XMLDATA][<?=$id?>][CODE]" placeholder="<?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_NAME')?>"/>
            <select name="PROFILE[XMLDATA][<?=$id?>][TYPE]" onchange="ShowConvalueBlock(this)" data-id="<?=$id?>">
                <?foreach($fieldType as $typeId => $typeName):?>
                    <option value="<?=$typeId?>" <?=$selected?>><?=$typeName?></option>
                    <?endforeach?>
            </select>
            <select id="field-block" name="PROFILE[XMLDATA][<?=$id?>][VALUE]">
                <option value="">--<?=GetMessage("ACRIT_EXPORTPRO_NE_VYBRANO")?>--</option>
                <?
                $opt = $profileUtils->selectFieldset2($options, '');
                echo implode("\n", $opt);
                unset($opt);
                ?>
            </select>
            <div id="const-block" class="<?=$hideConstBlock?>" >
                <textarea name="PROFILE[XMLDATA][<?=$id?>][CONTVALUE_TRUE]" placeholder="<?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONDITION_TRUE')?>"></textarea>
                <textarea name="PROFILE[XMLDATA][<?=$id?>][CONTVALUE_FALSE]" placeholder="<?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONDITION_FALSE')?>"></textarea>
            </div>
            <span class="fieldset-item-delete">&times</span>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr style="opacity: 0.2;">
        </td>
    </tr>
    <?
    $data = ob_get_clean();
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'data' => $data
    ));
    die();
}
function change_type()
{
    global $APPLICATION, $PROFILE;     

    $profile = new CExportproProfile;
    $types = $profile->GetTypes();

    $siteEncoding = array(
        'utf-8' => 'utf8',
        'UTF8' => 'utf8',
        'UTF-8' => 'utf8',
        'WINDOWS-1251' => 'cp1251',
        'windows-1251' => 'cp1251',
        'CP1251' => 'cp1251',
    );
    
    if( !isset( $_REQUEST["ID"] ) ){
        $obProfile = new CExportproProfileDB();
        $dbProcessProfiles = $obProfile->GetProcessList(
            array(
                $by => $order
            ),
            array()
        );

        $arActualProfileNames = array();
        while( $arProcessProfile = $dbProcessProfiles->Fetch() ){
            $arActualProfileNames[] = $arProcessProfile["NAME"];
        }

        if( !in_array( $PROFILE["TYPE"], $arActualProfileNames ) ){
            $profileCode = $PROFILE["TYPE"];
        }
        else{
            $bCorrentProfileName = false;
            $iProfileNameIndex = 1;
            while( !$bCorrentProfileName ){
                if( !in_array( $PROFILE["TYPE"].$iProfileNameIndex, $arActualProfileNames ) ){
                    $profileCode = $PROFILE["TYPE"].$iProfileNameIndex;
                    $bCorrentProfileName = true;
                }
                $iProfileNameIndex++;
            }
        }                      
        
        ob_start();
        ?>
        <input type="text" size="30" name="PROFILE[NAME]" value="<?=$profileCode;?>"/>
        <?
        $dataProfileName = ob_get_clean();
                
        ob_start();
        ?>
        <input type="text" size="30" name="PROFILE[CODE]" value="<?=$profileCode;?>"/>    
        <?$dataProfileCode = ob_get_clean();
        
        ob_start();
        ?>
        <input type="text" size="30" name="PROFILE[SETUP][URL_DATA_FILE]" value="/acrit.exportpro/<?=$profileCode?>.<?if( $PROFILE["TYPE"] == "advantshop" ):?>csv<?else:?>xml<?endif;?>"/>    
        <?$exportFilePath = ob_get_clean();
        
        ob_start();
        ?>
        <td colspan="2"></td>
        <?$advantShopCheckCompessArea = ob_get_clean();
        
        ob_start();
        ?>
        <td colspan="2">
            <input type="hidden" name="PROFILE[SETUP][FILE_TYPE]" value="csv" />
        </td>
        <?$advantShopFilePathArea = ob_get_clean();
        
        ob_start();
        ?>
        <input type="text" name="PROFILE[SETUP][EXPORT_STEP]" id="export_step_value" value="50000" disabled="disabled">
        <?$advantShopExportStepBlock = ob_get_clean();
    }
           
    ob_start();
    ?>
    <textarea name="PROFILE[FORMAT]" rows="5" cols="150"><?=$types[$PROFILE['TYPE']]['FORMAT']?></textarea>
    <?
    $data1 = ob_get_clean();
    ob_start();
    ?>
    <textarea name="PROFILE[OFFER_TEMPLATE]" rows="5" cols="150"><?=htmlspecialcharsbx( $types[$PROFILE['TYPE']]['ITEMS_FORMAT'] );?></textarea>
    <?
    $data2 = ob_get_clean();
    ob_start();
    ?>
    <textarea name="PROFILE[CATEGORY_TEMPLATE]" rows="5" cols="150"><?=htmlspecialcharsbx( $types[$PROFILE['TYPE']]['SECTIONS'] );?></textarea>
    <?
    $data3 = ob_get_clean();
    ob_start();
    ?>
    <textarea name="PROFILE[CURRENCY_TEMPLATE]" rows="5" cols="150"><?=htmlspecialcharsbx( $types[$PROFILE['TYPE']]['CURRENCIES'] );?></textarea>
    <?
    $data4 = ob_get_clean();
    ob_start();
    $iblockList = array();
    $dbIblock = CIBlock::GetList();
    while($arIBlock = $dbIblock->Fetch())
        $iblockList[] = $arIBlock['ID'];
    $options = $profile->createFieldset2($PROFILE['IBLOCK_ID'], true);

    $fieldType = array(
        'none' => GetMessage('ACRIT_EXPORTPRO_NE_VYBRANO'),
        'field' => GetMessage('ACRIT_EXPORTPRO_FIELDSET_FIELD'),
        'const' => GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONST')
    );?>      
    
    <tbody>                                                                           
        <?$idCnt = 0;?>
        <?foreach($types[$PROFILE['TYPE']]['FIELDS'] as $id => $field):?>
            <?
            $useCondition = $field['USE_CONDITION'] == 'Y' ? 'checked="checked"' : '';
            $hideCondition = $useCondition ? '' : 'hide';
            $hideConstBlock = $field['TYPE'] == 'const' ? '' : 'hide';
            $hideFieldBlock = (($field['TYPE'] != 'field') && !$hideConstBlock) || $field['TYPE'] == 'none' || !$field['TYPE'] ? 'hide' : '';
            $required = $field['REQUIRED'] == 'Y' ? 'checked="checked"' : '';
            $deleteOnEmpty = $field['DELETE_ONEMPTY'] == 'N' ? '' : 'checked="checked"';
            $htmlEncode = $field['HTML_ENCODE'] == 'N' ? '' : 'checked="checked"';
            $htmlToTxt = $field['HTML_TO_TXT'] == 'N' ? '' : 'checked="checked"';
            $skipUntermElement = $field['SKIP_UNTERM_ELEMENT'] == 'N' ? '' : 'checked="checked"';
            $urlEncode = $field['URL_ENCODE'] == 'Y' ? 'checked="checked"' : '';
            $convertCase = $field['CONVERT_CASE'] == 'Y' ? 'checked="checked"' : '';  
            ?>      
            <tr class="fieldset-item" data-id="<?=$idCnt++?>">
                <td >
                    <label for="PROFILE[XMLDATA][<?=$id?>]"><?=$field['NAME']?></label>
                    <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][NAME]" value="<?=$field['NAME']?>" />
                </td>
                <td colspan="2">
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
                            $opt = $profile->selectFieldset2($options, $field['VALUE']);
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
                        <span id="hint_EXPORTPRO_FIELDSET_REQUIRED"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPRO_FIELDSET_REQUIRED' ), '<?=GetMessage( "ACRIT_EXPORTPRO_FIELDSET_REQUIRED_HELP" )?>' );</script>
                        <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][REQUIRED]" value="Y" <?=$required?> />
                        <label for="PROFILE[XMLDATA][<?=$id?>][REQUIRED]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_REQUIRED')?></label>
                        
                        <div style="height: 5px;">&nbsp;</div>
                        
                        <span id="hint_EXPORTPRO_FIELDSET_CONDITION"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPRO_FIELDSET_CONDITION' ), '<?=GetMessage( "ACRIT_EXPORTPRO_FIELDSET_CONDITION_HELP" )?>' );</script>
                        <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][USE_CONDITION]" <?=$useCondition?> value="Y" data-id="<?=$id?>" onclick="ShowConditionBlock(this, <?=$idCnt?>)"/>
                        <label for="PROFILE[XMLDATA][<?=$id?>][USE_CONDITION]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONDITION')?></label>
                        
                        <div style="height: 5px;">&nbsp;</div>
                        
                        <span id="hint_EXPORTPRO_FIELDSET_DELETE_ONEMPTY"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPRO_FIELDSET_DELETE_ONEMPTY' ), '<?=GetMessage( "ACRIT_EXPORTPRO_FIELDSET_DELETE_ONEMPTY_HELP" )?>' );</script>
                        <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY]" <?=$deleteOnEmpty?> value="Y">
                        <label for="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_DELETE_ONEMPTY')?></label>
                        
                        <div style="height: 5px;">&nbsp;</div>
                        
                        <span id="hint_EXPORTPRO_FIELDSET_URL_ENCODE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPRO_FIELDSET_URL_ENCODE' ), '<?=GetMessage( "ACRIT_EXPORTPRO_FIELDSET_URL_ENCODE_HELP" )?>' );</script>
                        <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][URL_ENCODE]" <?=$urlEncode?> value="Y">
                        <label for="PROFILE[XMLDATA][<?=$id?>][URL_ENCODE]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_URL_ENCODE')?></label>
                        
                        <div style="height: 5px;">&nbsp;</div>
                        
                        <span id="hint_EXPORTPRO_FIELDSET_CONVERT_CASE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPRO_FIELDSET_CONVERT_CASE' ), '<?=GetMessage( "ACRIT_EXPORTPRO_FIELDSET_CONVERT_CASE_HELP" )?>' );</script>                    
                        <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][CONVERT_CASE]" <?=$convertCase?> value="Y">
                        <label for="PROFILE[XMLDATA][<?=$id?>][CONVERT_CASE]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_CONVERT_CASE')?></label>
                        
                        <div style="height: 5px;">&nbsp;</div>
                        
                        <span id="hint_EXPORTPRO_FIELDSET_HTML_ENCODE"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPRO_FIELDSET_HTML_ENCODE' ), '<?=GetMessage( "ACRIT_EXPORTPRO_FIELDSET_HTML_ENCODE_HELP" )?>' );</script>
                        <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][HTML_ENCODE]" <?=$htmlEncode?> value="Y">
                        <label for="PROFILE[XMLDATA][<?=$id?>][HTML_ENCODE]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_HTML_ENCODE')?></label>
                        
                        <div style="height: 5px;">&nbsp;</div>
                        
                        <span id="hint_EXPORTPRO_FIELDSET_HTML_TO_TXT"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPRO_FIELDSET_HTML_TO_TXT' ), '<?=GetMessage( "ACRIT_EXPORTPRO_FIELDSET_HTML_TO_TXT_HELP" )?>' );</script>
                        <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][HTML_TO_TXT]" <?=$htmlToTxt?> value="Y">
                        <label for="PROFILE[XMLDATA][<?=$id?>][HTML_TO_TXT]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_HTML_TO_TXT')?></label>
                        
                        <div style="height: 5px;">&nbsp;</div>
                        
                        <span id="hint_EXPORTPRO_FIELDSET_SKIP_UNTERM_ELEMENT"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPRO_FIELDSET_SKIP_UNTERM_ELEMENT' ), '<?=GetMessage( "ACRIT_EXPORTPRO_FIELDSET_SKIP_UNTERM_ELEMENT_HELP" )?>' );</script>
                        <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][SKIP_UNTERM_ELEMENT]" <?=$skipUntermElement?> value="Y">
                        <label for="PROFILE[XMLDATA][<?=$id?>][SKIP_UNTERM_ELEMENT]"><?=GetMessage('ACRIT_EXPORTPRO_FIELDSET_SKIP_UNTERM_ELEMENT')?></label>
                    </div>
                    <div id="PROFILE_XMLDATA_<?=$id?>_CONDITION" class="condition-block <?=$hideCondition?>">
                        <?
                        if($field['USE_CONDITION'] == 'Y')
                        {
                            $obCond = new CAcritExportproCatalogCond();
                            CAcritExportproProps::$arIBlockFilter = $profile->PrepareIBlock($PROFILE['IBLOCK_ID'], $PROFILE['USE_SKU']);
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
    <?
    $data5 = ob_get_clean();
    ob_start();?>
    <a href="<?=$types[$PROFILE["TYPE"]]["PORTAL_REQUIREMENTS"];?>" target="_blank"><?=$types[$PROFILE["TYPE"]]["PORTAL_REQUIREMENTS"];?></a>
    <?$dataPortalRequirements = ob_get_clean();
    ob_start();
    $encoding = $siteEncoding[SITE_CHARSET] == 'utf8' ? 'utf-8' : $siteEncoding[SITE_CHARSET];
    echo '<pre>',  htmlspecialchars($types[$PROFILE['TYPE']]['EXAMPLE'], ENT_COMPAT | ENT_HTML401, $encoding), '</pre>';
    $data6 = ob_get_clean();
    ob_start();
    echo $types[$PROFILE['TYPE']]['SCHEME_DESCRIPTION'];
    $data7 = ob_get_clean();
    ob_start();
    echo $types[$PROFILE['TYPE']]['SCHEME_OFFER_DESCRIPTION'];
    $data8 = ob_get_clean();
    
    $APPLICATION->RestartBuffer();
    
    $upFieldList = array(
        array(
            'id' => '#scheme_format',
            'html' => $data1
        ),
        array(
            'id' => '#scheme_offer',
            'html' => $data2
        ),
        array(
            'id' => '#scheme_category',
            'html' => $data3
        ),
        array(
            'id' => '#scheme_currency',
            'html' => $data4
        ),
        array(
            'id' => '#fieldset-container',
            'html' => $data5
        ),
        array(
            'id' => '#step3 #portal_requirements',
            'html' => $dataPortalRequirements
        ),
        array(
            'id' => '#step3 #description',
            'html' => $data6
        ),
        array(
            'id' => '#scheme_main_add_descr',
            'html' => $data7
        ),
        array(
            'id' => '#scheme_main_add_offer_descr',
            'html' => $data8
        ),
    );
    
    if( strlen( $profileCode ) > 0 ){
        $upFieldList[] = array(
            'id' => '#profile_name',
            'html' => $dataProfileName
        );
        
        $upFieldList[] = array(
            'id' => '#profile_code',
            'html' => $dataProfileCode
        );
        
        $upFieldList[] = array(
            "id" => "#export_file_path",
            "html" => $exportFilePath
        );
    }
    
    if( $profileCode == "advantshop" ){
        $upFieldList[] = array(
            "id" => "#tr_type_file",
            "html" => $advantShopFilePathArea
        );
        $upFieldList[] = array(
            "id" => "#export_step_block",
            "html" => $advantShopExportStepBlock
        );
        $upFieldList[] = array(
            "id" => "#check_compress_block",
            "html" => $advantShopCheckCompessArea
        );
    }
    
    echo Bitrix\Main\Web\Json::encode( array(
        'result' => 'ok',
        'blocks' => $upFieldList
    ));               
    die();
}
function catalog_only()
{
    change_site();
}
function include_subsection()
{
    global $PROFILE;
    change_iblock($PROFILE['CHECK_INCLUDE'] == 'Y');
}
function use_offers()
{
    change_site();
}
function change_site()
{
    global $APPLICATION;
    global $PROFILE;

    $profile = new CExportproProfile;
    $ibtypes = $profile->GetIBlockTypes(
        $PROFILE['LID'],
        $PROFILE['VIEW_CATALOG'] == 'Y',
        //'N'//$PROFILE['USE_SKU'] != 'Y'
        false
    );
    ob_start();
    ?>
    <select multiple="multiple" name="PROFILE[IBLOCK_TYPE_ID][]">
        <?foreach($ibtypes as $id => $type):?>
            <? $selected = in_array($id, $PROFILE['IBLOCK_TYPE_ID']) ? 'selected="selected"' : '' ?>
            <option value="<?=$id?>" <?=$selected?>><?=$type["NAME"]?></option>
            <?endforeach?>
    </select>
    <?
    $data1 = ob_get_clean();
    ob_start();
    ?>
    <select multiple="multiple" name="PROFILE[IBLOCK_ID][]">
        <?foreach($ibtypes as $type):?>
            <?if(!in_array($type['ID'], $PROFILE['IBLOCK_TYPE_ID'])) continue; ?>
            <?foreach($type["IBLOCK"] as $id => $iblock):?>
                <?
                $selected = '';
                if(in_array($id, $PROFILE['IBLOCK_ID']))
                {
                    $selected = 'selected="selected"';
                    $ibnew[] = $id;
                }

                ?>
                <option value="<?=$id?>" <?=$selected?>><?=$iblock?></option>
                <?endforeach?>
            <?endforeach?>
    </select>
    <?
    $data2 = ob_get_clean();
    $sections = $profile->GetSections(
        $ibnew,
        $PROFILE['CHECK_INCLUDE'] == 'Y'
    );
    ob_start();
    if( !empty( $sections ) ){
        foreach($sections as $depth)
            foreach($depth as $id => $section)
                $sect[$id] = $section;
        asort($sect);

        ?>
        <select multiple="multiple" name="PROFILE[CATEGORY][]">
            <?foreach($sect as $id => $section):?>
                <? $selected = in_array($id, $PROFILE['CATEGORY']) ? 'selected="selected"' : '' ?>
                <option value="<?=$id?>" <?=$selected?>><?=$section['NAME']?></option>
                <?endforeach?>
        </select>
    <?}
    $data3 = ob_get_clean();
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'blocks' => array(
            array(
                'id' => '#ibtype_select_block',
                'html' => $data1
            ),
            array(
                'id' => '#iblock_select_block',
                'html' => $data2
            ),
            array(
                'id' => '#section_select_block',
                'html' => $data3
            )
        )
    ));
    die();
}

function change_ibtype()
{
    global $APPLICATION;
    global $PROFILE;

    $profile = new CExportproProfile;
    $ibtypes = $profile->GetIBlockTypes(
        $PROFILE['LID'],
        $PROFILE['VIEW_CATALOG'] == 'Y',
        //'N'//$PROFILE['USE_SKU'] != 'Y'
        false
    );
    ob_start();
    ?>
    <select multiple="multiple" name="PROFILE[IBLOCK_ID][]">
        <?foreach($ibtypes as $type):?>
            <?if(!in_array($type['ID'], $PROFILE['IBLOCK_TYPE_ID'])) continue; ?>
            <?foreach($type["IBLOCK"] as $id => $iblock):?>
                <? $selected = in_array($id, $PROFILE['IBLOCK_ID']) ? 'selected="selected"' : '' ?>
                <option value="<?=$id?>" <?=$selected?>><?=$iblock?></option>
                <?endforeach?>
            <?endforeach?>
    </select>
    <?
    $data = ob_get_clean();
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'blocks' => array(
            array(
                'id' => '#iblock_select_block',
                'html' => $data
            )
        )
    ));
    die();
}

function change_iblock($changeType = false)
{
    global $APPLICATION;
    global $PROFILE;

    $profile = new CExportproProfile;
    $sections = $profile->GetSections(
        $PROFILE['IBLOCK_ID'],
        $PROFILE['CHECK_INCLUDE'] == 'Y'
    );

    ob_start();          
    ?>           
    <select multiple="multiple" name="PROFILE[CATEGORY][]" class="category_select">
        <?
        if( !empty( $sections ) ){
            foreach($sections as $depth){
                foreach($depth as $id => $section){
                    $sect[$id] = $section;
                }
            }
                
            asort( $sect );
            ?>
            <?foreach($sect as $id => $section){?>
                <? $selected = ( isset( $PROFILE['CATEGORY'] ) && in_array($id, $PROFILE['CATEGORY']) ) ? 'selected="selected"' : ''; ?>
                <? $selected = ( isset( $PROFILE['CATEGORY'] ) && in_array($section['PARENT_1'], $PROFILE['CATEGORY']) ) && $changeType ? 'selected="selected"' : $selected; ?>
                <option value="<?=$id?>" <?=$selected?>><?=$section['NAME']?></option>  
            <?}
        }?>
    </select>
    <?
    $data = ob_get_clean();
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(array(
        'result' => 'ok',
        'blocks' => array(
            array(
                'id' => '#section_select_block',
                'html' => $data
            )
        )
    ));
    die();
}


