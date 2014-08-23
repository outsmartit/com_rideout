<?php

/* * *****************************************************************************
 * 
 * @package     : com_rideout
 * @subpackage  : frontend
 * @contact     : http://www.outsmartit.be
 * 
 * @copyright Copyright(C)2014 www.outsmartit.be . All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * Controller 
 * 
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controllerform');

class rideoutControllerMyride extends JControllerForm {

    public function getTable($type = 'Myrides', $prefix = 'rideoutTable', $config = array()) {
        /* Table class from backend */
        JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/tables');
        /* make an instance */
        return JTable::getInstance($type, $prefix, $config);
    }
 
}

