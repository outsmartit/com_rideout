<?php

/* * *****************************************************************************
 * 
 * Backend component
 * 
 * @copyright Copyright(C)2014 Outsmartit.be. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * model Rideout
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modeladmin');

class rideoutModelMyride extends JModelAdmin {

    public function getTable($type = 'myrides', $prefix = 'rideoutTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getForm($data = array(), $loadData = true) {
        $options = array('control' => 'jform', 'load_data' => $loadData);
        $form = $this->loadForm('myrides', 'myride', $options);
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

    public function save($data) {
        // change date format to my sql format
        $data['eventdate'] = date("Y-m-d H:i:s", strtotime($data['eventdate']));
        if (!array_key_exists('date_registered', $data)) {
            $data['date_registered'] = date("Y-m-d H:i:s");
        }
        $return = parent::save($data);
        return $return;
    }

}
