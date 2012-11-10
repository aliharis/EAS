<?php

class Job
{
	public function __construct(pdo $db) {
		$this->db = $db;
	}

	public function getAll() {
		$st = $this->db->query("SELECT * FROM jobtitles");

		return $st->fetchAll();
	}

	public function add($raw_data) {
		$st = $this->db->prepare("INSERT INTO jobtitles VALUES (null, :jobtitle, :description)");

		$data = array(
			'jobtitle'    => $raw_data['jobtitle'],
			'description' => $raw_data['description']
		);

		if ($st->execute($data)) return true;
	}

	public function remove($id){
		$st_1 = $this->db->prepare("DELETE FROM jobtitles WHERE job_id = ?");
		$st_1->execute(array($id));
	}

	/**
	 * Get Employee Job Title 
	 * @param emp_id
	 */
	public function getTitle($emp_id){
		$st = $this->db->prepare("SELECT jobtitles.jobtitle FROM emp_job LEFT JOIN jobtitles ON jobtitles.job_id = emp_job.job_id WHERE emp_id = ?");
		$st->execute(array($emp_id));

		return array_pop($st->fetch(PDO::FETCH_ASSOC));
	}
}