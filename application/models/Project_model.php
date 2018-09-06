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
		}
	}

?>