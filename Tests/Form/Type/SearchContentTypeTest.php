<?php
// src/Emo/SimpleSearchBundle/Tests/Form/Type/SearchContentTypeTest.php
namespace Emo\SimpleSearchBundle\Tests\Form\Type;

use Emo\SimpleSearchBundle\Form\Type\SearchContentType;
use Emo\SimpleSearchBundle\Entity\FileSearch;
use Symfony\Component\Form\Test\TypeTestCase;

class SearchContentTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'searchContent' => 'tExt ImpoSSible to be fouNd .-',
            'fileType' => 'twig',
        );

        $type = new SearchContentType();
        $form = $this->factory->create($type);

        $object = new FileSearch();
        $object->setSearchContent('tExt ImpoSSible to be fouNd .-');
        $object->setFileType('twig');

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($form->getData(), $object);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}