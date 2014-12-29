<?php

namespace Front\Controller\Tool;
use Oculus\Engine\Controller;

class Test extends Controller {
	private $routes = array();
	private $categories;
	
	public function index() {
		
		


// below is all for new router

		// $order_id = 31;

		// $query = $this->db->query("
		// 	SELECT * 
		// 	FROM {$this->db->prefix}order_product 
		// 	WHERE order_id = '" . (int)$order_id . "'
		// ");

		// $product_ids = array();

		// foreach($query->rows as $row):
		// 	$product_ids[] = $row['product_id'];
		// endforeach;

		// $this->customer->processMembership($product_ids);

		// unset($product_ids);
		// exit;

		// $this->routes = $this->app['routes'];

		// $this->link('account/address/edit', 'path=' . '0_2' . '&address_id=' . 1 . '&my_thing=' . 254 . '&my_other_thing=' . 555, 'SSL');

		//$this->link('account/address/update', 'address_id=' . 1, 'SSL');

// Manufacturer: WORKS		
// [route_id] => 793
// [route] => catalog/manufacturer/info
// [query] => manufacturer_id:6
// [slug] => palm
// 
// Pages Works both in and out of
// [route_id] => 775
// [route] => content/page
// [query] => page_id:6
// [slug] => delivery-information

		//$this->link('catalog/manufacturer/info', 'manufacturer_id=' . 6, 'SSL');
		//$this->link('content/page/info', 'page_id=' . 6);
		//$this->link('catalog/category', 'path=' . '18_45' . '&sort=p.sort_order&order=ASC');
		//$this->link('content/category', 'bpath=' . '1' . '&sort=p.sort_order&order=ASC');
		//$this->link('catalog/product', 'product_id=' . '44');
		//$this->link('content/post', 'post_id=' . '1');
	}


	public function map_user($user_id) {
		$query = $this->db->query("
			SELECT c.customer_id AS customer_id 
			FROM {$this->db->prefix}customer c 
			LEFT JOIN {$this->db->prefix}wp_users u 
			ON(c.username = u.user_nicename) 
			WHERE u.ID = '" . (int)$user_id . "'");

		if ($query->num_rows)
			return $query->row['customer_id'];
	}

	private function rip_tags($string) { 
	
		// ----- remove HTML TAGs ----- 
		$string = preg_replace ('/<[^>]*>/', ' ', $string); 
		
		// ----- remove control characters ----- 
		$string = str_replace("\r", '', $string);    // --- replace with empty space
		$string = str_replace("\n", ' ', $string);   // --- replace with space
		$string = str_replace("\t", ' ', $string);   // --- replace with space
		
		// ----- remove multiple spaces ----- 
		$string = trim(preg_replace('/ {2,}/', ' ', $string));
		
		return $string; 
	
	}

	public function autop($pee, $br = true) {
		$pre_tags = array();

		if ( trim($pee) === '' )
			return '';

		$pee = $pee . "\n"; // just to make things a little easier, pad the end

		if ( strpos($pee, '<pre') !== false ) {
			$pee_parts = explode( '</pre>', $pee );
			$last_pee = array_pop($pee_parts);
			$pee = '';
			$i = 0;

			foreach ( $pee_parts as $pee_part ) {
				$start = strpos($pee_part, '<pre');

				// Malformed html?
				if ( $start === false ) {
					$pee .= $pee_part;
					continue;
				}

				$name = "<pre wp-pre-tag-$i></pre>";
				$pre_tags[$name] = substr( $pee_part, $start ) . '</pre>';

				$pee .= substr( $pee_part, 0, $start ) . $name;
				$i++;
			}

			$pee .= $last_pee;
		}

		$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
		// Space things out a little
		$allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|details|menu|summary)';
		$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
		$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
		$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines

		if ( strpos( $pee, '<option' ) !== false ) {
			// no P/BR around option
			$pee = preg_replace( '|\s*<option|', '<option', $pee );
			$pee = preg_replace( '|</option>\s*|', '</option>', $pee );
		}

		if ( strpos( $pee, '</object>' ) !== false ) {
			// no P/BR around param and embed
			$pee = preg_replace( '|(<object[^>]*>)\s*|', '$1', $pee );
			$pee = preg_replace( '|\s*</object>|', '</object>', $pee );
			$pee = preg_replace( '%\s*(</?(?:param|embed)[^>]*>)\s*%', '$1', $pee );
		}

		if ( strpos( $pee, '<source' ) !== false || strpos( $pee, '<track' ) !== false ) {
			// no P/BR around source and track
			$pee = preg_replace( '%([<\[](?:audio|video)[^>\]]*[>\]])\s*%', '$1', $pee );
			$pee = preg_replace( '%\s*([<\[]/(?:audio|video)[>\]])%', '$1', $pee );
			$pee = preg_replace( '%\s*(<(?:source|track)[^>]*>)\s*%', '$1', $pee );
		}

		$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
		// make paragraphs, including one at the end
		$pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
		$pee = '';

		foreach ( $pees as $tinkle ) {
			$pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
		}

		$pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
		$pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
		$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
		$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
		$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);

