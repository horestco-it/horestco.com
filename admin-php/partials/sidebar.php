<div class="col-sm-3 col-md-2 col-lg-2 sidebar">
	<ul class="nav nav-sidebar dropdown-menu sidebar-fixed" style="display:block">
		<li><a href="<?=BASE_URL?>/maincategory">Manage Main Categoy</a></li>
		<li><a href="<?=BASE_URL?>/category">Manage Categoy</a></li>
		<!-- <li><a href="<?=BASE_URL?>/subcategory">Manage Sub Categoy</a></li> -->
		<li><a href="<?=BASE_URL?>/dashboard">Manage Product</a></li>
		<?php if ( $type == 'A' ): ?>
		<li><a href="<?=BASE_URL?>/setting">Setting User</a></li>
		<li><a href="<?=BASE_URL?>/person">Employees</a></li>
		<?php endif; ?>
		<li role="presentation" class="divider"></li>
		<li><a href="<?=BASE_URL?>/portfolio">Portfolio</a></li>
		<li><a href="<?=THIS_FILE?>?action=addclient">Add Client</a></li>
	</ul>
</div>