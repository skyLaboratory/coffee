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
	
	private function prepareMassMail()
	{
		if(!is_array($emails))
		{
			return false;
		}
		
		$tmp = array();
		
		
	}
	
	/**
	 * massMailSend function.
	 * 
	 * @access private
	 * @param mixed $mails
	 * @return void
	 */
	private function massMailSend($mails)
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
	 * @return array
	 */
	private function replaceName($content,$names)
	{
		if(!is_array($name))
		{
			return false;
		}
		
		$content = array();
		
		foreach($names as $name)
		{
			$content[] = str_replace('#name#', $name, $content);
		}
	
		return $content;
	}

}
?>
