<?
$MESS["ACRIT_EXPORTPRO_NE_VYBRANO"] = "не выбрано--";
$MESS["ACRIT_EXPORTPRO_FIELDSET_FIELD"] = "Свойство или поле";
$MESS["ACRIT_EXPORTPRO_FIELDSET_CONST"] = "Постоянное значение";
$MESS["ACRIT_EXPORTPRO_FIELDSET_CONDITION_TRUE"] = "Условие выполнено";
$MESS["ACRIT_EXPORTPRO_FIELDSET_CONDITION_FALSE"] = "Условие не выполнено";
$MESS["ACRIT_EXPORTPRO_FIELDSET_CONDITION_ADD"] = "Добавить";
$MESS["ACRIT_EXPORTPRO_FIELDSET_REQUIRED"] = "Обязательное";
$MESS["ACRIT_EXPORTPRO_FIELDSET_CONDITION"] = "Условие";
$MESS["ACRIT_EXPORTPRO_FIELDSET_HEADER"] = "Настройка полей экспорта";
$MESS["ACRIT_EXPORTPRO_FIELDSET_DESCRIPTION"] = "
    <b>\"ПОЛЯ-ЭКСПОРТА\"</b> заменяются значениями. Если значение не задано или неопределено,<br>
    то тэг в выгрузке предложения будет пропущен. Если установлена галочка <b>\"обязательное\"</b> поле и тэг<br>
    не определен или пропущен, то товарное предложение будет исключено из выгрузки.<br>
    Если установлена галочка <b>\"условие\"</b>, то для каждого этого значения товарного предложения оно будет проверяться<br>.
    Если галочка <b>\"условие\"</b> установлена и блока условий нет, снимите галочку и установите снова.<br>
";
$MESS["ACRIT_EXPORTPRO_FIELDSET_DELETE_ONEMPTY"] = "Удалять тэг, если значение не установлено";
$MESS["ACRIT_EXPORTPRO_FIELDSET_URL_ENCODE"] = "URL-кодирование строки";
$MESS["ACRIT_EXPORTPRO_FIELDSET_CONVERT_CASE"] = "Изменить регистр";
$MESS["ACRIT_EXPORTPRO_FIELDSET_HTML_ENCODE"] = "Экранировать спецсимволы";
$MESS["ACRIT_EXPORTPRO_FIELDSET_HTML_TO_TXT"] = "Перевести HTML в TXT";
$MESS["ACRIT_EXPORTPRO_FIELDSET_SKIP_UNTERM_ELEMENT"] = "Пропустить некорректное предложение";


$MESS["ACRIT_EXPORTPRO_FIELDSET_REQUIRED_HELP"] = "Установка параметра означает добавление проверки на обязательность заполнения данного тега и в случае, если в элементе инфоблока будут отсутствовать значения, все элементы у которых будет отсутствовать значение, попадут в лог ошибок";
$MESS["ACRIT_EXPORTPRO_FIELDSET_CONDITION_HELP"] = "Включение условий формирования тега. Позоляет формировать нужные значения в файле экспорта в зависимости от исходных данных. Например, если у вас в свойстве элемента инфоблока присутствует значение \"студия\", а Яндекс.Недвижимость принимает только значения в цифрах, то вы, используя условия, можете переустановить значения в конечном файле, добавив условие, что если в тег попадает значение \"студия\", его надо устанавливать равным \"1\". И так же можно создавать группы условий для более сложных вариантов настройки";
$MESS["ACRIT_EXPORTPRO_FIELDSET_DELETE_ONEMPTY_HELP"] = "Установка этой опции позволит полнотью удалить даже сам тег из файла в случае, если ему устанавливается пустое значение";
$MESS["ACRIT_EXPORTPRO_FIELDSET_URL_ENCODE_HELP"] = "Установка этой опции включает механизм кодирования при передаче значений свойств элементов инфоблока для замены символов, которые используются как служебные.<br/><br/> Тут полный список кодирования:<br/> <a href=\"http://web-developer.name/urlcode/\" target=\"_blank\">http://web-developer.name/urlcode/</a>";
$MESS["ACRIT_EXPORTPRO_FIELDSET_CONVERT_CASE_HELP"] = "Установка данного флага позволяет привести все значения к нижнему регистру";
$MESS["ACRIT_EXPORTPRO_FIELDSET_HTML_ENCODE_HELP"] = "Установка данного флага позволяет экранировать все спецсимволы, передающиеся в значениях свойств элементов инфоблоков";
$MESS["ACRIT_EXPORTPRO_FIELDSET_HTML_TO_TXT_HELP"] = "Установка данного флага позволяет перевести все значениях свойств элементов инфоблоков из вида HTML к текстововму, вырезав все HTML теги из исходного кода";
$MESS["ACRIT_EXPORTPRO_FIELDSET_SKIP_UNTERM_ELEMENT_HELP"] = "Пропустить некорректное предложение";
?>