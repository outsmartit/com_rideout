<?php

/* * *****************************************************************************
 * 
 * @copyright Copyright(C)2012 Diederik. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * My Ideas Model
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modellist');

class rideoutModelMyrides extends JModelList {

    public function __construct($config = array()) {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array('id', 'title', 
                'distance', 'starting_point', 'eventdate', 'category', 'submitter');
        }
        parent::__construct($config);
    }

    protected function populateState($ordering = 'title', $direction = 'ASC') {
        $search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search', '', 'string');
        $this->setState('filter.search', $search);
        $categoryId = $this->getUserStateFromRequest($this->context . '.filter.category_id', 'filter_category_id', '');
        $this->setState('filter.category_id', $categoryId);
        parent::populateState($ordering, $direction);
    }

    protected function getStoreId($id = '') {
        $id.=':' . $this->getState('filter.search');
        $id .=':' . $this->getState('filter.category_id');
        return parent::getStoreId($id);
    }

    protected function getListQuery() {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select('a.*')->from('#__myrides AS a');
        $query->select('u.username AS submitter');
        $query->join('LEFT', '#__users AS u ON u.id = a.submitter_id');
        $query->select('c.title AS category');
        $query->join('LEFT', '#__categories AS c ON c.id = a.category_id');
        $categoryId = $this->getState('filter.category_id');
        if (is_numeric($categoryId)) {
            $query->where('a.category_id = ' . (int) $categoryId);
        }
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $s = $db->quote('%' . $db->escape($search, true) . '%');
            $query->where('a.title LIKE' . $s .
                    'OR a.starting_point LIKE' . $s .
                    'OR u.username LIKE' . $s);
        }
        $sort = $this->getState('list.ordering');
        $order = $this->getState('list.direction');
        $query->order($db->escape($sort) . ' ' . $db->escape($order));

        return $query;
    }

}

