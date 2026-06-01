<?php include "../../../../config.php"; ?>
<?php include "../../../header.php"; ?>
<?php include "../../../sidebar.php"; ?>

<div class="col-9 p-4">

    <table class="table table-bordered text-center">

        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Details</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $res = mysqli_query($conn, "SELECT * FROM contact_messages");
            while ($row = mysqli_fetch_assoc($res)) {
            ?>

                <tr>
                    <!-- NAME -->
                    <td class="fw-semibold">
                        <?= htmlspecialchars($row['name']) ?>
                    </td>
                    <!-- DETAILS (SHORT) -->
                    <td class="text-muted">
                        <?= htmlspecialchars(substr($row['message'], 0, 50)) ?>...
                    </td>
                    <!-- ACTION -->
                    <td>
                        <button class="btn btn-info btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#viewModal<?= $row['id'] ?>">
                            View
                        </button>
                    </td>
                </tr>
                <!-- MODAL (FULL DETAILS) -->
                <div class="modal fade" id="viewModal<?= $row['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Message Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-start">
                                <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
                                <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
                                <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
                                <p><strong>Service:</strong> <?= htmlspecialchars($row['service']) ?></p>
                                <p><strong>Message:</strong><br>
                                    <?= htmlspecialchars($row['message']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </tbody>
    </table>

</div>

<?php include "../../../footer.php"; ?>