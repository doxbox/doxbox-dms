<?php
// EDIT - START
$batch_db_active = 0 ;
// EDIT - END
// 
// we should always report which database is active
batch_log_msg2(basename(__FILE__), "batch_db_active=[" . $batch_db_active . "]" ) ;
//
// hook gt intentionally omitted