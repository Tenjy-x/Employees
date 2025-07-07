<?php
    $emp_no = $_GET['num'];
    $duration = duree($bdd, $emp_no);
    $fiche_result = FicheEmployees($bdd,$emp_no);
    $salaire_employees = SalaireEmployees($bdd,$emp_no);
    $cadre = TitleEmployees($bdd,$emp_no);
    $history = Historique($bdd,$emp_no);
?>
<div class="container mt-4">
    <?php while ($data = mysqli_fetch_assoc($fiche_result)) {?>
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Employee record</h2>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>First name :</strong> <?php echo $data['first_name']?></li>
                <li class="list-group-item"><strong>Last name :</strong> <?php echo $data['last_name']?></li>
                <li class="list-group-item"><strong>Birth date :</strong> <?php echo $data['birth_date']?></li>
                <li class="list-group-item"><strong>Gender :</strong> <?php echo $data['gender']?></li>
                <li class="list-group-item"><strong>Hire date :</strong> <?php echo $data['hire_date']?></li>
            </ul>
        </div>
    <?php }?>

    <div class="row mb-4">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Salary & Current Employment</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Salary</th>
                                <th>Employment</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($sell = mysqli_fetch_assoc($salaire_employees)) {?>
                            <?php while ($titre = mysqli_fetch_assoc($cadre)) {?>
                                <tr>
                                    <td><?php echo $sell['salary']?></td>
                                    <td><?php echo $titre['title']?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h4 class="mb-0">Historical</h4>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Salary</th>
                                <th>Employment</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($hist = mysqli_fetch_assoc($history)) {?>
                            <tr>
                                <td><?php echo $hist['salary']?></td>
                                <td><?php echo $hist['title']?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <p class = "text-end">This person spent more time in <i><?php  echo $duration['title']?></i></p>
            </div>
        </div>
    </div>
</div>
