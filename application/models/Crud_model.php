<?php 

	class Crud_model extends CI_model{

		function insertData($ans){

			$re= $this->db->insert('users',$ans);

			return $re;
		}

		function selectData(){
			//return "testing";
			$query= $this->db->get('users');

			// echo "<pre>";
			// print_r($query);
			// echo "</pre>";

			if($query->result_id->num_rows>0){
				//echo "ok";
				//$ans=$query->result();
				$ans=$query->result_array();

				// echo "<pre>";
				//  print_r($ans);
			 // 	echo "</pre>";

				return $ans;
			}
			else{
				return 0;
			}
		}


		function deleterecord($id){

			return $this->db->delete('users',array('id'=> $id));
		}

		function editrecord($id){
			//echo "$id";
			$this->db->select('id,uemail');

			$query = $this->db->get_where('users',array('id' => $id));

			if($query->result_id->num_rows>0){

				$ans=$query->result();

				return $ans;
			}
			else{
				return 0;
			}
		}

		function updateRecord($email,$id){

			$data = array('uemail'=> $email,);
		

		$this->db->where('id',$id);

		return $this->db->update('users',$data);
		}
	}

?>