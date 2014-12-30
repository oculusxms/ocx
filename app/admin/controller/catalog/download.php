<?php

namespace Admin\Controller\Catalog;
use Oculus\Engine\Controller;

class Download extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('catalog/download');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->theme->model('catalog/download');
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getList();
	}

	public function insert() {
		$this->language->load('catalog/download');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->theme->model('catalog/download');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_download->addDownload($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/download', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getForm();
	}

	public function update() {
		$this->language->load('catalog/download');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->theme->model('catalog/download');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_download->editDownload($this->request->get['download_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/download', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/download');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->theme->model('catalog/download');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $download_id) {
				$this->model_catalog_download->deleteDownload($download_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('catalog/download', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		$this->getList();
	}

	protected function getList() {
		$data = $this->theme->language('catalog/download');
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'dd.name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->breadcrumb->add('heading_title', 'catalog/download', $url);
		
		$data['insert'] = $this->url->link('catalog/download/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/download/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['downloads'] = array();

		$filter = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$download_total = $this->model_catalog_download->getTotalDownloads();

		$results = $this->model_catalog_download->getDownloads($filter);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/download/update', 'token=' . $this->session->data['token'] . '&download_id=' . $result['download_id'] . $url, 'SSL')
			);

			$data['downloads'][] = array(
				'download_id' => $result['download_id'],
				'name'        => $result['name'],
				'remaining'   => $result['remaining'],
				'selected'    => isset($this->request->post['selected']) && in_array($result['download_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] 		= $this->url->link('catalog/download', 'token=' . $this->session->data['token'] . '&sort=dd.name' . $url, 'SSL');
		$data['sort_remaining'] = $this->url->link('catalog/download', 'token=' . $this->session->data['token'] . '&sort=d.remaining' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$data['pagination'] = $this->theme->paginate(
			$download_total,
			$page,
			$this->config->get('config_admin_limit'),
			$this->language->get('text_pagination'),
			$this->url->link('catalog/download', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL')
		);

		$data['sort']  = $sort;
		$data['order'] = $order;
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('catalog/download_list', $data));
	}

	protected function getForm() {
		$data = $this->theme->language('catalog/download');

		$this->javascript->register('ajaxupload.min', 'typeahead.min');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['filename'])) {
			$data['error_filename'] = $this->error['filename'];
		} else {
			$data['error_filename'] = '';
		}

		if (isset($this->error['mask'])) {
			$data['error_mask'] = $this->error['mask'];
		} else {
			$data['error_mask'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->breadcrumb->add('heading_title', 'catalog/download', $url);
		
		if (!isset($this->request->get['download_id'])) {
			$data['action'] = $this->url->link('catalog/download/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/download/update', 'token=' . $this->session->data['token'] . '&download_id=' . $this->request->get['download_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/download', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->theme->model('localization/language');

		$data['languages'] = $this->model_localization_language->getLanguages();

		if (isset($this->request->get['download_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$download_info = $this->model_catalog_download->getDownload($this->request->get['download_id']);
		}

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['download_id'])) {
			$data['download_id'] = $this->request->get['download_id'];
		} else {
			$data['download_id'] = 0;
		}

		if (isset($this->request->post['download_description'])) {
			$data['download_description'] = $this->request->post['download_description'];
		} elseif (isset($this->request->get['download_id'])) {
			$data['download_description'] = $this->model_catalog_download->getDownloadDescriptions($this->request->get['download_id']);
		} else {
			$data['download_description'] = array();
		}

		if (isset($this->request->post['filename'])) {
			$data['filename'] = $this->request->post['filename'];
		} elseif (!empty($download_info)) {
			$data['filename'] = $download_info['filename'];
		} else {
			$data['filename'] = '';
		}

		if (isset($this->request->post['mask'])) {
			$data['mask'] = $this->request->post['mask'];
		} elseif (!empty($download_info)) {
			$data['mask'] = $download_info['mask'];
		} else {
			$data['mask'] = '';
		}

		if (isset($this->request->post['remaining'])) {
			$data['remaining'] = $this->request->post['remaining'];
		} elseif (!empty($download_info)) {
			$data['remaining'] = $download_info['remaining'];
		} else {
			$data['remaining'] = 1;
		}

		if (isset($this->request->post['update'])) {
			$data['update'] = $this->request->post['update'];
		} else {
			$data['update'] = false;
		}

		$this->theme->loadjs('javascript/catalog/download_form', $data);
		
		$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);

		$data = $this->theme->render_controllers($data);

		$this->response->setOutput($this->theme->view('catalog/download_form', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/download')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['download_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 64)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if ((utf8_strlen($this->request->post['filename']) < 3) || (utf8_strlen($this->request->post['filename']) > 128)) {
			$this->error['filename'] = $this->language->get('error_filename');
		}

		if (!file_exists($this->app['path.download'] . $this->request->post['filename']) && !is_file($this->app['path.download'] . $this->request->post['filename'])) {
			$this->error['filename'] = $this->language->get('error_exists');
		}

		if ((utf8_strlen($this->request->post['mask']) < 3) || (utf8_strlen($this->request->post['mask']) > 128)) {
			$this->error['mask'] = $this->language->get('error_mask');
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/download')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->theme->model('catalog/product');

		foreach ($this->request->post['selected'] as $download_id) {
			$product_total = $this->model_catalog_product->getTotalProductsByDownloadId($download_id);

			if ($product_total) {
				$this->error['warning'] = sprintf($this->language->get('error_product'), $product_total);
			}
		}
		
		$this->theme->listen(__CLASS__, __FUNCTION__);

		return !$this->error;
	}

	public function upload() {
		$this->language->load('sale/order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'catalog/download')) {
			$json['error'] = $this->language->get('error_permission');
		}

		if (!isset($json['error'])) {
			if (!empty($this->request->files['file']['name'])) {
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}

				// Allowed file extension types
				$allowed = array();

				$filetypes = explode("\n", str_replace(array("\r\n", "\r"), "\n", $this->config->get('config_file_extension_allowed')));

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Allowed file mime types
				$allowed = array();

				$filetypes = explode("\n", str_replace(array("\r\n", "\r"), "\n", $this->config->get('config_file_mime_allowed')));

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array($this->request->files['file']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
			} else {
				$json['error'] = $this->language->get('error_upload');
			}
		}

		if (!isset($json['error'])) {
			if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
				$ext = md5(mt_rand());

				$json['filename'] = $filename . '.' . $ext;
				$json['mask'] = $filename;

				move_uploaded_file($this->request->files['file']['tmp_name'], $this->app['path.download'] . $filename . '.' . $ext);
			}

			$json['success'] = $this->language->get('text_upload');
		}
		
		$json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);

		$this->response->setOutput(json_encode($json));
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->theme->model('catalog/download');

			$filter = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);

			$results = $this->model_catalog_download->getDownloads($filter);

			foreach ($results as $result) {
				$json[] = array(
					'download_id' => $result['download_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);
		
		$json = $this->theme->listen(__CLASS__, __FUNCTION__, $json);

		$this->response->setOutput(json_encode($json));
	}
}