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
class AdminConfigureCardsController extends ModuleAdminController
{

    public $bootstrap = true;

    public function __construct()
    {
        $this->table = 'christmasscard_card';
        $this->className = 'Card';
        $this->addRowAction('edit');
        $this->addRowAction('delete');

        parent::__construct();

        $this->fields_list = [
            'id_christmasscard_card' => [
                'title' => $this->trans('ID', [], 'Admin.Global'),
                'align' => 'center',
                'class' => 'fixed-width-xs',
            ],
            'name' => [
                'title' => $this->trans('Name', [], 'Admin.Global'),
            ],
            'active' => [
                'title' => $this->trans('Enabled', [], 'Admin.Global'),
                'active' => 'status',
                'type' => 'bool',
                'orderby' => false,
            ],   
        ];

        $this->bulk_actions = [
            'delete' => [
                'text' => $this->trans('Delete selected', [], 'Admin.Actions'),
                'icon' => 'icon-trash',
                'confirm' => $this->trans('Delete selected items?', [], 'Admin.Notifications.Warning'),
            ],
        ];
    }


    public function renderForm()
    {
        $obj = $this->loadObject(true);
        if (!$obj) {
            return '';
        }

        $this->fields_form = [
            'legend' => [
                'title' => $this->trans('Kartka świąteczna', [], 'Admin.Shopparameters.Feature'),
                'icon' => 'icon-tag',
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->trans('Name', [], 'Admin.Global'),
                    'name' => 'name',
                    'required' => true,
                ],
                [
                    'type' => 'textarea',
                    'label' => $this->trans('Kartka', [], 'Admin.Global'),
                    'name' => 'content',
                    'class' => 'rte',
                    'autoload_rte' => true,
                ],
                [
                    'type' => 'switch',
                    'label' => $this->trans('Włączona', [], 'Admin.Global'),
                    'desc' => $this->trans('Właczone kartki są losowane do pokazania na stronie głównej', [], 'Modules.Categoryproducts.Admin'),
                    'name' => 'active',
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->trans('Enabled', [], 'Admin.Global'),
                        ],
                        [
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->trans('Disabled', [], 'Admin.Global'),
                        ],
                    ],
                ],
            ],
            'submit' => [
                'title' => $this->trans('Save', [], 'Admin.Actions'),
            ],
        ];

        return parent::renderForm();
    }

}
