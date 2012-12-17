<?php
/*
* Autor: Leon Bergmann
* Datum: 13.12.2012 12:22
* Update:
* License: LICENSE.txt
*/
class email
{
	/**
	 * email
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $email;
	/**
	 * name
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $name;
	/**
	 * subject
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $subject;
	/**
	 * content
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $content;
	/**
	 * sender
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $sender;
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $email
	 * @param mixed $name
	 * @param mixed $subject
	 * @param mixed $content
	 * @param mixed $sender (default: NULL)
	 * @return void
	 */
	public function __construct($email,$name,$subject,$content,$sender = NULL)
	{
		if(empty($email) or empty($name) or empty($subject) or empty($content))
		{
			throw new Exception("Not all Values",3);
		}
		else
		{
			$this->email	= $email;
			$this->name		= $name;
			$this->subject	= $subject;
			$this->content	= $content;
			$this->sender	= $sender;
		}			
	}
	
	/**
	 * prepareMail function.
	 * 
	 * @access private
	 * @return array
	 */
	public function prepareMail()
	{
		
		if(is_null($this->sender))
		{
			$this->sender = 'notify@sky-lab.de';
		}
		
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$header .= 'X-Mailer: PHP/' . phpversion()."\r\n";	
		
		$tmp = array();
		if(is_array($this->email))
		{
			$count = count($this->email);
			
			for($i = 0; $i <= $count; $i++)
			{
				$header			   .= 'To: '.$this->name[$i].' <'.$this->email[$i].'>'."\r\n";
				$header			   .= 'From: Notification <'.$this->sender.'>'."\r\n";
				
				$message			= $this->replaceName($this->content,$this->name[$i]);
				
				$tmp[$i]['header']	= $header; 
				$tmp[$i]['mail']	= $this->email[$i];
				$tmp[$i]['subject']	= $this->subject;
				$tmp[$i]['content']	= $message;	
			}
		}
		else
		{
				$header			   .= 'To: '.$this->name.' <'.$this->email.'>'."\r\n";
				$header			   .= 'From: Notification <'.$this->sender.'>'."\r\n";
				
				$tmp[0]['header']	= $header; 
				$tmp[0]['mail']	= $this->email[$i];
				$tmp[0]['subject']	= $this->subject;
				$tmp[0]['content']	= $message;		
		}
		
		return $tmp;
	}

	/**
	 * mailSend function.
	 * 
	 * @access public
	 * @param mixed $mails
	 * @return void
	 */
	public function mailSend($mails)
	{
		if(!is_array($mails))
		{
			return false;
		}
		else
		{
			mail($mail['mail'],$mail['subject'],$mail['content'],$mail['header']);
		}
		
		return true;
	}
	
	/**
	 * massMailSend function.
	 * 
	 * @access public
	 * @param mixed $mails
	 * @return void
	 */
	public function massMailSend($mails)
	{

		foreach($mails as $mail)
		{
			$this->mailSend($mail);
		}
		
		return true;
	}
	/**
	 * replaceName function.
	 * 
	 * @access private
	 * @param mixed $content
	 * @param mixed $names
	 * @return string
	 */
	private function replaceName($content,$names)
	{
		$content[] = str_replace('#name#', $name, $content);
		return $content;
	}

}
?>