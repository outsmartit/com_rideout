<?php
/* * *****************************************************************************
 * 
 * @package : rideout
 * @subpackage : frontend 
 * @author : http://wwww.outsmartit.be
 * 
 * @copyright Copyright(C)2013 bul-it bvba. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * List view myRides
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
$nullDate = JFactory::getDbo()->getNullDate();

$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
?>
<h1><?php echo JText::_('COM_RIDEOUT_LIST_TITLE'); ?></h1>

<br />
<?php if ($this->items) { ?>

    <table style="margin: 0 auto">
        <tr>
            <th style="background:#ccc;" width="200">
    <?php echo JHtml::_('grid.sort', 'COM_RIDEOUT_TITLE', 'title', $listDirn, $listOrder); ?>
            </th>
            <th style="background:#ccc;" width="85">
    <?php echo JHtml::_('grid.sort', 'COM_RIDEOUT_DISTANCE', 'distance', $listDirn, $listOrder); ?>
            </th>
            <th style="background:#ccc;" width="135">
    <?php echo JHtml::_('grid.sort', 'COM_RIDEOUT_STARTINGPOINT', 'starting_point', $listDirn, $listOrder); ?>
            </th>
            <th style="background:#ccc;" width="135">
    <?php echo JHtml::_('grid.sort', 'COM_RIDEOUT_EVENTDATE', 'eventdate', $listDirn, $listOrder); ?>
            </th>
        </tr>
    <?php foreach ($this->items as $item) : ?>
            <tr>
                <td>
                    <?php
                    $link = JRoute::_("index.php?option=com_rideout&view=myride&id=" . $item->id);
                    echo '<a href ="' . $link . '">' . $item->title . '</a>';
                    ?>
                </td>
                <td> <?php echo $item->distance.' km'; ?></td>
                <td> <?php echo $item->starting_point ; ?></td>
                <td class="text-center"><?php if ($item->eventdate != $nullDate) {
                echo JHtml::_('date', $this->escape($item->eventdate), 'd.m.Y');
            }
            ?></td>
            </tr>
    <?php endforeach; ?>

    </table><br/>
    <form action="<?php echo JRoute::_('index.php?option=com_rideout&view=myrides'); ?>"
          method="post" name="adminForm" id="adminForm">
        <?php echo $this->pagination->getListFooter(); ?>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="option" value="com_rideout" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
    <?php echo JHtml::_('form.token'); ?>
    </form>

<?php } ?>