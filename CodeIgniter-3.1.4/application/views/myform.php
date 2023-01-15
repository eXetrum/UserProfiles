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