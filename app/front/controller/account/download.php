<?php

namespace Front\Controller\Account;
use Oculus\Engine\Controller;

class Download extends Controller {
	public function index() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/download', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$data = $this->theme->language('account/download');

		$this->theme->setTitle($this->language->get('heading_title'));

		$this->breadcrumb->add('text_account', 'account/dashboard', NULL, true, 'SSL');
		$this->breadcrumb->add('text_downloads', 'account/download', NULL, true, 'SSL');

		$this->theme->model('account/download');

		$download_total = $this->model_account_download->getTotalDownloads();

		if ($download_total) {

			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}			

			$data['downloads'] = array();

			$results = $this->model_account_download->getDownloads(($page - 1) * $this->config->get('config_catalog_limit'), $this->config->get('config_catalog_limit'));

			foreach ($results as $result) {
				if (file_exists($this->app['path.download'] . $result['filename'])) {
					$size = filesize($this->app['path.download'] . $result['filename']);

					$i = 0;

					$suffix = array(
						'B',
						'KB',
						'MB',
						'GB',
						'TB',
						'PB',
						'EB',
						'ZB',
						'YB'
					);

					while (($size / 1024) > 1) {
						$size = $size / 1024;
						$i++;
					}

					$data['downloads'][] = array(
						'order_id'   => $result['order_id'],
						'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
						'name'       => $result['name'],
						'remaining'  => $result['remaining'],
						'size'       => round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i],
						'href'       => $this->url->link('account/download/download', 'order_download_id=' . $result['order_download_id'], 'SSL')
					);
				}
			}
			
			$data['pagination'] = $this->theme->paginate(
				$download_total,
				$page,
				$this->config->get('config_catalog_limit'),
				$this->language->get('text_pagination'),
				$this->url->link('account/download', 'page={page}', 'SSL')
			);

			$data['continue'] = $this->url->link('account/dashboard', '', 'SSL');
			
			$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
			
			$this->theme->set_controller('header', 'shop/header');
			$this->theme->set_controller('footer', 'shop/footer');
			
			$data = $this->theme->render_controllers($data);

			$this->response->setOutput($this->theme->view('account/download', $data));			
		} else {

			$data['text_error'] = $this->language->get('text_empty');

			$data['continue'] = $this->url->link('account/dashboard', '', 'SSL');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . '/1.1 404 Not Found');
			
			$data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
			
			$this->theme->set_controller('header', 'shop/header');
			$this->theme->set_controller('footer', 'shop/footer');
			
			$data = $this->theme->render_controllers($data);

			$this->response->setOutput($this->theme->view('error/notfound', $data));
		}
	}

	public function download() {
		if (!$this->customer->isLogged()) {
			$this->session->data['redirect'] = $this->url->link('account/download', '', 'SSL');

			$this->response->redirect($this->url->link('account/login', '', 'SSL'));
		}

		$this->theme->model('account/download');

		if (isset($this->request->get['order_download_id'])) {
			$order_download_id = $this->request->get['order_download_id'];
		} else {
			$order_download_id = 0;
		}

		$download_info = $this->model_account_download->getDownload($order_download_id);

		if ($download_info) {
			$file = $this->app['path.download'] . $download_info['filename'];
			$mask = basename($download_info['mask']);

			if (!headers_sent()) {
				if (file_exists($file)) {
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="' . ($mask ? $mask : basename($file)) . '"');
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));

					if (ob_get_level()) ob_end_clean();
					
					$this->theme->listen(__CLASS__, __FUNCTION__);

					readfile($file, 'rb');

					$this->model_account_download->updateRemaining($this->request->get['order_download_id']);

					exit;
				} else {
					exit('Error: Could not find file ' . $file . '!');
				}
			} else {
				exit('Error: Headers already sent out!');
			}
		} else {
			$this->response->redirect($this->url->link('account/download', '', 'SSL'));
		}
	}
}