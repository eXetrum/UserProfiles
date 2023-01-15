<ul>
 <li <? if ($active['home']) { ?> class="active" <? } ?>><a href="<?= base_url(); ?>index.php?/Home">Home</a></li>
 <li <? if ($active['members']) { ?> class="active" <? } ?>><a href="<?= base_url(); ?>index.php?/Members">Members</a></li>
 <li <? if ($active['admin']) { ?> class="active" <? } ?>><a href="<?= base_url(); ?>index.php?/Admin">Admin</a></li>
 <? if ($loggedin) { ?>
 <li><a href="<?= base_url(); ?>index.php?/Login/logout">Logout</a></li>
 <? } else { ?>
 <li <? if ($active['login']) { ?> class="active" <? } ?>><a href="<?= base_url(); ?>index.php?/Login">Login</a></li>
 <? } ?>
</ul>