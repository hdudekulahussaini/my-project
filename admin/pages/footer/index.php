<?php include "../../../config.php"; ?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 p-4">

<!-- ================= FOOTER CONTENT ================= -->
<?php
$footer = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM footer_content LIMIT 1"));
?>

<div class="card mb-4 shadow">
<div class="card-header bg-dark text-white">Footer Content</div>

<table class="table text-center">
<tr>
<th>Logo</th>
<th>Description</th>
<th>Phone</th>
<th>Email</th>
<th>Action</th>
</tr>

<tr>
<td><?= $footer['logo_text'] ?> <?= $footer['subtitle'] ?></td>
<td><?= $footer['description'] ?></td>
<td><?= $footer['phone'] ?></td>
<td><?= $footer['email'] ?></td>
<td>
<a href="edit.php?id=<?= $footer['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
</td>
</tr>

</table>
</div>

<!-- ================= SOCIAL LINKS ================= -->

<div class="card shadow">
<div class="card-header bg-dark text-white d-flex justify-content-between">
Social Links
<a href="social/create.php" class="btn btn-success btn-sm">Add</a>
</div>

<table class="table text-center">
<tr>
<th>ID</th>
<th>Icon</th>
<th>Link</th>
<th>Action</th>
</tr>

<?php
$res = mysqli_query($conn,"SELECT * FROM social_links");
while($row = mysqli_fetch_assoc($res)){
?>

<tr>
<td><?= $row['id'] ?></td>

<td>
<i class="bi <?= $row['icon'] ?>"></i> <?= $row['icon'] ?>
</td>

<td><?= $row['link'] ?></td>

<td>
<a href="social/edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
<a href="social/delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Delete?')">Delete</a>
</td>
</tr>

<?php } ?>

</table>
</div>

</div>

<?php include "../../footer.php"; ?>