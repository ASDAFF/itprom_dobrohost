<?php
IncludeModuleLangFile( __FILE__ );

CModule::IncludeModule( "catalog" );
CModule::IncludeModule( "acrit.exportpro" );

class CAcritExportproExport{
    private $profile;
    private $dbMan;
    static $fileExport;
    static $fileExportUrl;
    static $firstStepFilename;
    private $baseDir;
    private $lockDir;

    private $siteEncoding = array(
        "utf-8" => "utf8",
        "UTF-8" => "utf8",
        "WINDOWS-1251" => "cp1251",
        "windows-1251" => "cp1251"
    );

    private $profileEncoding = array(
        "utf8" => "utf-8",
        "cp1251" => "windows-1251",
    );

    const PREPEND = 1;
    const APPEND = 0;
    const REWRITE = 2;

    public function __construct( $profileID ){
        global $exportstep;
        $this->lockDir = $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/acrit.exportpro/";
        
        $sessionData = AcritExportproSession::GetSession( $profileID );
        
        $this->dbMan = new CExportproProfileDB();
        $this->baseDir = $_SERVER["DOCUMENT_ROOT"]."/acrit.exportpro/";
        $this->profile = $this->dbMan->GetByID( $profileID );
        
        //if( is_dir( $this->profile["SETUP"]["URL_DATA_FILE"] ) )
        //    self::$fileExport = $_SERVER["DOCUMENT_ROOT"].$this->profile["SETUP"]["URL_DATA_FILE"]."export_".date( "d_m_Y_H_i" ).".xml";
        //else
        //    self::$fileExport = $_SERVER["DOCUMENT_ROOT"].$this->profile["SETUP"]["URL_DATA_FILE"];

        self::$fileExport = $_SERVER["DOCUMENT_ROOT"].$this->profile["SETUP"]["URL_DATA_FILE"];
        self::$fileExportUrl = ( ( CMain::IsHTTPS() ) ? "https://" : "http://" ).$this->profile["DOMAIN_NAME"].$this->profile["SETUP"]["URL_DATA_FILE"];
        //self::$fileExportUrl = ( ( CMain::IsHTTPS() ) ? "https://" : "http://" )."akrit.face71.tmweb.ru".$this->profile["SETUP"]["URL_DATA_FILE"];
        $this->originalName = self::$fileExport;
        if( empty( self::$fileExport ) || self::$fileExport == $_SERVER["DOCUMENT_ROOT"] ){
            if( !$exportstep || ( $exportstep == 1 ) ){
                self::$fileExport = $this->baseDir."market_".date( "d_m_Y_H_i", time() ).".xml";
                $sessionData["EXPORTPRO"]["TMP_NAME"][$this->profile["ID"]] = self::$fileExport;
            }
            else{
                self::$fileExport = $sessionData["EXPORTPRO"]["TMP_NAME"][$this->profile["ID"]];
            }
        }
        $this->dynamicDownload = false;
        
        if( strlen( strstr( self::$fileExport, $this->baseDir ) ) > 0 ){
            self::$fileExport = str_replace( $this->baseDir, $_SERVER["DOCUMENT_ROOT"]."/upload/acrit.exportpro/", self::$fileExport );
            CheckDirPath( dirname( self::$fileExport )."/" );
            $this->dynamicDownload = true;
        }
        AcritExportproSession::SetSession( $profileID, $sessionData );
    }

