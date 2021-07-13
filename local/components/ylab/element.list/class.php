<?php

namespace YLab\Components;

use Bitrix\Catalog\StoreTable;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\LoaderException;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use Bitrix\Main\UI\PageNavigation;
use Bitrix\Main\UI\Filter\Options as FilterOptions;
use CBitrixComponent;
use CIBlockElement;
use Exception;

/**
 * Class ElementListComponent
 * @package YLab\Components
 * Компонент отображения списка элементов нашего ИБ
 */
class ElementListComponent extends CBitrixComponent
{
    /** @var int $idIBlock ID информационого блока */
    private $idIBlock;

    /**
     * Метод executeComponent
     *
     * @return mixed|void
     * @throws ArgumentException
     * @throws LoaderException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function executeComponent()
    {
        $this->idIBlock = self::getIBlockIdByCode('lesson2');

//       $this->arResult['ITEMS'] = $this->getElements();

        $this->showByGrid();

        $this->includeComponentTemplate();
    }

    /**
     * Получим элементы ИБ
     * @return array
     */
    public function getElements(): array
    {
        $result = [];

        //Формируем массив для сортировки
        $arOrder = $this->getGridSort();

        //Формируем массив для фильтра
        $arFilter = $this->getArrFilter();

        //Навигация
        $arNav = $this->getArrNav();

        $elements = CIBlockElement::GetList(
            $arOrder,
            $arFilter,
            false,
            $arNav,
            ['ID', 'IBLOCK_ID', 'PROPERTY_TITLE', 'PROPERTY_PRICE', 'PROPERTY_PERCENT', 'PROPERTY_STATUS']
        );

        while ($element = $elements->GetNext()) {
            $total = round(((int)$element['PROPERTY_PRICE_VALUE'] * (int)$element['PROPERTY_PERCENT_VALUE']) / 100 +(int)$element['PROPERTY_PRICE_VALUE']);

            $result[] = [
                'ID' => $element['ID'],
                'TITLE' => $element['PROPERTY_TITLE_VALUE'],
                'PRICE' => $element['PROPERTY_PRICE_VALUE'],
                'PERCENT' => $element['PROPERTY_PERCENT_VALUE'],
                'TOTAL' => $total,
                'STATUS' => $element['PROPERTY_STATUS_VALUE'],
            ];
        }

        return $result;
    }

    /**
     * Отображение через грид
     */
    public function showByGrid()
    {
        $this->arResult['GRID_ID'] = $this->getGridId();
        $this->arResult['GRID_NAV'] = $this->getGridNav();
        $this->arResult['GRID_BODY'] = $this->getGridBody();
        $this->arResult['GRID_HEAD'] = $this->getGridHead();
        $this->arResult['GRID_FILTER'] = $this->getGridFilter();

        $this->arResult['BUTTONS']['ADD']['NAME'] = Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.ADD');
    }

    /**
     * Возвращает содержимое (тело) таблицы.
     *
     * @return array
     */
    private function getGridBody(): array
    {
        $arBody = [];

        $arItems = $this->getElements();

        foreach ($arItems as $arItem) {
            $arGridElement = [];

            $arGridElement['data'] = [
                'ID' => $arItem['ID'],
                'TITLE' => $arItem['TITLE'],
                'PRICE' => $arItem['PRICE'],
                'PERCENT' => !empty($arItem['PERCENT']) ? $arItem['PERCENT'] : '',
                'TOTAL' => !empty($arItem['TOTAL']) ? $arItem['TOTAL'] : '',
                'STATUS' => !empty($arItem['STATUS']) ? $arItem['STATUS'] : '',
            ];
            //$arGridElement['action'] = ....
            $arBody[] = $arGridElement;
        }
        return $arBody;
    }

    /**
     * Возвращает массив arFilter для подстановки в GetList.
     *
     * @return array
     */
    public function getArrFilter()
    {
        $filterOptions = new FilterOptions($this->getGridId() . '_filter');
        $filterFields = $filterOptions->getFilter([]);
        foreach ( $filterFields as $key => $value) {
            $filter[$key] = $value;
        }
        $arFilter = [
            'IBLOCK_ID' => $this->idIBlock,
            '>=PROPERTY_PRICE' => $filter['PRICE_from'],
            '<=PROPERTY_PRICE' => $filter['PRICE_to'],
            '>=PROPERTY_PERCENT' => $filter['PERCENT_from'],
            '<=PROPERTY_PERCENT' => $filter['PERCENT_to'],
            'PROPERTY_STATUS_VALUE' => $filter['STATUS'],
        ];
        return $arFilter;
    }

