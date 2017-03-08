<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Views extends Application
{

    public function index()
    {
        $this->data['pagetitle'] = 'Ordered TODO List';
        $tasks = $this->tasks->all();   // get all the tasks
        $this->data['content'] = 'Ok'; // so we don't need pagebody
        $this->data['leftside'] = $this->makePrioritizedPanel($tasks);
		$this->data['rightside'] = $this->makeCategorizedPanel($tasks);

        $this->render('template_secondary'); 
    }
	
	function makePrioritizedPanel($tasks) {
        foreach ($tasks as $task)
        {
            if ($task->status != 2){
                $undone[] = $task;
            }
        }
        // order them by priority
        usort($undone, "orderByPriority");
        // substitute the priority name
        foreach ($undone as $task){
            $task->priority = $this->priorities->get($task->priority)->name;
        }
        // convert the array of task objects into an array of associative objects       
        foreach ($undone as $task){
            $converted[] = (array) $task;
        }
        // and then pass them on
        $parms = ['display_tasks' => $converted];
		$role = $this->session->userdata('userrole');
		$parms['completer'] = ($role == ROLE_OWNER) ? '/views/complete' : '#';
        return $this->parser->parse('by_priority', $parms, true);

    }
    
    function makeCategorizedPanel($tasks)
    {
        $parms = ['display_tasks' => $this->tasks->getCategorizedTasks()];
        return $this->parser->parse('by_category', $parms, true);
    }
	
	// complete flagged items
	function complete() {
		$role = $this->session->userdata('userrole');
		if ($role != ROLE_OWNER) redirect('/work');
		
		// loop over the post fields, looking for flagged tasks
		foreach($this->input->post() as $key=>$value) {
			if (substr($key,0,4) == 'task') {
				// find the associated task
				$taskid = substr($key,4);
				$task = $this->tasks->get($taskid);
				$task->status = 2; // complete
				$this->tasks->update($task);
			}
		}
		$this->index();
	}
	
}

// return -1, 0, or 1 of $a's priority is higher, equal to, or lower than $b's
	function orderByPriority($a, $b)
	{
		if ($a->priority > $b->priority)
			return -1;
		elseif ($a->priority < $b->priority)
			return 1;
		else
			return 0;
	}