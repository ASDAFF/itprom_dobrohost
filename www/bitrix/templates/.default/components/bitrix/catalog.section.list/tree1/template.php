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
?>

<?
    $APPLICATION->SetAdditionalCSS($this->GetFolder().'/css/style.css');
    $APPLICATION->SetAdditionalCSS($this->GetFolder().'/css/bootstrap.css');
    $APPLICATION->AddHeadScript($this->GetFolder().'/js/common.js');
?>


<ul class="catalog-termo">
    <?
//    var_dump($arResult['SECTIONS']);
    foreach ($arResult["SECTIONS"] as $arSection)
    {
        ?>
        <li>
            <div class="shkaf-div">
                <a href="<?=$arSection["SECTION_PAGE_URL"]?>" title="<?= $arSection["UF_BROWSER_TITLE"] ?>">
                    <p>
                        <span>
                            <?
                                if(empty($arSection["UF_SECT_SERIES_NAME"]))
                                    echo $arSection["NAME"];
                                else echo$arSection["UF_SECT_SERIES_NAME"];
                            ?>
                        </span>
                    </p>
                    <img src="<?=$arSection['PICTURE']['SRC']?>" alt="">
                    <p>
                        <?
                            $text = $arSection["UF_SECT_CHARACTER"];
                            $lines = explode('|', $text);
                            echo $lines[0].'<br/>';
                            echo $lines[1];
                        ?>
                    </p>
                </a>
                <a href="#" class="quest-about">Подробное описание</a>
                <div style="display: none;" class="discription">
                    <p><?= $arSection["UF_SECT_DESCRIPTION"] ?></p>
                </div>
            </div>
        </li>
        <?
    }
    ?>
</ul>
<style>
    .shkaf-div a
    {
        text-decoration: none;
    }
</style>