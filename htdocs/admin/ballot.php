<?php
session_start();
$title = 'Ballot';
include "connection.php";
include "session/session.php";
require "include/headerAdmin.php";

$parse = parse_ini_file('config.ini', FALSE, INI_SCANNER_RAW);
$title = $parse['election_title'];
?>
<body>
    <h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b></h1>
</body>
