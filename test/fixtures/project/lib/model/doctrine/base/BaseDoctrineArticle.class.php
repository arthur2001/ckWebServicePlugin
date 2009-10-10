<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseDoctrineArticle extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('doctrine_article');
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('content', 'clob', null, array(
             'type' => 'clob',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasMany('DoctrineAuthor as Authors', array(
             'refClass' => 'DoctrineArticleAuthor',
             'local' => 'author_id',
             'foreign' => 'article_id'));

        $this->hasMany('DoctrineComment as Comments', array(
             'local' => 'id',
             'foreign' => 'article_id'));
    }
}