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

	public function contact()
	{
		if ( $_POST ) 
		{
			$to      = 'admin@kwn.me';
			$subject = $_POST['subject'];
			$message = wordwrap( htmlentities( $_POST['msg'] ) );
			$headers = 'From: kwn.me <admin@kwn.me>' . "\r\n" .
			    'Reply-To: ' . $_POST['email'] . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			$headers  .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


			if ( mail($to, $subject, $message, $headers) )
			{
				$this->view('Alert/Success', "Your message has been sent!");
			}
			else
			{
				$this->view('Error/Error', "Whoops, there was an error sending the message");
			}

		}
		else
		{
			$this->view('Page/Contact');
		}
	}

}
