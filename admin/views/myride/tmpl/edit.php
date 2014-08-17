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
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>
<form action="<?php echo JRoute::_('index.php?option=com_rideout&id=' . (int) $this->item->id); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">
    <div class="span9 fltlft">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_RIDEOUT_DATA_SET'); ?></legend>
            <div class="adminformlist">
                <span class="span12">
                    <?php echo $this->form->renderField('title'); ?>
                    <?php echo $this->form->renderField('category_id'); ?>                              
                    <?php echo $this->form->renderField('eventdate'); ?>
                    <?php echo $this->form->renderField('eventtime'); ?>
                    <?php echo $this->form->getLabel('distance'); ?>
                    <?php echo $this->form->getInput('distance'); ?>
                    <?php echo '<span>'. $this->unit .'</span>'; ?>                  
                    <?php echo $this->form->renderField('starting_point'); ?>
                    <?php echo $this->form->renderField('description'); ?>
                </span>
            </div>
        </fieldset>
    </div>
    <div class="span3 fltrt">
        <?php echo JHtml::_('sliders.start', 'idea-data'); ?>
        <?php echo JHtml::_('sliders.panel', JText::_('COM_RIDEOUT_RIDE_DATA'), 'myride-data'); ?> 
        <fieldset class="adminform">
            <div class="adminformlist">
                <span>
                    <?php echo $this->form->renderField('submitter_id'); ?>

                </span>

            </div>
        </fieldset>
        <?php echo JHtml::_('sliders.end'); ?>
        <input type="hidden" name="task" value=""/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
<div class="clr"></div>