    public function Export( $type = "", $cronpage = 0 ){
        set_time_limit( 0 );
        global $APPLICATION, $USER, $DB, $exportstep, $end;
        
        if( !$this->profile )
            return false;
            
        if( $this->profile["ACTIVE"] != "Y" && $type == "cron" )
            return false;
        
        $cronrun = ( $type == "cron" ) || ( $type == "agent" );
        if( !$cronpage )
            $cronpage = 0;
            
        if( $cronrun ){
            $exportstep = $cronpage;
            self::$firstStepFilename = self::$fileExport;
            self::$fileExport .= ".part".$cronpage;
            if( file_exists( self::$fileExport ) )
                unlink( self::$fileExport );
        }
        AcritExportproSession::Init( $exportstep );
		
		$log = new CAcritExportproLog( $this->profile["ID"] );
        
        /*Проверка запущен ли уже процесс экспорта*/
        if( $this->isLock() && ( !$exportstep || ( $exportstep == 1 ) ) ){
            if( $_REQUEST["unlock"] == "Y" ){
                unlink( $this->lockDir."export_{$this->profile["ID"]}_run.lock" );
            }
            else{
                require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php" );
                $APPLICATION->AddHeadScript( "/bitrix/panel/main/admin-public.css" );
                if( $type != "cron" ){
                    echo '<div id="bx-admin-prefix">';
                    CAdminMessage::ShowMessage(
                        array(
                            "MESSAGE" => GetMessage( "ACRIT_EXPORTPRO_PROCESS_RUN" ),
                            "TYPE" => "FAIL",
                            "HTML" => "TRUE"
                        )
                    );
                    echo '</div>';
                }
                else{
                    $adminEmail = COption::GetOptionString( "main", "email_from" );
                    $subject = GetMessage( "ACRIT_EXOPRTPRO_PROCESS_RUN_SUBJECT" );
                    $errorMessage = GetMessage( "ACRIT_EXOPRTPRO_PROCESS_RUN_ERROE_MESSAGE" );
                    $errorMessage = str_replace( array( "#PROFILE_ID#", "#PROFILE_NAME#" ), array( $this->profile["ID"], $this->profile["NAME"] ), $errorMessage );
                    //mail($adminEmail, $subject, $errorMessage);
                }
                return false;
            }
        }

        $profileUtils = new CExportproProfile();
        
        if( CModule::IncludeModule( "catalog" ) ){
            $obCond = new CAcritExportproCatalogCond();
            CAcritExportproProps::$arIBlockFilter = $profileUtils->PrepareIBlock( $this->profile["IBLOCK_ID"], $this->profile["USE_SKU"] );
		    $obCond->Init( BT_COND_MODE_GENERATE, 0, array() );
            $this->profile["EVAL_FILTER"] = $obCond->Generate( $this->profile["CONDITION"], array( "FIELD" => '$GLOBALS["CHECK_COND"]' ) );
            $this->PrepareFieldFilter();
        }
        
        //if(!$exportstep || $exportstep == 1)
        //    if(!eval(GetMessage('ACRIT_EXPORTPRO_PROTECT')))
        //        return false;

        $elementsObj = new CAcritExportproElement( $this->profile );
        $this->Lock();

        if( !$end ){
            if( !$exportstep || $exportstep == 1 ){
                $exportstep = 1;
                if( file_exists( self::$fileExport ) )
                    unlink( self::$fileExport );
                
                AcritExportproSession::DeleteSession( $this->profile["ID"] );
            }
                
            if( $cronrun ){
                if( intval( $cronpage ) > 1 ){
                    $procResult = $elementsObj->Process( $exportstep, $cronrun, $this->profile["SETUP"]["FILE_TYPE"], self::$fileExport, $this->profile["SETUP"]["URL_DATA_FILE"] );
                    echo serialize( array( "procResult" => ( $procResult == true ) ) );
                    exit();
                }
                else{
                    $threads = new Threads();
                    
                    $tCnt = intval( $this->profile["SETUP"]["THREADS"] ) > 0 ? intval( $this->profile["SETUP"]["THREADS"] ) : 1;
                    $cronpage = 2;
                    
                    $allPages = $elementsObj->Process( 1, $cronrun, $this->profile["SETUP"]["FILE_TYPE"], self::$fileExport, $this->profile["SETUP"]["URL_DATA_FILE"] );
                    
                    $sessionData = AcritExportproSession::GetSession( $this->profile["ID"] );
                    
                    $steps = $sessionData["EXPORTPRO"]["LOG"][$this->profile["ID"]]["STEPS"];
                    $steps2 = $steps / $tCnt + ($steps % $tCnt == 0 ? 0 : 1);
                    
                    for( $i = 0; $i < $steps2; $i++ ){
                        for( $j = 0; $j < $tCnt; $j++ ){
                            if( $cronpage > $steps )
                                break;
                                
                            $threads->newThread( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/acrit.exportpro/tools/cronrun_proc.php",
                                array(
                                    "documentRoot" => $_SERVER["DOCUMENT_ROOT"],
                                    "profileId" => $this->profile["ID"],
                                    "cronPage" => $cronpage++,
                                )
                            );
                        }
                        
                        while( false !== ( $procResult = $threads->iteration() ) ){
                        }
                    }
                    $allPages = true;
                }
            }
            else{                              
                $allPages = $elementsObj->Process( $exportstep, $cronrun, $this->profile["SETUP"]["FILE_TYPE"], self::$fileExport, $this->profile["SETUP"]["URL_DATA_FILE"] );
            }
            if( !$allPages && $allPages != -1 && !$cronrun ){
                $exportstep++;
                $this->profile["LOG"] = $log->GetLog( $this->profile["ID"] );
                $this->dbMan->Update( $this->profile["ID"], $this->profile );
                echo "<script>window.location=\"", $APPLICATION->GetCurPageParam( "exportstep=$exportstep", array( "exportstep", "unlock" ) ), "\"</script>";
                die();
            }
            else{
                if( $cronrun ){
                    if( file_exists( self::$firstStepFilename ) )
                        unlink( self::$firstStepFilename );
                        
                    $dirName = dirname( self::$firstStepFilename );
                    $files = scandir( $dirName );
                    foreach( $files as $file ){
                        if( ( $file == '.' ) || ( $file == '..' ) )
                            continue;
                        
                        if( ( false !== strpos( $file, basename( self::$firstStepFilename ) ) )
                            && ( $file != basename( self::$firstStepFilename ) ) ){
                                file_put_contents( self::$firstStepFilename, file_get_contents( $dirName."/".$file ), FILE_APPEND );
                                unlink( $dirName."/".$file );
                        }
                    }
                    self::$fileExport = self::$firstStepFilename;
                }
				
				$basePatern =  "Y-m-dTh:i:s±h:i";
				$paternCharset = $this->GetStringCharset( $basePatern );
				
				if( $paternCharset == "cp1251" ){
					$basePatern = $APPLICATION->ConvertCharset( $basePatern, "cp1251", "utf8" );
				}
								
				$dateGenerate = ( $this->profile["DATEFORMAT"] == $basePatern ) ? $elementsObj->GetYandexDateTime( date( "d.m.Y H:i:s" ) ) : date( str_replace( "_", " ", $this->profile["DATEFORMAT"] ), time() );                
				
                $defaultFields = array(
                    "#ENCODING#" => $this->profileEncoding[$this->profile["ENCODING"]],
                    "#DATE#" => $this->profile["DATEFORMAT"],
                    "#SHOP_NAME#" => $this->profile["SHOPNAME"],
                    "#COMPANY_NAME#" => $this->profile["COMPANY"],
                    "#SITE_URL#" => ( ( CMain::IsHTTPS() ) ? "https://" : "http://" ).$this->profile["DOMAIN_NAME"],
                    "#DESCRIPTION#" => $this->profile["DESCRIPTION"],
                    "#CATEGORY#" => $this->GetCategoryXML( $elementsObj->GetSections() ),
                    "#CURRENCY#" => ( CModule::IncludeModule( "catalog" ) ) ? $this->GetCurrencyXML( $elementsObj->GetCurrencies() ) : "RUR",
                    "#DATE#" => $dateGenerate,
                );      
                
                $xmlHeader = explode( "#ITEMS#", $this->profile["FORMAT"] );
                $xmlHeader[0] = str_replace( array_keys( $defaultFields ), array_values( $defaultFields ), $xmlHeader[0] );
                $xmlHeader[1] = str_replace( array_keys( $defaultFields ), array_values( $defaultFields ), $xmlHeader[1] );
                                            
                self::Save( $xmlHeader[0], self::PREPEND );
                self::Save( $xmlHeader[1] );
                
                $this->ConvertEncoding();

                $this->profile["LOG"] = $log->GetLog( $this->profile["ID"] );
                $this->profile["SETUP"]["LAST_START_EXPORT"] = $this->profile["LOG"]["LAST_START_EXPORT"];
                $this->profile["TIMESTAMP_X"] = CDatabase::FormatDate( $this->profile["TIMESTAMP_X"], "YYYY-MM-DD HH:MI:SS", "DD.MM.YYYY HH:MI:SS" );
                
                $this->dbMan->Update( $this->profile["ID"], $this->profile );
                $this->Unlock();
                AcritExportproSession::DeleteSession( $this->profile["ID"] );

                if( !$cronrun )
                    LocalRedirect( str_replace( $_SERVER["DOCUMENT_ROOT"], "", $this->originalName ) );
                
                //LocalRedirect($APPLICATION->GetCurPageParam("end=Y", array("page")));
                die();
            }
        }

        /* Вывод xml файла*/
        //$APPLICATION->RestartBuffer();
        //header("Content-Type: text/xml");
        //echo $this->Get();
        //die();
        /* -- */
        //echo "<pre>", print_r($elementsObj->GetElementCount(), true), "</pre>";
    }
    private function Unlock()
    {
        if(file_exists($this->lockDir."export_{$this->profile['ID']}_run.lock"))
            unlink($this->lockDir."export_{$this->profile['ID']}_run.lock");
    }
    private function Lock()
    {
        file_put_contents($this->lockDir."export_{$this->profile['ID']}_run.lock", ''); 
    }
    public function isLock()
    {
        return file_exists($this->lockDir."export_{$this->profile['ID']}_run.lock");  
    }
    private function GetCurrencyXML($currencies)
    {
        $baseCurrency = CCurrency::GetBaseCurrency();
        $currencyRates = CExportproProfile::LoadCurrencyRates();
        $CURRENCIES = array();
        if($this->profile['CURRENCY']['CONVERT_CURRENCY'] == 'Y')
        {
            $currencyTo = array();
            foreach($currencies as $curr)
            {
                $curr2 = $this->profile['CURRENCY'][$curr]['CHECK'] == 'Y' ? $this->profile['CURRENCY'][$curr]['CONVERT_TO'] : $curr;
                $rate = $baseCurrency == $curr2;
                if($rate)
                {
                    $rate = 1;
                }
                else
                {
                    if(!key_exists($this->profile['CURRENCY'][$curr]['RATE'], $currencyRates))
                    {
                        $rate = CCurrencyRates::ConvertCurrency(1, $this->profile['CURRENCY'][$curr]['CONVERT_TO'], $baseCurrency);
                    }
                    else
                    {
                        $rate = $this->profile['CURRENCY'][$curr]['RATE'];
                    }
                }
                foreach($currencyTo as $acur)
                {
                    if($acur['CURRENCY'] == $curr2)
                        continue 2;
                }
                $currencyTo[] = array(
                    'CURRENCY' => $curr2,
                    'RATE' => $rate,
                    'PLUS' => $this->profile['CURRENCY'][$curr]['PLUS'],
                );
            }
            $currencies = $currencyTo;
            unset($currencyTo);
        }
        else
        {
            $currencyTo = array();
            foreach($currencies as $curr)
            {
                $rate = $baseCurrency == $curr;
                if($rate)
                {
                    $rate = 1;
                }
                else
                {
                    if(!key_exists($this->profile['CURRENCY'][$curr]['RATE'], $currencyRates))
                    {
                        $rate = CCurrencyRates::ConvertCurrency(1, $curr, $baseCurrency);
                    }
                    else
                    {
                        $rate = $this->profile['CURRENCY'][$curr]['RATE'];
                    }
                }
                foreach($currencyTo as $acur)
                {
                    if($acur['CURRENCY'] == $curr2)
                        continue 2;
                }
                $currencyTo[] = array(
                    'CURRENCY' => $curr,
                    'RATE' => $rate,
                    'PLUS' => $this->profile['CURRENCY'][$curr]['PLUS'],
                );
            }
            $currencies = $currencyTo;
            unset($currencyTo);
        }
        foreach($currencies as $curr)
        {
            $currencyTempalte = $this->profile['CURRENCY_TEMPLATE'];
            foreach($curr as $id => $value)
            {
                $currencyFields["#$id#"] = htmlspecialcharsbx(html_entity_decode($value));
            }
            $CURRENCIES[] = str_replace(array_keys($currencyFields), array_values($currencyFields), $currencyTempalte);
        }  
        return implode( "", $CURRENCIES );
    }
    
