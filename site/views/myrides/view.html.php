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
 * rideout - myrides view
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class rideoutViewMyrides extends JViewLegacy {

    protected $items;
    protected $pagination;

    function display($tpl = null) {
        $app = &JFactory::getApplication();
        $input = $app->input;
        $menuitemid = $input->getInt('Itemid');  // this returns the menu id number so you can reference parameters
        $menu = JSite::getMenu();
        $parameter1 = '';
        $parameter2 = '';
        $category_bool = 0;
        $category = 0;
        if ($menuitemid) {
            $menuparams = $menu->getParams($menuitemid);
            $reach = $menuparams->get('reach'); // 
            if ($reach == 'Next') {
                $parameter1 = $menuparams->get('nr_of_events');
            } elseif ($reach == "Window") {
                $parameter1 = $menuparams->get('start');
                $parameter2 = $menuparams->get('end');
            }
            $category_bool = $menuparams->get('category_select');
            if ($category_bool != 0) {
                $category = $menuparams->get('ride_category_id');
            }
//parameter reach determines the content of the list view
        } else {
            $reach = '';
        }
        $this->anotherfirst = JLanguage::getFirstDay();
        $this->nr_of_months = JComponentHelper::getParams('com_rideout')->get('rideout_nr_of_months');
        $this->firstday = JComponentHelper::getParams('com_rideout')->get('rideout_first_weekday');
        if (($reach == "All" || $reach == '') && $category == 0) {
            $this->items = $this->get('Items');
            $this->state = $this->get('State');
            $this->pagination = $this->get('Pagination');
        } else {
            $rides_model = $this->getModel("myrides");
            $data = $rides_model->getRidesList($reach, $category, $parameter1, $parameter2);
            $this->items = $data;
            $nr_of_items = count($data);
            $this->state = $this->get('State');
        }
        parent::display($tpl);
    }

    function getRidesByMonth($month, $year) {
        $rides_model = $this->getModel("myrides");
        $data = $rides_model->getRidesByMonth($month, $year);
        return $data;
    }

}
