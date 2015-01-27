<?php if ($logged): ?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?= $dashboard; ?>">
				<img src="../asset/bs3/img/logo.png" class="img-responsive" alt="<?= $heading_title; ?>">
			</a>
		</div>
		<div class="collapse navbar-collapse" id="menu">
			<ul class="nav navbar-nav">
				<li class="dropdown" id="catalog"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_catalog; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?= $category; ?>"><?= $text_category; ?></a></li>
						<li><a href="<?= $product; ?>"><?= $text_product; ?></a></li>
						<li><a href="<?= $event; ?>"><?= $text_event; ?></a></li>
						<li><a href="<?= $recurring; ?>"><?= $text_recurring; ?></a></li>
						<li><a href="<?= $filter; ?>"><?= $text_filter; ?></a></li>
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_attribute; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $attribute; ?>"><?= $text_attribute; ?></a></li>
								<li><a href="<?= $attribute_group; ?>"><?= $text_attribute_group; ?></a></li>
							</ul>
						</li>
						<li><a href="<?= $option; ?>"><?= $text_option; ?></a></li>
						<li><a href="<?= $manufacturer; ?>"><?= $text_manufacturer; ?></a></li>
						<li><a href="<?= $download; ?>"><?= $text_download; ?></a></li>
						<li><a href="<?= $review; ?>"><?= $text_review; ?></a></li>
					</ul>
				</li>
				<li class="dropdown" id="content"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_content; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?= $page; ?>"><?= $text_page; ?></a></li>
						<div class="divider"></div>
						<li class="dropdown-header"><?= $text_blog; ?></li>
						<li><a href="<?= $blog_category; ?>"><?= $text_blog_cats; ?></a></li>
						<li><a href="<?= $blog_post; ?>"><?= $text_blog_post; ?></a></li>
						<li><a href="<?= $blog_comment; ?>"><?= $text_blog_comm; ?></a></li>
						<li><a href="<?= $blog_setting; ?>"><?= $text_blog_sett; ?></a></li>
					</ul>
				</li>
				<li class="dropdown" id="module"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_module; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="dropdown-header"><?= $text_core_mods; ?></li>
						<li><a href="<?= $menubuilder; ?>"><?= $text_menubuilder; ?></a></li>
						<li><a href="<?= $notification; ?>"><?= $text_notification; ?></a></li>
						<div class="divider"></div>
						<li class="dropdown-header"><?= $text_core_cart; ?></li>
						<li><a href="<?= $shipping; ?>"><?= $text_shipping; ?></a></li>
						<li><a href="<?= $payment; ?>"><?= $text_payment; ?></a></li>
						<li><a href="<?= $total; ?>"><?= $text_total; ?></a></li>
						<li><a href="<?= $feed; ?>"><?= $text_feed; ?></a></li>
					</ul>
				</li>
				<li class="dropdown" id="plugin"><a href="<?= $plugin; ?>" class="dropdown-toggle"><?= $text_plugin; ?></a></li>
				<li class="dropdown" id="widget"><a href="<?= $widget; ?>" class="dropdown-toggle"><?= $text_widget; ?></a></li>
				<li class="dropdown" id="sale"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_sale; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?= $order; ?>"><?= $text_order; ?></a></li>
						<li><a href="<?= $order_recurring; ?>"><?= $text_order_recurring; ?></a></li>
						<li><a href="<?= $return; ?>"><?= $text_return; ?></a></li>
						<li><a href="<?= $coupon; ?>"><?= $text_coupon; ?></a></li>
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_voucher; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $voucher; ?>"><?= $text_voucher; ?></a></li>
								<li><a href="<?= $voucher_theme; ?>"><?= $text_voucher_theme; ?></a></li>
							</ul>
						</li>
						<?php if ($paypalexpress_status) { ?>
							<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_paypal_manage; ?> <b class="fa fa-caret-right"></b></a>
								<ul class="dropdown-menu">
									<li><a href="<?= $paypal_express; ?>"><?= $text_paypal_manage; ?></a></li>
									<li><a href="<?= $paypal_express_search; ?>"><?= $text_paypal_search; ?></a></li>
								</ul>
							</li>
						<?php } ?>
					</ul>
				</li>
				<li class="dropdown" id="people"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_people; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?= $affiliate; ?>"><?= $text_affiliate; ?></a></li>
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_customer; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $customer; ?>"><?= $text_customer; ?></a></li>
								<li><a href="<?= $customer_group; ?>"><?= $text_customer_group; ?></a></li>
								<li><a href="<?= $customer_ban_ip; ?>"><?= $text_customer_ban_ip; ?></a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_users; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $user; ?>"><?= $text_user; ?></a></li>
								<li><a href="<?= $user_group; ?>"><?= $text_user_group; ?></a></li>
							</ul>
						</li>
						<div class="divider"></div>
						<li><a href="<?= $contact; ?>"><?= $text_contact; ?></a></li>
					</ul>
				</li>
				<li class="dropdown" id="system"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_system; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?= $setting; ?>"><?= $text_setting; ?></a></li>
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_design; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $layout; ?>"><?= $text_layout; ?></a></li>
								<li><a href="<?= $banner; ?>"><?= $text_banner; ?></a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_localization; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $language; ?>"><?= $text_language; ?></a></li>
								<li><a href="<?= $currency; ?>"><?= $text_currency; ?></a></li>
								<li><a href="<?= $stock_status; ?>"><?= $text_stock_status; ?></a></li>
								<li><a href="<?= $order_status; ?>"><?= $text_order_status; ?></a></li>
								<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_return; ?> <b class="fa fa-caret-right"></b></a>
									<ul class="dropdown-menu">
										<li><a href="<?= $return_status; ?>"><?= $text_return_status; ?></a></li>
										<li><a href="<?= $return_action; ?>"><?= $text_return_action; ?></a></li>
										<li><a href="<?= $return_reason; ?>"><?= $text_return_reason; ?></a></li>
									</ul>
								</li>
								<li><a href="<?= $country; ?>"><?= $text_country; ?></a></li>
								<li><a href="<?= $zone; ?>"><?= $text_zone; ?></a></li>
								<li><a href="<?= $geo_zone; ?>"><?= $text_geo_zone; ?></a></li>
								<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_tax; ?> <b class="fa fa-caret-right"></b></a>
									<ul class="dropdown-menu">
										<li><a href="<?= $tax_class; ?>"><?= $text_tax_class; ?></a></li>
										<li><a href="<?= $tax_rate; ?>"><?= $text_tax_rate; ?></a></li>
									</ul>
								</li>
								<li><a href="<?= $length_class; ?>"><?= $text_length_class; ?></a></li>
								<li><a href="<?= $weight_class; ?>"><?= $text_weight_class; ?></a></li>
							</ul>
						</li>
						<li><a href="<?= $error_log; ?>"><?= $text_error_log; ?></a></li>
						<li><a href="<?= $backup; ?>"><?= $text_backup; ?></a></li>
						<li><a href="<?= $testing; ?>"><?= $text_testing; ?></a></li>
					</ul>
				</li>
				<li class="dropdown" id="reports"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_reports; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_sale; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $report_sale_order; ?>"><?= $text_report_sale_order; ?></a></li>
								<li><a href="<?= $report_sale_tax; ?>"><?= $text_report_sale_tax; ?></a></li>
								<li><a href="<?= $report_sale_shipping; ?>"><?= $text_report_sale_shipping; ?></a></li>
								<li><a href="<?= $report_sale_return; ?>"><?= $text_report_sale_return; ?></a></li>
								<li><a href="<?= $report_sale_coupon; ?>"><?= $text_report_sale_coupon; ?></a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_product; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $report_product_viewed; ?>"><?= $text_report_product_viewed; ?></a></li>
								<li><a href="<?= $report_product_purchased; ?>"><?= $text_report_product_purchased; ?></a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_customer; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $report_customer_online; ?>"><?= $text_report_customer_online; ?></a></li>
								<li><a href="<?= $report_customer_order; ?>"><?= $text_report_customer_order; ?></a></li>
								<li><a href="<?= $report_customer_reward; ?>"><?= $text_report_customer_reward; ?></a></li>
								<li><a href="<?= $report_customer_credit; ?>"><?= $text_report_customer_credit; ?></a></li>
							</ul>
						</li>
						<li class="dropdown-submenu"><a class="dropdown-toggle" data-toggle="dropdown"><?= $text_affiliate; ?> <b class="fa fa-caret-right"></b></a>
							<ul class="dropdown-menu">
								<li><a href="<?= $report_affiliate_commission; ?>"><?= $text_report_affiliate_commission; ?></a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown" id="store">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<span class="label label-danger pull-left visible-label"><?= $alerts; ?></span> 
						<i class="fa fa-bell fa-lg visible-label"></i>
						
						<span class="label label-danger pull-right hidden-md hidden-lg"><?= $alerts; ?></span> 
						<span class="hidden-md hidden-lg"><?= $text_alerts; ?></span>
						<b class="caret hidden-md hidden-lg"></b>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-header visible-md visible-lg"><?= $text_order; ?></li>
						<li>
							<a href="<?= $alert_order_status; ?>" style="display: block; overflow: auto;">
								<?= $text_pending_status; ?> <span class="label label-warning pull-right"><?= $order_status_total; ?></span>
							</a>
						</li>
						<li>
							<a href="<?= $alert_complete_status; ?>">
								<?= $text_complete_status; ?> <span class="label label-success pull-right"><?= $complete_status_total; ?></span>
							</a>
						</li>
						<li>
							<a href="<?= $alert_return; ?>">
								<?= $text_return; ?> <span class="label label-danger pull-right"><?= $return_total; ?></span>
							</a>
						</li>
						<li class="divider visible-md visible-lg"></li>
						<li class="dropdown-header visible-md visible-lg"><?= $text_customer; ?></li>
						<?php if ($online_total): ?>
						<li>
							<a href="<?= $alert_online; ?>">
								<?= $text_online; ?> <span class="label label-success pull-right"><?= $online_total; ?></span>
							</a>
						</li>
						<?php endif; ?>
						<li>
							<a href="<?= $alert_customer_approval; ?>">
								<?= $text_approval; ?> <span class="label label-danger pull-right"><?= $customer_total; ?></span>
							</a>
						</li>
						<li class="divider visible-md visible-lg"></li>
						<li class="dropdown-header visible-md visible-lg"><?= $text_product; ?></li>
						<li>
							<a href="">
								<?= $text_stock; ?> <span class="label label-danger pull-right"><?= $product_total; ?>
							</a>
						</li>
						<li>
							<a href="<?= $alert_review; ?>">
								<?= $text_review_approve; ?> <span class="label label-danger pull-right"><?= $review_total; ?></span>
							</a>
						</li>
						<li class="divider visible-md visible-lg"></li>
						<li class="dropdown-header visible-md visible-lg"><?= $text_affiliate; ?></li>
							<li>
							<a href="<?= $alert_affiliate_approval; ?>">
								<?= $text_approval; ?> <span class="label label-danger pull-right"><?= $affiliate_total; ?></span>
							</a>
						</li>
					</ul>
				</li>
				<li class="dropdown" id="help">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-cog fa-lg visible-label"></i>
						<span class="hidden-md hidden-lg"><?= $text_info; ?></span>
						<b class="caret hidden-md hidden-lg"></b>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-header visible-md visible-lg">
							<?= $text_store; ?> <i class="fa fa-shopping-cart"></i>
						</li>
						<li><a href="<?= $store; ?>" target="_blank"><?= $text_front; ?></a></li>
						<?php foreach ($stores as $store) { ?>
						<li><a href="<?= $store['href']; ?>" target="_blank"><?= $store['name']; ?></a></li>
						<?php } ?>
						<li class="divider visible-md visible-lg"></li>
						<li class="dropdown-header visible-md visible-lg"><?= $text_help; ?> <i class="fa fa-question-circle"></i></li>
						<li><a href="http://ocx.io" target="_blank"><?= $text_ocx; ?></a></li>
						<li><a href="http://ocx.io" target="_blank"><?= $text_documentation; ?></a></li>
						<li><a href="http://forum.ocx.io" target="_blank"><?= $text_support; ?></a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-user fa-lg visible-label"></i>
						<span class="hidden-md hidden-lg"><?= $text_setting; ?></span>
						<b class="caret hidden-md hidden-lg"></b>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-header"><?= $logged; ?></li>
						<li><a href="<?= $alert_store_setting; ?>"><?= $text_setting; ?></a></li>
						<li><a href="<?= $logout; ?>"><?= $text_logout; ?></a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php endif; ?>