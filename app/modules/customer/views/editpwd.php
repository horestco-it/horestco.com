<?php $this->load->view('template/default/header') ?>

<?php $this->load->view('template/default/nav') ?>



<main>

	<div class="container">

		<div class="row valign-wrapper">

		  <p class="green-text"><?=$this->session->flashdata('message')?></p>
		</div>

	</div>

</main>



<?php $this->load->view('template/default/script') ?>

<?php $this->load->view('template/default/footer') ?>