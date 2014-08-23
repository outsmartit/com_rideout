<?php

/* * *****************************************************************************
 * 
 * @package     : com_rideout
 * @subpackage  : frontend/helper
 * @contact     : wwww.outsmartit.be
 * 
 * @copyright Copyright(C)2013 Outsmartit.be. All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 */
defined('_JEXEC') or die('Restricted access');

function draw_calendar($month, $year, $rides_model) {
    $rides_this_month = $rides_model->getRidesByMonth($month, $year);
    $firstday = JComponentHelper::getParams('com_rideout')->get('rideout_first_weekday');
    $current_day = date('d');
    $current_month = date('m');
    /* draw table */
    $calendar = '<table cellpadding="10px" cellspacing="0" class="calendar">';
    /* table headings : when firstday = 0, first day of week is Monday */
    if (!$firstday) {
        $headings = array(JText::_('Mon'), 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', "Sun");
    } else {
        $headings = array(JText::_("Sun"), 'Mon', 'Tues', 'Wed', 'Thu', 'Fri', 'Sat');
    }
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td><td class="calendar-day-head">', $headings) . '</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */
    //TODO blanks should be -1 if first day is monday 
    if (!$firstday) {
        if ($running_day > 0) {
            $myindex = $running_day - 1;
        } else {
            $myindex = 6;
        }
    } else {
        $myindex = $running_day;
    }

    for ($x = 0; $x < $myindex; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $calendar.= '<td class="calendar-day">';
        /* add in the day number */
        $rider = "";
        // selectie op rides : indien ride wordt gevonden wordt een link geplaatst naar de desbetreffende ride
        if (!empty($rides_this_month)) {
            $check_date = date("Ymd", mktime(0, 0, 0, $month, $list_day, $year));
            $checkobject = date_create($check_date);
            $nextevent = date_create($rides_this_month[0]);
            if (strtotime($checkobject->format("Ymd")) == strtotime($nextevent->format("Ymd"))) {
                $format = "a_ride";
//                $rider = " id =" . $rides_this_month[0]->id; id is replaced by date for multiple rides/day
                $rider = " id =" .$nextevent->format("Ymd");
//                $link = '<a href="' . JRoute::_('index.php?option=com_rideout&view=myride&id=' . $rides_this_month[0]->id) . '">';
                //              $link_end = '</a>'; link is replaced by Ajax call
                array_shift($rides_this_month);
            } else {
                $format = "no_ride";
            }
        } else {
            $format = "no_ride";
        }
        if ($list_day == $current_day && $month == $current_month) {
            if ($format == "no_ride") {
                $format = '"no_ride today"';
            } else {
                $format = '"a_ride today"';
            }
        }

        $calendar.= '<div class=' . $format . $rider . '>' . $list_day . '</div>';
 
        $calendar.= '</td>';
        if ($myindex == 6):
            $calendar.= '</tr>';
            if (($day_counter + 1) != $days_in_month):
                $calendar.= '<tr class="calendar-row">';
            endif;
            $myindex = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++;
        $myindex++;
        $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if ($days_in_this_week < 8):
        for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;
    /* final row */
    $calendar.= '</tr>';
    /* end the table */
    $calendar.= '</table>';

    return $calendar;
}
?>


