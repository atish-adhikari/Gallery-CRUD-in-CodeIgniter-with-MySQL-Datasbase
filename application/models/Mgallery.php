<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mgallery extends CI_Model{

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->gallery_table_name   = 'album';
        $this->pictures_table_name   = 'album_pictures';
        $this->primary_key  = 'id';
        $this->data = $this->db->get($this->gallery_table_name)->result();

        $config['upload_path'] = realpath( APPPATH . '../uploads/gallery/');
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']    = 102400;
        $config['max_width']  = 30720;
        $config['max_height']  = 10240;
		$this->load->library('upload', $config);
    }

    function SetDetails() {
        if($_FILES['Featured']['size'] > 0){
			$File = $_FILES['Featured'];
			$_FILES['Featured']['name']= $File['name'];
	        $_FILES['Featured']['type']    = $File['type'];
	        $_FILES['Featured']['tmp_name'] = $File['tmp_name'];
	        $_FILES['Featured']['error']       = $File['error'];
	        $_FILES['Featured']['size']    = $File['size']; 

	        if(!$this->upload->do_upload('Featured')){
					$errors = $this->upload->display_errors();
					echo 'Error Uploading Image';
					echo $errors;
				} else {
					$document_data = $this->upload->data();
	                $image_prefix   = $this->generate_code(10);
	                $new_image_name = $image_prefix . $document_data['file_ext'];
	                rename($document_data['full_path'], $document_data['file_path'].$new_image_name);
	                // update image data
	                $document_data['full_path']    = $document_data['file_path'].$new_image_name;
	                $document_data['file_name']    = $new_image_name;
				}
            }
            $new_image_name = !empty($document_data['file_name'])?$document_data['file_name']:$_POST['featured_file'];

        $this->data   = array(
                'title'           => $this->input->post('Title'),
                'featured'                => $new_image_name
        );
    }

    function SetPictures() {  
    	$images = array();
        if(isset($_POST['img_name']) && count($_POST['img_name']) > 0 ){
        	foreach($_POST['img_name'] as $key=>$val){ 
        	    $val2 = $_POST['img_title'][$key]; 
        	    $images[$key]['name'] = $val; 
        	    $images[$key]['title'] = $val2; 
        	}
        }   
    	 return $images;
    }

    function Save() {
    	$this->SetDetails();
        if($this->input->post($this->primary_key) && intval($this->input->post($this->primary_key)) && $this->input->post($this->primary_key) > 0) {
            $ID = $this->input->post($this->primary_key);
            $this->db->where($this->primary_key,$this->input->post($this->primary_key));
            $this->db->update($this->gallery_table_name,$this->data);
            $images = $this->SetPictures();
            if(count($images) >0 ){
            $this->db->where('album_id', $ID )->delete($this->pictures_table_name);
            foreach ($images as $key => $value) {
            	$this->data1 = array(
            		'album_id' => $ID,
            		'title' => $value['title'],
            		'image' => $value['name']
            		);
                $this->db->insert($this->pictures_table_name,$this->data1);
                }
            }
        	return $this->db->insert_id();
        }
        $this->data['created_on']=date('Y-m-d');          
        $this->db->insert($this->gallery_table_name,$this->data);
        $insert_id = $this->db->insert_id();
        $images = $this->SetPictures();
        if(count($images) >0 ){
            foreach ($images as $key => $value) {
            	$this->data1 = array(
            		'album_id' => $insert_id,
            		'title' => $value['title'],
            		'image' => $value['name']
            		);
            $this->db->insert($this->pictures_table_name,$this->data1);
            }
        }    
        return $this->db->insert_id();
    }

    function Deactivate($id) {
       $this->db->where('ID', $id);
       $this->db->delete($this->gallery_table_name ); 
    }

    function GetPictureList($id){
        $sql="SELECT id, title, image FROM ".$this->pictures_table_name." WHERE album_id =".$id;
        $result = $this->db->query($sql)->result();
        return $result;
    }    
    function GetAlbumDetails($id){
        $sql="SELECT id, title, featured FROM ".$this->gallery_table_name." WHERE ".$this->primary_key."=".$id;
        $result = $this->db->query($sql)->row();
        return $result;
    }    
    function GetAlbumList(){
        return $this->data;
    }

    function generate_code($length = 10) {
                if ($length <= 0) return false;
                $code = "";
                $today = date('ymdhis');
                $chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
                srand((double)microtime() * 1000000);
                for ($i = 0; $i < $length; $i++) {
                    $code = $code . substr($chars, rand() % strlen($chars), 1);
                }
                return $code.$today;
            }		
    }
