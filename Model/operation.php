<?php
 require_once('db.php');
class operation extends db
{
	public function select()
	{
		//$sql="SELECT * FROM student";

		$result = $this->connect()->prepare("select * from student order by enroll_no asc");
        $result->execute();
		if($result->rowCount()>0){
			while($row = $result->fetch()){
				$data[]=$row;
			}
			return $data;
			
		}
	}

	public function insert($enroll_no,$name,$mobile)
	{
		
		

		$res=$this->connect()->prepare("insert into student values(null,:enroll_no,:name, :mobile)");
		$res->bindparam(':enroll_no', $enroll_no);
		$res->bindparam(':name', $name);
		$res->bindparam(':mobile', $mobile);
		$res->execute();
		if ($res) {
			header('location:index.php');
		}
	}

	public function selectOne($id)
	{


		$stmt = $this->connect()->prepare("select * from student where id =:id");
	    $stmt->bindparam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}
	
	public function update($enroll_no,$name,$mobile,$id)
	{
		

		
         $res = $this->connect()->prepare("update student set enroll_no =:enroll_no, name =:name, mobile =:mobile where id =:id");
         $res->bindparam(':enroll_no', $enroll_no);
         $res->bindparam(':name', $name);
         $res->bindparam(':mobile', $mobile);
         $res->bindparam(':id', $id);
         $res->execute();
	    if ($res) {
	    	header('location:index.php');
	    }
		
     }

     public function delete($id)
     {
     	$res = $this->connect()->prepare("delete from student where id =:id");
	    $res->bindparam(':id', $id);
	    $res->execute();
	   
     }
}
?>