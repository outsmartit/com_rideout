<?php
/*******************************************************************************
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

class rideoutViewMyride extends JViewLegacy{
    protected $item;
    protected $form;
    
    public function display($tpl = null) {      
        $app = &JFactory::getApplication();
        $app->input->set('hidemainmenu',true);
        $this->unit = JComponentHelper::getParams('com_rideout')->get('rideout_unit');
        $this->form = $this->get('Form');
         $this->item = $this->get('Item');
         $this->addToolbar();
        parent::display($tpl);
    }
    protected function addToolbar(){
        if($this->item->id == 0){
            JToolBarHelper::title(JText::_('COM_RIDEOUT_NEW'));
        }else{
            JToolBarHelper::title(JText::_('COM_RIDEOUT_CHANGE'));
        }
        JToolBarHelper::apply('myride.apply','JTOOLBAR_APPLY');
        JToolBarHelper::save('myride.save','JTOOLBAR_SAVE');
        JToolBarHelper::save2copy('myride.save2copy');
        JToolBarHelper::save2new('myride.save2new');
        JToolBarHelper::cancel('myride.cancel','JTOOLBAR_CANCEL');
        
    }
}

?>
