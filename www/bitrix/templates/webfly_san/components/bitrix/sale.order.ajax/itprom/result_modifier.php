<?php
/**
 * Created by PhpStorm.
 * User: shara
 * Date: 04.03.2016
 * Time: 5:07
 */

foreach ($arResult["GRID"]["ROWS"] as $k => $arData) {
    if (strlen($arData["data"]["PREVIEW_PICTURE_SRC"]) > 0):
        $url = $arData["data"]["PREVIEW_PICTURE_SRC"];
    elseif (strlen($arData["data"]["DETAIL_PICTURE_SRC"]) > 0):
        $url = $arData["data"]["DETAIL_PICTURE_SRC"];
    else:
        $url = $templateFolder."/images/no_photo.png";
    endif;
    $arFileTmp = CFile::ResizeImageGet(
        $url,
        array("width" => "110", "height" =>"110"),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true
    );
    $arData["data"]['PICTURE_SRC']=$arFileTmp['src'];
}