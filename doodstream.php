<?php
/*
	Doodstream.com API library PHP
	PHP verison should be atleast 5.5 to use the library
*/

class DoodstreamAPI {
	private $api_key = '';
	
	public function Setup($api_key) {
		$this->api_key = $api_key;
	}
	
	/**
	 * Get basic info of your account
	 * @param No parameters required
	 */
	public function AccountInfo() {
		return $this->api_call('account', 'info', array());
	}

	/**
	 * Get report of your account (default last 7 days)
	 * @param (Optional) last - Last x days report
	 */
	public function AccountReport($last = NULL) {	
		$req = array(
			'last' => $last
		);
		return $this->api_call('account', 'stats', $req);
	}

    /**
	 * Get DMCA reported files list (500 results per page)
	 * @param No parameters required
	 */
	public function DMCAList() {
		return $this->api_call('dmca', 'list', array());
	}

    /**
	 * Upload Local File to DoodSteam 
	 * @param (Required) tempfile - Location of the file's temporary location on the server, called using $_FILES['video']['tmp_name']
	 * @param (Required) type - Video Extention, called using $_FILES['video']['type'] 
	 * @param (Required) name - Name you want to save the video with, needs to full name with extention for example :- Video1.mp4
	 */
	public function Upload($tempfile, $type, $name) {
		$upload = $this->api_call('upload', 'server', array());
		$json  = json_decode($upload, true);
        return $this->post_call($tempfile, $type, $name, $json["result"]);
	}

    /**
	 * Copy / Clone your's or other's file
	 * @param (Required) file_code - File code of the video you want to copy
     * @param (Optional) fld_id - Folder ID to store inside
	 */
	public function Copy($file_code, $fld_id = NULL) {	
		$req = array(
			'file_code' => $file_code,
			'fld_id' => $fld_id
		);
		return $this->api_call('file', 'clone', $req);
	}

    /**
	 * Remote Upload an file using it's direct url (This functions adds the url to the Remote Upload queue of the account)
	 * @param (Required) url - URL to remote upload
     * @param (Optional) new_title - Set a custom video title
	 */
	public function RUpload($url, $new_title = NULL) {	
		$req = array(
			'url' => $url,
			'new_title' => $new_title
		);
		return $this->api_call('upload', 'url', $req);
	}

    /**
	 * Remote Upload URLs List & Status
	 * @param No parameters required
	 */
	public function RUploadList() {
		return $this->api_call('urlupload', 'list', array());
	}

    /**
	 * Remote Upload File Status
	 * @param (Required) file_code - File code of the file in Remote Upload Queue
	 */
	public function RUploadStatus($fld_id = NULL) {	
		$req = array(
			'file_code' => $file_code
		);
		return $this->api_call('urlupload', 'status', $req);
	}    

    /**
	 * Get total & used remote upload slots
	 * @param No parameters required
	 */
	public function RUploadSlots() {
		return $this->api_call('urlupload', 'slots', array());
	}	

    /**
	 * Restart Errors In Remote Upload List/Queue
	 * @param No parameters required
	 */
	public function RestartErrors() {	
		$req = array(
			'restart_errors' => '1'
		);
		return $this->api_call('urlupload', 'actions', $req);
	}

    /**
	 * Clear All Errors In Remote Upload List/Queue
	 * @param No parameters required
	 */
	public function ClearErrors() {	
		$req = array(
			'clear_errors' => '1'
		);
		return $this->api_call('urlupload', 'actions', $req);
	}    

    /**
	 * Clear All Pending Files In Remote Upload List/Queue
	 * @param No parameters required
	 */
	public function ClearAll() {	
		$req = array(
			'clear_all' => '1'
		);
		return $this->api_call('urlupload', 'actions', $req);
	}    

    /**
	 * Remove a Specific File from Remote Upload List/Queue
	 * @param (Required) file_code - File code to be removed from Remote Upload List/Queue
	 */
	public function DeleteCode($file_code) {	
		$req = array(
			'delete_code' => $file_code
		);
		return $this->api_call('urlupload', 'actions', $req);
	} 

