<h2>Admin page</h2>
<?php
if(is_array($this->TPL["errors"])) {
	foreach($this->TPL["errors"] as $error) {
		echo "<p><strong>" . $error . "</strong></p>";
	}
}
?>
<h3>User Table</h3>
<table>
<tr>
	<th>Delete</th><th>Freeze</th><th>Username</th><th>Password</th><th>Access level</th><th>Frozen</th>
</tr>
<?php

$Users = $this->TPL["records"];
foreach($Users as $user) {
	echo "<tr>";
	echo "<td><a href='" . base_url() . "index.php?/Admin/delete/" . $user->compid . "'>D</a></td>";
	echo "<td><a href='" . base_url() . "index.php?/Admin/freeze/" . $user->compid . "'>F</a></td>";
	echo "<td>" . $user->username . "</td>";
	echo "<td>" . $user->password . "</td>";
	echo "<td>" . $user->accesslevel. "</td>";
	echo "<td>" . ($user->frozen ? "Y" : "N") . "</td>";
	echo "</tr>";
}
?>
</table>

<br>

<?= form_open("Admin/adduser") ?>
<?= form_fieldset("Add new user"); ?>
<?= form_label('Username:', 'username'); ?> <br>
<?= form_input(array('name' => 'username',
 'id' => 'username',
 'value' => set_value('username',"") )); ?> <br>
<?= form_label('Password:', 'password'); ?> <br>
<?= form_input(array('name' => 'password',
 'id' => 'password',
 'value' => set_value('password',"") )); ?> <br>
 <?= form_label('Access Level:', 'accesslevel'); ?> <br>
<?= form_input(array('name' => 'accesslevel',
 'id' => 'accesslevel',
 'value' => set_value('accesslevel',"") )); ?> <br>
<?= form_submit('submit', 'Submit'); ?>
<?= form_fieldset_close(); ?>
<?= form_close() ?>
