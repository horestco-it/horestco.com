<?php
use Illuminate\Support\Str;

$product_title = isset($product->name) ? $product->name : '';
$product_code = isset($product->code) ? $product->code : (isset($product->sku) ? $product->sku : '');
$wa_message = "Hi Horestco, I would like to inquire about: " . $product_title;
if (!empty($product_code)) {
    $wa_message .= " (Code: " . $product_code . ")";
}
$wa_url = "https://wa.me/60162240799?text=" . rawurlencode($wa_message);
$quote_url = base_url("contact-furniture-manufacturer?product=" . rawurlencode($product_title) . "&code=" . rawurlencode($product_code));
?>
<div class="row">
	<div class="col s12 grey lighten-4 grey-text text-darken-3 z-depth-1" style="padding: 20px 15px; border-radius: 4px; border: 1px solid #e0e0e0;">
		
		<h6 style="font-weight: 600; text-transform: uppercase; margin-top: 0; color: #333; border-bottom: 2px solid #009688; padding-bottom: 8px;">
			<i class="fa fa-info-circle teal-text left"></i> Product Inquiry
		</h6>

		<p style="font-size: 0.9rem; line-height: 1.4; color: #666; margin: 12px 0;">
			Interested in <strong><?=htmlspecialchars($product_title)?></strong> for your hotel, resort, restaurant, or commercial project?
		</p>

		<!-- WhatsApp Direct Button -->
		<div style="margin-bottom: 12px;">
			<a href="<?=$wa_url?>" target="_blank" rel="noopener noreferrer" class="btn waves-effect waves-light green darken-1" style="width: 100%; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; text-transform: none; font-size: 0.95rem;">
				<i class="fa fa-whatsapp fa-lg"></i> Inquire on WhatsApp
			</a>
		</div>

		<!-- Request Quote Button -->
		<div style="margin-bottom: 15px;">
			<a href="<?=$quote_url?>" class="btn waves-effect waves-light teal darken-2" style="width: 100%; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; text-transform: none; font-size: 0.95rem;">
				<i class="fa fa-envelope-o"></i> Request a Quote
			</a>
		</div>

		<div class="divider" style="margin: 15px 0;"></div>

		<!-- Highlights -->
		<ul style="font-size: 0.85rem; color: #555; line-height: 1.6; margin: 0; padding-left: 10px;">
			<li><i class="fa fa-check teal-text"></i> Custom sizes & finishes available</li>
			<li><i class="fa fa-check teal-text"></i> Commercial grade craftsmanship</li>
			<li><i class="fa fa-check teal-text"></i> Worldwide delivery & export support</li>
			<li><i class="fa fa-check teal-text"></i> Bulk & project pricing upon request</li>
		</ul>

	</div>
</div>
