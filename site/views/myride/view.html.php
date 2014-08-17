<?php

/* * *****************************************************************************
 * 
 * * @package : rideout
 * @subpackage : frontend 
 * @author : http://wwww.outsmartit.be
 * 
 * @copyright Copyright(C)2014 bul-it bvba. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class rideoutViewMyride extends JViewLegacy {

    protected $item;

    function display($tpl = null) {
        $this->unit = JComponentHelper::getParams('com_rideout')->get('rideout_unit');
        $this->item = $this->get('Item');
        $this->form = $this->get('Form');
        parent::display($tpl);
    }

}
