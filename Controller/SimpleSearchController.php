<?php
/*
* This file is part of EmoSimpleSearchBundle bundle
*
* (c) Emiliyan Kadiyski <e.kadiyski@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Emo\SimpleSearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Emo\SimpleSearchBundle\Entity\FileSearch;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Request;
use Emo\SimpleSearchBundle\Form\Type\SearchContentType;

/**
* Main controller that renders the form and result from the search
*/
class SimpleSearchController extends Controller
{
    /**
     * @Route("/emo_simple_search_bundle")
     */
    public function searchAction(Request $request)
    {
        // create a search
        $search = new FileSearch();

		$dirsList = $this->generateDirsList();

        $form = $this->createForm(SearchContentType::class, $search, array('dirs_list' => $dirsList));

        $form->handleRequest($request);

	    if ($form->isSubmitted() && $form->isValid()) {
	    	$searchContent = $form->get('searchContent')->getData();
	    	$fileType = $form->get('fileType')->getData();
	    	$searchDir = $form->get('searchDir')->getData();

	    	$finder = new Finder();
	    	if(isset($fileType))
	    	{
	    		$finder->files()->name("*.$fileType");
	    	}

	    	if(isset($searchDir))
	    	{
	    		$finder->files()->in($searchDir);
	    	}else{
	    		$finder->files()->in(__DIR__);
	    	}

	    	if(isset($searchContent))
	    	{
	    		$finder->contains($searchContent);
	    	}

	    	if(isset($finder) && count($finder)>0)
	    	{
	    		echo "Found results in $searchDir: <br/>";
	    		foreach ($finder as $key => $value) {
					echo "<h4> $value contains '$searchContent' </h4>";
				}
	    	}else{
	    		echo "No content '$searchContent' in '$searchDir'";
	    	}
	    }
	    
        return $this->render('EmoSimpleSearchBundle:contentsearch:search_form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
    * Function that generates the directories list
    * which is used to fill the drop down options for Search Path
    *
    * @return array
    */
    public function generateDirsList()
    {
    	$path = $this->get('kernel')->getRootDir();
    	$finder = new Finder();
    	
		$iterator = $finder
			->ignoreUnreadableDirs()
			->directories()
			->depth('< 2')
			->in($path);
		
		$dirsList = array();
		foreach ($iterator as $key => $value) {
			$dirsList["$value"] = "$value";
		}

		return $dirsList;
    }
}
