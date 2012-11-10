<?php

class Department
{
	public function __construct(pdo $db) {
		$this->db = $db;
	}

	public function getAll() {
		$st = $this->db->query("SELECT * FROM department");

		return $st->fetchAll();
	}

	public function add($value) {
		$st = $this->db->prepare("INSERT INTO department VALUES (null, :abbrv, :deptname)");

		$data = array(
			'abbrv'    => substr($value, 0, 3),
			'deptname' => $value
		);

		if ($st->execute($data))
			echo "Added Successfully!";
	}

	public function delete($id) {
		$st = $this->db->prepare("DELETE FROM department WHERE dept_id = ?");

		if ($st->execute(array($id))) return true;
	}

	public function update($raw_data) {
		$st = $this->db->prepare("UPDATE department SET deptabbrv = :abbrv, deptname = :deptname WHERE dept_id = :dept_id");

		$data = array(
			'abbrv'    => substr($raw_data['value'], 0, 3),
			'deptname' => $raw_data['value'],
			'dept_id'  => $raw_data['id']
		);

		if ($st->execute($data)) return true;
	}

	/**
	 * Get Department Title 
	 * @param emp_id
	 */
	public function getTitle($emp_id){
		$st = $this->db->prepare('SELECT department.deptname FROM emp_dept LEFT JOIN department ON emp_dept.dept_id = department.dept_id WHERE emp_dept.emp_id = ?');
		$st->execute(array($emp_id));

		$result = $st->fetch(PDO::FETCH_ASSOC);

		return $result['deptname'];
	}
}