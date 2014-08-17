<?php
/*******************************************************************************
 * 
 * 
 * @package : com_rideout
 * @subpackage : backend main file
 * 
 * @author : http://www.outsmartit.be
 * 
 * @copyright Copyright(C)2013 bul-it bvba. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

$controller = JControllerLegacy::getInstance('rideout');

$input = JFactory::getApplication()->input;
$controller->execute($input->get('task'));
$controller->redirect();
?>
