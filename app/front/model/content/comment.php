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

namespace Front\Model\Content;
use Oculus\Engine\Model;

class Comment extends Model {
    public function addComment($post_id, $data) {
        $website = (isset($data['website'])) ? $data['website'] : '';
        
        $sql = "INSERT INTO {$this->db->prefix}blog_comment 
				SET 
					author = '" . $this->db->escape($data['name']) . "', 
					customer_id = '" . (int)$this->customer->getId() . "', 
					email = '" . $this->db->escape($data['email']) . "', 
					website = '" . $this->db->escape($website) . "', 
					post_id = '" . (int)$post_id . "', 
					text = '" . $this->db->escape($data['text']) . "', 
					rating = '" . (int)$data['rating'] . "', 
					date_added = NOW()";
        
        if (!$this->config->get('blog_comment_require_approve')) {
            $sql.= ", status = 1";
        }
        
        $this->db->query($sql);
        
        $comment_id = $this->db->getLastId();
        
        if (!$this->config->get('blog_comment_require_approve')):
            $this->theme->trigger('comment_add_approved', array('comment_id' => $comment_id));
        else:
            $this->theme->trigger('comment_add_unapproved', array('comment_id' => $comment_id));
        endif;
    }
    
    public function getCommentsByPostId($post_id, $start = 0, $limit = 20) {
        if ($start < 0) {
            $start = 0;
        }
        
        if ($limit < 1) {
            $limit = 20;
        }
        
        $key = 'post.comments.by.post.id.' . $post_id . '.' . $start . '.' . $limit;
        $cachefile = $this->cache->get($key);
        
        if (is_bool($cachefile)):
            $query = $this->db->query("
			SELECT 
				c.comment_id, 
				c.author, 
				c.email, 
				c.website, 
				c.rating, 
				c.text, 
				p.post_id, 
				pd.name, 
				p.image, 
				c.date_added 
			FROM {$this->db->prefix}blog_comment c 
			LEFT JOIN {$this->db->prefix}blog_post p 
				ON (c.post_id = p.post_id) 
			LEFT JOIN {$this->db->prefix}blog_post_description pd 
				ON (p.post_id = pd.post_id) 
			WHERE p.post_id = '" . (int)$post_id . "' 
			AND p.date_available <= NOW() 
			AND p.status = '1' 
			AND c.status = '1' 
			AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
			ORDER BY c.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);
            
            if ($query->num_rows):
                $cachefile = $query->rows;
                $this->cache->set($key, $cachefile);
            else:
                $this->cache->set($key, array());
                return array();
            endif;
        endif;
        
        return $cachefile;
    }
    
    public function getAverageRating($post_id) {
        $key = 'post.average.rating.' . $post_id;
        $cachefile = $this->cache->get($key);
        
        if (is_bool($cachefile)):
            $query = $this->db->query("
				SELECT AVG(rating) AS total 
				FROM {$this->db->prefix}blog_comment 
				WHERE status = '1' 
				AND post_id = '" . (int)$post_id . "' 
				GROUP BY post_id
			");
            
            if (isset($query->row['total'])):
                $cachefile = (int)$query->row['total'];
                $this->cache->set($key, $cachefile);
            else:
                $cachefile = 0;
                $this->cache->set($key, $cachefile);
            endif;
        endif;
        
        return $cachefile;
    }
    
    public function getTotalComments() {
        $key = 'posts.comments.total';
        $cachefile = $this->cache->get($key);
        
        if (is_bool($cachefile)):
            $query = $this->db->query("
				SELECT COUNT(*) AS total 
				FROM {$this->db->prefix}blog_comment c 
				LEFT JOIN {$this->db->prefix}blog_post p 
				ON (c.post_id = p.post_id) 
				WHERE p.date_available <= NOW() 
				AND p.status = '1' 
				AND c.status = '1'
			");
            
            $cachefile = $query->row['total'];
            $this->cache->set($key, $cachefile);
        endif;
        
        return $cachefile;
    }
    
    public function getTotalCommentsByPostId($post_id) {
        $key = 'post.comment.total.by.post.id.' . $post_id;
        $cachefile = $this->cache->get($key);
        
        if (is_bool($cachefile)):
            $query = $this->db->query("
				SELECT COUNT(*) AS total 
				FROM {$this->db->prefix}blog_comment c 
				LEFT JOIN {$this->db->prefix}blog_post p 
					ON (c.post_id = p.post_id) 
				LEFT JOIN {$this->db->prefix}blog_post_description pd 
					ON (p.post_id = pd.post_id) 
				WHERE p.post_id = '" . (int)$post_id . "' 
				AND p.date_available <= NOW() 
				AND p.status = '1' 
				AND c.status = '1' 
				AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
			");
            
            $cachefile = $query->row['total'];
            $this->cache->set($key, (int)$cachefile);
        endif;
        
        return $cachefile;
    }
}
