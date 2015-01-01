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

namespace Front\Controller\Widget;
use Oculus\Engine\Controller;

class Postwall extends Controller {
    public function index($setting) {
        static $widget = 0;
        
        $data = $this->theme->language('widget/postwall');
        
        $this->javascript->register('masonry.min', 'bootstrap.min')->register('imagesloaded.min', 'masonry.min');
        
        $data['heading_title'] = $this->language->get('heading_' . $setting['post_type']);
        
        $data['text_empty'] = sprintf($this->language->get('text_empty'), $setting['post_type']);
        
        $this->theme->model('content/post');
        $this->theme->model('tool/image');
        
        $data['button'] = $setting['button'];
        $data['span'] = $setting['span'];
        
        $data['class_row'] = ($setting['span'] == 1) ? 'slim-row' : 'row';
        
        $class_col = array(1 => 'slim-col-xs-4 slim-col-sm-2 slim-col-md-1', 2 => 'col-xs-6 col-sm-3 col-md-2', 3 => 'col-xs-12 col-sm-4 col-md-3', 4 => 'col-xs-12 col-sm-6 col-md-4', 6 => 'col-xs-12 col-sm-6');
        
        $data['class_col'] = $class_col[$setting['span']];
        
        if (!$setting['height']) {
            $data['class_1'] = 'masonry';
            $data['class_2'] = 'thumbnail';
            $data['class_3'] = '';
        } else {
            $data['class_1'] = 'block';
            $data['class_2'] = 'spacer';
            $data['class_3'] = 'thumbnail';
        }
        
        $key = 'posts.masonry.' . (int)$widget;
        $cachefile = $this->cache->get($key);
        
        if (is_bool($cachefile)) {
            $image_width = 60 + (($setting['span'] - 1) * 100);
            
            $masonry_posts = array();
            
            if ($setting['post_type'] == 'featured') {
                $results = array();
                
                $posts = explode(',', $this->config->get('featured_post'));
                
                if (empty($setting['limit'])) {
                    $setting['limit'] = 5;
                }
                
                $posts = array_slice($posts, 0, (int)$setting['limit']);
                
                foreach ($posts as $post_id) {
                    $post_info = $this->model_content_post->getPost($post_id);
                    
                    if ($post_info) {
                        $results[] = $post_info;
                    }
                }
            } else {
                $results = $this->model_content_post->getPosts(array('sort' => 'p.date_added', 'order' => 'DESC', 'start' => 0, 'limit' => $setting['limit']));
            }
            
            $chars = $setting['span'] * 40;
            
            foreach ($results as $result) {
                if ($result['image'] && file_exists($this->app['path.image'] . $result['image'])) {
                    if ($setting['height'] !== false) {
                        $height = $setting['height'];
                    } else {
                        $size = getimagesize($this->app['path.image'] . $result['image']);
                        
                        $height = ceil(((int)$image_width / $size[0]) * $size[1]);
                    }
                    
                    $image = $this->model_tool_image->resize($result['image'], (int)$image_width, $height, 'h');
                } else {
                    $image = '';
                }
                
                if ($setting['description'] && $result['description']) {
                    $description = $this->formatDescription($result['description'], $chars);
                } else {
                    $description = false;
                }
                
                if ($this->config->get('blog_comment_status') && $setting['span'] > 1) {
                    $rating = $result['rating'];
                } else {
                    $rating = false;
                }
                
                $masonry_posts[] = array('post_id' => $result['post_id'], 'thumb' => $image, 'name' => $result['name'], 'description' => $description, 'rating' => $rating, 'comments' => sprintf($this->language->get('text_comments'), (int)$result['comments']), 'href' => $this->url->link('content/post', 'post_id=' . $result['post_id']),);
            }
            
            $cachefile = $masonry_posts;
            $this->cache->set($key, $cachefile);
        }
        
        $data['posts'] = $cachefile;
        
        $data['widget'] = $widget++;
        
        $data = $this->theme->listen(__CLASS__, __FUNCTION__, $data);
        
        return $this->theme->view('widget/postwall', $data);
    }
    
    protected function formatDescription($description, $chars = 100) {
        $description = preg_replace('/<[^>]+>/i', ' ', html_entity_decode($description, ENT_QUOTES, 'UTF-8'));
        
        $this->theme->listen(__CLASS__, __FUNCTION__);
        
        if ($this->encode->strlen($description) > $chars) {
            return trim($this->encode->substr($description, 0, $chars)) . '...';
        } else {
            return $description;
        }
    }
}