    private function GetCategoryXML( $sections ){
        $sections = array_filter( $sections );
        if( empty( $sections ) )
            return "";
            
        $CATEGORIES = array();
        $fields = array(
            "ID" => "ID",
            "NAME" => "NAME",
            "IBLOCK_SECTION_ID" => "PARENT_ID",
        );
        $dbSection = CIBlockSection::GetList(
            array(
                "ID" => "ASC"
            ),
            array(
                "ID" => $sections
            ),
            false,
            array(
                "ID",
                "NAME",
                "IBLOCK_SECTION_ID"
            )
        );
        while( $arSection = $dbSection->GetNext() ){
            $sectionTempalte = $this->profile["CATEGORY_TEMPLATE"];
            
            if( $this->profile["EXPORT_PARENT_CATEGORIES"] == "Y" ){
                $innerXmlCategory = simplexml_load_string( $sectionTempalte );
                if( $innerXmlCategory ){
                    $innerXmlCategory->addAttribute( "parentId", "#PARENT_ID#" );
                    $sectionInnerTempalte = str_replace( '<?xml version="1.0"?>', "", $innerXmlCategory->asXML() );
                }    
            }
                        
            foreach( $arSection as $id => $value ){
                $sectionFields["#$fields[$id]#"] = htmlspecialcharsbx( html_entity_decode( $value ) );
            }
            
            unset( $arSection );
            
            if( ( strlen( $sectionInnerTempalte ) > 0 ) && intval( $sectionFields["#PARENT_ID#"] ) > 0 ){
                $CATEGORIES[] = str_replace( array_keys( $sectionFields ), array_values( $sectionFields ), $sectionInnerTempalte );
            }
            else{
                $CATEGORIES[] = str_replace( array_keys( $sectionFields ), array_values( $sectionFields ), $sectionTempalte );
            }
        }
        
        return implode( "", $CATEGORIES );
    }
    
