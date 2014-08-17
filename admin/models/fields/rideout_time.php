<?php

/* * *****************************************************************************
 * 
 * @package     : rideout
 * @subpackage  : backend
 * @contact     : info@outsmartit.be
 * 
 * @copyright Copyright(C)2014 Diederik. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * field definition for services in booking form
 * 
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldrideout_time extends JFormField {

    protected $type = 'rideout_time';

    public function getInput() {
        // Initialize some field attributes.
		$size = $this->element['size'] ? ' size="' . (int) $this->element['size'] . '"' : '';
		$maxLength = $this->element['maxlength'] ? ' maxlength="' . (int) $this->element['maxlength'] . '"' : '';
		$class = $this->element['class'] ? ' ' . (string) $this->element['class'] : '';
		$readonly = ((string) $this->element['readonly'] == 'true') ? ' readonly="readonly"' : '';
		$disabled = ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		// Initialize JavaScript field attributes.
		$onchange = $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';
		return '<input type="text" name="' . $this->name . '" id="' . $this->id . '"' . ' value="'
			. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '"' .'class="'. $class .'"'. $size . $disabled . $readonly . $onchange . $maxLength . 'pattern="[0-9]{2}:[0-9]{2}"/>';
    }
}