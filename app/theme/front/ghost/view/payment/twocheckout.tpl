<form action="<?= $action; ?>" method="post" id="twocheckout">
	<input type="hidden" name="sid" value="<?= $sid; ?>">
	<input type="hidden" name="total" value="<?= $total; ?>">
	<input type="hidden" name="cart_order_id" value="<?= $cart_order_id; ?>">
	<input type="hidden" name="card_holder_name" value="<?= $card_holder_name; ?>">
	<input type="hidden" name="street_address" value="<?= $street_address; ?>">
	<input type="hidden" name="city" value="<?= $city; ?>">
	<input type="hidden" name="state" value="<?= $state; ?>">
	<input type="hidden" name="zip" value="<?= $zip; ?>">
	<input type="hidden" name="country" value="<?= $country; ?>">
	<input type="hidden" name="email" value="<?= $email; ?>">
	<input type="hidden" name="phone" value="<?= $phone; ?>">
	<input type="hidden" name="ship_street_address" value="<?= $ship_street_address; ?>">
	<input type="hidden" name="ship_city" value="<?= $ship_city; ?>">
	<input type="hidden" name="ship_state" value="<?= $ship_state; ?>">
	<input type="hidden" name="ship_zip" value="<?= $ship_zip; ?>">
	<input type="hidden" name="ship_country" value="<?= $ship_country; ?>">
	<?php $i = 0; ?>
	<?php foreach ($products as $product) { ?>
	<input type="hidden" name="c_prod_<?= $i; ?>" value="<?= $product['product_id']; ?>,<?= $product['quantity']; ?>">
	<input type="hidden" name="c_name_<?= $i; ?>" value="<?= $product['name']; ?>">
	<input type="hidden" name="c_description_<?= $i; ?>" value="<?= $product['description']; ?>">
	<input type="hidden" name="c_price_<?= $i; ?>" value="<?= $product['price']; ?>">
	<?php $i++; ?>
	<?php } ?>
	<input type="hidden" name="id_type" value="1">
	<?php if ($demo) { ?>
	<input type="hidden" name="demo" value="<?= $demo; ?>">
	<?php } ?>
	<input type="hidden" name="lang" value="<?= $lang; ?>">
	<input type="hidden" name="return_url" value="<?= $return_url; ?>">
</form>
