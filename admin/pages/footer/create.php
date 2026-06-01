<?php include "../../../config.php"; ?>

<h3>Footer Content</h3>

<?php
$footer = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM footer_content LIMIT 1"));
?>

<table border="1" cellpadding="10">
<tr>
<th>Logo</th>
<th>Phone</th>
<th>Action</th>
</tr>

<tr>
<td><?= $footer['logo_text'] ?> <?= $footer['subtitle'] ?></td>
<td><?= $footer['phone'] ?></td>
<td>
<a href="edit.php?id=<?= $footer['id'] ?>">Edit</a>
</td>
</tr>
</table>

<hr>

<h3>Social Links</h3>

<a href="social/create.php">Add Social</a>

<table border="1" cellpadding="10">
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
<td><?= $row['icon'] ?></td>
<td><?= $row['link'] ?></td>
<td>
<a href="social/edit.php?id=<?= $row['id'] ?>">Edit</a> |
<a href="social/delete.php?id=<?= $row['id'] ?>">Delete</a>
</td>
</tr>

<?php } ?>
</table>
<?php include "../../footer.php"; ?>