    /**
     * Возвращает массив arOrder для подстановки в GetList.
     *
     * @return array
     */
    public function getGridSort()
    {
        $gridSort = $this->getObGridParams()->getSorting();

        foreach ($gridSort['sort'] as $key => $value) {
            $item = $key;
        }

        if ($gridSort['sort'][$item] && $item != 'ID')
        {
            $arOrder = [
                'PROPERTY_' . $item => $gridSort['sort'][$item],
            ];
        } else {
            $arOrder = [
                'ID' => $gridSort['sort']['ID'],
            ];
        }
        return $arOrder;
    }

    /**
     * Параметры навигации грида
     *
     * @return PageNavigation
     */
    private function getGridNav(): PageNavigation
    {
        if ($this->gridNav === null) {
            $this->gridNav = new PageNavigation($this->getGridId());

            $this->gridNav
                ->allowAllRecords(true)
                ->setPageSize($this->getObGridParams()->GetNavParams()['nPageSize'])
                ->setRecordCount(count($this->getElements()))
                ->initFromUri();

//            var_dump($this->gridNav);
        }
        return $this->gridNav;
    }

    /**
     * Возвращает массив arNavStartParams для подстановки в GetList.
     *
     * @return array
     */
    private function getArrNav()
    {
        $nPageSize = $this->getObGridParams()->GetNavParams()['nPageSize'];
        $arNav = [
            'nPageSize' => $nPageSize,
        ];
        return  $arNav;
    }

    /**
     * Возвращает идентификатор грида.
     *
     * @return string
     */
    private function getGridId(): string
    {
        return 'ylab_elements_list_' . $this->idIBlock;
    }

    /**
     * Возвращает единственный экземпляр настроек грида.
     *
     * @return GridOptions
     */
    private function getObGridParams(): GridOptions
    {
        return $this->gridOption ?? $this->gridOption = new GridOptions($this->getGridId());
    }

    /**
     * Возвращает массив полей фильтра для подстановки в шаблон.
     *
     * @return array
     */
    private function getGridFilter(): array
    {
        return [
                [
                    'id' => 'PRICE',
                    'name' => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.PRICE'),
                    'type' => 'number'
                ],
                [
                    'id' => 'PERCENT',
                    'name' => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.PERCENT'),
                    'type' => 'number'
                ],
                [
                    'id' => 'STATUS',
                    'name' => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.STATUS'),
                    'type' => 'list',
                    'items' =>
                        [
                            Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.STATUS.IN_WORK') => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.STATUS.IN_WORK'),
                            Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.STATUS.DONE') => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.STATUS.DONE')
                        ]
                ]
        ];
    }

    /**
     * Возращает заголовки таблицы.
     *
     * @return array
     */
    private function getGridHead(): array
    {
        return [
            [
                'id' => 'ID',
                'name' => 'ID',
                'sort' => 'ID',
                'default' => true,
            ],
            [
                'id' => 'TITLE',
                'name' => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.TITLE'),
                'sort' => 'TITLE',
                'default' => true,
            ],
            [
                'id' => 'PRICE',
                'name' => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.PRICE'),
                'sort' => 'PRICE',
                'default' => true,
            ],
            [
                'id' => 'PERCENT',
                'name' => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.PERCENT'),
                'sort' => 'PERCENT',
                'default' => true,
            ],
            [
                'id' => 'TOTAL',
                'name' => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.TOTAL'),
                'default' => true,
            ],
            [
                'id' => 'STATUS',
                'name' => Loc::getMessage('YLAB.ELEMENT.LIST.CLASS.STATUS'),
                'sort' => 'STATUS',
                'default' => true,
            ],
        ];
    }

    /**
     * Метод возвращает ID инфоблока по символьному коду
     *
     * @param $code
     *
     * @return int|void
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public static function getIBlockIdByCode($code)
    {
        $IB = IblockTable::getList([
            'select' => ['ID'],
            'filter' => ['CODE' => $code],
            'limit' => '1',
            'cache' => ['ttl' => 3600],
        ]);
        $return = $IB->fetch();
        if (!$return) {
            throw new Exception('IBlock with code"' . $code . '" not found');
        }
        return $return['ID'];
    }
}
