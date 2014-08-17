<?php

/* * *****************************************************************************
 * 
 * @package : rideout
 * @subpackage : frontend
 * @author : http://wwww.outsmartit.be
 * 
 * @copyright Copyright(C)2012 bul-it bvba. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * MyIdea Model
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.modelform');

class rideoutModelMyride extends JModelForm {

    public function getItem() {
        $inp = JFactory::getApplication()->input;
        $requested_id = $inp->get('id', 0, 'int');
        if ($requested_id > 0) {
            $db = $this->getDbo();
            $query = $db->getQuery(true);
            $query->from('#__myrides AS a');
            $query->select('a.*');
            $query->select('c.title AS category');
            $query->join('LEFT', '#__categories AS c ON c.id = a.category_id');
            $query->where('a.id = ' . $requested_id);
            $db->setQuery($query);
            $result = $db->loadObject();
        }
        return $result;
        //        parent::getListQuery();
    }

    public function getItemById($id = "") {
        if ($id > 0) {
            $db = $this->getDbo();
            $query = $db->getQuery(true);
            $query->from('#__myrides AS a');
            $query->select('a.*');
            $query->select('c.title AS category');
            $query->join('LEFT', '#__categories AS c ON c.id = a.category_id');
            $query->where('a.id = ' . $id);
            $db->setQuery($query);
            $result = $db->loadObject();
            return $result;
        }else{
            return;
        }
        
    }

    public function getForm($data = array(), $loadData = true) {
        $options = array('control' => 'jform', 'load_data' => $loadData);
        $form = $this->loadForm('rideout', 'myride', $options);
        if (empty($form)) {
            return false;
        }
        return $form;
    }

    protected function loadFormData() {
        $app = JFactory::getApplication();
        $data = $app->getUserState('com_rideout.edit.myride.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }

}
