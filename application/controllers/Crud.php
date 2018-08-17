<?php

	class Crud extends CI_Controller{

		public function index(){

			// echo "<pre>";
			// print_r($this);
			// echo "</pre>";


			// error_reporting(0);
			$this->load->view('index');
		}
		public function show(){
			//echo "test";
			$this->load->model('crud_model');
			$result=$this->crud_model->selectData();
			//print_r($result);

			$this->load->view('show_view', array("xyz"=>$result));
		}
		public function action_page(){
			//print_r($_POST);
			//$this->load->library('form_validation');
			$this->form_validation->set_rules('uemail','EMAILID','trim|required|valid_email|is_unique[users.uemail]');
			$this->form_validation->set_rules('upass','PASSWORD','trim|required|min_length[4]|max_length[12]|alpha_numeric');


			if($this->form_validation->run() == FALSE){
				//echo "error";
				$this->load->view('index.php');

			}
			else{
				echo "ok";
				$_POST['upass']= do_hash($_POST['upass']);
				print_r($_POST);
				$this->load->model('crud_model');
				if($this->crud_model->insertData($_POST)){
					//echo "Record Added";
					redirect(base_url('index.php/crud/show'));
				}
			}
		}

		function deleteData($id){

			$this->load->model('crud_model');
			if($this->crud_model->deleterecord($id))
			{
				redirect(base_url('index.php/crud/show'));
			}
		}

		function editData($id){

			//echo "$id";
			$this->session->set_userdata("userid",$id);
			$this->load->model('crud_model');
			$response=$this->crud_model->editrecord($id);

			if(is_array($response)){
				print_r($response);

				$this->load->view('edit_view',array("xyz"=>$response[0]));
			}

		}

		function action_update(){
			//print_r($_POST);
			$this->load->model('crud_model');
			$id = $this->session->userdata("userid");
			$this->crud_model->updateRecord($_POST['uemail'],$id);

			redirect(base_url('index.php/crud/show'));
		}


		public function action_page1(){
			//print_r($_POST);
			//exit;
			//$this->load->library('form_validation');
			$this->form_validation->set_rules('uemail','EMAILID','trim|required|valid_email|is_unique[users.uemail]');
			$this->form_validation->set_rules('upass','PASSWORD','trim|required|min_length[4]|max_length[12]|alpha_numeric');


			if($this->form_validation->run() == FALSE){
				//echo "error";
				//$this->load->view('index.php');
				echo validation_errors();

			}
			else{
				echo "ok";
				$_POST['upass']= do_hash($_POST['upass']);
				print_r($_POST);
				$this->load->model('crud_model');
				if($this->crud_model->insertData($_POST)){
					//echo "Record Added";
					//redirect(base_url('index.php/crud/show'));

					echo "user added";
				}
			}
		}

	}
?>