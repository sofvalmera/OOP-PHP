<?php
include '../database/db.php';

class nba Extends Database implements crocodile
{
function createtable(){
   $this->dbcon();

   $t="CREATE TABLE IF NOT EXISTS NBA(id int primary key auto_increment,
   fname varchar(255) not null,
   nbateam varchar(255) not null,
   position longtext not null,
   age int not null)";

   $this->con->query($t);
}


public function create($params)
	{
		

	if ($_SERVER['REQUEST_METHOD'] != 'CREATE'){
		return json_encode([
			'code' => 422,
			'message' => 'CREATE method is only allowed!'
		]);
	}
	if(!isset($params['fname']) || empty($params['fname']))
	{
		return json_encode([

			'code' =>422,
			'message' => 'fullname is required',
		]);
	}
	if(!isset($params['nbateam']) || empty($params['nbateam']))
	{
		return json_encode([

			'code' =>422,
			'message' => 'nba team is required',
		]);
	}
	if(!isset($params['position']) || empty($params['position']))
	{
		return json_encode([

			'code' =>422,
			'message' => 'position is required',
		]);
	}
	if(!isset($params['age']) || empty($params['age']))
	{
		return json_encode([

			'code' =>422,
			'message' => 'age is required',
		]);
	}
		
		$fname = $params[ 'fname'];
		$nbateam = $params[ 'nbateam'];
        $position = $params[ 'position'];
        $age = $params[ 'age'];
		$sql = "INSERT INTO NBA(fname,nbateam,position,age) VALUES ('$fname','$nbateam','$position','$age')";
		$isadded=$this->con->query($sql);
		if ($isadded){
          
		return json_encode([
			'code' => 200,
			'message' => ' Sucessfully added'
		]);
		} else {
			return json_encode([
				'code' => 500,
				'message' => $this->kungError()
			]);
		}
	
	}

    public function read()
	{

		// $this->authentication();
     if ($_SERVER['REQUEST_METHOD'] != 'VIEW'){
			return json_encode([
				'code' => 422,
				'message' => 'VIEW method is only allowed!'
			]);
		}
		$u=$this->con->query("SELECT * FROM NBA");
		$userlist=[];
		return json_encode($u->fetch_all(MYSQLI_ASSOC));
	}
    public function update($params)
	{
		if ($_SERVER['REQUEST_METHOD'] != 'UPDATE'){
			return json_encode([
				'code' => 422,
				'message' => 'UPDATE method is only allowed!'
			]);
		}
		if(!isset($params['id']) || empty($params['id']))
		{
			return json_encode([

				'code' =>422,
				'message' => 'id is required',
			]);
		}
		if(!isset($params['fname']) || empty($params['fname']))
		{
			return json_encode([

				'code' =>422,
				'message' => 'full name is required',
			]);
		}
		if(!isset($params['nbateam']) || empty($params['nbateam']))
		{
			return json_encode([

				'code' =>422,
				'message' => 'nba team is required',
			]);
		}
		if(!isset($params['position']) || empty($params['position']))
		{
			return json_encode([

				'code' =>422,
				'message' => 'position is required',
			]);
		}
        if(!isset($params['age']) || empty($params['age']))
		{
			return json_encode([

				'code' =>422,
				'message' => 'age is required',
			]);
		}

		$id = $params['id'];
		$fname = $params['fname'];
		$nbateam = $params['nbateam'];
        $position = $params['position'];
        $age = $params['age'];
		$sql = "UPDATE NBA SET fname = '$fname', nbateam = '$nbateam', position = '$position', age = '$age' where id ='$id'";
		$isupdated=$this->con->query($sql);
		if ($isupdated){

		return json_encode([
			'code' => 200,
			'message' => 'Sucessfully updated',
		]);
		} else {
			return json_encode([
				'code' => 500,
				'message' => $this->kungError(),
			]);
		}
	}
    public function delete($params)
	{
		if ($_SERVER['REQUEST_METHOD'] != 'DELETE'){
			return json_encode([
				'code' => 422,
				'message' => 'DELETE method is only allowed!'
			]);
		}
	
		
		if(!isset($params['id']) || empty($params['id']))
		{
			return json_encode([

				'code' =>422,
				'message' => 'id is required',
			]);
		}
		$id = $params ['id'];
		$sql ="DELETE FROM NBA where id ='$id'";
		$isdeleted=$this->con->query($sql);
		if ($isdeleted){

		return json_encode([
			'code' => 200,
			'message' => 'Sucessfully deleted'
		]);
		} else {
			return json_encode([
				'code' => 500,
				'message' => $this->kungError()
			]);
	    }
		}
        public function search($params)
	{
		if ($_SERVER['REQUEST_METHOD'] != 'SEARCH'){
			return json_encode([
				'code' => 422,
				'message' => 'SEARCH method is only allowed!'
			]);
		}
		$fname= $params['fname'] ?? '';
		$sql = "SELECT * FROM NBA where fname like '%$fname%'";
		$users = $this->con->query($sql);
		if (empty($this->kungError())){
			return json_encode($users->fetch_all(MYSQLI_ASSOC));
			} else {
				return json_encode([
					'code' => 500,
					'message' => $this->kungError()
				]);
			}
	}
	public function authentication()
    {
        if (!isset($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])) {
        echo json_encode([
            'code' => 401,
            'message' => 'Authentication is required!'
        ]);
        } else {
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];

            $sql = $this->con->query("SELECT * FROM nba");
       
        if ($username === 'root' && $password === 'valmera123') {
            echo json_encode([
                'code' => 200,
                'message' => 'authentication successful!'
                ]);
           
            return json_encode($sql->fetch_all(MYSQLI_ASSOC));
        } else {
            echo json_encode([
                'code' => 401,
                'message' => 'Invalid Authentication!'
                ]);
            }
        }
    }
}
?>
