<?php
// Emo/SimpleSearchBundle/Entity/FileSearch.php
namespace Emo\SimpleSearchBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
/**
* This is the Entity class that stores parameters
* that we use for search - searchContent, fileType and searchDir
*/
class FileSearch
{
    /**
     * @Assert\NotBlank()
     * @var string
    */
	protected $searchContent;

    /**
     * @var string
    */
	protected $fileType;

    /**
     * @var string
    */
	protected $searchDir;

	public function getSearchContent()
    {
        return $this->searchContent;
    }

    public function setSearchContent($searchContent)
    {
        $this->searchContent = $searchContent;
    }

    public function getFileType()
    {
    	return $this->fileType;
    }

    public function setFileType($fileType)
    {
    	$this->fileType = $fileType;
    }

    public function getSearchDir()
    {
    	return $this->searchDir;
    }

    public function setSearchDir($searchDir)
    {
    	$this->searchDir = $searchDir;
    }
}