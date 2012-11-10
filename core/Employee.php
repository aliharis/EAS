<?php

class Employee
{
	public function __construct(pdo $db){
		$this->db = $db;
	}

	public function add($data) {
		$st_1 = $this->db->prepare("
			INSERT INTO 
				employee (emp_id, firstname, middlename, lastname, gender, nationalid, dob, permaddress, prsntaddress, contactnos, sup_id)
			VALUES 
				(null, :firstname, :middlename, :lastname, :gender, :nationalid, :dob, :permaddress, :prsntaddress, :contactnos, :supervisor_id)
		");

		$st_1->bindParam(':firstname', $data['firstname']);
		$st_1->bindParam(':middlename', $data['middlename']);
		$st_1->bindParam(':lastname', $data['lastname']);
		$st_1->bindParam(':gender', $data['gender']);
		$st_1->bindParam(':nationalid', $data['nationalid']);
		$st_1->bindParam(':dob', $data['dob']);
		$st_1->bindParam(':permaddress', $data['permaddress']);
		$st_1->bindParam(':prsntaddress', $data['prsntaddress']);
		$st_1->bindParam(':contactnos', $data['contactnos']);
		$st_1->bindParam(':supervisor_id', $data['supervisor_id']);
		$st_1->execute(); 

		// Set last insert ID as emp_id
		$data['emp_id'] = $this->db->lastInsertId();

		$st_2 = $this->db->prepare("INSERT INTO emp_dept VALUES (:emp_id, :dept_id)");
		$st_2->bindParam(':emp_id', $data['emp_id']);
		$st_2->bindParam(':dept_id', $data['dept_id']);
		$st_2->execute();

		$st_3 = $this->db->prepare("INSERT INTO emp_job (emp_id, job_id) VALUES (:emp_id, :job_id)");
		$st_3->bindParam(':emp_id', $data['emp_id']);
		$st_3->bindParam(':job_id', $data['job_id']);
		$st_3->execute();

		return true;
	}

	public function remove($id){
		// delete from employee table
		$st_1 = $this->db->prepare("DELETE FROM employee WHERE emp_id = ?");
		$st_1->execute(array($id));

		// delete from emp_deot table
		$st_2 = $this->db->prepare("DELETE FROM emp_dept WHERE emp_id = ?");
		$st_2->execute(array($id));

		// delete from emp_job table
		$st_3 = $this->db->prepare("DELETE FROM emp_job WHERE emp_id = ?");
		$st_3->execute(array($id));
	}

	public function edit($data) {
		$st_1 = $this->db->prepare("UPDATE employee SET firstname = :firstname, middlename = :middlename, lastname = :lastname, gender = :gender, nationalid = :nationalid, 
									dob = :dob, permaddress = :permaddress, prsntaddress = :prsntaddress, contactnos = :contactnos,
									sup_id = :supervisor_id WHERE emp_id = :emp_id");

		// bind the parameters to avoid the errors
		$st_1->bindParam(':firstname', $data['firstname']);
		$st_1->bindParam(':middlename', $data['middlename']);
		$st_1->bindParam(':lastname', $data['lastname']);
		$st_1->bindParam(':gender', $data['gender']);
		$st_1->bindParam(':nationalid', $data['nationalid']);
		$st_1->bindParam(':dob', $data['dob']);
		$st_1->bindParam(':permaddress', $data['permaddress']);
		$st_1->bindParam(':prsntaddress', $data['prsntaddress']);
		$st_1->bindParam(':contactnos', $data['contactnos']);
		$st_1->bindParam(':supervisor_id', $data['supervisor_id']);
		$st_1->bindParam(':emp_id', $data['emp_id']);
		
		if ($st_1->execute()) return true; 
	}
 
	/**
	 * Get a record of an employee
	 * @param emp_ikd
	 */
	public function view($id){
		$st = $this->db->prepare("SELECT employee.*, supervision.emp_id as sup_emp_id FROM employee LEFT JOIN supervision ON employee.sup_id = supervision.sup_id WHERE employee.emp_id = ?");
		$st->execute(array($id));

		return $st->fetch(PDO::FETCH_ASSOC);
	}

	/** 
	 * Fetch all the Employees
	 */
	public function getAll(){
		$st = $this->db->prepare("SELECT employee.*, supervision.emp_id as sup_emp_id FROM employee LEFT JOIN supervision ON employee.sup_id = supervision.sup_id");
		$st->execute();

		return $st->fetchAll();
	}

	/**
	 * Get Employees by Department
	 * @param dept_id
	 */
	public function getByDepartment($dept_id){
		$st = $this->db->query("SELECT firstname FROM employee WHERE emp_id = ANY(SELECT emp_id FROM emp_dept WHERE dept_id = ".$dept_id.")");

		return $st->fetchAll(PDO::FETCH_ASSOC);
	}
}