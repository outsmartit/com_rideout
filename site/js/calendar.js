/* 
 * @package     : com_rideout
 * @subpackage  : frontend
 * @contact     : http://www.outsmartit.be
 * 
 * @copyright Copyright(C)2014 www.outsmartit.be . All rights reserved. 
 * @license GNU General Public License version 2 or later; see LICENSE.txt
 * 
 * 
 * Ajax call to backend to fetch ride details
 */
$(document).ready(function() {
        $(".a_ride").click(function() {  
            $("#details").html("Getting the Details");
            var currentId = $(this).attr('id');
            varurl = 'index.php?option=com_rideout&view=myrides&format=raw';
            var jqxhr = $.ajax({
                type: "POST",
                url: varurl,
                data: {id: currentId}
            })
                    .done(function(result) {
                        //alert(result);
                        $("#details").html("<span>" + result + "</span>");
                    })
                    .fail(function() {
                        alert("wrong");
                    })
                    ;
        });
    });

