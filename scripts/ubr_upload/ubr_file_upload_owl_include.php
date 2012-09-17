<?php

require 'ubr_ini.php';
require 'ubr_default_config.php';
require_once 'ubr_lib.php';

/*
header('Content-type: text/html; charset=UTF-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . date('r'));
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
*/

?>
  <style>
    .debug {font:16px Arial; background-color:#FFFFFF; border:1px solid #898989; width:700px; height:100px; overflow:auto;}
    .alert {font:18px Arial;}
    .data {background-color:#b3b3b3; border:1px solid #898989; width:350px;}
    .data tr td {background-color:#dddddd; font:13px Arial; width:35%;}
    .bar1 {background-image:url(/owl-0.96/scripts/ubr_upload/images/progress_bar_white.gif); layer-background-image:url(/owl-0.96/scripts/ubr_upload/images/progress_bar_white.gif); position:relative; text-align:left; height:20px; width:<?php print $_CONFIG['progress_bar_width']; ?>px; border:1px solid #505050;}
    .bar2 {background-image:url(/owl-0.96/scripts/ubr_upload/images/progress_bar_blue.gif); layer-background-image:url(/owl-0.96/scripts/ubr_upload/images/progress_bar_blue.gif); position:relative; text-align:left; height:20px; width:0%;}
  </style>
<!--
    .bar1 {background-color:#b3b3b3; position:relative; text-align:left; height:20px; width:<?php print $_CONFIG['progress_bar_width']; ?>px; border:1px solid #505050;}
    .bar2 {background-color:#000099; position:relative; text-align:left; height:20px; width:0%;}
-->

  <script language="javascript" type="text/javascript">
    var path_to_link_script = "scripts/ubr_upload/<?php print $PATH_TO_LINK_SCRIPT; ?>";
    var path_to_set_progress_script = "scripts/ubr_upload/<?php print $PATH_TO_SET_PROGRESS_SCRIPT; ?>";
    var path_to_get_progress_script = "scripts/ubr_upload/<?php print $PATH_TO_GET_PROGRESS_SCRIPT; ?>";
    var path_to_upload_script = "<?php print $PATH_TO_UPLOAD_SCRIPT; ?>";
    var multi_configs_enabled = <?php print $MULTI_CONFIGS_ENABLED; ?>;
    var check_allow_extensions_on_client = <?php print $_CONFIG['check_allow_extensions_on_client']; ?>;
    var check_disallow_extensions_on_client = <?php print $_CONFIG['check_disallow_extensions_on_client']; ?>;
    <?php if($_CONFIG['check_allow_extensions_on_client']){ print "var allow_extensions = /" . $_CONFIG['allow_extensions'] . "$/i;\n"; } ?>
    <?php if($_CONFIG['check_disallow_extensions_on_client']){ print "var disallow_extensions = /" . $_CONFIG['disallow_extensions'] . "$/i;\n"; } ?>
    var check_file_name_format = <?php print $_CONFIG['check_file_name_format']; ?>;
    var check_null_file_count = <?php print $_CONFIG['check_null_file_count']; ?>;
    var check_duplicate_file_count = <?php print $_CONFIG['check_duplicate_file_count']; ?>;
    var max_upload_slots = <?php print $_CONFIG['max_upload_slots']; ?>;
    var cedric_progress_bar = <?php print $_CONFIG['cedric_progress_bar']; ?>;
    var cedric_hold_to_sync = <?php print $_CONFIG['cedric_hold_to_sync']; ?>;
    var progress_bar_width = <?php print $_CONFIG['progress_bar_width']; ?>;
    var show_percent_complete = <?php print $_CONFIG['show_percent_complete']; ?>;
    var show_files_uploaded = <?php print $_CONFIG['show_files_uploaded']; ?>;
    var show_current_position = <?php print $_CONFIG['show_current_position']; ?>;
    var show_elapsed_time = <?php print $_CONFIG['show_elapsed_time']; ?>;
    var show_est_time_left = <?php print $_CONFIG['show_est_time_left']; ?>;
    var show_est_speed = <?php print $_CONFIG['show_est_speed']; ?>;
  </script>
  
      
  <div align="center">

    <?php if($DEBUG_AJAX){ print "<br><div class=\"debug\" id=\"ubr_debug\"><b>AJAX DEBUG WINDOW</b><br></div><br>\n"; } ?>

    <!-- Start Progress Bar -->
    <div class="alert" id="ubr_alert"></div>
    <div id="progress_bar" style="display:none">
      <div class="bar1" id="upload_status_wrap">
        <div class="bar2" id="upload_status"></div>
      </div>

      <?php if($_CONFIG['show_percent_complete'] || $_CONFIG['show_files_uploaded'] || $_CONFIG['show_current_position'] || $_CONFIG['show_elapsed_time'] || $_CONFIG['show_est_time_left'] || $_CONFIG['show_est_speed']){ ?>
      <br>
      <table class="data" cellpadding='3' cellspacing='1'>
        <?php if($_CONFIG['show_percent_complete']){ ?>
        <tr>
          <td align="left"><b>Percent Complete:</b></td>
          <td align="center"><span id="percent">0%</span></td>
        </tr>
        <?php } ?>
        <?php if($_CONFIG['show_files_uploaded']){ ?>
        <tr>
          <td align="left"><b>Files Uploaded:</b></td>
          <td align="center"><span id="uploaded_files">0</span> of <span id="total_uploads"></span></td>
        </tr>
        <?php } ?>
        <?php if($_CONFIG['show_current_position']){ ?>
        <tr>
          <td align="left"><b>Current Position:</b></td>
          <td align="center"><span id="current">0</span> / <span id="total_kbytes"></span> KBytes</td>
        </tr>
        <?php } ?>
        <?php if($_CONFIG['show_elapsed_time']){ ?>
        <tr>
          <td align="left"><b>Elapsed Time:</b></td>
          <td align="center"><span id="time">0</span></td>
        </tr>
        <?php } ?>
        <?php if($_CONFIG['show_est_time_left']){ ?>
        <tr>
          <td align="left"><b>Est Time Left:</b></td>
          <td align="center"><span id="remain">0</span></td>
        </tr>
        <?php } ?>
        <?php if($_CONFIG['show_est_speed']){ ?>
        <tr>
          <td align="left"><b>Est Speed:</b></td>
          <td align="center"><span id="speed">0</span> KB/s.</td>
        </tr>
        <?php } ?>
      </table>
      <?php } ?>
    </div>
    <!-- End Progress Bar -->

    <?php if($_CONFIG['embedded_upload_results'] || $_CONFIG['opera_browser'] || $_CONFIG['safari_browser']){ ?>
    <div id="upload_div" style="display:none;"><iframe name="upload_iframe" frameborder="0" width="800" height="200" scrolling="auto"></iframe></div>
    <?php } ?>

  </div>

  <div id='ajax_div'><!-- Used to store AJAX --></div>
  
