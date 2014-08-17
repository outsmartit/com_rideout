<?php
/**
 * @package : Rideout
 * @subpackage : frontend
 * @author : http://wwww.outsmartit.be
 * 
 * @copyright Copyright(C)2014 bul-it bvba. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * Alternarive list view
 */
defined('_JEXEC') or die;

/* Add Stylesheet from media folder */
JFactory::getDocument()->addStyleSheet(JURI::base(true) . '/media/myideas/css/myideas.css');
$user = JFactory::getUser();

 $input = JFactory::getApplication()->input;
      $menuitemid = $input->getInt( 'Itemid' );  // this returns the menu id number so you can reference parameters
       $menu = JSite::getMenu();
                if ($menuitemid) {
                   $menuparams = $menu->getParams( $menuitemid );
                   $filterstatus = $menuparams->get('statusfilter');}
$myItems = $this->getItemsByStatus($filterstatus);
/* Get Initial data format from database */
$nullDate = JFactory::getDbo()->getNullDate();
/* Sort criteria */
$listOrder = $this->escape($this->state->get('list.ordering'));
/* Sort direction */
$listDirn = $this->escape($this->state->get('list.direction'));
?>

<div class="MYIDEAS <?php echo count($myItems) ? '' : 'no-things' ?>">
    <h2><span><?php echo JText::_('COM_MYIDEAS_SLOGAN') ?></span></h2>
    <h2><?php
$link = JRoute::_("index.php?option=com_myIdeas&view=myIdea&layout=edit");
echo '<a href ="' . $link . '">' . "submit your idea !" . '</a>';
?></h2><br />
    <?php if (count($myItems)) { ?>
        <table class="things">
            <thead>
                <tr>
                    <th class="title"><?php echo JHtml::_('grid.sort', 'COM_MYIDEAS_TITLE', 'a.title', $listDirn, $listOrder) ?></th>
                    <th class="category"><?php echo JHtml::_('grid.sort', 'COM_MYIDEAS_CATEGORY', 'category', $listDirn, $listOrder) ?></th>
                    <th class="submitter"><?php echo JHtml::_('grid.sort', 'COM_MYIDEAS_SUBMITTER', 'submitter', $listDirn, $listOrder) ?></th>
                    <th class="date"><?php echo JHtml::_('grid.sort', 'COM_MYIDEAS_DATE_IN', 'date_in', $listDirn, $listOrder) ?></th>
                    <th class="status"><?php echo JHtml::_('grid.sort', 'COM_MYIDEAS_STATUS', 'status', $listDirn, $listOrder) ?></th>
                </tr>
            </thead>
            <tbody class="thing-list">
                <?php
                foreach ($myItems as $item) {
                    // addition variables
                    $link = JRoute::_("index.php?option=com_myideas&view=myidea&id=" . (int) $item->id);
                    
                    ?>
                    <tr class="thing-item">
                        <td class="title"><a href="<?php echo $link ?>"><?php echo $this->escape($item->title) ?></a></td>
                        <td class="category"><?php echo $this->escape($item->category) ?></td>
                        <td class="submitter"><?php echo $this->escape($item->submitter) ?></td>
                        <td class="date"><?php echo JHtml::_('date', $item->date_in, 'd.m.Y'); ?></td>
                        <td class="status"><?php echo $this->escape($item->status); ?></td>
                    </tr>
    <?php } ?>
            </tbody>
        </table>

        <form action="<?php echo JRoute::_('index.php?option=com_myideas&view=myideas') ?>"
              method="post" name="adminForm" id="adminForm">
            <div class="pagination"><?php echo $this->pagination->getListFooter() ?></div>
            <input type="hidden" name="layout" value="stylish" />
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="filter_order" value="<?php echo $listOrder ?>" />
            <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn ?>" />
        <?php echo JHtml::_('form.token') ?>
        </form>
<?php } ?>

</div>
