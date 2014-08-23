<?php
/* * *****************************************************************************
 * 
 * @package     : com_rideout
 * @subpackage  : frontend view
 * @contact     : www.outsmartit.be
 * 
 * @copyright Copyright(C)2014 www.outsmartit.be. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 */
defined('_JEXEC') or die('Restricted access');
require_once JPATH_COMPONENT_SITE . '/helpers/calendarhelper.php';
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_rideout/css/calendar.css');
$jinput = JFactory::getApplication()->input;

$document->addScript('//code.jquery.com/jquery-latest.min.js');
?>

<form class="month">
    <h1><?php echo JText::_("COM_RIDEOUT_CALENDAR"); ?></h1>
    <p>
        <?php
        $ridesmodel = $this->getModel();
        setlocale(LC_ALL, 'nld_nld');
        if ($this->nr_of_months) {
            $nr = (int) $this->nr_of_months;
        } else {
            $nr = 1;
        }
        $today = new DateTime();
        $defaultmonth = $today->format('m') + 0;
        $mydate = $jinput->get('month', $defaultmonth, 'INT');
        $currentYear = $jinput->get('year', $today->format('Y'), 'INT');

        $prev_date = $mydate - $nr;
        if ($prev_date <= 0) {
            $prev_date = 12 - $prev_date;
            $year = $currentYear - 1;
        } else {
            $year = $currentYear;
        }
        $previous_link = $prev_date . '&year=' . $year;
        //echo '<a href="' . JRoute::_('index.php?option=com_rideout&view=myrides&layout=calendar&month=') . $prev_date . '&year='.$year.'">' . JText::_("COM_RIDEOUT_PREVIOUS_MONTH") . '</a>';
        echo '<div class="ridemonth">' . date("F", mktime(0, 0, 0, $mydate, 1, $currentYear)) . '</div>';
        echo draw_calendar($mydate, $currentYear, $ridesmodel);
        echo '<br/>';
        for ($i = 1; $i < $nr; $i++) {
            echo '<p>';

            if ($mydate == 12) {
                $mydate = 0;
                $currentYear++;
            }
            $mydate++;
            echo date("F", mktime(0, 0, 0, $mydate, 1, $currentYear));
            echo draw_calendar($mydate, $currentYear, $ridesmodel);

            echo '</p><br/>';
        }
        $linkmonth = $mydate + 1;
        if ($linkmonth == 13) {
            $linkmonth = 1;
            $year = $year + 1;
        }
        echo '<a href="' . JRoute::_('index.php?option=com_rideout&view=myrides&layout=calendar&month=') . $previous_link . '" class="align-left">' . JText::_("COM_RIDEOUT_PREVIOUS_MONTH") . '</a>';
        echo '<a href="' . JRoute::_('index.php?option=com_rideout&view=myrides&layout=calendar&month=') . $linkmonth . '&year=' . $year . '" class="align-right">' . JText::_("COM_RIDEOUT_NEXT_MONTH") . '</a>'
        ?>
        <br/>
    <div id="details"></div>
</form>

<?php
$document->addScript('components/com_rideout/js/calendar.js');
?>

