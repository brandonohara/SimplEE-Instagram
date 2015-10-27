<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	require_once(PATH_THIRD."simplee_instagram/config.php");

	class SimpleeInstagram {
		public $get = array();
		public $client_id = null;
		
		public $plugin_name = "SimplEE Instagram";
    
		public function __construct(){
			$this->client_id = (ee()->TMPL->fetch_param('client_id') != "" ? ee()->TMPL->fetch_param('client_id') : INSTAGRAM_DEVELOPER_ID);
		
    		if($this->client_id == "")
    			ee()->output->show_user_error('general', $this->plugin_name.": Must enter Instagram client id in system/third_party/simplee_instagram/config.php");
		}
		
		function comments(){
			$id = (ee()->TMPL->fetch_param("id") != "" ? ee()->TMPL->fetch_param("id") : NULL);
			if(!$id)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Post ID to recieve comments");
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			
			$this->get['count'] = $limit;
			$url = $this->instagram_url("media/".$id."/comments");
			
			$comments = $this->get_posts($url, !$reverse, "Instagram_Comment");
			
			if (count($comments) == 0)
		        return ee()->TMPL->no_results();
		        
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $comments);
		}
    

		function hash(){
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$hash = (ee()->TMPL->fetch_param("hash") != "" ? ee()->TMPL->fetch_param("hash") : NULL);
			if(!$hash)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Hash");
			
			$this->get['count'] = $limit;
			$url = $this->instagram_url("tags/".$hash."/media/recent");
			$posts = $this->get_posts($url, $reverse);
			
			if (count($posts) == 0)
		        return ee()->TMPL->no_results();
			
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $posts);
		}
		
		function likes(){
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$id = (ee()->TMPL->fetch_param("id") != "" ? ee()->TMPL->fetch_param("id") : NULL);
			if(!$id)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Post ID");
			
			$this->get['count'] = $limit;
			$url = $this->instagram_url("media/".$id."/likes");
			$users = $this->get_posts($url, $reverse, "Instagram_User");
			
			if (count($users) == 0)
		        return ee()->TMPL->no_results();
			
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $users);
		}
		
		function location(){
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$location = (intval(ee()->TMPL->fetch_param("id")) > 0 ? intval(ee()->TMPL->fetch_param("id")) : NULL);
			if(!$location)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Location ID, not the name of the location.");
			
			$this->get['count'] = $limit;
			$url = $this->instagram_url("locations/".$location."/media/recent");
			$posts = $this->get_posts($url, $reverse);
			
			if (count($posts) == 0)
		        return ee()->TMPL->no_results();
			
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $posts);
		}
		
		function post(){
			$id = (ee()->TMPL->fetch_param("id") != "" ? ee()->TMPL->fetch_param("id") : NULL);
			if(!$id)ee()->output->show_user_error('general', $this->plugin_name.": Must Specify Post ID");
			
			$url = $this->instagram_url("media/".$id);
			$data = json_decode(file_get_contents($url));
			$post = new Instagram_Post($data->data);
			
			return ee()->TMPL->parse_variables_row(ee()->TMPL->tagdata, $post->get_array());
		}
		
		function user(){
			$reverse = (ee()->TMPL->fetch_param('reverse') == "yes" ? TRUE : FALSE);
			$limit = (ee()->TMPL->fetch_param("limit") != "" ? intval(ee()->TMPL->fetch_param("limit")) : 25);
			$user = $this->get_user_id();
			
			$this->get['count'] = $limit;
			$url = $this->instagram_url("users/".$user."/media/recent/");
			$posts = $this->get_posts($url, $reverse);
			
			if (count($posts) == 0)
		        return ee()->TMPL->no_results();
			
			return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $posts);
		}
		
		function user_info(){
			$id = $this->get_user_id();
			$url = $this->instagram_url("users/".$id);
			
			$data = json_decode(file_get_contents($url));
			$user = new Instagram_User($data->data);
		        
			return ee()->TMPL->parse_variables_row(ee()->TMPL->tagdata, $user->get_array());
		}
		
		private function instagram_url($segment, $get = NULL){
			$get = isset($get) ? $get : $this->get;
			$get['client_id'] = $this->client_id;
			$base = "https://api.instagram.com/v1/".$segment;
			return $base."?".http_build_query($get);
		}
		
		private function get_user_id(){
			$user_id = (ee()->TMPL->fetch_param("user_id") != "" ? ee()->TMPL->fetch_param("user_id") : NULL);
			$username = (ee()->TMPL->fetch_param("username") != "" ? ee()->TMPL->fetch_param("username") : NULL);
			
			if($user_id && intval($user_id) > 0)
				return $user_id;
			else if($username){
			
				//check for user_id in cache
				$cache_file = PATH_THIRD."simplee_instagram/usernames.txt";
				if(!file_exists($cache_file)){
					$f = fopen($cache_file, "w");
					fclose($f);
				}
					
				$f = fopen($cache_file, "r");
				while (!feof($f)) {
					$arr = explode("|", fgets($f));
					if($arr[0] == $username)
						return intval(trim($arr[1]));
				}
				fclose($f);
				
				$get = array();
				$get['q'] = $username;
				$get['count'] = 1;
				$url = $this->instagram_url("users/search", $get);
				$data = json_decode(file_get_contents($url));
				
				if(count($data->data) == 0)
					return ee()->output->show_user_error('general', $this->plugin_name.": Could not find a user with username: ".$username);
					
				foreach($data->data as $user){
					$line = $username."|".$user->id.PHP_EOL;
					file_put_contents($cache_file, $line, FILE_APPEND);
					return $user->id;
				}
			} else
				return ee()->output->show_user_error('general', $this->plugin_name.": Must Specify User ID or Username.");
		}
		
		private function get_posts($url, $reverse = FALSE, $classname = "Instagram_Post"){
			$arr = array();
			$data = json_decode(file_get_contents($url));
			
			$count = 0;
			foreach($data->data as $item){
				$item = new $classname($item);
				$item->count = ++$count;
				array_push($arr, $item->get_array());
			}
			if($reverse)
				$arr = array_reverse($arr);
			
			return $arr;
		}
	}