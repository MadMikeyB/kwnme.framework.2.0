<?php

class Page extends Controller
{

	public function index()
	{
		$p = str_replace('page/', '', $_REQUEST['url']);
		$page = KwnPage::findBySlug($p);

		if ( $page )
		{
			$this->view('Page/Scaffold', $page);
		}
		else
		{
			$this->view('Error/Error', "No page found");
		}
	}

	public function terms()
	{
		$this->view('Page/Terms');
	}

}
