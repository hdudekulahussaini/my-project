<?php include "../../header.php"; ?>
<?php include "../../../config.php"; ?>
<?php include "../../sidebar.php"; ?>

        <!-- RIGHT SIDE (CONTENT) -->
        <div class="col-9 p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Counters List</h3>
                <a href="create.php" class="btn btn-success">+ Add Counter</a>
            </div>

            <div class="card shadow">
                <div class="card-body">

                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        $data = mysqli_query($conn, "SELECT * FROM counters");

                        while($row = mysqli_fetch_assoc($data)){
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><strong><?php echo $row['number']; ?></strong></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
                                       onclick="return confirm('Delete this?')">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>

                </div>
            </div>

        
        </div>
<?php include "../../footer.php"; ?>