<?php include "../../../config.php"; ?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 p-4">

    <?php
    $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM faq_section LIMIT 1"));
    ?>

    <!-- SECTION -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-dark text-white">Section</div>
        <div class="card-body">

            <table class="table table-bordered text-center">
                <tr>
                    <th>title</th>
                    <th>Subtitle</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>

                <tr>
                    <td><?= $section['subtitle'] ?></td>
                    <td><?= $section['title'] ?></td>
                    <td><?= $section['description'] ?></td>
                    <td>
                        <a href="edit_section.php" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            </table>

        </div>
    </div>

    <!-- FAQ LIST -->
    <div class="card shadow">
        <div class="card-header bg-dark text-white d-flex justify-content-between">
            FAQ List
            <a href="create.php" class="btn btn-success btn-sm">Add</a>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">

                <!-- ✅ TABLE HEAD -->
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <!-- ✅ TABLE BODY -->
                <tbody>

                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM faqs");
                    while ($row = mysqli_fetch_assoc($res)) {
                    ?>

                        <tr>
                            <td class="text-center"><?= $row['id'] ?></td>

                            <td>
                                <strong><?= htmlspecialchars($row['question']) ?></strong>
                            </td>

                            <td>
                                <?= htmlspecialchars($row['answer']) ?>
                            </td>

                            <td class="text-center">
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</a>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>

            </table>
        </div>
    </div>

</div>

<?php include "../../footer.php"; ?>