<?php
ob_start();
session_start();
include ("appConfig/constants.php");
include ("appConfig/db_connect.php");
include ("api_v1/auth/session_manager.php");
include ("pages/routs.php");
