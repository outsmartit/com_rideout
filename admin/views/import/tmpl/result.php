<?php
/* * *****************************************************************************
 * 
 * @copyright Copyright(C)2014 Outsmartit.be. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');

JHtml::_('behavior.keepalive');

echo "<h3>".JText::_('COM_RIDEOUT_UPLOAD_RESULTS')."</h3>";
echo $this->output;
?>
<div class="clr"></div>
