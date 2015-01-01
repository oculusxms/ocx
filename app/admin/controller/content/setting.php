<?php

/*
|--------------------------------------------------------------------------
|   Oculus XMS
|--------------------------------------------------------------------------
|
|   This file is part of the Oculus XMS Framework package.
|	
|	(c) Vince Kronlein <vince@ocx.io>
|	
|	For the full copyright and license information, please view the LICENSE
|	file that was distributed with this source code.
|	
*/

namespace Admin\Controller\Content;
use Oculus\Engine\Controller;

class Setting extends Controller {
    private $error = array();
    
    public function index() {
        $data = $this->theme->language('content/setting');
        
        $this->theme->setTitle($this->language->get('doc_title'));
        $this->theme->model('setting/setting');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('blog', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            
            $this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        
        if (isset($this->error['name'])) {
            $data['error_name'] = $this->error['name'];
        } else {
            $data['error_name'] = '';
        }
        
        if (isset($this->error['title'])) {
            $data['error_title'] = $this->error['title'];
        } else {
            $data['error_title'] = '';
        }
        
        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
        }
        
        if (isset($this->error['image_thumb'])) {
            $data['error_image_thumb'] = $this->error['image_thumb'];
        } else {
            $data['error_image_thumb'] = '';
        }
        
        if (isset($this->error['image_popup'])) {
            $data['error_image_popup'] = $this->error['image_popup'];
        } else {
            $data['error_image_popup'] = '';
        }
        
        if (isset($this->error['image_post'])) {
            $data['error_image_post'] = $this->error['image_post'];
        } else {
            $data['error_image_post'] = '';
        }
        
        if (isset($this->error['image_additional'])) {
            $data['error_image_additional'] = $this->error['image_additional'];
        } else {
            $data['error_image_additional'] = '';
        }
        
        if (isset($this->error['image_related'])) {
            $data['error_image_related'] = $this->error['image_related'];
        } else {
            $data['error_image_related'] = '';
        }
        
        if (isset($this->error['blog_limit'])) {
            $data['error_blog_limit'] = $this->error['blog_limit'];
        } else {
            $data['error_blog_limit'] = '';
        }
        
        if (isset($this->error['blog_posted_by'])) {
            $data['error_blog_posted_by'] = $this->error['blog_posted_by'];
        } else {
            $data['error_blog_posted_by'] = '';
        }
        
        if (isset($this->error['blog_admin_group_id'])) {
            $data['error_blog_admin_group_id'] = $this->error['blog_admin_group_id'];
        } else {
            $data['error_blog_admin_group_id'] = '';
        }
        
        if (isset($this->error['blog_author_group_id'])) {
            $data['error_blog_author_group_id'] = $this->error['blog_author_group_id'];
        } else {
            $data['error_blog_author_group_id'] = '';
        }
        
        $this->breadcrumb->add('heading_title', 'content/setting');
        
        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }
        
