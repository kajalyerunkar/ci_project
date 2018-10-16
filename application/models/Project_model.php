<?php

	/**
	* 
	*/
	class Project_model extends CI_model
	{
		
		function getRecords($tablename){

			$query= $this->db->get($tablename);

			if($query->result_id->num_rows>0){

				return $query->result();
			}
			else{
				return 0;
			}
		}

		function getAllProducts($extra=""){

			$str = "select p_id,p_name,p_amt,p_discount,p_caid,
			p_brid,p_desc,p_imgpath,ca_name,br_name from category, brand,products where ca_id = p_caid and br_id= p_brid $extra order by p_id desc";

			$result = $this->db->query($str);

			if($result->result_id->num_rows>0){

				return $result->result();
			}
			else{
				return 0;
			}
		}

		function getAllProductsCart($rec){

			$str = "select p_id,p_name,p_amt,p_discount,p_caid,
			p_brid,p_desc,p_imgpath,ca_name,br_name from category, brand,products where ca_id = p_caid and br_id=p_brid and p_id in($rec) order by p_id desc";

			$result = $this->db->query($str);

			if($result->result_id->num_rows>0){

				return $result->result();
			}
			else{
				return 0;
			}
		}

		function insertData($table,$data){
			
			return $this ->db->insert($table,$data);
			return $this->db->insert_id();
		}



		function auth($data){

			//print_r($data);
			$result = $this->db->select("login_password")->get_where("login",array("login_email"=>$data['login_email']))->result_array();

			//print_r($result);

			if(count($result)>0){

				if($data['login_password'] == $result[0]['login_password']){

					return true;
				}
				else{
					return false;
				}
			}
			else{

				return false;
			}
		}

		function getuserdata($email){

			return $this->db->get_where("login",array("login_email"=>$email))->result_array();
		}

		function update_status($status, $id){

			$this->db->where("login_id",$id);
			$data = array("login_status"=>$status);
			$this->db->update("login",$data);
		}

		function check_cpass($data,$id){

			
			$ans=$this->db->select("login_password")->get_where("login",array("login_id"=>$id))->result_array();
			//print_r($ans);
			
			return ($ans[0]['login_password'] == $data)?true:false;

		}

		function update_cpass($pass,$id){

			$data = array(
				"login_password"=>$pass);

			$this->db->where("login_id",$id);
			return $this->db->update("login", $data);
		}

		function insertwishData($table,$data){
			
			return $this ->db->insert($table,$data);
			//return $this->db->insert_id();
		}

		function check_count_wishlist($pid,$uid){
			
			$this->db->where("p_id",$pid);
			$this->db->where("u_id",$uid);
			return $this->db->count_all_results("wishlist");


		}
	}

?>