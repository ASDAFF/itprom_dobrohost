<?
IncludeModuleLangFile(__FILE__);

Class acrit_exportpro extends CModule
{
    const MODULE_ID = 'acrit.exportpro';
    var $MODULE_ID = "acrit.exportpro";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    private $siteArray = array();

    private $siteEncoding = array(
        'utf-8' => 'utf8',
        'UTF-8' => 'utf8',
        'WINDOWS-1251' => 'cp1251',
        'windows-1251' => 'cp1251',
    );

    function acrit_exportpro()
    {
        require(__DIR__.'/version.php');

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }
        $this->MODULE_NAME = GetMessage('ACRIT_EXPORTPRO_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('ACRIT_EXPORTPRO_MODULE_DESC');
        $this->PARTNER_NAME = GetMessage("ACRIT_EXPORTPRO_PARTNER_NAME");
        $this->PARTNER_URI = GetMessage("ACRIT_EXPORTPRO_PARTNER_URI");
        
        $app = \Bitrix\Main\Application::getInstance();
        $dbSite = \Bitrix\Main\SiteTable::getList();
        while($arSite = $dbSite->Fetch())
        {
            if(!$arSite['DOC_ROOT'])
                $this->siteArray[$arSite['LID']] = $app->getDocumentRoot().$arSite['DIR'];
            else
                $this->siteArray[$arSite['LID']] = $arSite['DOC_ROOT'];
            $this->siteArray[$arSite['LID']] = \Bitrix\Main\IO\Path::normalize($this->siteArray[$arSite['LID']]);
        }
        
    }
    function InstallEvents(){
        //RegisterModuleDependences('catalog', "OnCondCatControlBuildList", self::MODULE_ID, "CAcritExportproCond", "GetControlDescr", 300);
        RegisterModuleDependences('main', 'OnBuildGlobalMenu', self::MODULE_ID , 'CAcritExportproMenu', 'OnBuildGlobalMenu');
        return true;
    }

    function UnInstallEvents(){
        //UnRegisterModuleDependences('catalog', "OnCondCatControlBuildList", self::MODULE_ID, "CAcritExportproCond", "GetControlDescr");
        UnRegisterModuleDependences('main', "OnBuildGlobalMenu", self::MODULE_ID, "CAcritExportproMenu", "OnBuildGlobalMenu");
        return true;
    }
    function InstallDB($arParams = array())
    {
        global $DB, $DBType, $APPLICATION;
        $this->errors = false;
        $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/install.sql");
        if($this->errors !== false){
            $APPLICATION->ThrowException(implode("<br>", $this->errors));
            return false;
        }
        //if($this->siteEncoding[strtoupper(SITE_CHARSET)] != 'cp1251')
        //{
        //    $marketData = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/market.sql");
        //    $marketDataUTF8 = mb_convert_encoding($marketData, 'utf8', 'cp1251');
        //    $marketData = file_put_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/market.sql", $marketDataUTF8);
        //
        //    $marketData = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/market_ebay.sql");
        //    $marketDataUTF8 = mb_convert_encoding($marketData, 'utf8', 'cp1251');
        //    $marketData = file_put_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/market_ebay.sql", $marketDataUTF8);
        //    unset($marketData, $marketDataUTF8);
        //}
        //if(!$DB->Query('SELECT * FROM acrit_exportpro_market LIMIT 1', true))
        //{
        //    $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/market.sql");
        //    if($this->errors !== false){
        //        $APPLICATION->ThrowException(implode("<br>", $this->errors));
        //        return false;
        //    }
        //}
        //if(!$DB->Query('SELECT * FROM acrit_exportpro_market_ebay LIMIT 1', true))
        //{
        //    $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/market_ebay.sql");
        //    if($this->errors !== false){
        //        $APPLICATION->ThrowException(implode("<br>", $this->errors));
        //        return false;
        //    }
        //}
        return true;
    }
    function UninstallDB($arParams = array()){
        global $DB, $DBType, $APPLICATION;
        $this->errors = false;
        if(!array_key_exists("save_tables", $arParams) || ($arParams["save_tables"] != "Y")){
            $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/db/uninstall.sql");
        }
        return true;
    }
    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION, $DB, $DBType, $step, $install;
        if ($APPLICATION->GetGroupRight('main') < 'W'){
            return;
        }
        $licenceDB = $DB->Query("SELECT * FROM b_option WHERE `MODULE_ID`='{$this->MODULE_ID}' AND `NAME`='~bsm_stop_date'");
        if($licenceDB->Fetch())
        {
            $DB->Query("DELETE FROM b_option WHERE `MODULE_ID`='{$this->MODULE_ID}' AND `NAME`='~bsm_stop_date'");
        }

        if(!isset($step) || $step < 1)
        {
            $APPLICATION->IncludeAdminFile(GetMessage('ACRIT_EXPORTPRO_RECOMMENDED'), $DOCUMENT_ROOT."/bitrix/modules/{$this->MODULE_ID}/install/step.php");
        }
        elseif($step == 3 && $install == 'Y')
        {
            $this->InstallFiles();
            $this->InstallDB();
            RegisterModule(self::MODULE_ID);
            $this->InstallEvents();
            $urlRewriter = new CUrlRewriter;
            foreach($this->siteArray as $siteID => $siteDir)
            {
                $urlRewriter->Add(array(
                    'SITE_ID' => $siteID,
                    'CONDITION' => '#^/acrit.exportpro/(.*)#',
                    'PATH' => '/acrit.exportpro/index.php',
                    'RULE' => 'path=$1',
                ));
            }
            $APPLICATION->IncludeAdminFile(GetMessage('MOD_INST_OK'), $DOCUMENT_ROOT."/bitrix/modules/{$this->MODULE_ID}/install/step3.php");
        }
        elseif($step == 2)
        {
            CheckDirPath(__DIR__.'/db/category');
            CopyDirFiles(__DIR__.'/db/', __DIR__.'/db/category');
            $APPLICATION->IncludeAdminFile(GetMessage('MOD_INST_OK'), $DOCUMENT_ROOT."/bitrix/modules/{$this->MODULE_ID}/install/step2.php");
        }
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION, $DB, $DBType;
        if ($APPLICATION->GetGroupRight('main') < 'W'){
            return;
        }

        if ($_REQUEST['step'] < 2){
            global $moduleID;
            $moduleID = $this->MODULE_ID;
            $APPLICATION->IncludeAdminFile(GetMessage('MOD_UNINST_OK'), $DOCUMENT_ROOT."/bitrix/modules/{$this->MODULE_ID}/install/unstep.php");
        }
        elseif ($_REQUEST['step'] == 2){
            global $APPLICATION;
            $this->UnInstallEvents();
            UnRegisterModule(self::MODULE_ID);
            $this->UnInstallFiles();
            if ($_REQUEST['savedata'] != 'Y'){
                $this->UnInstallDB();
            }
            $DB->Query("DELETE FROM b_option WHERE `MODULE_ID`='{$this->MODULE_ID}' AND `NAME`='~bsm_stop_date'");
            $APPLICATION->IncludeAdminFile(GetMessage('MOD_UNINST_OK'), $DOCUMENT_ROOT."/bitrix/modules/{$this->MODULE_ID}/install/unstep2.php");
        }
    }

    function InstallFiles($arParams = array()){
        global $DB, $DBType, $APPLICATION;
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin')){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == '..' || $item == '.' || $item == 'menu.php'){
                        continue;
                    }
                    file_put_contents($file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/acrit_exportpro_'.$item,
                        '<'.'? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.self::MODULE_ID.'/admin/'.$item.'");?'.'>');
                }
                closedir($dir);
            }
        }
        if($_ENV["COMPUTERNAME"] != 'BX'){
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/components', $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/image', $_SERVER['DOCUMENT_ROOT'].'/bitrix/images', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/js', $_SERVER['DOCUMENT_ROOT'].'/bitrix/js', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/themes', $_SERVER['DOCUMENT_ROOT'].'/bitrix/themes', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/tools', $_SERVER['DOCUMENT_ROOT'].'/bitrix/tools', true, true);
            CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/panel', $_SERVER['DOCUMENT_ROOT'].'/bitrix/panel', true, true);
            //			CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/public/acrit_exportpro', $_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/catalog_export', true, true);
            foreach($this->siteArray as $sireDir)
                CopyDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/public', $sireDir, true, true);
        }
        return true;
    }
    function UnInstallFiles(){
        global $DB, $DBType, $APPLICATION;
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin')){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == '..' || $item == '.'){
                        continue;
                    }
                    if( file_exists( $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item ) ){
                        unlink( $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/'.self::MODULE_ID.'_'.$item );    
                    }
                }
                closedir($dir);
            }
        }
        if (is_dir($p = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install/components')){
            if ($dir = opendir($p)){
                while (false !== $item = readdir($dir)){
                    if ($item == '..' || $item == '.' || !is_dir($p0 = $p.'/'.$item)){
                        continue;
                    }

                    $dir0 = opendir($p0);
                    while (false !== $item0 = readdir($dir0)){
                        if ($item0 == '..' || $item0 == '.'){
                            continue;
                        }

                        DeleteDirFilesEx('/bitrix/components/'.$item.'/'.$item0);
                    }
                    closedir($dir0);
                }
                closedir($dir);
            }
        }
        if($_ENV["COMPUTERNAME"] != 'BX'){
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/components', $_SERVER['DOCUMENT_ROOT'].'/bitrix/components/');
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/image', $_SERVER['DOCUMENT_ROOT'].'/bitrix/images');
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/js', $_SERVER['DOCUMENT_ROOT'].'/bitrix/js');
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/tools', $_SERVER['DOCUMENT_ROOT'].'/bitrix/tools');
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/themes', $_SERVER['DOCUMENT_ROOT'].'/bitrix/themes');
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/panel', $_SERVER['DOCUMENT_ROOT'].'/bitrix/panel');
            DeleteDirFiles($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$this->MODULE_ID.'/install/public/acrit_exportpro', $_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/catalog_export');
            DeleteDirFilesEx('/upload/acrit_exportpro/');
        }
        return true;
    }
}