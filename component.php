<?

if ($this->StartResultCache()) // http://dev.1c-bitrix.ru/api_help/main/reference/cbitrixcomponent/startresultcache.php
{
    // Запрос данных и заполнение $arResult
    $arResult = "ID";

    // Если выполнилось какое-то условие, то кешировать
    // данные не надо
    if ($arParams["ID"] < 10)
        $this->AbortResultCache();

    // Подключить шаблон вывода
    $this->IncludeComponentTemplate();
}

?>
