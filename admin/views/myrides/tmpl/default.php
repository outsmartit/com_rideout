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
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
$nullDate = JFactory::getDbo()->getNullDate();
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
?>
<form action ="<?php echo JRoute::_('index.php?option=com_rideout&view=myrides') ?>" method="post" 
      name="adminForm" id="adminForm">
    <fieldset id="filter-bar">
        <div clas="filter-search fltft">
            <label class="filter-search-lbl">
                <?php echo JText::_('JSEARCH_FILTER_LABEL'); ?>
            </label>
            <input type="text"
                   name="filter_search"
                   id="filter_search"
                   value ="<?php echo $this->escape($this->state->get('filter.search')); ?>" />
            <button type="submit">
                <?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>
            </button>
            <button type="button"
                    onclick="document.id('filter_search').value='';
                        this.form.submit(); ">
                        <?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>
            </button>

        </div>
    </fieldset>
    <div class="clr"></div>
    <table class="adminlist">
        <thead>
            <tr>
                <th class="span1">
                    <input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" />
                </th>
                <th class="span3">
                    <?php echo JHtml::_('grid.sort', 'COM_RIDEOUT_TITLE', 'title', $listDirn, $listOrder); ?></th>
                <th class="span1">
                    <?php echo JHtml::_('grid.sort', 'COM_RIDEOUT_DISTANCE', 'distance', $listDirn, $listOrder); ?>
                </th> 
                <th class="span2">
                    <?php echo JHtml::_('grid.sort', 'COM_RIDEOUT_CAT', 'category', $listDirn, $listOrder); ?>
        <p><select name="filter_category_id" class="inputbox" onchange="this.form.submit()">
                <option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY'); ?></option>
                <?php echo JHtml::_('select.options', JHtml::_('category.options', 'com_rideout'), 'value', 'text', $this->state->get('filter.category_id'));
                ?>
            </select> </p>
        </th>
        <th class="span2">
            <?php echo JHtml::_('grid.sort', 'COM_RIDEOUT_STARTING_POINT', 'starting_point', $listDirn, $listOrder); ?></th>
        <th class="span2">
            <?php echo JHtml::_('grid.sort', 'COM_RIDEOUT_EVENTDATE', 'eventdate', $listDirn, $listOrder); ?></th>
        </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="7">
                    <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>

            <?php foreach ($this->items as $i => $item) :
                ?>
                <tr class="row<?php echo $i % 2; ?>">
                    <td class="center">
                        <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                    </td>
                    <td>
                        <?php
                        $mylink = JRoute::_("index.php?option=com_rideout&task=myride.edit&id=$item->id");
                        echo '<a href="' . $mylink . '">' . $this->escape($item->title) . '</a>'
                        ?>
                    </td>

                    <td class="center"><?php echo $this->escape($item->distance); echo ' '.$this->unit ?></td>
                    <td class="center"><?php echo $this->escape($item->category); ?></td>
                    <td><?php echo $this->escape($item->starting_point); ?></td>
                    <td class="center"><?php
                    if ($item->eventdate != $nullDate) {
                        echo JHtml::_('date', $item->eventdate, 'd.m.Y');
                    }
                        ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <div>
        <input type="hidden" name ="task" value =" " />
        <input type="hidden" name ="boxchecked" value ="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
