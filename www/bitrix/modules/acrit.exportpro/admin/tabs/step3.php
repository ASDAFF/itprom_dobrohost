<?php
IncludeModuleLangFile(__FILE__);

$types = $profileUtils->GetTypes();
      
$yandex_market = array(
    "ym_simple",
    "ym_vendormodel",
    "ym_book",
    "ym_audiobook",
    "ym_multimedia",
    "ym_tour",
    "ym_clothes"
);

$yandex_realty = array(
    "y_realty"
);

$yandex_webmaster = array(

);

$google = array(
    "google"
);

$wikimart = array(
	"wikimart_audiobook",
	"wikimart_book",
	"wikimart_multimedia",
	"wikimart_simple",
	"wikimart_vendormodel",
);

$tiu = array(
	"tiu_simple",
	"tiu_vendormodel"
);

$mailru = array(
	"mailru",
	"mailru_clothing"
);

$allbiz = array(
	"allbiz",
);

$activizm = array(
	"activizm"
);

$avito = array(
	"avito_general",
	"avito_room",
	"avito_apartment",
	"avito_house",
	"avito_land",
	"avito_garage",
	"avito_importreal",
	"avito_commercereal",
);

$ebay = array(
	"ebay_1",
	"ebay_2",
	"ebay_mp30",
);

$ozon = array(
	"ozon",
);

$pulscen = array(
	"pulscen",
);

$lengow = array(
    "lengow",
);


$advantshop = array(
	"advantshop",
);
?>

<tr class="heading" align="center">
	<td colspan="2">
		<b><?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE")?></b>
	</td>
</tr>

<tr>
	<td><?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_LABEL")?></td>
	<td> 
        <?//echo "<pre>"; print_r( $types ); echo "</pre>";?>
    
		<select name="PROFILE[TYPE]">
            <? $selected = $arProfile["TYPE"] == "optional" ? 'selected="selected"' : ""; ?>
            <option <?=$selected?>><?=$types["optional"]["NAME"]?></option>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_YANDEX")?>">
                <optgroup label="&nbsp;&nbsp;&nbsp;<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_YANDEX_MARKET")?>">
                    <?foreach($yandex_market as $typeCode):?>
                        <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
                        <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                    <?endforeach?>
                </optgroup>
                <optgroup label="&nbsp;&nbsp;&nbsp;<?=GetMessage( "ACRIT_EXPORTPRO_EXPORTTYPE_YANDEX_REALTY" )?>">
                    <?foreach( $yandex_realty as $typeCode ):?>
                        <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
                        <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                    <?endforeach;?>
                </optgroup>
            </optgroup>
            
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_GOOGLE")?>">
				 <?foreach($google as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_WIKIMART")?>">
				 <?foreach($wikimart as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_TIU")?>">
				 <?foreach($tiu as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_MAIL.RU")?>">
				 <?foreach($mailru as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_ALLBIZ")?>">
				 <?foreach($allbiz as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_ACTIVIZM")?>">
				 <?foreach($activizm as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_AVITO")?>">
				 <?foreach($avito as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_EBAY")?>">
				 <?foreach($ebay as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_OZON")?>">
				 <?foreach($ozon as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_PULSCEN")?>">
				 <?foreach($pulscen as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
			<optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_LENGOW")?>">
				 <?foreach($lengow as $typeCode):?>
					 <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				 <?endforeach?>
			</optgroup>
            <optgroup label="<?=GetMessage("ACRIT_EXPORTPRO_EXPORTTYPE_ADVANTSHOP")?>">
                 <?foreach( $advantshop as $typeCode ):?>
                     <? $selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : ""; ?>
                     <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                 <?endforeach?>
            </optgroup>
		</select>
	</td>
</tr>
<tr class="heading"><td colspan="2"><?=GetMessage("ACRIT_EXPORTPRO_EXPORT_EXAMPLE")?></td></tr>
<tr>
	<td colspan="2" style="background:#FDF6E3" id="description">
		<?
			if($siteEncoding[SITE_CHARSET] != "utf8")
				echo "<pre>",  htmlspecialchars($types[$arProfile["TYPE"]]["EXAMPLE"], ENT_COMPAT | ENT_HTML401, $siteEncoding[SITE_CHARSET]), "</pre>";
			else
				echo "<pre>",  htmlspecialchars($types[$arProfile["TYPE"]]["EXAMPLE"]), "</pre>";
		?>
	</td>
</tr>

