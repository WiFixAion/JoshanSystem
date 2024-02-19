<?php
class appointment{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='db_wbapp';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
	public function new_appointment($name, $purpose, $date, $time){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');

		$data = [
			[$name, $purpose, $date, $time],
		];
		$stmt = $this->conn->prepare("INSERT INTO tbl_appointment (appointment_name, appointment_purpose, appointment_date, appointment_time) VALUES (?,?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			$this->conn->commit();
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}

		return true;

	}

	public function update_appointment($appointment_id,$name,$purpose, $date, $time){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');

		$sql = "UPDATE tbl_appointment SET appointment_name=:appointment_name, appointment_purpose=:appointment_purpose, appointment_date=:appointment_date, appointment_time=:appointment_time WHERE appointment_id=:appointment_id";

		$q = $this->conn->prepare($sql);
	$q->execute(array(':appointment_name'=>$name, ':appointment_purpose'=>$purpose, ':appointment_date'=>$date, ':appointment_time'=>$time, ':appointment_id'=>$appointment_id));
		return true;
	}

	public function list_appointments(){
		$sql="SELECT * FROM tbl_appointment";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
}

public function delete_appointment($appointment_id){
	$sql = "DELETE FROM tbl_appointment WHERE appointment_id = :appointment_id";
	$q = $this->conn->prepare($sql);
	$q->execute(array(':appointment_id'=>$appointment_id));
	return true;
}
	function get_appointment_id($name){
		$sql="SELECT appointment_id FROM tbl_appointment WHERE appointment_name = :name";	
		$q = $this->conn->prepare($sql);
		$q->execute(['name' => $name]);
		$appointment_id = $q->fetchColumn();
		return $appointment_id;
	}
	function get_appointment_name($id){
		$sql="SELECT appointment_email FROM tbl_appointment WHERE appointment_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$appointment_email = $q->fetchColumn();
		return $appointment_email;
	}
	function get_appointment_purpose($id){
		$sql="SELECT appointment_purpose FROM tbl_appointment WHERE appointment_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$appointment_purpose = $q->fetchColumn();
		return $appointment_purpose;
	}
	function get_appointment_date($id){
		$sql="SELECT appointment_date FROM tbl_appointment WHERE appointment_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$appointment_date = $q->fetchColumn();
		return $appointment_date;
	}
	function get_appointment_time($id){
		$sql="SELECT appointment_time FROM tbl_appointment WHERE appointment_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$appointment_time = $q->fetchColumn();
		return $appointment_time;
	}
	
	function get_session(){
		if(isset($_SESSION['login']) && $_SESSION['login'] == true){
			return true;
		}else{
			return false;
		}
	}
	public function check_login($email,$password){
		
		$sql = "SELECT count(*) FROM tbl_users WHERE user_email = :email AND user_password = :password"; 
		$q = $this->conn->prepare($sql);
		$q->execute(['email' => $email,'password' => $password ]);
		$number_of_rows = $q->fetchColumn();
		

	
		if($number_of_rows == 1){
			
			$_SESSION['login']=true;
			$_SESSION['user_email']=$email;
			return true;
		}else{
			return false;
		}
	}
}