    /**
	 * Create a folder
	 * @param (Required) name - Name of the folder to be created
	 * @param (Optional) parent_id - Parent folder ID
	 */
	public function CreateFolder($name, $parent_id = NULL) {	
		$req = array(
			'name' => $name,
			'parent_id' => $parent_id
		);
		return $this->api_call('folder', 'create', $req);
	} 

    /**
	 * Rename a folder
	 * @param (Required) fld_id - Folder ID
	 * @param (Required) name - New name of the folder
	 */
	public function RenameFolder($fld_id, $name) {	
		$req = array(
			'fld_id' => $fld_id,
			'name' => $name
		);
		return $this->api_call('folder', 'rename', $req);
	} 



     /**
	 * Get List of Videos Uploaded with info- 
	 * @param (Required) page - Pagination , page number from which results have to shown (1 for the most recent uploads; Ascending Order followed)
	 * @param (Required) per_page - Max videos per page (Cannot be more than 200)
	 * @param (Optional) fld_id - Show videos inside a specific folder 
	 */
	public function List($page, $per_page, $fld_id = NULL) {	
		$req = array(
			'page' => $page,
			'per_page' => $per_page,
			'fld_id' => $fld_id
		);
		return $this->api_call('file', 'list', $req);
	} 

     /**
	 * Check status of an uploaded file
	 * @param (Required) file_code - File Code
	 */
	public function FileStatus($file_code) {	
		$req = array(
			'file_code' => $file_code
		);
		return $this->api_call('file', 'check', $req);
	} 

     /**
	 * Get File Info
	 * @param (Required) file_code - File Code
	 */
	public function FileInfo($file_code) {	
		$req = array(
			'file_code' => $file_code
		);
		return $this->api_call('file', 'info', $req);
	} 

     /**
	 * Get file splash, single or thumbnail image
	 * @param (Required) file_code - File Code
	 */
	public function FileImage($file_code) {	
		$req = array(
			'file_code' => $file_code
		);
		return $this->api_call('file', 'image', $req);
	} 

     /**
	 * Get file splash, single or thumbnail image
	 * @param (Required) file_code - File Code
	 * @param (Required) name - New File Name
	 */
	public function FileRename($file_code, $name) {	
		$req = array(
			'file_code' => $file_code,
			'title' => $name
		);
		return $this->api_call('file', 'rename', $req);
	} 

     /**
	 * Search your files
	 * @param (Required) search_term - Search term
	 */
	public function Search($search_term) {	
		$req = array(
			'search_term' => $search_term
		);
		return $this->api_call('search', 'videos', $req);
	} 


	private function is_setup() {
		return (!empty($this->api_key));
	}
	

	//GET methods call

	private function api_call($path, $cmd, $req = array()) {
		if (!$this->is_setup()) {
			return array('error' => 'You have not called the Setup function with your api key!');
		}
		
		$req['key'] = $this->api_key;
	    
		// Generate the query string
		$urldata = http_build_query($req, '', '&');
	    $url = "https://doodapi.com/api/". $path ."/". $cmd ."?" . $urldata;
		// cURL request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    
		$data = curl_exec($ch);                
		if ($data !== FALSE) {
            return $data;
		} else {
			return array('error' => 'cURL error: '.curl_error($ch));
		}
		$path = null;
		$cmd = null;
		$req = null;
	}

    //Post call for file uploading

	private function post_call($tempfile, $type, $name, $uploadurl) {
		if (!$this->is_setup()) {
			return array('error' => 'You have not called the Setup function with your api key!');
		} 
        
        $key = $this->api_key;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $uploadurl . '?' . $key);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, 1);
	    
	    $post = array(
        'api_key' => "$key",
        'file' => curl_file_create($tempfile, $type, $name)
        );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

		$data = curl_exec($ch);                
		if ($data !== FALSE) {
            return $data;
		} else {
			return array('error' => 'cURL error: '.curl_error($ch));
		}
	}
};

