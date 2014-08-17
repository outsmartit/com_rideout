<?php
/*******************************************************************************
 * 
 * @package : rideout
 * @subpackage : backend
 * 
 * @copyright Copyright(C)2012 Diederik. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * main controller
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class rideoutController extends JControllerLegacy {
    
    protected $default_view='myrides';
    
    public function display($cachable = false, $urlparams = false) {
        $input = JFactory::getApplication()->input;
        $view = $input->get('view', $this->default_view);
        $layout = $input->get('layout','default');
        $id = $input->get('id');
        if ($view == 'myride' && $layout == 'edit'){
            if(!$this->checkEditId('com_rideout.edit.myride', $id)){
                $this->setRedirect(JRoute::_('index.php?option=com_rideout&view=myrides',false));
                return false; }
        }
        parent::display($cachable, $urlparams);
    }
 
}


