<?php
    include('../inc/connexion.php');
    include('../inc/function.php');
    session_start();
    $emp_no = $_GET['emp_no'];
    $dept_no = $_GET['department'];
    $from_date = $_GET['from_date'];
    $changement = update_department($bdd , $emp_no , $dept_no , $from_date);
    header('Location: modal.php?num='.$emp_no.'&page=fiche');
?>