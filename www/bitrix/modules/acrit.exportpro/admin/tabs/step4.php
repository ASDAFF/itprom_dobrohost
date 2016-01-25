<?php
IncludeModuleLangFile(__FILE__);

$time[] = GetMessage("ACRIT_EXPORTPRO_NOSELECT");
//24hours format
$time["Y-m-d_H:i"] = date("Y-m-d H:i", time());
$time["Y-m-d_h:i"] = date("Y-m-d h:i", time());
$time["d/m/Y"] = date("d/m/Y", time());
$time["Y/m/d"] = date("Y/m/d", time());
$time["d.m.Y"] = date("d.m.Y", time());
$time["Y-m-d_h:i:s"] = date("Y-m-d h:i:s", time());
$time["YmdThis"] = date("YmdThis", time());
$time["Y/m/d_h:i:s"] = date("Y/m/d h:i:s", time());
$time["d/m/Y_h:i:s"] = date("d/m/Y h:i:s", time());
$time["d.m.Y_h:i:s"] = date("d.m.Y h:i:s", time());
$time["Y-m-d_h:i:s_".GetMessage("ACRIT_EXPORTPRO_")] = date("Y-m-d h:m:s ".GetMessage("ACRIT_EXPORTPRO_"), time());
$time["Y-m-d_h:i:s_".GetMessage("ACRIT_EXPORTPRO_1")] = date("Y-m-d h:i:s ".GetMessage("ACRIT_EXPORTPRO_1"), time());
$time["Y-m-d_h:i:s_".GetMessage("ACRIT_EXPORTPRO_2")] = date("Y-m-d h:i:s ".GetMessage("ACRIT_EXPORTPRO_2"), time());
$time["Y/m/d_h:i:s_".GetMessage("ACRIT_EXPORTPRO_")] = date("Y/m/d h:i:s ".GetMessage("ACRIT_EXPORTPRO_"), time());
$time["Y/m/d_h:i:s_".GetMessage("ACRIT_EXPORTPRO_1")] = date("Y/m/d h:i:s ".GetMessage("ACRIT_EXPORTPRO_1"), time());
$time["Y/m/d_h:i:s_".GetMessage("ACRIT_EXPORTPRO_2")] = date("Y/m/d h:i:s ".GetMessage("ACRIT_EXPORTPRO_2"), time());
$time["D/m/Y_h:i:s_".GetMessage("ACRIT_EXPORTPRO_")] = date("D/m/Y h:i:s ".GetMessage("ACRIT_EXPORTPRO_"), time());
$time["D/m/Y_h:i:s_".GetMessage("ACRIT_EXPORTPRO_1")] = date("D/m/Y h:i:s ".GetMessage("ACRIT_EXPORTPRO_1"), time());
$time["D/m/Y_h:i:s_".GetMessage("ACRIT_EXPORTPRO_2")] = date("D/m/Y h:i:s ".GetMessage("ACRIT_EXPORTPRO_2"), time());
$time["d.m.Y_h:i:s".GetMessage("ACRIT_EXPORTPRO_")] = date("d.m.Y h:i:s".GetMessage("ACRIT_EXPORTPRO_"), time());
$time["d.m.Y_h:i:s".GetMessage("ACRIT_EXPORTPRO_1")] = date("d.m.Y h:i:s".GetMessage("ACRIT_EXPORTPRO_1"), time());
$time["d.m.Y_h:i:s".GetMessage("ACRIT_EXPORTPRO_2")] = date("d.m.Y h:i:s".GetMessage("ACRIT_EXPORTPRO_2"), time());
$time["Ymd"] = date("Ymd", time());
$time["Y-m-d"] = date("Y-m-d", time());
$time["YmdThis".GetMessage("ACRIT_EXPORTPRO_")] = date("YmdThis".GetMessage("ACRIT_EXPORTPRO_"), time());
$time["YmdThis".GetMessage("ACRIT_EXPORTPRO_1")] = date("YmdThis".GetMessage("ACRIT_EXPORTPRO_1"), time());
$time["Y-m-dTh:i:s".GetMessage("ACRIT_EXPORTPRO_")] = date("Y-m-dTh:i:s".GetMessage("ACRIT_EXPORTPRO_"), time());
$time["Y-m-dTh:i:s".GetMessage("ACRIT_EXPORTPRO_2")] = date("Y-m-dTh:i:s".GetMessage("ACRIT_EXPORTPRO_2"), time());
$time["YmdThis"] = date("YmdThis", time());
$time["Y-m-dTh:i:s"] = date("Y-m-dTh:i:s", time());
$time["YmdThi".GetMessage("ACRIT_EXPORTPRO_")] = date("YmdThi".GetMessage("ACRIT_EXPORTPRO_"), time());
$time["YmdThi".GetMessage("ACRIT_EXPORTPRO_1")] = date("YmdThi".GetMessage("ACRIT_EXPORTPRO_1"), time());
$time["Y-m-dTh:i".GetMessage("ACRIT_EXPORTPRO_")] = date("Y-m-dTh:i".GetMessage("ACRIT_EXPORTPRO_"), time());
$time["Y-m-dTh:i".GetMessage("ACRIT_EXPORTPRO_2")] = date("Y-m-dTh:i".GetMessage("ACRIT_EXPORTPRO_2"), time());
$time["YmdThi"] = date("YmdThi", time());
$time["Y-m-dTh:i"] = date("Y-m-dTh:i", time());

