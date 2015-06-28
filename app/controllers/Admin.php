<?php

class Admin extends Controller
{
	public function __construct()
	{
		$user = Auth::check( @$_COOKIE['user'] );

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

	public function spammers()
	{
		$spammers = SpamCheck::all();
		if ( $spammers )
		{
			$this->view('Admin/Spammers', $spammers);
		}
	}

	public function addSpammer( $url=null, $ip=null, $base=null )
	{
		$input = $_POST;
		if ( $input )
		{
			$info = array(
								'url'	=> $input['url'],
								'ip'	=> isset($input['ip']) ? $input['ip'] : 0,
								'base'	=> isset($input['base']) ? $input['base'] : 0
							);

			if ( !preg_match( "/(http|https):\/\/(.*?)$/i", $info['url'] ) )
			{
				$info['url'] = 'http://' . $info['url'];
			}

			SpamCheck::logSpammer($info);

			$flash = 'Spammer added';

			$url = ShortUrl::findByBase( $info['base'] );
			$url->is_spam = true;
			$url->save();

			$this->view('Admin/AddSpammer', array($url, $ip, $base, $flash) );

		}
		else
		{
			$this->view('Admin/AddSpammer', array($url, $ip, $base) );
		}

	}

	public function users()
	{
		$users = KwnUser::where('id', '>', '0')->orderBy('id', 'desc')->simplePaginate('25');
		if ( $users )
		{
			$this->view('Admin/Users', $users);
		}	
	}

	public function urls()
	{
		$urls = ShortUrl::where('id', '>', '0')->orderBy('id', 'desc')->simplePaginate('25');
		if ( $urls )
		{
			$this->view('Admin/Urls', $urls);
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