		if ( $br ) {
			$pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', function( $matches ) {
				return str_replace("\n", "<WPPreserveNewline />", $matches[0]);
			}, $pee);
			$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
			$pee = str_replace('<WPPreserveNewline />', "\n", $pee);
		}

		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
		$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
		$pee = preg_replace( "|\n</p>$|", '</p>', $pee );

		if ( !empty($pre_tags) )
			$pee = str_replace(array_keys($pre_tags), array_values($pre_tags), $pee);

		return $pee;
	}



	public function link ($route, $args = '', $secure = false) {
		$link = array();

		if ($secure):
			$url = $this->app['https.server'];
		else:
			$url = $this->app['http.server'];
		endif;
		
		// we need to trim our route
		$routes = explode('/', $route);
		unset($route);

		$method = false;

		if (count($routes) > 2):
			$method = array_pop($routes);
		endif;

		$route = implode('/', $routes);
		unset($routes);
		
		// The builder array holds the elements of our url
		$builder = array();

		// Not all passed in links will contain categories
		// but for those that do we want to store them in
		// an array so we can keep thm in order and rewrite
		
		$categories = array();

		if ($args):
			$arguments = explode('&', $args);
			
			// we're going to loop through each 
			// part separately so that we don't make any
			// errors and keep the writer flexible

			if (array_key_exists($route, $this->routes)):
				$route_array = $this->routes[$route];
			elseif (array_key_exists($route . '/' . $method, $this->routes)):
				$route_array = $this->routes[$route . '/' . $method];
			endif;

			// let's add our method back into the route
			if ($method) $route = $route . '/' . $method;
			
			/**
			 * sets categories for shop ad blog categories
			 */
			foreach($arguments as $i => $arg):
				$key   = strstr($arg, '=', true);
				$value = str_replace($key . '=', '', $arg);
				if ($key == 'path'):
					$this->construct_categories($value, 'category', $route);
					unset($arguments[$i]);
				endif;
				if ($key == 'bpath'):
					$this->construct_categories($value, 'blog_category', $route);
					unset($arguments[$i]);
				endif;
				
				if (!$this->config->get('config_top_level')):
					switch ($key):
						case 'post_id':
							$this->build_blog_category_paths($value);
							break;
						case 'product_id':
							$this->build_category_paths($value);
							break;
					endswitch;
				endif;
			endforeach;			
			
			if(!empty($this->categories)):
				foreach($this->categories as $category):
					$builder[] = $category;
				endforeach;
				unset($this->categories);
			endif;

			foreach($arguments as $i => $arg):
				$item = str_replace('=', ':', $arg);
				foreach($route_array as $rt):
					if ($rt['query'] == $item):
						$builder[] = ($this->config->get('config_ucfirst')) ? $this->url->cap_slug($rt['slug']) : $rt['slug'];
						unset($arguments[$i]);
					endif;
				endforeach;
			endforeach;

			if (!empty($arguments)):
				foreach($arguments as $argument):
					$builder[] = str_replace('=', '/' , $argument);
				endforeach;
			endif;

			$url .= implode('/', $builder);
		else:
			// we have no arguments, just pass the route
			$url .= $route;	
		endif;

		$this->theme->test($url);

		//$this->decode($route);
	}

	private function decode($route) {
		//$args = array();
		$args = parse_url($route);
		
	}

	private function construct_categories($string, $type, $route) {
		$paths = explode('_', $string);
		foreach($paths as $path):
			$category = $type . '_id:' . $path;
			foreach($this->routes[$route] as $item):
				if (in_array($category, $item)):
					$this->categories[] = ($this->config->get('config_ucfirst')) ? $this->url->cap_slug($item['slug']) : $item['slug'];
				endif;
			endforeach;
		endforeach;
	}

	private function build_category_paths ($product_id) {
		$this->theme->model('catalog/product');
		
		$category_id = $this->model_catalog_product->getProductParentCategory($product_id);	
		$path = $category_id;
		$categories = $this->model_catalog_product->getCategories ($product_id);
		
		foreach ($categories as $category):
			if ($category['category_id'] != $category_id):
				$path .= '_' . (int)$category['category_id'];
			endif;
		endforeach;
		
		return $this->construct_categories($path, 'category', 'catalog/category');
	}

	private function build_blog_category_paths ($post_id) {
		$this->theme->model('content/post');
		
		$category_id = $this->model_content_post->getPostParentCategory($post_id);	
		$path = $category_id;
		$categories = $this->model_content_post->getCategories ($post_id);
		
		foreach ($categories as $category):
			if ($category['category_id'] != $category_id):
				$path .= '_' . (int)$category['category_id'];
			endif;
		endforeach;
		
		return $this->construct_categories($path, 'blog_category', 'content/category');
	}
}