$bExportParentCategories = $arProfile["EXPORT_PARENT_CATEGORIES"] == "Y" ? 'checked="checked"' : "";
?>

<tr class="heading" align="center">
	<td colspan="2"><b><?=GetMessage('ACRIT_EXPORTPRO_SCHEME_DETAIL')?></b></td>
</tr>
<tr align="center">
	<td colspan="2">
		<?=BeginNote();?>
		<?=GetMessage('ACRIT_EXPORTPRO_SCHEME_DETAIL_DESCRIPTION');?>
		<?=EndNote();?>
	</td>
</tr>
<tr>
    <td width="50%" class="adm-detail-content-cell-l">
        <label for="PROFILE[DATEFORMAT]"><b><?=GetMessage('ACRIT_EXPORTPRO_SCHEME_DATEFORMAT')?></b></label>
    </td>
    <td width="" class="adm-detail-content-cell-r">
        <select name="PROFILE[DATEFORMAT]">
            <?foreach($time as $format => $formatTime):?>
                <? $selected = ($format == $arProfile['DATEFORMAT']) ? 'selected="selected"' : ''; ?>
                <option value="<?=$format?>" <?=$selected?>><?=$formatTime?></option>
            <?endforeach?>
        </select>
    </td>
</tr>
<tr>
    <td width="50%"><label for="PROFILE[EXPORT_PARENT_CATEGORIES]"><?=GetMessage( "ACRIT_EXPORTPRO_SCHEME_EXPORT_PARENT_CATEGORIES" );?></label></td>
    <td><input type="checkbox" name="PROFILE[EXPORT_PARENT_CATEGORIES]" value="Y" <?=$bExportParentCategories?> ></td>
</tr>
<tr class="heading">
	<td colspan="2"><?=GetMessage('ACRIT_EXPORTPRO_SCHEME_TAGS')?></td>
</tr>
<tr>
	<td align="center" colspan="2">
		<div class="adm-info-message"><?=GetMessage('ACRIT_EXPORTPRO_SCHEME_FULLDESC')?></div>
	</td>
</tr>

<tr class="heading">
	<td colspan="2"><?=GetMessage('ACRIT_EXPORTPRO_SCHEME_ALL')?></td>
</tr>
<tr align="center">
	<td colspan="2">
		<?=BeginNote();?>
		<?=GetMessage('ACRIT_EXPORTPRO_SCHEME_MAIN_DESCRIPTION')?>
		<br>
		<div id="scheme_main_add_descr">
			<?=$types[$arProfile['TYPE']]['SCHEME_DESCRIPTION']?>
		</div>
		<?=EndNote();?>
	</td>
</tr>
<tr align="center">
	<td colspan="2" id="scheme_format">
		<textarea name="PROFILE[FORMAT]" rows="5" cols="150" id="scheme_format_main"><?=$arProfile['FORMAT']?></textarea>
	</td>
</tr>


<tr class="heading">
	<td colspan="2"><?=GetMessage('ACRIT_EXPORTPRO_SCHEME_OFFER')?></td>
</tr>
<tr align="center">
	<td colspan="2">
		<?=BeginNote();?>
		<?=GetMessage('ACRIT_EXPORTPRO_SCHEME_TAGS_DESCRIPTION');?>
		<div id="scheme_main_add_offer_descr">
			<?=$types[$arProfile['TYPE']]['SCHEME_OFFER_DESCRIPTION']?>
		</div>
		<?=EndNote();?>
	</td>
</tr>

<tr>
	<td align="center" colspan="2" id="scheme_offer">
		<textarea name="PROFILE[OFFER_TEMPLATE]" rows="5" cols="150" id="scheme_offer_template"><?=htmlspecialcharsbx($arProfile['OFFER_TEMPLATE'])?></textarea>
	</td>
</tr>

<tr class="heading">
	<td colspan="2"><?=GetMessage('ACRIT_EXPORTPRO_SCHEME_CATEGORY')?></td>
</tr>
<tr align="center">
	<td colspan="2">
		<?=BeginNote();?>
		<?=GetMessage('ACRIT_EXPORTPRO_SCHEME_CATEGORY_DESCRIPTION');?>
		<?=EndNote();?>
	</td>
</tr>
<tr>
	<td align="center" colspan="2" id="scheme_category">
		<textarea name="PROFILE[CATEGORY_TEMPLATE]" rows="5" cols="150" id="scheme_category_template"><?=htmlspecialcharsbx($arProfile['CATEGORY_TEMPLATE'])?></textarea>
	</td>
</tr>

<tr class="heading">
	<td colspan="2"><?=GetMessage('ACRIT_EXPORTPRO_SCHEME_CURRENCY')?></td>
</tr>
<tr align="center">
	<td colspan="2">
		<?=BeginNote();?>
		<?=GetMessage('ACRIT_EXPORTPRO_SCHEME_CURRENCY_DESCRIPTION');?>
		<?=EndNote();?>
	</td>
</tr>
<tr>
	<td align="center" colspan="2" id="scheme_currency">
		<textarea name="PROFILE[CURRENCY_TEMPLATE]" rows="5" cols="150" id="scheme_currency_template"><?=htmlspecialcharsbx($arProfile['CURRENCY_TEMPLATE'])?></textarea>
	</td>
</tr>
