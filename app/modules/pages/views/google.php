<?php $this->load->view( config_item('theme').'header', ['page'=>'google'] ) ?>
<?php $this->load->view( config_item('theme').'nav' ) ?>

<main>
	<div class="container">
		<div class="row">
			<div class="col s12 m6">
				<form id="form">
					<div class="input field">
						<input type="text" id="fname" name="fname" value="Husain">
						<label for="fname"></label>
					</div>
					<div class="input field">
						<input type="text" id="lname" name="lname" value="Albaweny">
						<label for="lname"></label>
					</div>
					<div class="input-field">
						<button type="submit" class="btn" id="sendBtn">Send</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</main>

<?php $this->load->view( config_item('theme').'script' ) ?>

<script>
	$(document).ready(function(){
		$('#form').submit(function(e){
			e.preventDefault();
			$.ajax({
				url : "https://script.google.com/macros/s/AKfycbz_TB9CKM3M68taPFJp-afB0Q-zTmsBx-l4bbpe331XYK5pqL6d/exec",
				type: 'post',
				data: $(this).serialize(),
				success: function(data){
					console.log(data)
				}
			});
		});
	})
</script>

<?php $this->load->view( config_item('theme').'footer' ) ?>
