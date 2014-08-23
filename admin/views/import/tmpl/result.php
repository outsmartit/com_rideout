<?php
/* * *****************************************************************************
 * 
 * @package     : com_rideout
 * @subpackage  : backend
 * @contact     : www.outsmartit.be
 * 
 * @copyright   : Copyright(C)2014 www.outsmartit.be. All rights reserved. 
 * @license     : GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * view to display upload result
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');

JHtml::_('behavior.keepalive');

echo "<h3>".JText::_('COM_RIDEOUT_UPLOAD_RESULTS')."</h3>";
echo $this->output;
?>
<div class="clr"></div>
