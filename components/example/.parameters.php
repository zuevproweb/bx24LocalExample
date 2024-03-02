<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/*
 Создано в: PhpStorm
 Создатель: Oleg Zuev
 Телеграмм: #zuev174
 Дата: 02.03.2024
 Время: 18:53
 
 "Не волнуйтесь, если что-то не работает. Если бы всё работало, вас бы уволили."
*********************************************************************************/

// проверяем установку модуля «Информационные блоки»
if (!CModule::IncludeModule('iblock')) {
    return;
}
// получаем массив всех типов инфоблоков для возможности выбора
$arIBlockType = CIBlockParameters::GetIBlockTypes();
// пустой массив для вывода
$arInfoBlocks = array();
// выбираем активные инфоблоки
$arFilterInfoBlocks = array('ACTIVE' => 'Y');
// сортируем по озрастанию поля сортировка
$arOrderInfoBlocks = array('SORT' => 'ASC');
// если уже выбран тип инфоблока, выбираем инфоблоки только этого типа
if (!empty($arCurrentValues['IBLOCK_TYPE'])) {
    $arFilterInfoBlocks['TYPE'] = $arCurrentValues['IBLOCK_TYPE'];
}
// метод выборки информационных блоков
$rsIBlock = CIBlock::GetList($arOrderInfoBlocks, $arFilterInfoBlocks);
// перебираем и выводим в адмику доступные информационные блоки
while ($obIBlock = $rsIBlock->Fetch()) {
    $arInfoBlocks[$obIBlock['ID']] = '[' . $obIBlock['ID'] . '] ' . $obIBlock['NAME'];
}
// настройки компонента, формируем массив $arParams
$arComponentParameters = array(
    // название кастомной группы не обязательный параметр
    "GROUPS" => array(
        "TEST" => array(
            "NAME" => 'Тест'
        ),
    ),
    // основной массив с параметрами
    'PARAMETERS' => array(
        // выбор типа инфоблока
        'IBLOCK_TYPE' => array(                  // ключ массива $arParams в component.php
            'PARENT' => 'TEST',                  // название группы
            'NAME' => 'Выберите тип инфоблока',  // название параметра
            'TYPE' => 'LIST',                    // тип элемента управления, в котором будет устанавливаться параметр
            'VALUES' => $arIBlockType,           // входные значения
            'REFRESH' => 'Y',                    // перегружать настройки или нет после выбора (N/Y)
            'DEFAULT' => 'news',                 // значение по умолчанию
            'MULTIPLE' => 'N',                   // одиночное/множественное значение (N/Y)
        ),
        // выбор самого инфоблока
        'IBLOCK_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Выберите родительский инфоблок',
            'TYPE' => 'LIST',
            'VALUES' => $arInfoBlocks,
            'REFRESH' => 'Y',
            "DEFAULT" => '',
            "ADDITIONAL_VALUES" => "Y",
        ),
        // настройки кэширования
        'CACHE_TIME' => array(
            'DEFAULT' => 3600
        ),
    ),
);