<?php

/* * *****************************************************************************
 * @package    : com_rideout
 * @subpackage : backend
 * @contact    : www.outsmartit.be
 * 
 * @copyright Copyright(C)2014 www.outsmartit.be. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * view MyRides
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class rideoutViewMyrides extends JViewLegacy {

    protected $items;

    public function display($tpl = null) {
        $app = &JFactory::getApplication();
        $this->unit = JComponentHelper::getParams('com_rideout')->get('rideout_unit');
        $this->addToolbar();
        $this->items = $this->get('Items');
        $this->state = $this->get('State');
        $this->pagination = $this->get('Pagination');
        parent::display($tpl);
    }

    protected function addToolbar() {
        JToolBarHelper::title(JText::_('COM_RIDEOUT_ADMIN'));
        JToolBarHelper::addNew('myride.add', 'JTOOLBAR_NEW');
        JToolBarHelper::editList('myride.edit', 'JTOOLBAR_EDIT');
        JToolBarHelper::deleteList('', 'myrides.delete', 'JTOOLBAR_DELETE');
        JToolBarHelper::preferences('com_rideout');
        JToolBarHelper::custom('myrides.import_csv', 'upload.png', 'upload_f2.png', 'COM_RIDEOUT_RIDES_IMPORT', false);
    }

}
