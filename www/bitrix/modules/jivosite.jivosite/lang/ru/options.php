<?
$sites_aviable = CSite::GetList($by="sort", $order="desc", Array());
$sites = "";
$sites_enabled = json_decode(COption::GetOptionString("jivosite.jivosite", "sites"));

while ($site = $sites_aviable->fetch())
{

    $sites .= '<input '.(array_key_exists($site['ID'],$sites_enabled ) ? "checked='checked'" : "").' class="adm-designed-checkbox-label" type="checkbox" name="sites['.$site['ID'].']" />
                   <label>'.$site['NAME'].' ('.$site['SERVER_NAME'].')</label><br/>';
}

$MESS ['GOTO_ADMIN'] = 'Перейти в личный кабинет';

$MESS ['SETUP_AIR'] = "
		<h3>Установка приложения для операторов</h3>
		<p style='width: 500px'>
			Эти приложения позволяют вам и вашим операторам общаться с посетителями сайта.<br>
		</p>
		<form action='http://jivosite.com/apps' target='_blank'>
            <input type='submit' value='Скачать приложение для оператора'>
        </form>

        <h3>Выберите сайты, на которых будет отображаться чат</h3>
        <form method='post'>
            ".$sites."
            <br/>
            <input type='submit' name='set_sites' value='Сохранить настройки'>
        </form>

		<h3>Техподдержка</h3>
		<p style='width: 500px'>
		    Если вам нужна помощь - пожалуйста, напишите нам на <a href='mailto:info@jivosite.ru'>info@jivosite.ru</a><br>или <a href='http://jivosite.copiny.com/' target='_blank'>задайте вопрос на форуме</a>
		</p>
	";
?>