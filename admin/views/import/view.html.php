<?php

/* * *****************************************************************************
 * @package : rideout
 * @subpackage: backend
 * @single view 
 * 
 * @copyright Copyright(C)2012 Diederik. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

JLoader::import('joomla.application.component.view');

class rideoutViewImport extends JViewLegacy {

    protected $item;
    protected $form;

    public function display($tpl = null) {
        $app = &JFactory::getApplication();
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar() {
        JToolBarHelper::title(JText::_('COM_RIDEOUT_IMPORT_DATA'));
    }

}

?>
