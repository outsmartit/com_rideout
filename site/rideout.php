<?php
/*******************************************************************************
 * 
 * @package     : com_rideout
 * @subpackage  : frontend
 * @contact     : info@outsmartit.be
 * 
 * @copyright Copyright(C)2014 www.outsmartit.be. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');
$controller = JControllerLegacy::getInstance('rideout');
$input = JFactory::getApplication()->input;
$controller->execute($input->get('task'));
