<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */
class Card extends ObjectModel
{
    /** @var int ID */
    public $id_christmasscard_card;
    public $name;
    public $content;
    public $date_add;
    public $active;


    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'christmasscard_card',
        'primary' => 'id_christmasscard_card',
        'fields' => [
            'active' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool'],
            'date_add' => ['type' => self::TYPE_DATE, 'required' => true],
            'name' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'required' => true, 'size' => 32],
            'content' => ['type' => self::TYPE_HTML, 'validate' => 'isCleanHtml'],
        ],
    ];


    public static function getCardToShow()
    {
        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('christmasscard_card');
        $sql->where('active = 1');
        $sql->where('id_christmasscard_card >= FLOOR(RAND() * (SELECT MAX(id_christmasscard_card) FROM ' . _DB_PREFIX_ . 'christmasscard_card))');

        return Db::getInstance()->getRow($sql);

    }

}
