<?php
class Mtce extends Application {

        public function index()
        {
                $this->data['pagetitle'] = 'TODO List Maintenance';
                $tasks = $this->tasks->all(); // get all the tasks

                // substitute the status name
				foreach ($tasks as $task)
				if (!empty($task->status))
					$task->status = $this->statuses->get($task->status)->name;

				// build the task presentation output
				$result = '';   // start with an empty array        
				foreach ($tasks as $task)
					$result .= $this->parser->parse('oneitem',(array)$task,true);

				// and then pass them on
				$this->data['display_tasks'] = $result;
				$this->data['pagebody'] = 'itemlist';
				$this->render();
        }

}

?>