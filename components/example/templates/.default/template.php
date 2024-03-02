<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/*
 Создано в: PhpStorm
 Создатель: Oleg Zuev
 Телеграмм: #zuev174
 Дата: 02.03.2024
 Время: 18:56
 
 "Не волнуйтесь, если что-то не работает. Если бы всё работало, вас бы уволили."
*********************************************************************************/
?>
<section>
    <div class="container product_slider">
        <div class="swiper mySwiper4">
            <div class="swiper-wrapper">
                <? foreach ($arResult as $arElement) : ?>
                    <?
                    // ссылки для экшенов и название кнопки
                    $arButtons = CIBlock::GetPanelButtons(
                    // идентификатор инфоблока, которому принадлежит элемент
                        $arElement["IBLOCK_ID"],
                        // идентификатор текущего элемента информационного блока
                        $arElement["ID"],
                        // идентификатор раздела инфоблока (при наличии)
                        0,
                        // массив, содержащий локализацию названий
                        array("SECTION_BUTTONS" => false, "SESSID" => false)
                    );
                    // экшен изменения элемента
                    $this->AddEditAction(
                    // идентификатор текущего элемента информационного блока
                        $arElement["ID"],
                        // ссылка из $arButtons на изменение эллемента
                        $arButtons["edit"]["edit_element"]["ACTION_URL"],
                        // название кнопки
                        $arButtons["edit"]["edit_element"]["TEXT"]
                    );
                    // экшен добавления элемента
                    $this->AddEditAction(
                    // идентификатор текущего элемента информационного блока
                        $arElement["ID"],
                        // ссылка из $arButtons на изменение эллемента
                        $arButtons["edit"]["add_element"]["ACTION_URL"],
                        // название кнопки
                        $arButtons["edit"]["add_element"]["TEXT"]
                    );
                    // экшен удаления элемента
                    $this->AddDeleteAction(
                    // идентификатор текущего элемента информационного блока
                        $arElement["ID"],
                        // ссылка из $arButtons на изменение эллемента
                        $arButtons["edit"]["delete_element"]["ACTION_URL"],
                        // название кнопки
                        $arButtons["edit"]["delete_element"]["TEXT"],
                        array("CONFIRM" => "Удалить?")
                    ); ?>
                    <?
                    // проверка на администратора для вывода экшенов
                    if ($USER->IsAdmin() && $APPLICATION->GetShowIncludeAreas()) {
                        echo '<div class="swiper-slide" id="' . $this->GetEditAreaId($arElement["ID"]) . '">';
                    } else {
                        echo '<div class="swiper-slide">';
                    }
                    ?>
                    <div class="product">
                        <div class="item">
                            <div class="row">
                                <div class="col-8 title"><?= $arElement["PROPERTY_ID_2_ZAGOLOVOK_VALUE"] ?></div>
                                <div class="col-4 image"><img src="<?= "/local/templates/hmarketing/img/svg/icons/" . preg_replace('#[a-z]{3,4}$#', 'svg', $arElement["PREVIEW_PICTURE"]["ORIGINAL_NAME"], 1) ?>" alt="<?= $arElement["PREVIEW_PICTURE"]["DESCRIPTION"] ?>" width="40" height="40"></div>
                                <div class="col-12 tekst"><?= $arElement["PROPERTY_ID_2_TEXT_VALUE"] ?></div>
                                <div class="col-12 button">Узнать больше<span class="icon-arrow-right"></div>
                            </div>
                        </div>
                        <div class="hover swiper-lazy" data-background="<?= $arElement["PROPERTY_ID_2_KARTINKA_VALUE"]["SRC"] ?>">
                            <div class="row">
                                <div class="col-12 title"><?= $arElement["PROPERTY_ID_2_ZAGOLOVOKHOVER_VALUE"] ?></div>
                                <div class="col-12 tekst"><?= $arElement["PROPERTY_ID_2_TEXTHOVER_VALUE"] ?></div>
                                <div class="col-12 button"><a href="<?= $arElement["PROPERTY_ID_2_HREF_VALUE"] ?>">Жми подробнее... <span class="icon-arrow-right"></span></a></div>
                            </div>
                        </div>
                    </div>
                    <? echo '</div>'; ?>
                <? endforeach ?>
            </div>
            <div class="slider-nav">
                <div class="swiper-prev"></div>
                <div class="swiper-indicators"></div>
                <div class="swiper-next"></div>
            </div>
        </div>
</section>
