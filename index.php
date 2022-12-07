<?php
// Initialise Twig

include('controleur.php');
if (isset($_GET['page'])) $page = $_GET['page']; else $page = '';
if (isset($_GET['action'])) $action = $_GET['action']; else $action = 'read';
if (isset($_GET['id'])) $id = intval($_GET['id']); else $id = 0;