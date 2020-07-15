<?php 
$this->session->sess_destroy();
session_destroy();
unset($_SESSION);

header("Location: index");