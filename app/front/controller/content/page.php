<?php

namespace Front\Controller\Content;
use Oculus\Engine\Controller;
 
class Page extends Controller {
	public function index() {  
		$data = $this->theme->language('content/page');

		$this->theme->model('content/page');

		if (isset($this->request->get['page_id'])) {
			$page_id = (int)$this->request->get['page_id'];
		} else {
			$page_id = 0;
		}

		$page_info = $this->model_content_page->getPage($page_id);

		if ($page_info) {
			$this->theme->setTitle($page_info['title']);
			$this->theme->setDescription($page_info['meta_description']);
			$this->theme->setKeywords($page_info['meta_keywords']);

			$this->theme->setOgType('article');
			$this->theme->setOgDescription(html_entity_decode($page_info['description'], ENT_QUOTES, 'UTF-8'));
			
			$this->breadcrumb->add($page_info['title'], 'content/page', 'page_id=' .  $page_id);
			
			$data['heading_title'] = $page_info['title'];

			$data['description'] = html_entity_decode($page_info['description'], ENT_QUOTES, 'UTF-8');

			$data['continue'] = $this->url->link('content/home');
			
			$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
			
			$data = $this->theme->render_controllers($data);

			$this->response->setOutput($this->theme->view('content/page', $data));
		} else {
			$this->breadcrumb->add('text_error', 'content/page', 'page_id=' . $page_id);
			
			$this->theme->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['continue'] = $this->url->link('content/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . '/1.1 404 Not Found');
			
			$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
			
			$data = $this->theme->render_controllers($data);

			$this->response->setOutput($this->theme->view('error/notfound', $data));
		}
	}

	public function info() {
		$this->theme->model('content/page');

		if (isset($this->request->get['page_id'])) {
			$page_id = (int)$this->request->get['page_id'];
		} else {
			$page_id = 0;
		}      

		$page_info = $this->model_content_page->getPage($page_id);

		if ($page_info) {
			$output  = '<html dir="ltr" lang="en">' . "\n";
			$output .= '<head>' . "\n";
			$output .= '  <title>' . $page_info['title'] . '</title>' . "\n";
			$output .= '  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">' . "\n";
			$output .= '  <meta name="robots" content="noindex">' . "\n";
			$output .= '</head>' . "\n";
			$output .= '<body>' . "\n";
			$output .= html_entity_decode($page_info['description'], ENT_QUOTES, 'UTF-8') . "\n";
			$output .= '  </body>' . "\n";
			$output .= '</html>' . "\n";
			
			$this->theme->listen(__CLASS__, __FUNCTION__);			

			$this->response->setOutput($output);
		}
	}
}