        $data['action'] = $this->url->link('content/setting', 'token=' . $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
        
        $data['token'] = $this->session->data['token'];
        
        if (isset($this->request->post['blog_name'])) {
            $data['blog_name'] = $this->request->post['blog_name'];
        } else {
            $data['blog_name'] = $this->config->get('blog_name');
        }
        
        if (isset($this->request->post['blog_title'])) {
            $data['blog_title'] = $this->request->post['blog_title'];
        } else {
            $data['blog_title'] = $this->config->get('blog_title');
        }
        
        if (isset($this->request->post['blog_meta_description'])) {
            $data['blog_meta_description'] = $this->request->post['blog_meta_description'];
        } else {
            $data['blog_meta_description'] = $this->config->get('blog_meta_description');
        }
        
        if (isset($this->request->post['blog_email'])) {
            $data['blog_email'] = $this->request->post['blog_email'];
        } else {
            $data['blog_email'] = $this->config->get('blog_email');
        }
        
        if (isset($this->request->post['blog_limit'])) {
            $data['blog_limit'] = $this->request->post['blog_limit'];
        } else {
            $data['blog_limit'] = $this->config->get('blog_limit');
        }
        
        if (isset($this->request->post['blog_posted_by'])) {
            $data['blog_posted_by'] = $this->request->post['blog_posted_by'];
        } else {
            $data['blog_posted_by'] = $this->config->get('blog_posted_by');
        }
        
        if (isset($this->request->post['blog_comment_status'])) {
            $data['blog_comment_status'] = $this->request->post['blog_comment_status'];
        } else {
            $data['blog_comment_status'] = $this->config->get('blog_comment_status');
        }
        
        if (isset($this->request->post['blog_comment_logged'])) {
            $data['blog_comment_logged'] = $this->request->post['blog_comment_logged'];
        } else {
            $data['blog_comment_logged'] = $this->config->get('blog_comment_logged');
        }
        
        if (isset($this->request->post['blog_comment_require_approve'])) {
            $data['blog_comment_require_approve'] = $this->request->post['blog_comment_require_approve'];
        } else {
            $data['blog_comment_require_approve'] = $this->config->get('blog_comment_require_approve');
        }
        
        if (isset($this->request->post['blog_admin_group_id'])) {
            $data['blog_admin_group_id'] = $this->request->post['blog_admin_group_id'];
        } else {
            $data['blog_admin_group_id'] = $this->config->get('blog_admin_group_id');
        }
        
        if (isset($this->request->post['blog_author_group_id'])) {
            $data['blog_author_group_id'] = $this->request->post['blog_author_group_id'];
        } else {
            $data['blog_author_group_id'] = $this->config->get('blog_author_group_id');
        }
        
        $this->theme->model('tool/image');
        
        if (isset($this->request->post['blog_logo'])) {
            $data['blog_logo'] = $this->request->post['blog_logo'];
        } else {
            $data['blog_logo'] = $this->config->get('blog_logo');
        }
        
        if ($this->config->get('blog_logo') && file_exists($this->app['path.image'] . $this->config->get('blog_logo')) && is_file($this->app['path.image'] . $this->config->get('blog_logo'))) {
            $data['logo'] = $this->model_tool_image->resize($this->config->get('blog_logo'), 100, 100);
        } else {
            $data['logo'] = $this->model_tool_image->resize('placeholder.png', 100, 100);
        }
        
        if (isset($this->request->post['blog_icon'])) {
            $data['blog_icon'] = $this->request->post['blog_icon'];
        } else {
            $data['blog_icon'] = $this->config->get('blog_icon');
        }
        
        if ($this->config->get('blog_icon') && file_exists($this->app['path.image'] . $this->config->get('blog_icon')) && is_file($this->app['path.image'] . $this->config->get('blog_icon'))) {
            $data['icon'] = $this->model_tool_image->resize($this->config->get('blog_icon'), 100, 100);
        } else {
            $data['icon'] = $this->model_tool_image->resize('placeholder.png', 100, 100);
        }
        
        $data['no_image'] = $this->model_tool_image->resize('placeholder.png', 100, 100);
        
        if (isset($this->request->post['blog_image_thumb_width'])) {
            $data['blog_image_thumb_width'] = $this->request->post['blog_image_thumb_width'];
        } else {
            $data['blog_image_thumb_width'] = $this->config->get('blog_image_thumb_width');
        }
        
        if (isset($this->request->post['blog_image_thumb_height'])) {
            $data['blog_image_thumb_height'] = $this->request->post['blog_image_thumb_height'];
        } else {
            $data['blog_image_thumb_height'] = $this->config->get('blog_image_thumb_height');
        }
        
        if (isset($this->request->post['blog_image_popup_width'])) {
            $data['blog_image_popup_width'] = $this->request->post['blog_image_popup_width'];
        } else {
            $data['blog_image_popup_width'] = $this->config->get('blog_image_popup_width');
        }
        
        if (isset($this->request->post['blog_image_popup_height'])) {
            $data['blog_image_popup_height'] = $this->request->post['blog_image_popup_height'];
        } else {
            $data['blog_image_popup_height'] = $this->config->get('blog_image_popup_height');
        }
        
        if (isset($this->request->post['blog_image_post_width'])) {
            $data['blog_image_post_width'] = $this->request->post['blog_image_post_width'];
        } else {
            $data['blog_image_post_width'] = $this->config->get('blog_image_post_width');
        }
        
        if (isset($this->request->post['blog_image_post_height'])) {
            $data['blog_image_post_height'] = $this->request->post['blog_image_post_height'];
        } else {
            $data['blog_image_post_height'] = $this->config->get('blog_image_post_height');
        }
        
        if (isset($this->request->post['blog_image_additional_width'])) {
            $data['blog_image_additional_width'] = $this->request->post['blog_image_additional_width'];
        } else {
            $data['blog_image_additional_width'] = $this->config->get('blog_image_additional_width');
        }
        
        if (isset($this->request->post['blog_image_additional_height'])) {
            $data['blog_image_additional_height'] = $this->request->post['blog_image_additional_height'];
        } else {
            $data['blog_image_additional_height'] = $this->config->get('blog_image_additional_height');
        }
        
        if (isset($this->request->post['blog_image_related_width'])) {
            $data['blog_image_related_width'] = $this->request->post['blog_image_related_width'];
        } else {
            $data['blog_image_related_width'] = $this->config->get('blog_image_related_width');
        }
        
        if (isset($this->request->post['blog_image_related_height'])) {
            $data['blog_image_related_height'] = $this->request->post['blog_image_related_height'];
        } else {
            $data['blog_image_related_height'] = $this->config->get('blog_image_related_height');
        }
        
        $this->theme->model('people/user_group');
        
        $data['user_groups'] = $this->model_people_user_group->getUserGroups();
        
        $this->theme->model('people/customergroup');
        
        $data['customer_groups'] = $this->model_people_customergroup->getCustomerGroups();
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('content/setting', $data));
    }
    
    private function validate() {
        if (!$this->user->hasPermission('modify', 'content/setting')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if (!$this->request->post['blog_name']) {
            $this->error['name'] = $this->language->get('error_name');
        }
        
        if (!$this->request->post['blog_title']) {
            $this->error['title'] = $this->language->get('error_title');
        }
        
        if (($this->encode->strlen($this->request->post['blog_email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['blog_email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }
        
        if (!$this->request->post['blog_image_thumb_width'] || !$this->request->post['blog_image_thumb_height']) {
            $this->error['image_thumb'] = $this->language->get('error_image_thumb');
        }
        
        if (!$this->request->post['blog_image_popup_width'] || !$this->request->post['blog_image_popup_height']) {
            $this->error['image_popup'] = $this->language->get('error_image_popup');
        }
        
        if (!$this->request->post['blog_image_post_width'] || !$this->request->post['blog_image_post_height']) {
            $this->error['image_post'] = $this->language->get('error_image_post');
        }
        
        if (!$this->request->post['blog_image_additional_width'] || !$this->request->post['blog_image_additional_height']) {
            $this->error['image_additional'] = $this->language->get('error_image_additional');
        }
        
        if (!$this->request->post['blog_image_related_width'] || !$this->request->post['blog_image_related_height']) {
            $this->error['image_related'] = $this->language->get('error_image_related');
        }
        
        if (!$this->request->post['blog_limit']) {
            $this->error['blog_limit'] = $this->language->get('error_limit');
        }
        
        if ($this->encode->strlen($this->request->post['blog_posted_by']) == 0) {
            $this->error['blog_posted_by'] = $this->language->get('error_posted_by');
        }
        
        if ($this->encode->strlen($this->request->post['blog_admin_group_id']) == 0) {
            $this->error['blog_admin_group_id'] = $this->language->get('error_admin_group_id');
        }
        
        if ($this->encode->strlen($this->request->post['blog_author_group_id']) == 0) {
            $this->error['blog_author_group_id'] = $this->language->get('error_author_group_id');
        }
        
        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        return !$this->error;
    }
}
