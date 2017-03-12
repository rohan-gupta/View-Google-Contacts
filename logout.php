<!DOCTYPE html>
<?php

	session_destroy();
	header('https://accounts.google.com/Logout?continue=./login.php');