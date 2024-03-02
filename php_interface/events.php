<?php
use Bitrix\Main\Diag\Debug;
use Bitrix\Mail\Helper\Message;
use \Bitrix\Main\Entity\Event;
use Bitrix\Main\Page\Asset;
/**
 * This file contains a full list of custom event handlers
 * Code the handlers need NOT be contained in this file.
 * It needs to be made relevant to the PSR-[0-4] structure, classes
 */

$eventManager = \Bitrix\Main\EventManager::getInstance();

/**
 * For new core of bitrix use
 *     $eventManager->addEventHandler( #module#, #handler#, [#namespace#, #function#]);
 *
 * For old core of bitrix use
 *     $eventManager->addEventHandlerCompatible( #module#, #handler#, [#namespace#, #function#]);
 */


/**
 * Перечень событий
 * https://dev.1c-bitrix.ru/api_help/main/events/index.php
 */
//example for task full ( /company/personal/user/1/tasks/task/view/2/ , /workgroups/group/7/tasks/task/view/5/?pgpg=1111&111=333 )
AddEventHandler('main', 'OnProlog', function(){
    $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
    $curUri = parse_url($request->getRequestUri());
    $curUri = $curUri['path'];
    $wantedPath = '/crm/type/175/details/';
    $pos = strpos($curUri, $wantedPath);
    if($pos!==false){

        Asset::getInstance()->addJs('/local/js/script.js');
    }
});


/* End of file. Do not past code after this line! */
unset($eventManager);
