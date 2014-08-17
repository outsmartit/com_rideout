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
?>
<form action="<?php echo JRoute::_('index.php') ?>"
      method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">
          <?php
          echo '<input type="hidden" name="option" value="com_rideout" />';
          echo '<input type="hidden" name="task" id="task" value="myrides.uploadcsv" />';
          echo '<input type="hidden" name="controller" value="myrides" />';
          ?>
    <div class="span9 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_RIDEOUT_IMPORT_DATA'); ?></legend>
            <div class="adminformlist">
                <?php
                echo '<br />';
                echo '<input type="file" size="200" name="import_file" id="import_file" />';
                echo '';
                echo ' <button class="rp_button">' . JText::_('COM_RIDEOUT_UPLOAD') . '</button>';
                echo '<br />';
                ?>
            </div>
        </fieldset>
    </div>
    <div class="span3 fltrt">
        
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
<div class="clr"></div>
