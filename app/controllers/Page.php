<?php

class Page extends Controller
{

	public function index()
	{
		$this->redirect('page/terms');
		//$this->view('Page/Index');
	}

	public function terms()
	{
		$this->view('Page/Terms');
	}

}
