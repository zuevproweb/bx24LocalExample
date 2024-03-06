<?php
/*
 Создано в: PhpStorm
 Создатель: Oleg Zuev
 Телеграмм: #zuev174
 Дата: 24.02.2024
 Время: 9:39
 
 "Не волнуйтесь, если что-то не работает. Если бы всё работало, вас бы уволили."
*********************************************************************************/


use Bitrix\Main\Diag\Debug;
use Bitrix\Mail\Helper\Message;
use Bitrix\Main\Entity\Event;
use Bitrix\Main\Page\Asset;

if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/vendor/autoload.php")) {
    require_once ($_SERVER["DOCUMENT_ROOT"] . "/local/vendor/autoload.php");
}
Kint::$enabled_mode = true;
Kint\Renderer\RichRenderer::$theme = 'solarized.css';

spl_autoload_register(function ($sClassName) {
    $sClassFile = __DIR__ . '/classes';

    if (file_exists($sClassFile . '/' . str_replace('\\', '/', $sClassName) . '.php')) {
        require_once $sClassFile . '/' . str_replace('\\', '/', $sClassName) . '.php';
        return;
    }

    $arClass = explode('\\', strtolower($sClassName));
    foreach ($arClass as $sPath) {
        $sClassFile .= '/' . ucfirst($sPath);
    }
    $sClassFile .= '.php';
    if (file_exists($sClassFile)) {
        require_once $sClassFile;
    }
});
