<?php

namespace Front\Model\Content;
use Oculus\Engine\Model;

class Author extends Model {
	public function getPostAuthor($author_id){
		$key = 'author.' . $author_id;
		$cachefile = $this->cache->get($key);

		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT * 
				FROM {$this->db->prefix}user 
				WHERE user_id = '" . (int)$author_id . "' LIMIT 0,1
			");
			
			if ($query->num_rows):
				$cachefile = $this->getAuthorNameRelatedToPostedBy($query->row);
				$this->cache->set($key, $cachefile);
			else:
				$cachefile = '';
			endif;
		endif;
		
		return $cachefile;
	}
	
	public function getAuthorNameRelatedToPostedBy($user_info){
		$posted_by = $user_info['firstname'] . ' ' . $user_info['lastname'];
		
		if ($this->config->get('blog_posted_by') == 'firstname lastname'):
			$posted_by = $user_info['firstname'] . ' ' . $user_info['lastname'];
		elseif ($this->config->get('blog_posted_by') == 'lastname firstname'):
			$posted_by = $user_info['lastname'] . ' ' . $user_info['firstname'];
		elseif ($this->config->get('blog_posted_by') == 'username'):
			$posted_by = $user_info['username'];
		endif; 
		
		return $posted_by;
	}
	
	public function getTotalPostsByAuthorId($author_id) {
		$key = 'author.total.' . $author_id;
		$cachefile = $this->cache->get($key);

		if (is_bool($cachefile)):
			$query = $this->db->query("
				SELECT COUNT(*) AS total 
				FROM {$this->db->prefix}blog_post 
				WHERE author_id = '" . (int)$author_id . "' 
				AND status=1
			");

			$cachefile = $query->row['total'];
			$this->cache->set($cachefile);
		endif;

		return $cachefile;
	}
}