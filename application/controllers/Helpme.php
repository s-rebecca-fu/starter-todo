<?php
/**
 * Created by PhpStorm.
 * User: YYao
 * Date: 2017-02-15
 * Time: 12:20 PM
 */
    class Helpme extends Application
    {

        public function index()
        {
           // $this->data['pagebody'] = 'homepage';

            $this->data['pagetitle'] = 'Help Wanted!';
            $stuff = file_get_contents('../data/jobs.md');
            $this->data['content'] = $this->parsedown->parse($stuff);

            $this->render();
        }

    }