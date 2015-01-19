<?php

class Admin extends Controller
{
	public function __construct()
	{
		$user = Auth::check( $_COOKIE['user'] );

		if ( $user )
		{
			if ( $user->group_id < '2')
			{
				$this->view('Error/Error', '<b>Whoops!</b><br /> Your permission level is not high enough to see this page.');
			}
		}
		else
		{
			$this->view('Error/Error', '<b>Whoops!</b><br /> Your permission level is not high enough to see this page.');
		}
	}

	public function index()
	{
		$this->view('Admin/Index');
	}

	public function pages()
	{
		$pages = KwnPage::all();
		if ( $pages )
		{
			$this->view('Admin/Pages', $pages);
		}
	}

	public function users()
	{
		$users = KwnUser::all();
		if ( $users )
		{
			$this->view('Admin/Users', $users);
		}	
	}

	public function addPage()
	{
		// get input
		$input = $_POST;
		if ( $input )
		{
			$kwnPage 			= new KwnPage;
			$kwnPage->title 	= $input['title'];
			$kwnPage->slug 		= parent::slugify($input['title']);
			$kwnPage->content 	= $input['content'];
			$kwnPage->save();

			$this->redirect( 'http://kwn.me/page/' . $kwnPage->slug );
		}
		else
		{
			$this->view('Admin/AddPage');
		}		
	}

	public function editPage( $page )
	{
		// get input
		$input = $_POST;
		if ( $input )
		{
			$page = KwnPage::findBySlug( $page );
			$kwnPage = KwnPage::find($page->id);
			$kwnPage->content = $input['content'];
			$kwnPage->save();
			//dd($page);
			$this->redirect( 'http://kwn.me/page/' . $page->slug );
		}
		else
		{
			$page = KwnPage::findBySlug( $page );

			if ( ! $page )
			{
				$this->view('Error/Error', "No page found.");
			}
			$this->view('Admin/EditPage', $page);

		}

	}

}