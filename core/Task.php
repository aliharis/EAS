<?php

class Task
{
	public function __construct(pdo $db){
		$this->db = $db;
	}

	public function newTask(array $data){
		$data['total_rating'] = $data['subcat1'] + $data['subcat2'] + $data['subcat3']; 

		$st = $this->db->prepare("INSERT INTO task VALUES (null, :emp_id, :sup_id, :taskdetail, :assigneddate, :duedate, '', :total_rating, :remarks)");

		$st->bindParam(':emp_id', $data['emp_id']);
		$st->bindParam(':sup_id', $data['sup_id']);
		$st->bindParam(':taskdetail', $data['taskdetail']);
		$st->bindParam(':assigneddate', $data['date_assigned']);
		$st->bindParam(':duedate', $data['due_date']);
		$st->bindParam(':total_rating', $data['total_rating']);
		$st->bindParam(':remarks', $data['remarks']);
		$st->execute();

		$data['query'] = $this->db->query('SELECT task_id FROM task ORDER BY task_id DESC LIMIT 1');
		$data['task_id'] = array_pop($data['query']->fetch());

		// subcat1
		$st_1 = $this->db->prepare("INSERT INTO task_ratings VALUES (:task_id, 1, :subcat1)");
		$st_1->bindParam(':task_id', $data['task_id']);
		$st_1->bindParam(':subcat1', $data['subcat1']);
		$st_1->execute();

		// subcat2
		$st_2 = $this->db->prepare("INSERT INTO task_ratings VALUES (:task_id, 2, :subcat2)");
		$st_2->bindParam(':task_id', $data['task_id']);
		$st_2->bindParam(':subcat2', $data['subcat2']);
		$st_2->execute();

		// subcat3
		$st_3 = $this->db->prepare("INSERT INTO task_ratings VALUES (:task_id, 3, :subcat3)");
		$st_3->bindParam(':task_id', $data['task_id']);
		$st_3->bindParam(':subcat3', $data['subcat3']);
		$st_3->execute();
	}

	public function getAll($emp_id){
		$st = $this->db->query("SELECT * FROM task WHERE emp_id = " . $emp_id);

		return $st->fetchAll();
	}

	public function getRating($task_id, $subcat_id){
		$st = $this->db->query("SELECT rating FROM task_ratings WHERE task_id = ".$task_id." AND subcat_id = ".$subcat_id);

		return array_pop($st->fetch());
	}

	public function edit($raw_data){
		$st_1 = $this->db->prepare("UPDATE task_ratings SET rating = :rating_1 WHERE task_id = :task_id AND subcat_id = 1");
		$data_1 = array('rating_1' => $raw_data['subcat1'], 'task_id' => $raw_data['task_id']);
		$st_1->execute($data_1);

		$st_2 = $this->db->prepare("UPDATE task_ratings SET rating = :rating_2 WHERE task_id = :task_id AND subcat_id = 2");
		$data_2 = array('rating_2' => $raw_data['subcat2'], 'task_id' => $raw_data['task_id']);
		$st_2->execute($data_2);

		$st_3 = $this->db->prepare("UPDATE task_ratings SET rating = :rating_3 WHERE task_id = :task_id AND subcat_id = 3");
		$data_3 = array('rating_3' => $raw_data['subcat3'], 'task_id' => $raw_data['task_id']);
		$st_3->execute($data_3);

		$st = $this->db->prepare("UPDATE task SET taskdetail = :taskdetail, remarks = :remarks, total_rating = :total WHERE task_id = :task_id");

		$data = array();
		$data['taskdetail'] = $raw_data['taskdetail'];
		$data['task_id'] = $raw_data['task_id'];
		$data['remarks'] = $raw_data['remarks'];
		$data['total']   = $raw_data['subcat1'] + $raw_data['subcat2'] + $raw_data['subcat3'];

		if ($st->execute($data))
			return true;
	}

	public function updateRemarks($remarks, $task_id){
		$st = $this->db->prepare("UPDATE task SET remarks = :remarks WHERE task_id = :task_id");

		$data = array('remarks' => $remarks, 'task_id' => $task_id);

		if ($st->execute($data)) 
			return true;
	}

	public function submit_task($task_id){
		$st = $this->db->prepare("UPDATE task SET submitdate = :submitdate WHERE task_id = :task_id");

		$data = array('submitdate' => date('Y-m-d'), 'task_id' => $task_id);

		if ($st->execute($data))
			return true;
	}

	public function getUnsubmittedTasks($emp_id){
		$st = $this->db->query("SELECT * FROM task WHERE emp_id = ".$emp_id." AND submitdate = '0000-00-00'");

		return $st->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getSubmittedTasks($emp_id){
		$st = $this->db->query("SELECT * FROM task WHERE emp_id = ".$emp_id." AND submitdate != '0000-00-00'");

		return $st->fetchAll(PDO::FETCH_ASSOC);
	}
}