<?php

class Supervisor
{
	public function __construct(pdo $db) {
		$this->db = $db;
	}

	public function getAll() {
		$st = $this->db->query('SELECT employee.* FROM supervision LEFT JOIN employee ON employee.emp_id = supervision.emp_id');

		return $st->fetchAll();
	}

	/**
	 * Get supervisor name
	 * @param emp_id
	 */
	public function getName($id){
		$st = $this->db->prepare('SELECT * FROM employee WHERE emp_id = ?');
		$st->execute(array($id));

		$result = array_pop($st->fetchAll(PDO::FETCH_ASSOC));
		return $result['firstname'] . ' ' . $result['lastname'];
	}

	/**
	 * Set employee as a new supervisor
	 */
	public function setSupervision(array $data){
		$st = $this->db->prepare("INSERT INTO supervision VALUES (:emp_id, :sup_id, :startdate, '')");

		$param = array('emp_id' => $data['emp_id'], 'sup_id' => $data['sup_id'], 'startdate' => $data['startdate']);

		if ($st->execute($param))
			return true;
	}

	/**
	 * Get supervision start date
	 * @return date(Y-d-m)
	 */
	public function getSupervisionStart($emp_id){
		$st = $this->db->query("SELECT startdate FROM supervision WHERE emp_id = $emp_id");

		$result = $st->fetch(PDO::FETCH_ASSOC);

		return $result['startdate'];
	}
}