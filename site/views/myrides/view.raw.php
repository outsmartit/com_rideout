<?php

/* * *****************************************************************************
 * 
 * @package : com_rideout
 * @subpackage : front end
 * @author : http://www.outsmartit.be
 * 
 * @copyright Copyright(C)2014 www.outsmartit.be. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * rideout - myrides raw view
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class rideoutViewMyrides extends JViewLegacy {

    protected $items;

    function display($tpl = null) {
        $inp = &JFactory::getApplication()->input;
        $requested_date = $inp->get('id', 0, 'int');
        $results = $this->getRidesByDate($requested_date);
        foreach ($results as $result) {
                $link = JRoute::_("index.php?option=com_rideout&view=myride&id=" . $result->id);
                echo $result->title . " : " . $result->eventdate . '<a href ="' . $link . '"> Details</a><br/>';
        }   
    }

    function getRidesByDate($ridedate) {
        $rides_model = $this->getModel("myrides");
        $data = $rides_model->getRidesByDate($ridedate);
        return $data;
    }

}
