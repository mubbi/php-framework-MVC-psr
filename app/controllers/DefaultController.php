<?php

namespace Mubbi;

/**
* Default Controller
*/
class DefaultController extends BaseController
{
    public function index()
    {
        $this->view('default');
    }
}
