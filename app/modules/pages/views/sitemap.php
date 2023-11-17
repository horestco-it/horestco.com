<?php $this->load->view('template/default/header') ?>

<title>Sitemap horestco.com.my</title>

<?php $this->load->view('template/default/nav') ?>

	






<div class="section lead light-blue darken-4">

  <div class="container">

    <div class="row">

      <div class="col s12 center white-text">

        <h3 class="lead-heading"><?=strtoupper('sitemap')?></h3>

        <h5 class="lead-sub-heading"><i class="mdi-maps-map large grey-text text-darken-1"></i></h5>

      </div>

    </div>

  </div>

</div>



<section id="sitemap" style="padding:2rem 0">

	<div class="container">

		<div class="row">

			<div class="col s12 m4 center">

				<h5 class="center"><i class="mdi-action-home medium"></i></h5>

				<ul class="nav-lists">

					<?php foreach ($sites->static as $key => $page): ?>

						<?php if ($page->name == 'home'): ?>

						<li><a href="<?=$page->slug?>"><h5><?=strtoupper($page->name)?></h5></a></li>

						<?php else: ?>

						<li><a href="<?=$page->slug?>"><?=ucwords($page->name)?></a></li>

						<?php endif ?>

					<?php endforeach ?>

				</ul>

			</div>



			<div class="col s12 m4 center">

				<h5 class="center"><i class="mdi-device-now-widgets medium"></i></h5>

				<ul class="nav-lists">

				<?php foreach ($sites->catalog as $key => $page): ?>

					<?php if ($page->name == 'catalog'): ?>

					<li><a href="/<?=$page->slug?>"><h5><?=strtoupper($page->name)?></h5></a></li>

					<?php else: ?>

					<li><a href="/<?=$page->slug?>"><?=ucwords($page->name)?></a></li>

					<?php endif ?>

				<?php endforeach ?>

					<li><a href="/catalog-downloads">Catalog Downloads</a></li>

				</ul>

			</div>



			<div class="col s12 m4 center">

				<h5><i class="mdi-action-dashboard medium"></i></h5>

				<ul class="nav-lists">

					<?php foreach ($sites->portfolio as $key => $page): ?>

						<?php if ($page->name == 'portfolio'): ?>

						<li><a href="/<?=$page->slug?>"><h5><?=strtoupper($page->name)?></h5></a></li>

						<?php else: ?>

						<li><a href="/<?=$page->slug?>"><?=ucwords($page->name)?></a></li>

						<?php endif ?>

					<?php endforeach ?>

				</ul>

			</div>

		</div>

	</div>

</section>





<?php $this->load->view('partials/footer') ?>

</body>

</html>