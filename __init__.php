<?php
mb_internal_encoding("UTF-8");
mb_http_output("UTF-8");
ob_start('mb_output_handler');

include_once("./__settings__.php");
Rhaco::constant('HTML_TEMPLATE_ARG_ESCAPE', true);

?>