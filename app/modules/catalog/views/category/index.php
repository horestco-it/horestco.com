<!DOCTYPE html>
<html lang="en">

<head>
	<?php echo get_meta($page) ?>
	<?php $this->load->view('partials/meta-and-assets') ?>
	

	<?php $this->load->view(config_item('theme') . 'nav' . $version) ?>

	<div class="container" id="container">
		<div id="product-container">
			<?php if( count($subcategories) ): ?>
				<?php foreach ($subcategories as $key => $subcategory) : ?>
	
					<?php $this->load->view('category/subcategory', compact('subcategory', 'category')) ?>
	
				<?php endforeach ?>
	
			<?php endif ?>
		</div>
		<?php if( $hasLoadMore ): ?>
			<div class="flex justify-center my-20">
				<!-- <button class="btn" id="load-more" data-src="<?=$loadMoreSrc?>">Load More</button> -->
				<div id="load-more" data-src="<?=$loadMoreSrc?>"></div>
				<img id="preloader" src="<?=base_url()?>/assets/images/preloader.gif" alt=""/>
			</div>
		<?php endif ?>
	</div>



	<?php $this->load->view(config_item('theme') . 'script') ?>
	<?php $this->load->view('partials/lazyload.js.php') ?>
	<script>
		$('html, body').animate({
        scrollTop: '0px'
    }, 1000, 'swing');

		let options = {
			rootMargin: '0px',
			threshold: 0.9
		};
		let currentUrl = '<?=$loadMoreSrc?>'

		target = document.querySelector('#load-more');

		observer = new IntersectionObserver(entries => {
			var entry = entries[0];
			if (entry.isIntersecting) {
				console.log('You reached the bottom of the list!');
				appendMorePosts();
			}
		}, options);
		observer.observe(target);

		appendMorePosts = function() {
			if(currentUrl) {
				loadMore( currentUrl )
			}
		}
		
		function loadMore(url) {
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: {
					category: '<?=$category->slug?>'
				}
			})
				.then(function(data){
					// $('#load-more').parent().remove();
					if(data.hasLoadMore) {
						currentUrl = data.loadMoreSrc
					}
					else{
						currentUrl = null
						$('#preloader').hide()
					}
					setTimeout(function(){
						$('#product-container').append(data.html)
					}, 1000);
				})
				.then(function(){
				})
		}
	</script>
	<?php $this->load->view(config_item('theme') . 'footer') ?>