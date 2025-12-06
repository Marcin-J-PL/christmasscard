<?php
/**
* 2007-2025 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2025 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
use PrestaShop\PrestaShop\Core\Module\WidgetInterface;

require_once __DIR__ . '/classes/Card.php';

class Christmasscard extends Module implements WidgetInterface{
    protected $templateFile;

    public function __construct()
    {
        $this->name = 'christmasscard';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'MarcinJ';
        $this->need_instance = 1;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Christmasscard');
        $this->description = $this->l('Kartka z życzeniami po wejściu na stronę główną.');
        $this->confirmUninstall = $this->l('');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->templateFile = 'module:christmasscard/views/templates/hook/christmasscard.tpl';

    }

    public function install()
    {

        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() &&
            $this->installTab() &&
            $this->registerHook('displayHeader') &&
            $this->registerHook('displayHome');
    }

    public function uninstall()
    {

        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }


    public function hookdisplayHeader($params)
    {
        $this->context->controller->registerStylesheet('modules-christmasscard', 'modules/' . $this->name . '/views/css/christmasscard.css', ['media' => 'all', 'priority' => 1500]);
        $this->context->controller->registerJavascript('modules-christmasscard', 'modules/' . $this->name . '/views/js/christmasscard.js', ['position' => 'bottom', 'priority' => 1500]);
    }


    public function renderWidget($hookName = null, array $configuration = [])
    {
            $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));

        return $this->fetch($this->templateFile);
    }

    public function getWidgetVariables($hookName = null, array $configuration = [])
    {
        return [
            'card' => Card::getCardToShow(),
        ];
    }

    public function installTab()
    {
        $designTab = Tab::getInstanceFromClassName('AdminParentThemes');

        $tab = new Tab();
        $tab->class_name = 'AdminConfigureCards';
        $tab->module = $this->name;
        $tab->active = true;
        $tab->id_parent = $designTab->id;
        $tab->name = array_fill_keys(
            Language::getIDs(false),
            $this->l('Christmass cards')
        );

        return $tab->add();
    }


}
