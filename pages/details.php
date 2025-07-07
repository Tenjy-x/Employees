<?php
    $donnees = CountManANDWoman($bdd);
?>
<div class="container">
  <div class="row mt-3 title text-light">
      <h1 class = "text-center">DETAILS</h1>
  </div>
  <div class="row">
      <table class = "table table-blue table-striped text-center ">
      <thead>
      <tr>
          <th>Job</th>
          <th>Number Of Man</th>
          <th>Number Of Woman</th>
          <th>SALARY AVERAGE</th>
      </tr>
      </thead>
      <tbody class = "table-group-divider">
      <?php while ($data = mysqli_fetch_assoc($donnees)) {?>
          <tr>
              <td><?php echo $data['title']?></td>
              <td><?php echo $data['man_count']?></td>
              <td><?php echo $data['woman_count']?></td>
              <td><?php echo $data['moy']?></td>
          </tr>
      <?php }?>
      </tbody>
      </table>
</div>