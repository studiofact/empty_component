<? // Подробное описание параметров тут: http://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=2132&LESSON_PATH=3913.4565.2132
CModule::IncludeModule("iblock");

$dbIBlockType = CIBlockType::GetList(
	array("sort" => "asc"),
	array("ACTIVE" => "Y")
);
while ($arIBlockType = $dbIBlockType->Fetch())
{
	if ($arIBlockTypeLang = CIBlockType::GetByIDLang($arIBlockType["ID"], LANGUAGE_ID))
		$arIblockType[$arIBlockType["ID"]] = "[".$arIBlockType["ID"]."] ".$arIBlockTypeLang["NAME"];
}

$arComponentParameters = array(
	/*"код группы" => array(
		"NAME" => "название группы на текущем языке"
		"SORT" => "сортировка",
	)*/
	"GROUPS" => array(
		"SETTINGS" => array(
			"NAME" => GetMessage("SETTINGS_GROUP")
		),
		"PARAMS" => array(
			"NAME" => GetMessage("PARAMS_GROUP")
		),
	),

	/*"код параметра" => array(
		"PARENT" => "код группы",  // если нет - ставится ADDITIONAL_SETTINGS
		"NAME" => "название параметра на текущем языке",

		"TYPE" => "тип элемента управления, в котором будет устанавливаться параметр",
			Возможные значения TYPE:
			LIST - выбор из списка значений. Для типа LIST ключ VALUES содержит массив значений следующего вида:
				VALUES => array(
				   "ID или код, сохраняемый в настройках компонента" => "языкозависимое описание",
				),
			STRING - текстовое поле ввода.
			CHECKBOX - да/нет.
			CUSTOM - позволяет создавать кастомные элементы управления.

		"REFRESH" => "перегружать настройки или нет после выбора (N/Y)",
		"MULTIPLE" => "одиночное/множественное значение (N/Y)",
		"VALUES" => "массив значений для списка (TYPE = LIST)",
		"ADDITIONAL_VALUES" => "показывать поле для значений, вводимых вручную (Y/N)",
		"SIZE" => "число строк для списка (если нужен не выпадающий список)",
		"DEFAULT" => "значение по умолчанию",
		"COLS" => "ширина поля в символах",
	),*/
	"PARAMETERS" => array(
		"IBLOCK_TYPE_ID" => array(
			"PARENT" => "SETTINGS",
			"NAME" => GetMessage("INFOBLOCK_TYPE_PHR"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIblockType,
			"REFRESH" => "Y"
		),
		"BASKET_PAGE_TEMPLATE" => array(
			"PARENT" => "PARAMS",
			"NAME" => GetMessage("BASKET_LINK_PHR"),
			"TYPE" => "STRING",
			"MULTIPLE" => "N",
			"DEFAULT" => "/personal/basket.php",
			"COLS" => 25
		),
		"SET_TITLE" => array(),
		"CACHE_TIME" => array(),
		"VARIABLE_ALIASES" => array(
			"IBLOCK_ID" => array(
				"NAME" => GetMessage("CATALOG_ID_VARIABLE_PHR"),
			),
			"SECTION_ID" => array(
				"NAME" => GetMessage("SECTION_ID_VARIABLE_PHR"),
			),
		),
		"SEF_MODE" => array(
			"list" => array(
				"NAME" => GetMessage("CATALOG_LIST_PATH_TEMPLATE_PHR"),
				"DEFAULT" => "index.php",
				"VARIABLES" => array()
			),
			"section1" => array(
				"NAME" => GetMessage("SECTION_LIST_PATH_TEMPLATE_PHR"),
				"DEFAULT" => "#IBLOCK_ID#",
				"VARIABLES" => array("IBLOCK_ID")
			),
			"section2" => array(
				"NAME" => GetMessage("SUB_SECTION_LIST_PATH_TEMPLATE_PHR"),
				"DEFAULT" => "#IBLOCK_ID#/#SECTION_ID#",
				"VARIABLES" => array("IBLOCK_ID", "SECTION_ID")
			),
		),
		"COLOR" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("PARAM_NAME_COLOR_PICKER"),
			"TYPE" => "COLORPICKER",
			"DEFAULT" => 'FFFF00'
		),
	)
);
?>