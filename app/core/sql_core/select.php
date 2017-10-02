<?

class select
{
	public $construct_req ="";
	public function __construct($req_sql)
	{

		$construct_req = "";
		if(is_object($req_sql))
		{
			$construct_req .= "SELECT ";

			if(isset($req_sql->var) && $req_sql->var != "")
			{
				if(isset($req_sql->distinct) && $req_sql->distinct != false)
					$construct_req .="DISTINCT ";

				$construct_req .= $req_sql->var." ";
			}
			else
			{
				if(isset($req_sql->distinct) && $req_sql->distinct != false)
					$construct_req .="DISTINCT ";

				$construct_req .= "* ";
			}
				

			


			if(isset($req_sql->table) && $req_sql->table != "")
				$construct_req .= "FROM ".$req_sql->table." ";
			else
				return 0;


			if(isset($req_sql->where) && $req_sql->where != "")
				$construct_req .= "WHERE ".$req_sql->where." ";	
			else
				$construct_req .= "WHERE 1 ";	


			if(isset($req_sql->order) && $req_sql->order != "")
				$construct_req .= "ORDER BY ".$req_sql->order." ";	
			else
				$construct_req .= "ORDER BY id ASC";	


			if(isset($req_sql->limit) && $req_sql->limit != "")
				$construct_req .= " LIMIT ".$req_sql->limit." ";	
			else
				$construct_req .= "";	


		}

		$this->construct_req = $construct_req;
	}

	public function parser()
	{
		
	}
		
	public function get_string()
	{
		return $this->construct_req;
	}
}