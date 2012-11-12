<?php
// Autor: Leon Bergmann
// Date: 12.11.2012 08:58 Uhr 
class installAPI
{
	public function removeGitFiles()
	{
		$dirName = $this->getBaseDir();
		$dir = scandir($dirName);
		foreach($dir as $entry)
		{
			if(is_file($dirName."/".$entry))
			{
				$files[] = $dirName."/".$entry;
			}
			elseif(is_dir($dirName."/".$entry))
			{
				$folder[] = $dirName."/".$entry;
			
			}

		}
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