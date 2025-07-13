<?php
    include('../inc/connexion.php');
    include('../inc/function.php');
    session_start();
    $emp_no = $_GET['emp_no'];
    $dept_no = $_GET['department'];
    $from_date = $_GET['from_date'];
    $dept = find_departementsNameForEmployees($bdd, $emp_no);
    $current_from_date = $dept['from_date'];
    if ($from_date < $current_from_date) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <title>Date Error</title>
        </head>
        <body class="bg-light d-flex align-items-center justify-content-center" style="min-height:100vh;">
            <div class="alert alert-danger shadow-lg p-4 rounded-4 text-center" style="max-width: 500px;">
                <h4 class="alert-heading mb-3">Date Error</h4>
                <p>The start date for the new department (<strong><?php echo $from_date; ?></strong>)<br>cannot be earlier than the start date of the current department (<strong><?php echo $current_from_date; ?></strong>).</p>
                <hr>
                <a href="modal.php?num=<?php echo $emp_no; ?>&page=fiche" class="btn btn-outline-danger mt-2">Back to employee record</a>
            </div>
            <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    } else {
        $changement = update_department($bdd , $emp_no , $dept_no , $from_date);
        header('Location: modal.php?num='.$emp_no.'&page=fiche');
    }
?>          