    private function PrepareFieldFilter(){
        $obCond = new CAcritExportproCatalogCond();
        $obCond->Init( BT_COND_MODE_GENERATE, 0, array() );

        foreach( $this->profile["XMLDATA"] as $id => $field ){
            if( empty( $field["CONDITION"]["CHILDREN"] ) ) continue;
            $this->profile["XMLDATA"][$id]["EVAL_FILTER"] = $obCond->Generate( 
                $field["CONDITION"],
                array(
                    "FIELD" => '$GLOBALS["CHECK_COND"]'
                )
            );
        }
    }

    public function Get(){
        return file_get_contents( self::$fileExport );
    }

    public static function Save( $data, $mode = self::APPEND ){
        if( !isset( self::$fileExport ) )
            return false;
                                                                
        if( $mode == self::APPEND ){
            file_put_contents( self::$fileExport, $data, FILE_APPEND );
        }
        elseif( $mode == self::PREPEND ){
            //$preData = file_get_contents( self::$fileExportUrl );
            $preData = file_get_contents( self::$fileExport );
            file_put_contents( self::$fileExport, $data );
            file_put_contents( self::$fileExport, $preData, FILE_APPEND );
            unset( $preData );
        }
        else{
            file_put_contents( self::$fileExport, $data );
        }
        return true;
    }
    
    public function printProfile(){
        echo '<pre>', print_r( $this->profile, true ), '</pre>';
    }
    
    private function ConvertEncoding(){
        if( $this->profile["ENCODING"] != $this->siteEncoding[ToLower( SITE_CHARSET )] ){
            $data = $this->Get();
            $encodingData = mb_convert_encoding( $data, $this->profile["ENCODING"], $this->siteEncoding[ToLower( SITE_CHARSET )] );
            if( !$encodingData ){
                return false;
            }
            unset( $data );
            self::Save( $encodingData, self::REWRITE );
        }
        return true;
    }
    
    private function GetStringCharset( $str ){ 
        global $APPLICATION;
        if( preg_match( "/[\xe0\xe1\xe3-\xff]/", $str ) )
            return "cp1251";
        
        $str0 = $APPLICATION->ConvertCharset( $str, "utf8", "cp1251" );
        
        if( preg_match( "/[\xe0\xe1\xe3-\xff]/", $str0, $regs ) )
            return "utf8";
        
        return "cp1251";
    }
}
