<?php
/* * *****************************************************************************
 * 
 * * @package : rideout
 * @subpackage : frontend 
 * @author : http://wwww.outsmartit.be
 * 
 * @copyright Copyright(C)2014 bul-it bvba. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class rideoutViewMyride extends JViewLegacy {

    protected $item;

    function display($tpl = null) {
        $unit = JComponentHelper::getParams('com_rideout')->get('rideout_unit');
        $item = $this->get('Item');
        $nullDate = JFactory::getDbo()->getNullDate();
        echo '<h5>'; 
        $link = JRoute::_("index.php?option=com_rideout&view=myride&id=" . $item->id);

        if ($item->eventdate != $nullDate) {
            echo JHtml::_('date', $item->eventdate, 'd.m.Y') ;
        }
        echo ' '. $item->title . '</h5>';
        echo $item->starting_point .' : ';
        echo $item->distance.' '.$unit;
        echo '<br/><a href ="' . $link . '"> Details</a>';
    }

}
