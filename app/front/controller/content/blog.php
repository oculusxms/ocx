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

namespace Front\Controller\Content;
use Oculus\Engine\Controller;

class Blog extends Controller {

    public function index() {
        $data = $this->theme->language('content/home');
        
        $this->theme->setTitle($this->config->get('config_name'));
        $this->theme->setDescription($this->config->get('config_meta_description'));
        
        $this->theme->setOgType('article');
        $this->theme->setOgDescription(html_entity_decode($this->config->get('config_meta_description'), ENT_QUOTES, 'UTF-8'));
        
        $this->breadcrumb->add(sprintf($this->language->get('lang_heading_title'), $this->config->get('config_name')), 'content/home');
        
        $this->theme->model('content/post');
        $this->theme->model('content/category');
        
        if (isset($this->request->get['sort'])):
            $sort = $this->request->get['sort'];
        else:
            $sort = 'p.date_added';
        endif;
        
        if (isset($this->request->get['order'])):
            $order = $this->request->get['order'];
        else:
            $order = 'DESC';
        endif;
        
        if (isset($this->request->get['page'])):
            $page = $this->request->get['page'];
        else:
            $page = 1;
        endif;
        
        if (isset($this->request->get['limit'])):
            $limit = $this->request->get['limit'];
        else:
            $limit = $this->config->get('config_catalog_limit');
        endif;
        
        $post_total = $this->model_content_post->getTotalPosts();
        $posts = $this->model_content_post->getPosts();
        
        $data['posts'] = array();
        
        foreach ($posts as $post):
            if ($post['image']):
                $image = IMAGE_URL . $post['image'];
                // remove resizing and allow img-responsive to handle sizing
            else:
                $image = '';
            endif;
                
            if ($this->config->get('blog_comment_status')):
                $rating = (int)$post['rating'];
            else:
                $rating = false;
            endif;
                
            $categories = $this->model_content_category->getCategoriesByPostId($post['post_id']);
            
            $posted_in = array();
            $posted_in_categories = '';
            
            if ($categories):
                foreach ($categories as $category):
                    $posted_in[] = sprintf($this->language->get('lang_text_posted_categories'), $category['href'], $category['name']);
                endforeach;
            endif;
            
            if (!empty($posted_in)):
                $posted_in_categories = implode(", ", $posted_in);
            endif;
            
            $comment_text = ($post['comments'] == 1) ? rtrim($this->language->get('lang_text_comments'), 's') : $this->language->get('lang_text_comments');
            
            $data['posts'][] = array('post_id' => $post['post_id'], 'author_name' => $post['author_name'], 'thumb' => $image, 'name' => $post['name'], 'short' => $this->encode->substr(strip_tags(html_entity_decode($post['description'], ENT_QUOTES, 'UTF-8')), 0, 450) . '..', 'blurb' => $this->encode->substr(strip_tags(html_entity_decode($post['description'], ENT_QUOTES, 'UTF-8')), 0, 200) . '..', 'rating' => $rating, 'views' => sprintf($this->language->get('lang_text_views'), (int)$post['viewed']), 'comments' => sprintf($comment_text, (int)$post['comments']), 'href' => $this->url->link('content/post', 'post_id=' . $post['post_id']), 'comments_href' => $this->url->link('content/post', 'post_id=' . $post['post_id'] . '&to_comments=1'), 'author_href' => $this->url->link('content/search', '&filter_author_id=' . $post['author_id']), 'date_added' => date($this->language->get('lang_post_date'), strtotime($post['date_added'])), 'categories' => $posted_in_categories);
        endforeach;
            
        $url = '';
        
        if (isset($this->request->get['sort'])):
            $url.= '&sort=' . $this->request->get['sort'];
        endif;
        
        if (isset($this->request->get['order'])):
            $url.= '&order=' . $this->request->get['order'];
        endif;
        
        if (isset($this->request->get['limit'])):
            $url.= '&limit=' . $this->request->get['limit'];
        endif;
        
        $data['pagination'] = $this->theme->paginate($post_total, $page, $limit, $this->language->get('lang_text_pagination'), $this->url->link('content/home', $url . '&page={page}'));
        
        $data['sort'] = $sort;
        $data['order'] = $order;
        $data['limit'] = $limit;
        
        // Search
        if (isset($this->request->get['filter_name'])):
            $data['filter_name'] = $this->request->get['filter_name'];
        else:
            $data['filter_name'] = '';
        endif;
            
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        $data = $this->theme->render_controllers($data);
        
        $this->response->setOutput($this->theme->view('content/home', $data));
    }
}
