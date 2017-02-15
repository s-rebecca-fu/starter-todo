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
		
		$parms = ['display_tasks' => []];
		return $this->parser->parse('by_priority',$parms,true);
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
}