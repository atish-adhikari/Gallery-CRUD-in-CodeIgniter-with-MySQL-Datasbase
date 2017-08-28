<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Mgallery');
        $this->PageLimit = 20;
        $this->load->library('UploadHandler');
      }

    public function index(){
    	$data = array (
                'albums'    => $this->Mgallery->GetAlbumList(),
                'title'    => 'Albums'
            );
        $this->load->view('index', $data);
      }

	public function album($param='null',$id='null') {

        if( $this->input->post('process') == 'true' ) {
            if($this->Mgallery->Save()) {
            	echo "Success";
                // $this->session->set_flashdata('_flash_msg', array(
                //     '_css_cls'  => 'success',
                //     '_message'  => intval($param)?'Successfully updated.':'Successfully added.'
                //     )); 
            }
            else {
            	echo "error";
                // $this->session->set_flashdata('_flash_msg', array(
                //     '_css_cls'  => 'error',
                //     '_message'  => 'Could not be updated. There seems to be some problem on server. Try again shortly.'
                //     ));
            }
            redirect( base_url() , 'refresh');
            exit();
        }

        if(isset($param) && is_numeric($param)) { 
            $data_content   =  array(
                'title'   => 'View Album',
                'record' => $this->Mgallery->GetAlbumDetails($param),
                'picturelist'   => $this->Mgallery->GetPictureList($param)
                );
            $this->load->view('index', $data_content);
        }                 
        elseif(isset($param) && $param=="create") {  
          $data = array (
                'title'    => 'Add/Edit Album'
            );
          $this->load->view('index', $data);
        }
        elseif(isset($param) && $param=="edit" && is_numeric($id)) {  
          $data_content = array (
                'title'    => 'Add/Edit Album',
                'picturelist' => $this->Mgallery->GetPictureList($id),
                'record' => $this->Mgallery->GetAlbumDetails($id)
            );
          $this->load->view('index', $data_content);
        }
        elseif(isset($param) && $param=="deactivate" && is_numeric($id)) {
            $this->deactivate($id);
            redirect(base_url(), 'refresh');
        }
        else{
        	redirect(base_url(), 'refresh');
        }
    }

    function deactivate($id) {
       $this->Mgallery->Deactivate($id);
       return true;
    }    

	public function do_upload() {
        $upload_path_url = base_url() . 'uploads/gallery/';

        $config['upload_path'] = './uploads/gallery';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '30000';

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
            //$error = array('error' => $this->upload->display_errors());
            //$this->load->view('upload', $error);

            //Load the list of existing files in the upload directory
            $existingFiles = get_dir_file_info($config['upload_path']);
            $foundFiles = array();
            $f=0;
            foreach ($existingFiles as $fileName => $info) {
              if($fileName!='thumbs'){//Skip over thumbs directory
                //set the data for the json array   
                $foundFiles[$f]['name'] = $fileName;
                $foundFiles[$f]['size'] = $info['size'];
                $foundFiles[$f]['url'] = $upload_path_url . $fileName;
                $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
                $foundFiles[$f]['deleteUrl'] = base_url() . 'albums/deleteImage/' . $fileName;
                $foundFiles[$f]['deleteType'] = 'DELETE';
                $foundFiles[$f]['error'] = null;
                
                $f++;
              }
            }
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('files' => $foundFiles)));
        } else {
            $data = $this->upload->data();
            /*
             * Array
              (
              [file_name] => png1.jpg
              [file_type] => image/jpeg
              [file_path] => /home/ipresupu/public_html/uploads/
              [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
              [raw_name] => png1
              [orig_name] => png.jpg
              [client_name] => png.jpg
              [file_ext] => .jpg
              [file_size] => 456.93
              [is_image] => 1
              [image_width] => 1198
              [image_height] => 1166
              [image_type] => jpeg
              [image_size_str] => width="1198" height="1166"
              )
             */
            // to re-size for thumbnail images un-comment and set path here and in json array
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = TRUE;
            $config['new_image'] = $data['file_path'] . 'thumbs/';
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] = '';
            $config['width'] = 75;
            $config['height'] = 50;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            
            //set the data for the json array
            $info = new StdClass;
            $info->name = $data['file_name'];
            $info->size = $data['file_size'] * 1024;
            $info->type = $data['file_type'];
            $info->url = $upload_path_url . $data['file_name'];
            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
            $info->deleteUrl = base_url() . 'albums/deleteImage/' . $data['file_name'];
            $info->deleteType = 'DELETE';
            $info->error = null;

            $files[] = $info;
            //this is why we put this in the constants to pass only json data
            if ($this->input->is_ajax_request()) {
                echo json_encode(array("files" => $files));
                //this has to be the only data returned or you will get an error.
                //if you don't give this a json array it will give you a Empty file upload result error
                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                // so that this will still work if javascript is not enabled
            } else {
                $file_data['upload_data'] = $this->upload->data();
            }
        }
    }

    public function deleteImage($file) {//gets the job done but you might want to add error checking and security
        $success = unlink(FCPATH . 'uploads/gallery/' . $file);
        $success = unlink(FCPATH . 'uploads/gallery/thumbs/' . $file);
        //info to see if it is doing what it is supposed to
    	$info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'uploads/gallery/' . $file;
        $info->file = is_file(FCPATH . 'uploads/gallery' . $file);

        if ($this->input->is_ajax_request()) {
            //I don't think it matters if this is set but good for error checking in the console/firebug
            echo json_encode(array($info));
        } else {
            //here you will need to decide what you want to show for a successful delete        
            $file_data['delete_data'] = $file;
        }
    }
}

