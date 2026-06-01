<?php include "../../../config.php"; ?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<style>
table, th, td {
    border: 1px solid black !important;
    border-collapse: collapse;
}
</style>

<div class="col-9 container-fluid mt-5">

<?php
$section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM project_section LIMIT 1"));
?>

<!--  SECTION TABLE -->
<h4 class="mb-3">Project Section</h4>

<table class="table text-center mb-5">

    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Subtitle</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td><?php echo $section['id']; ?></td>
            <td><?php echo $section['subtitle']; ?></td>
            <td><?php echo $section['title']; ?></td>
            <td><?php echo $section['description']; ?></td>
            <td>
                <a href="edit_section.php?id=<?php echo $section['id']; ?>" 
                   class="btn btn-warning btn-sm">Edit</a>
            </td>
        </tr>
    </tbody>

</table>

<!--  ADD PROJECT BUTTON -->
<div class="d-flex justify-content-end mb-3">
    <a href="create.php" class="btn btn-success">+ Add Project</a>
</div>

<!--  PROJECT TABLE -->
<table class="table text-center">

<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Category</th>
    <th>Title</th>
    <th>Action</th>
</tr>
</thead>

<tbody>

<?php
$result = mysqli_query($conn, "SELECT * FROM projects");

while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td><?php echo $row['id']; ?></td>

    <td>
        <img src="../../upload/<?php echo $row['image']; ?>" width="70">
    </td>

    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['title']; ?></td>

    <td>
        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

        <a href="delete.php?id=<?php echo $row['id']; ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Delete?')">Delete</a>
    </td>
</tr>

<?php } ?>

</tbody>
</table>

</div>

<?php include "../../footer.php"; ?>