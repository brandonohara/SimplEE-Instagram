<?php
	class Instagram_User extends EE_Object {
		
		public $id;
		public $username;
		public $full_name;
		public $picture;
		
		//only in some feeds
		public $bio;
		public $website;
		
		//only in user_info()
		public $media_count;
		public $follows;
		public $followers;
		
		function __construct($json){
			$this->id = $json->id;
			$this->username = $json->username;
			$this->full_name = $json->full_name;
			$this->picture = $json->profile_picture;
			
			$this->bio = isset($json->bio) ? $json->bio : "";
			$this->website = isset($json->website) ? $json->website : "";
			
			if(isset($json->counts)){
				$this->media_count = isset($json->counts->media) ? $json->counts->media : '';
				$this->follows = isset($json->counts->follows) ? $json->counts->follows : '';
				$this->followers = isset($json->counts->followed_by) ? $json->counts->followed_by : '';
			}
		}
	}