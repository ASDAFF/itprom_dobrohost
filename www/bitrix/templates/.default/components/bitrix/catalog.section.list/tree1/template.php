<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$strTitle = "";
?>
<script src='js/common.js'></script>
<link rel="stylesheet" href="css/style.css">
<?
//["UF_BROWSER_TITLE"]
?>
    <ul class="catalog-termo">
        <?
        foreach ($arResult["SECTIONS"] as $arSection)
        {
            ?>
                <li>
                    <div class="shkaf-div">
                        <a href="#" title="<?=$arSection["UF_BROWSER_TITLE"]?>"></a>
                        <a href="#" class="quest-about">Подробное описание</a>
                        <div style="display: none;" class="discription">
                            <?=$arSection["UF_DESCR_TEMPLATE"]?>
                        </div>
                    </div>
                </li>
            <?
        }
        ?>
    </ul>
<?= ($strTitle ? '<br/><h2>' . $strTitle . '</h2>' : '') ?>
