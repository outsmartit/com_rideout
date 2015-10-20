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
 * MyRides controller
 */
//no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controlleradmin');

class rideoutControllerMyrides extends JControllerAdmin {

    public function getModel($name = 'myride', $prefix = 'rideoutModel', $config = array()) {
        $config['ignore_request'] = true;
        $model = parent::getModel($name, $prefix, $config);
        return $model;
    }

    public function import_csv() {
        $view = $this->getView('import', 'html');
        $view->display();
    }

    public function uploadcsv() {
        $output=null;
        $sequence = array('title', 'starting_point', 'eventdate', 'distance', 'category_id', '');
        jimport('joomla.filesystem.file');
        //       $ridesmodel = $this->getModel();
//       adding enctype to form allows to use the getVar
        $upfile = JRequest::getVar('import_file', '', 'files', 'array');
        if ($upfile['name']) {
            $upfile['name'] = JFile::makeSafe($upfile['name']);
            //tmp_name includes the path
            $file_data = file_get_contents($upfile['tmp_name']);
            $your_array = explode("\n", $file_data);

            foreach ($your_array as $gegeven) {
                $ridesmodel = $this->getModel();
                $second_array = explode(";", $gegeven);
                $i = 0;
                $data = array();
                foreach ($second_array as $myfieldname) {
                    if ($sequence[$i] == 'category_id' AND $sequence[$i]) {
                        $myfieldname = $this->getCategorieId($myfieldname);
                    }
                    $data[$sequence[$i]] = $myfieldname;
                    $i++;
                }
                $resultsave = $ridesmodel->save($data);
                $output .= $data['title']." : ";
                if ($resultsave==1){
                     $output = $output. "ok";
                } else {
                    $output = $output. "error while saving";
                }
                
                $output = $output. "<br />";
            }
        } else {
           $output = JText::_('COM_RIDEOUT_UPLOAD_NO_FILE_FOUND');
        }
         $view = $this->getView('import', 'html');
         $view->setLayout('result');
         $view->output = $output;
         $view->display();
    }

    public function getCategorieId($title = "") {
        $kat = '';
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id');
        $query->from('#__categories');
        $query->where("extension='com_rideout' AND title =" . $db->quote($title));
        $db->setQuery($query);
        $results = $db->loadObjectList();
        if ($results) {
            $kat = $results[0]->id;
        }
        return $kat;
    }

}
