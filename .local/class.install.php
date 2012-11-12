<?php
// Autor: Leon Bergmann
// Date: 12.11.2012 08:58 Uhr 
class installAPI
{
	public function removeGitFiles()
	{
		$dir = $this->getBaseDir();
		$dir = scandir($dir);
		foreach($dir as $entry)
		{
			if(is_file($entry))
			{
				$files[] = $entry;
			}
			elseif(is_dir($entry))
			{
				$folder[] = $entry;
			}
			else
			{
				
			}
		}
		
		echo "<pre>";
		print_r($files);
		/* print_r($folder); */
	}
	private function getBaseDir()
	{
		return dirname(dirname(__FILE__));
	}
	public function parseSQL($file)
	{
		if(is_file($file))
		{
			$fileContent = file_get_contents($file);
		}
		else
		{
			return false;
		}
		
		return $fileContent;
	}
}
?>