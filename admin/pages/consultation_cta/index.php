<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<?php include "../../../config.php"; ?>
<?php
$result = mysqli_query($conn, "SELECT * FROM consultation_cta ORDER BY id DESC");
if (!$result) {
  die("Query Failed: " . mysqli_error($conn));
}
$cta_count = mysqli_num_rows($result);
?>
<div class="col-9 container-fluid">
  <div class="row">
    <!--  MAIN CONTENT -->
    <div class="col-md-12 p-4">

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Consultation CTA</h3>
        <?php if ($cta_count < 1) { ?>
          <a href="create.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add CTA
          </a>
        <?php } ?>
      </div>
      <!-- CARD -->
      <div class="card shadow">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Button 1</th>
                  <th>Button 2</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>

                <?php if (mysqli_num_rows($result) > 0) { ?>
                  <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>
                      <td>
                        <span class="badge bg-secondary">
                          <?php echo $row['id']; ?>
                        </span>
                      </td>

                      <td class="text-start">
                        <?php echo htmlspecialchars($row['title']); ?>
                      </td>

                      <td><?php echo htmlspecialchars($row['btn1_text']); ?></td>
                      <td><?php echo htmlspecialchars($row['btn2_text']); ?></td>

                      <td>
                        <?php if ($row['status'] == 'active') { ?>
                          <span class="badge bg-success">Active</span>
                        <?php } else { ?>
                          <span class="badge bg-secondary">Inactive</span>
                        <?php } ?>
                      </td>

                      <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>"
                          class="btn btn-warning btn-sm">
                          <i class="bi bi-pencil"></i>
                        </a>

                        <a href="delete.php?id=<?php echo $row['id']; ?>"
                          class="btn btn-danger btn-sm"
                          onclick="return confirm('Delete this CTA?')">
                          <i class="bi bi-trash"></i>
                        </a>
                      </td>
                    </tr>

                  <?php } ?>
                <?php } else { ?>

                  <tr>
                    <td colspan="6">No Data Found</td>
                  </tr>

                <?php } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 🎨 STYLE -->
<style>
  .nav-link {
    padding: 10px;
    border-radius: 6px;
    transition: 0.3s;
  }

  .nav-link:hover {
    background: #0d6efd;
    padding-left: 15px;
  }

  .badge {
    font-size: 11px;
  }
</style>

<?php include "../../footer.php"; ?>