<?php
class Mtce extends Application {

    private $items_per_page = 10;
    public function index()
    {
        $this->page(1);
    }

// Show a single page of todo items
    private function show_page($tasks)
    {
        $this->data['pagetitle'] = 'TODO List Maintenance';
        // build the task presentation output
        $result = ''; // start with an empty array
        foreach ($tasks as $task)
        {
            if (!empty($task->status))
                $task->status = $this->statuses->get($task->status)->name;
            $result .= $this->parser->parse('oneitem', (array) $task, true);
        }
        $this->data['display_tasks'] = $result;

        // and then pass them on
        $this->data['pagebody'] = 'itemlist';
        $this->render();
    }

    // Extract & handle a page of items, defaulting to the beginning
    function page($num = 1)
    {
        $records = $this->tasks->all(); // get all the tasks
        $tasks = array(); // start with an empty extract

        // use a foreach loop, because the record indices may not be sequential
        $index = 0; // where are we in the tasks list
        $count = 0; // how many items have we added to the extract
        $start = ($num - 1) * $this->items_per_page;
        foreach($records as $task) {
            if ($index++ >= $start) {
                $tasks[] = $task;
                $count++;
            }
            if ($count >= $this->items_per_page) break;
        }
        $this->data['pagination'] = $this->pagenav($num);
        $this->show_page($tasks);
    }

    // Build the pagination navbar
    private function pagenav($num) {
        $lastpage = ceil($this->tasks->size() / $this->items_per_page);
        $parms = array(
            'first' => 1,
            'previous' => (max($num-1,1)),
            'next' => min($num+1,$lastpage),
            'last' => $lastpage
        );
        return $this->parser->parse('itemnav',$parms,true);
    }

}

?>