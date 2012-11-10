<?php

class Category 
{
	public function __construct(pdo $db){
		$this->db = $db;
	}

	public function get($cat_id){
		$st = $this->db->query("SELECT catname FROM categories WHERE cat_id = '" . $cat_id . "'");
		$result = $st->fetch(PDO::FETCH_ASSOC);
		
		return $result['catname'];
	}

	/**
	 * Get subcategories from cat_id
	 * @param cat_id
	 */
	public function getSubCategories($cat_id) {
		$st = $this->db->query("SELECT * FROM subcategories WHERE cat_id = '" . $cat_id . "'");

		return $st->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Add new sub category
	 */
	public function addSubCat($raw_data) {
		$st = $this->db->prepare("INSERT INTO subcategories VALUES (null, :cat_id, :description)");

		$data = array(
			'cat_id' => $raw_data['catid'],
			'description' => $raw_data['description']
		);

		if ($st->execute($data)) return true;
	}

	/** 
	 * Get all categories
	 */
	public function getAll(){
		$st = $this->db->query("SELECT * FROM categories");

		return $st->fetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Update category percentage
	 */
	public function updateCategoryPercentage($data){
		// CAT A
		$st_a = $this->db->prepare("UPDATE categories SET percentallocated = ? WHERE cat_id = 'CAT A'");
		$st_a->execute(array($data['CAT_A']));

		// CAT B
		$st_b = $this->db->prepare("UPDATE categories SET percentallocated = ? WHERE cat_id = 'CAT B'");
		$st_b->execute(array($data['CAT_B']));

		// CAT C
		$st_c = $this->db->prepare("UPDATE categories SET percentallocated = ? WHERE cat_id = 'CAT C'");
		$st_c->execute(array($data['CAT_C']));

		// CAT D
		$st_d = $this->db->prepare("UPDATE categories SET percentallocated = ? WHERE cat_id = 'CAT D'");
		$st_d->execute(array($data['CAT_D']));

		// CAT E
		$st_e = $this->db->prepare("UPDATE categories SET percentallocated = ? WHERE cat_id = 'CAT E'");
		$st_e->execute(array($data['CAT_E']));
	}

	public function remove($id){
		$st_1 = $this->db->prepare("DELETE FROM subcategories WHERE subcat_id = ?");
		$st_1->execute(array($id));
	}

	public function updateSubCategory($raw_data) {
		$st = $this->db->prepare("UPDATE subcategories SET description = :description WHERE subcat_id = :subcat_id");

		$data = array(
			'description' => $raw_data['value'],
			'subcat_id'  => $raw_data['id']
		);

		if ($st->execute($data)) return true;
	}

	/**
	 * @return an array with average of subcat rating and total with percentage
	 */
	public function subCatAvg($emp_id){
		// get all the tasks
		$st_1 =  $this->db->query("SELECT * FROM task WHERE emp_id = $emp_id");
		$tasks = $st_1->fetchAll(PDO::FETCH_ASSOC);

		$results = array();

		// loop the tasks 
		foreach ($tasks as $task) {
			// set task id var
			$task_id = $task['task_id'];

			// get tasks ratings through the loop
			$st_2 = $this->db->query("SELECT um.task_id, fn.rating AS subcat_1, ln.rating AS subcat_2, en.rating AS subcat_3, task.*
				FROM task_ratings AS um
					LEFT JOIN task_ratings AS fn ON um.task_id = fn.task_id AND fn.subcat_id = 1
					LEFT JOIN task_ratings AS ln ON um.task_id = ln.task_id AND ln.subcat_id = 2
					LEFT JOIN task_ratings AS en ON um.task_id = en.task_id AND en.subcat_id = 3 
					LEFT JOIN task ON um.task_id = task.task_id
				WHERE um.task_id = $task_id LIMIT 1");

			// merge the results to produce a final results array
			$results = array_merge($results, $st_2->fetchAll(PDO::FETCH_ASSOC));
		}

		// the final result array to return
		$result = array();

		// loop and get the total rating and add to array
		for($i = 0, $size = count($results), $subcat_1 = 0, $subcat_2 = 0, $subcat_3 = 0; $i < $size; ++$i) {
			$i = $i = $i;
			$result['subcat_1'] = $subcat_1 + $results[$i]['subcat_1'];
			$result['subcat_2'] = $subcat_2 + $results[$i]['subcat_2'];
			$result['subcat_3'] = $subcat_3 + $results[$i]['subcat_3'];
		}

		// loop the result array and update with average
		foreach ($result as $key => $re) {
			// find the average
			$result[$key] = $result[$key] / $i;
			// set the total
			$result['total'] = $result[$key] + $result[$key];
		}

		// get the percentage allocated for 'CAT_A'
		$st_3 = $this->db->query("SELECT percentallocated FROM categories WHERE cat_id = 'CAT A'");
		$percentallocated = array_pop($st_3->fetch(PDO::FETCH_ASSOC));

		// set the category percentage
		$result['percentage'] = $result['total'] * ($percentallocated / 100);

		return $result;
	}

	/**
	 * Get percent allocated for the category
	 * @param category_id
	 */
	public function getPercentage($cat_id){
		$st = $this->db->query("SELECT percentallocated FROM categories WHERE cat_id = '$cat_id'");

		return array_pop($st->fetch());
	}
}