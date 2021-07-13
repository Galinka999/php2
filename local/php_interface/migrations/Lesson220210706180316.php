<?php

namespace Sprint\Migration;

/**
 * Class Lesson220210706180316
 * @package Sprint\Migration
 *
 * Добавим поля Цена, Наценка и Статус
 */
class Lesson220210706180316 extends Version
{
    /** @var string $description */
    protected $description = "Добавим поля Цена, Наценка и Статус";

    /** @var string $moduleVersion */
    protected $moduleVersion = "3.28.8";

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function up()
    {
        $helper = $this->getHelperManager();

        $iblockId = $helper->Iblock()->getIblockIdIfExists('lesson2', 'lesson1');

        $helper->Iblock()->saveProperty($iblockId, array(
            'NAME' => 'Цена',
            'ACTIVE' => 'Y',
            'SORT' => '500',
            'CODE' => 'PRICE',
            'DEFAULT_VALUE' => '',
            'PROPERTY_TYPE' => 'N',
            'ROW_COUNT' => '1',
            'COL_COUNT' => '30',
            'LIST_TYPE' => 'L',
            'MULTIPLE' => 'N',
            'XML_ID' => null,
            'FILE_TYPE' => '',
            'MULTIPLE_CNT' => '5',
            'LINK_IBLOCK_ID' => '0',
            'WITH_DESCRIPTION' => 'N',
            'SEARCHABLE' => 'N',
            'FILTRABLE' => 'N',
            'IS_REQUIRED' => 'N',
            'VERSION' => '2',
            'USER_TYPE' => null,
            'USER_TYPE_SETTINGS' => null,
            'HINT' => '',
        ));

        $helper->Iblock()->saveProperty($iblockId, array(
            'NAME' => 'Наценка %',
            'ACTIVE' => 'Y',
            'SORT' => '500',
            'CODE' => 'PERCENT',
            'DEFAULT_VALUE' => '',
            'PROPERTY_TYPE' => 'N',
            'ROW_COUNT' => '1',
            'COL_COUNT' => '30',
            'LIST_TYPE' => 'L',
            'MULTIPLE' => 'N',
            'XML_ID' => null,
            'FILE_TYPE' => '',
            'MULTIPLE_CNT' => '5',
            'LINK_IBLOCK_ID' => '0',
            'WITH_DESCRIPTION' => 'N',
            'SEARCHABLE' => 'N',
            'FILTRABLE' => 'N',
            'IS_REQUIRED' => 'N',
            'VERSION' => '2',
            'USER_TYPE' => null,
            'USER_TYPE_SETTINGS' => null,
            'HINT' => '',
        ));

        $helper->Iblock()->saveProperty($iblockId, array(
            'NAME' => 'Статус',
            'ACTIVE' => 'Y',
            'SORT' => '500',
            'CODE' => 'STATUS',
            'DEFAULT_VALUE' => '',
            'PROPERTY_TYPE' => 'L',
            'ROW_COUNT' => '1',
            'COL_COUNT' => '30',
            'LIST_TYPE' => 'L',
            'MULTIPLE' => 'N',
            'XML_ID' => null,
            'FILE_TYPE' => '',
            'MULTIPLE_CNT' => '5',
            'LINK_IBLOCK_ID' => '0',
            'WITH_DESCRIPTION' => 'N',
            'SEARCHABLE' => 'N',
            'FILTRABLE' => 'N',
            'IS_REQUIRED' => 'N',
            'VERSION' => '2',
            'USER_TYPE' => null,
            'USER_TYPE_SETTINGS' => null,
            'HINT' => '',
            'VALUES' =>
                array(
                    0 =>
                        array(
                            'VALUE' => 'В работе',
                            'DEF' => 'N',
                            'SORT' => '500',
                            'XML_ID' => 'in_work',
                        ),
                    1 =>
                        array(
                            'VALUE' => 'Готово',
                            'DEF' => 'N',
                            'SORT' => '500',
                            'XML_ID' => 'done',
                        ),
                ),
        ));
    }

    /**
     * @return bool|void
     * @throws Exceptions\HelperException
     */
    public function down()
    {
        $helper = $this->getHelperManager();

        $iblockId = $helper->Iblock()->getIblockIdIfExists('lesson2', 'lesson1');

        $helper->Iblock()->deletePropertyIfExists($iblockId, 'PRICE');
        $helper->Iblock()->deletePropertyIfExists($iblockId, 'PERCENT');
        $helper->Iblock()->deletePropertyIfExists($iblockId, 'STATUS');
    }
}
