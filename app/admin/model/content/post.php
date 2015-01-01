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

namespace Admin\Model\Content;
use Oculus\Engine\Model;

class Post extends Model {
    public function addPost($data) {
        $this->db->query("
			INSERT INTO {$this->db->prefix}blog_post 
			SET 
				date_available = '" . $this->db->escape($data['date_available']) . "', 
				author_id = '" . (int)$data['author_id'] . "', 
				status = '" . (int)$data['status'] . "', 
				sort_order = '" . (int)$data['sort_order'] . "', 
				date_added = NOW()
		");
        
        $post_id = $this->db->getLastId();
        
        if (isset($data['image'])) {
            $this->db->query("
				UPDATE {$this->db->prefix}blog_post 
				SET 
					image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' 
				WHERE post_id = '" . (int)$post_id . "'
			");
        }
        
        foreach ($data['post_description'] as $language_id => $value) {
            $this->db->query("
				INSERT INTO {$this->db->prefix}blog_post_description 
				SET 
					post_id = '" . (int)$post_id . "', 
					language_id = '" . (int)$language_id . "', 
					name = '" . $this->db->escape($value['name']) . "', 
					meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', 
					meta_description = '" . $this->db->escape($value['meta_description']) . "', 
					description = '" . $this->db->escape($value['description']) . "', 
					tag = '" . $this->db->escape($value['tag']) . "'
			");
        }
        
        if (isset($data['post_store'])) {
            foreach ($data['post_store'] as $store_id) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_to_store 
					SET 
						post_id = '" . (int)$post_id . "', 
						store_id = '" . (int)$store_id . "'
				");
            }
        }
        
        if (isset($data['post_image'])) {
            foreach ($data['post_image'] as $post_image) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_image 
					SET 
						post_id = '" . (int)$post_id . "', 
						image = '" . $this->db->escape(html_entity_decode($post_image['image'], ENT_QUOTES, 'UTF-8')) . "', 
						sort_order = '" . (int)$post_image['sort_order'] . "'
				");
            }
        }
        
        if (isset($data['post_category'])) {
            foreach ($data['post_category'] as $category_id) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_to_category 
					SET 
						post_id = '" . (int)$post_id . "', 
						category_id = '" . (int)$category_id . "'
				");
            }
        }
        
        if (isset($data['post_related'])) {
            foreach ($data['post_related'] as $related_id) {
                $this->db->query("DELETE FROM {$this->db->prefix}blog_post_related WHERE post_id = '" . (int)$post_id . "' AND related_id = '" . (int)$related_id . "'");
                
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_related 
					SET 
						post_id = '" . (int)$post_id . "', 
						related_id = '" . (int)$related_id . "'
				");
                
                $this->db->query("DELETE FROM {$this->db->prefix}blog_post_related WHERE post_id = '" . (int)$related_id . "' AND related_id = '" . (int)$post_id . "'");
                
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_related 
					SET 
						post_id = '" . (int)$related_id . "', 
						related_id = '" . (int)$post_id . "'
				");
            }
        }
        
        if (isset($data['post_layout'])) {
            foreach ($data['post_layout'] as $store_id => $layout) {
                if ($layout['layout_id']) {
                    $this->db->query("
						INSERT INTO {$this->db->prefix}blog_post_to_layout 
						SET 
							post_id = '" . (int)$post_id . "', 
							store_id = '" . (int)$store_id . "', 
							layout_id = '" . (int)$layout['layout_id'] . "'
					");
                }
            }
        }
        
        if ($data['slug']) {
            $this->db->query("
				INSERT INTO {$this->db->prefix}route 
				SET 
					route = 'content/post', 
					query = 'post_id:" . (int)$post_id . "', 
					slug = '" . $this->db->escape($data['slug']) . "'
			");
        }
        
        $this->cache->delete('post');
        $this->cache->delete('posts');
        $this->cache->delete('author');
        
        $this->theme->trigger('admin_blog_add_post', array('blog_post_id' => $post_id));
    }
    
    public function editPost($post_id, $data) {
        $this->db->query("
			UPDATE {$this->db->prefix}blog_post 
			SET 
				date_available = '" . $this->db->escape($data['date_available']) . "', 
				author_id = '" . (int)$data['author_id'] . "', 
				status = '" . (int)$data['status'] . "', 
				sort_order = '" . (int)$data['sort_order'] . "', 
				date_modified = NOW() 
			WHERE post_id = '" . (int)$post_id . "'
		");
        
        if (isset($data['image'])) {
            $this->db->query("
				UPDATE {$this->db->prefix}blog_post 
				SET 
					image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' 
					WHERE post_id = '" . (int)$post_id . "'
			");
        }
        
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_description WHERE post_id = '" . (int)$post_id . "'");
        
        foreach ($data['post_description'] as $language_id => $value) {
            $this->db->query("
				INSERT INTO {$this->db->prefix}blog_post_description 
				SET 
					post_id = '" . (int)$post_id . "', 
					language_id = '" . (int)$language_id . "', 
					name = '" . $this->db->escape($value['name']) . "', 
					meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', 
					meta_description = '" . $this->db->escape($value['meta_description']) . "', 
					description = '" . $this->db->escape($value['description']) . "', 
					tag = '" . $this->db->escape($value['tag']) . "'
			");
        }
        
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_to_store WHERE post_id = '" . (int)$post_id . "'");
        
        if (isset($data['post_store'])) {
            foreach ($data['post_store'] as $store_id) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_to_store 
					SET 
						post_id = '" . (int)$post_id . "', 
						store_id = '" . (int)$store_id . "'
				");
            }
        }
        
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_image WHERE post_id = '" . (int)$post_id . "'");
        
        if (isset($data['post_image'])) {
            foreach ($data['post_image'] as $post_image) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_image 
					SET 
						post_id = '" . (int)$post_id . "', 
						image = '" . $this->db->escape(html_entity_decode($post_image['image'], ENT_QUOTES, 'UTF-8')) . "', 
						sort_order = '" . (int)$post_image['sort_order'] . "'
				");
            }
        }
        
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_to_category WHERE post_id = '" . (int)$post_id . "'");
        
        if (isset($data['post_category'])) {
            foreach ($data['post_category'] as $category_id) {
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_to_category 
					SET 
						post_id = '" . (int)$post_id . "', 
						category_id = '" . (int)$category_id . "'
				");
            }
        }
        
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_related WHERE post_id = '" . (int)$post_id . "'");
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_related WHERE related_id = '" . (int)$post_id . "'");
        
        if (isset($data['post_related'])) {
            foreach ($data['post_related'] as $related_id) {
                $this->db->query("DELETE FROM {$this->db->prefix}blog_post_related WHERE post_id = '" . (int)$post_id . "' AND related_id = '" . (int)$related_id . "'");
                
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_related 
					SET 
						post_id = '" . (int)$post_id . "', 
						related_id = '" . (int)$related_id . "'
				");
                
                $this->db->query("DELETE FROM {$this->db->prefix}blog_post_related WHERE post_id = '" . (int)$related_id . "' AND related_id = '" . (int)$post_id . "'");
                
                $this->db->query("
					INSERT INTO {$this->db->prefix}blog_post_related 
					SET 
						post_id = '" . (int)$related_id . "', 
						related_id = '" . (int)$post_id . "'
				");
            }
        }
        
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_to_layout WHERE post_id = '" . (int)$post_id . "'");
        
        if (isset($data['post_layout'])) {
            foreach ($data['post_layout'] as $store_id => $layout) {
                if ($layout['layout_id']) {
                    $this->db->query("
						INSERT INTO {$this->db->prefix}blog_post_to_layout 
						SET 
							post_id = '" . (int)$post_id . "', 
							store_id = '" . (int)$store_id . "', 
							layout_id = '" . (int)$layout['layout_id'] . "'
					");
                }
            }
        }
        
        $this->db->query("DELETE FROM {$this->db->prefix}route WHERE query = 'post_id:" . (int)$post_id . "'");
        
        if ($data['slug']) {
            $this->db->query("
				INSERT INTO {$this->db->prefix}route 
				SET 
					route = 'content/post', 
					query = 'post_id:" . (int)$post_id . "', 
					slug = '" . $this->db->escape($data['slug']) . "'
			");
        }
        
        $this->cache->delete('post');
        $this->cache->delete('posts');
        $this->cache->delete('author');
        
        $this->theme->trigger('admin_blog_edit_post', array('blog_post_id' => $post_id));
    }
    
    public function deletePost($post_id) {
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post WHERE post_id = '" . (int)$post_id . "'");
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_description WHERE post_id = '" . (int)$post_id . "'");
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_image WHERE post_id = '" . (int)$post_id . "'");
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_related WHERE post_id = '" . (int)$post_id . "'");
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_related WHERE related_id = '" . (int)$post_id . "'");
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_to_category WHERE post_id = '" . (int)$post_id . "'");
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_to_layout WHERE post_id = '" . (int)$post_id . "'");
        $this->db->query("DELETE FROM {$this->db->prefix}blog_post_to_store WHERE post_id = '" . (int)$post_id . "'");
        $this->db->query("DELETE FROM {$this->db->prefix}blog_comment WHERE post_id = '" . (int)$post_id . "'");
        
        $this->db->query("DELETE FROM {$this->db->prefix}route WHERE query = 'post_id:" . (int)$post_id . "'");
        
        $this->cache->delete('post');
        $this->cache->delete('posts');
        $this->cache->delete('author');
        
        $this->theme->trigger('admin_blog_delete_post', array('blog_post_id' => $post_id));
    }
    
    public function getPost($post_id) {
        $query = $this->db->query("
			SELECT DISTINCT *, 
			(SELECT slug FROM {$this->db->prefix}route WHERE query = 'post_id:" . (int)$post_id . "') AS slug 
			FROM {$this->db->prefix}blog_post p 
			LEFT JOIN {$this->db->prefix}blog_post_description pd 
				ON (p.post_id = pd.post_id) 
			WHERE p.post_id = '" . (int)$post_id . "' 
			AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
		");
        
        return $query->row;
    }
    
    public function getPosts($data = array()) {
        if ($data) {
            $sql = "
				SELECT * 
				FROM {$this->db->prefix}blog_post p 
				LEFT JOIN {$this->db->prefix}blog_post_description pd 
				ON (p.post_id = pd.post_id) ";
            
            if (!empty($data['filter_category_id'])) {
                $sql.= " LEFT JOIN {$this->db->prefix}blog_post_to_category p2c ON (p.post_id = p2c.post_id)";
            }
            
            $sql.= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
            
            if (!empty($data['filter_name'])) {
                $sql.= " AND LCASE(pd.name) LIKE '" . $this->db->escape($this->encode->strtolower($data['filter_name'])) . "%'";
            }
            
            if (!empty($data['filter_author_id'])) {
                $sql.= " AND p.author_id= '" . (int)$data['filter_author_id'] . "'";
            }
            
            if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
                $sql.= " AND p.status = '" . (int)$data['filter_status'] . "'";
            }
            
            if (!empty($data['filter_date_added'])) {
                $sql.= " AND DATE(p.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
            }
            
            if (!empty($data['filter_date_modified'])) {
                $sql.= " AND DATE(p.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
            }
            
            if (!empty($data['filter_category_id'])) {
                if (!empty($data['filter_sub_category'])) {
                    $implode_data = array();
                    
                    $implode_data[] = "category_id = '" . (int)$data['filter_category_id'] . "'";
                    
                    $this->theme->model('content/category');
                    
                    $categories = $this->model_content_category->getCategories($data['filter_category_id']);
                    
                    foreach ($categories as $category) {
                        $implode_data[] = "p2c.category_id = '" . (int)$category['category_id'] . "'";
                    }
                    
                    $sql.= " AND (" . implode(' OR ', $implode_data) . ")";
                } else {
                    $sql.= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
                }
            }
            
            if ($this->user->getGroupId() != $this->config->get('blog_admin_group_id')) {
                $sql.= " AND p.author_id ='" . (int)$this->user->getId() . "'";
            }
            
            $sql.= " GROUP BY p.post_id";
            
            $sort_data = array('pd.name', 'p.author_id', 'p.status', 'p.sort_order');
            
            if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
                $sql.= " ORDER BY {$data['sort']}";
            } else {
                $sql.= " ORDER BY pd.post_id";
            }
            
            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql.= " DESC";
            } else {
                $sql.= " ASC";
            }
            
            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }
                
                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }
                
                $sql.= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
            }
            
            $query = $this->db->query($sql);
            
            return $query->rows;
        } else {
            $post_data = $this->cache->get('post.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'));
            
            if (!$post_data) {
                $sql = "
						SELECT * FROM {$this->db->prefix}blog_post p 
						 LEFT JOIN {$this->db->prefix}blog_post_description pd 
						 	ON (p.post_id = pd.post_id) 
						 WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
                
                if ($this->user->getGroupId() != $this->config->get('blog_admin_group_id')) {
                    $sql.= " AND p.author_id ='" . (int)$this->user->getId() . "'";
                }
                
                $sql.= " ORDER BY pd.name ASC";
                
                $query = $this->db->query($sql);
                
                $post_data = $query->rows;
                
                $this->cache->set('post.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'), $post_data);
            }
            
            return $post_data;
        }
    }
    
    public function getPostsByCategoryId($category_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}blog_post p 
			LEFT JOIN {$this->db->prefix}blog_post_description pd 
				ON (p.post_id = pd.post_id) 
			LEFT JOIN {$this->db->prefix}blog_post_to_category p2c 
				ON (p.post_id = p2c.post_id) 
			WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' 
			AND p2c.category_id = '" . (int)$category_id . "' 
			ORDER BY pd.name ASC
		");
        
        return $query->rows;
    }
    
    public function getPostDescriptions($post_id) {
        $post_description_data = array();
        
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}blog_post_description 
			WHERE post_id = '" . (int)$post_id . "'
		");
        
        foreach ($query->rows as $result) {
            $post_description_data[$result['language_id']] = array('name' => $result['name'], 'description' => $result['description'], 'meta_keyword' => $result['meta_keyword'], 'meta_description' => $result['meta_description'], 'tag' => $result['tag']);
        }
        
        return $post_description_data;
    }
    
    public function getPostAuthor($author_id) {
        $this->theme->model('people/user');
        
        $user_info = $this->model_people_user->getUser($author_id);
        
        return $this->getAuthorNameRelatedToPostedBy($user_info);
    }
    
    public function getAuthors() {
        $authors_data = array();
        
        $this->theme->model('people/user');
        
        $authors = $this->model_people_user->getUsers();
        
        if ($authors) {
            foreach ($authors as $author) {
                $authors_data[] = array('author_id' => $author['user_id'], 'name' => $this->getAuthorNameRelatedToPostedBy($author), 'firstname' => $author['firstname'], 'lastname' => $author['lastname'], 'username' => $author['username']);
            }
        }
        
        return $authors_data;
    }
    
    public function getAuthorNameRelatedToPostedBy($user_info) {
        
        $posted_by = $user_info['firstname'] . ' ' . $user_info['lastname'];
        
        if ($this->config->get('blog_posted_by') == 'firstname lastname') {
            $posted_by = $user_info['firstname'] . ' ' . $user_info['lastname'];
        } elseif ($this->config->get('blog_posted_by') == 'lastname firstname') {
            $posted_by = $user_info['lastname'] . ' ' . $user_info['firstname'];
        } elseif ($this->config->get('blog_posted_by') == 'username') {
            $posted_by = $user_info['username'];
        }
        
        return $posted_by;
    }
    
    public function getPostImages($post_id) {
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}blog_post_image 
			WHERE post_id = '" . (int)$post_id . "'
		");
        
        return $query->rows;
    }
    
    public function getPostStores($post_id) {
        $post_store_data = array();
        
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}blog_post_to_store 
			WHERE post_id = '" . (int)$post_id . "'
		");
        
        foreach ($query->rows as $result) {
            $post_store_data[] = $result['store_id'];
        }
        
        return $post_store_data;
    }
    
    public function getPostLayouts($post_id) {
        $post_layout_data = array();
        
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}blog_post_to_layout 
			WHERE post_id = '" . (int)$post_id . "'
		");
        
        foreach ($query->rows as $result) {
            $post_layout_data[$result['store_id']] = $result['layout_id'];
        }
        
        return $post_layout_data;
    }
    
    public function getPostCategories($post_id) {
        $post_category_data = array();
        
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}blog_post_to_category 
			WHERE post_id = '" . (int)$post_id . "'
		");
        
        foreach ($query->rows as $result) {
            $post_category_data[] = $result['category_id'];
        }
        
        return $post_category_data;
    }
    
    public function getPostCategoriesNames($post_id) {
        $post_category_data = array();
        
        $query = $this->db->query("
			SELECT cd.* 
			FROM {$this->db->prefix}blog_post_to_category p2c 
			LEFT JOIN {$this->db->prefix}blog_category_description cd 
				ON (p2c.category_id = cd.category_id) 
			WHERE p2c.post_id = '" . (int)$post_id . "' 
			AND cd.language_id='" . (int)$this->config->get('config_language_id') . "'
		");
        
        foreach ($query->rows as $result) {
            $post_category_data[] = $result['name'];
        }
        
        return $post_category_data;
    }
    
    public function getPostRelated($post_id) {
        $post_related_data = array();
        
        $query = $this->db->query("
			SELECT * 
			FROM {$this->db->prefix}blog_post_related 
			WHERE post_id = '" . (int)$post_id . "'
		");
        
        foreach ($query->rows as $result) {
            $post_related_data[] = $result['related_id'];
        }
        
        return $post_related_data;
    }
    
    public function getTotalPosts($data = array()) {
        
        $sql = "SELECT COUNT(DISTINCT p.post_id) AS total 
					FROM {$this->db->prefix}blog_post p 
					LEFT JOIN {$this->db->prefix}blog_post_description pd 
					ON (p.post_id = pd.post_id)";
        
        if (!empty($data['filter_category_id'])) {
            $sql.= " LEFT JOIN {$this->db->prefix}blog_post_to_category p2c ON (p.post_id = p2c.post_id)";
        }
        
        $sql.= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
        
        if (!empty($data['filter_name'])) {
            $sql.= " AND LCASE(pd.name) LIKE '" . $this->db->escape($this->encode->strtolower($data['filter_name'])) . "%'";
        }
        
        if (!empty($data['filter_author_id'])) {
            $sql.= " AND p.author_id = '" . (int)$data['filter_author_id'] . "'";
        }
        
        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql.= " AND p.status = '" . (int)$data['filter_status'] . "'";
        }
        
        if (!empty($data['filter_date_added'])) {
            $sql.= " AND DATE(p.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
        }
        
        if (!empty($data['filter_date_modified'])) {
            $sql.= " AND DATE(p.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
        }
        
        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
                $implode_data = array();
                
                $implode_data[] = "p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
                
                $this->theme->model('content/category');
                
                $categories = $this->model_content_category->getCategories($data['filter_category_id']);
                
                foreach ($categories as $category) {
                    $implode_data[] = "p2c.category_id = '" . (int)$category['category_id'] . "'";
                }
                
                $sql.= " AND (" . implode(' OR ', $implode_data) . ")";
            } else {
                $sql.= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
            }
        }
        
        if ($this->user->getGroupId() != $this->config->get('blog_admin_group_id')) {
            $sql.= " AND p.author_id ='" . (int)$this->user->getId() . "'";
        }
        
        $query = $this->db->query($sql);
        
        return $query->row['total'];
    }
    
    public function getTotalPostsByAuthorId($author_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}blog_post 
			WHERE author_id = '" . (int)$author_id . "'
		");
        
        return $query->row['total'];
    }
    
    public function getTotalPostsByLayoutId($layout_id) {
        $query = $this->db->query("
			SELECT COUNT(*) AS total 
			FROM {$this->db->prefix}blog_post_to_layout 
			WHERE layout_id = '" . (int)$layout_id . "'
		");
        
        return $query->row['total'];
    }
}
