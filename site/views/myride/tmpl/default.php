<?php
/*******************************************************************************
 *  
 * @package : com_rideout
 * @subpackage : frontend
 * @author : http://wwww.outsmartit.be
 * 
 * @copyright Copyright(C)2014 www.outsmartit.be. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * MyRide view
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');

$item = $this->item;
$nullDate = JFactory::getDbo()->getNullDate();

?>
<h1>

<?php echo $item->title; ?></h1>
<br/>

<?php echo JText::_('COM_RIDEOUT_DESCRIPTION')." : ".$item->description; ?> <br/>
<?php echo JText::_('COM_RIDEOUT_STARTINGPOINT')." : ".$item->starting_point; ?> <br />
<?php echo JText::_('COM_RIDEOUT_CATEGORY')." : ".$item->category; ?> <br/>
<?php echo JText::_('COM_RIDEOUT_DISTANCE')." : ".$item->distance .' '. $this->unit; ?> <br/>
<?php echo JText::_('COM_RIDEOUT_EVENTDATE')." : "; 
     if ($item->eventdate != $nullDate) {
       echo JHtml::_('date', $this->escape($item->eventdate), 'd.m.Y');} ?> <br/>


    

