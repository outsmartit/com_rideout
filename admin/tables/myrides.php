<?php
/*******************************************************************************
 * 
 * @package     : com_rideout
 * @subpackage  : backend
 * @contact     : www.outsmartit.be
 * 
 * @copyright   : Copyright(C)2014 www.outsmartit.be. All rights reserved. 
 * @license     : GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * table definition
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

class rideoutTableMyrides extends JTable
{
    public $id;
    public $title;
    public $description;
    public $submitter_id;
    public $category_id;
    public $status;
    public $distance;
    public $starting_point;
    public $eventdate;
    public $date_registered;



    public function __construct(&$db) {
        parent::__construct('#__myrides', 'id', $db);
    }
}


