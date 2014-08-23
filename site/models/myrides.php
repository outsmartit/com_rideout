<?php

/* * *****************************************************************************
 * 
 * @package : com_rideout
 * @subpackage : frontend
 * @author : http://wwww.outsmartit.be
 * 
 * @copyright Copyright(C)2014 www.outsmartit.be. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * model MyRides
 * 
 * 
 */
//no direct access
//defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

class rideoutModelMyrides extends JModelList {

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array('id', 'title', 'distance', 'starting_point', 'eventdate');
        }
        parent::__construct($config);
    }

    protected function populateState($ordering = 'eventdate', $direction = 'ASC') {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search', '', 'string');
        $this->setState('filter.search', $search);
        parent::populateState($ordering, $direction);
    }

    protected function getStoreId($id = '') {
        $id.=':' . $this->getState('filter.search');
        return parent::getStoreId($id);
    }

    protected function getListQuery() {
        $month = false;
        $db = $this->getDbo();
        $today = $db->quote(date("Y-m-d"));
        $query = $db->getQuery(true);
        $query->from('#__myrides AS a');
        $query->select('a.*');
        $query->select('u.username AS submitter');
        $query->join('LEFT', '#__users AS u ON u.id = a.submitter_id');
        $query->select('c.title AS category');
        $query->join('LEFT', '#__categories AS c ON c.id = a.category_id');
        $sort = $this->getState('list.ordering');
        $order = $this->getState('list.direction');
        $query->order($db->escape($sort) . ' ' . $db->escape($order));
        if ($month) {
            $query->where($db->quoteName("a.eventdate") . " >= " . $today);
        }
        return $query;
    }

    public function getRidesByMonth($month, $year) {
        $cleanresults = array();
        $db = $this->getDbo();
        $firstday = $db->quote(date("Y-m-d", mktime(0, 0, 0, $month, 1, $year)));
        $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
        $lastday = $db->quote(date("Y-m-d", mktime(0, 0, 0, $month, $days_in_month, $year)));
        $query = $db->getQuery(true);
        $query->from('#__myrides AS a');
        $query->select('a.eventdate');
        $query->order("a.eventdate");
        if ($month) {
            $query->where($db->quoteName("a.eventdate") . " >= " . $firstday . " AND " .
                    $db->quoteName("a.eventdate") . ' <= ' . $lastday);
        }
        $db->setQuery($query);
        $results = $db->loadObjectList();
        foreach ($results as $result) {
            $a_date = date("Ymd", strtotime($result->eventdate));
            array_push($cleanresults, $a_date);
        }
        $cleanedresults = array_unique($cleanresults);
        return $cleanedresults;
    }

    public function getRidesByDate($pdate) {
        $db = $this->getDbo();
        $firstday = $db->quote(date("Y-m-d", strtotime($pdate)));
        $lastday = $db->quote(date("Y-m-d", strtotime($pdate . '+1 day')));
        $query = $db->getQuery(true);
        $query->from('#__myrides AS a');
        $query->select('a.*');
        $query->order("a.eventdate");
        if ($pdate) {
            $query->where($db->quoteName("a.eventdate") . " >= " . $firstday . " AND " .
                    $db->quoteName("a.eventdate") . ' <= ' . $lastday);
        }
        $db->setQuery($query);
        $results = $db->loadObjectList();
        return $results;
    }

    public function getRidesList($reach, $category_id, $parameter1, $parameter2) {
        $db = $this->getDbo();
        //set start & end date
        if ($reach == "Current") {
            $startdate = $db->quote(date("Y-m-d", mktime(0, 0, 0, 1, 1, date('Y')))); //&st day of current year
            $enddate = $db->quote(date("Y-m-d", mktime(0, 0, 0, 12, 31, date('Y')))); //last day of curent year
        } elseif ($reach == "Window") {
            $startdate = $db->quote(date("Y-m-d", strtotime("-" . $parameter1 . " month")));
            $enddate = $db->quote(date("Y-m-d", strtotime("+" . $parameter2 . " month")));
        }
        $today = $db->quote(date("Y-m-d"));
        $query = $db->getQuery(true);
        $query->from('#__myrides AS a');
        $query->select('a.*');
        $query->select('u.username AS submitter');
        $query->join('LEFT', '#__users AS u ON u.id = a.submitter_id');
        $query->select('c.title AS category');
        $query->join('LEFT', '#__categories AS c ON c.id = a.category_id');
        $sort = $this->getState('list.ordering');
        $order = $this->getState('list.direction');
        $query->order($db->escape($sort) . ' ' . $db->escape($order));
        if ($reach == 'Upcoming' || $reach == "Next") {
            $query->where($db->quoteName("a.eventdate") . " >= " . $today);
        }
        if ($reach == 'Window' || $reach == 'Current') {
            $query->where($db->quoteName("a.eventdate") . " >= " . $startdate . "AND" .
                    $db->quoteName("a.eventdate") . " <= " . $enddate);
        }
        if ($category_id) {
            $query->where($db->quoteName("a.category_id") . " = " . $category_id);
        }
        if ($reach != 'Next') {
            $db->setQuery($query);
        } else {
            $db->setQuery($query, 0, $parameter1);
        }
//        $mydata = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        $results = $db->loadObjectList();
        return $results;
    }

}
