<?php include "../../../config.php"; ?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 p-4">

  <?php
  $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM contact_section LIMIT 1"));
  ?>

  <!-- SECTION -->
  <div class="card mb-3">
    <div class="card-header bg-dark text-white">Contact Section</div>
    <div class="card-body">

      <table class="table table-bordered text-center">
        <tr>
          <th>Subtitle</th>
          <th>Title</th>
          <th>Action</th>
        </tr>

        <tr>
          <td><?= $section['subtitle'] ?></td>
          <td><?= $section['title'] ?></td>
          <td>
            <a href="edit_section.php" class="btn btn-warning btn-sm">Edit</a>
          </td>
        </tr>
      </table>

    </div>
  </div>
  <!-- LINKS -->
  <a href="studio_hours/index.php" class="btn btn-primary">Studio Hours</a>
  <a href="messages/index.php" class="btn btn-success">View Messages</a>
</div>
<?php include "../../footer.php"; ?>