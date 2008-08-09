<?php
/**
 * This file is part of the ckWebServicePlugin
 *
 * @package   ckWsdlGenerator
 * @author    Christian Kerl <christian-kerl@web.de>
 * @copyright Copyright (c) 2008, Christian Kerl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @version   SVN: $Id$
 */

/**
 * Enter description here...
 *
 * @package    ckWsdlGenerator
 * @subpackage wsdl
 * @author     Christian Kerl <christian-kerl@web.de>
 */
class ckWsdlOperation implements ckDOMSerializable
{
  public static function create($name, ReflectionMethod $method)
  {
    $result = new ckWsdlOperation();
    $result->setName($name);
    return $result;
  }

  const ELEMENT_NAME = 'operation';

  protected $name;
  protected $input;
  protected $output;

  public function getName()
  {
    return $this->name;
  }

  public function setName($value)
  {
    $this->name = $value;
  }

  /**
   * Enter description here...
   *
   * @return ckWsdlMessage
   */
  public function getInput()
  {
    return $this->input;
  }

  public function setInput(ckWsdlMessage $value)
  {
    $this->input = $value;
  }

  /**
   * Enter description here...
   *
   * @return ckWsdlMessage
   */
  public function getOutput()
  {
    return $this->output;
  }

  public function getNodeName()
  {
    return self::ELEMENT_NAME;
  }

  protected function __construct()
  {

  }

  public function serialize(DOMDocument $document)
  {
    $wsdl = ckXsdNamespace::get('wsdl');
    $tns  = ckXsdNamespace::get('tns');

    $node = $document->createElementNS($wsdl->getUrl(), $wsdl->qualify($this->getNodeName()));

    $node->setAttribute('name', $this->getName());
    $node->setAttribute('parameterOrder', implode(' ', $this->getInput()->getParts()));

    if(!is_null($this->getInput()))
    {
      $input_node = $document->createElementNS($wsdl->getUrl(), $wsdl->qualify('input'));
      $input_node->setAttribute('message', $tns->qualify($this->getInput()->getName()));
      $node->appendChild($input_node);
    }

    if(!is_null($this->getOutput()))
    {
      $output_node = $document->createElementNS($wsdl->getUrl(), $wsdl->qualify('output'));
      $output_node->setAttribute('message', $tns->qualify($this->getOutput()->getName()));
      $node->appendChild($output_node);
    }


    return $node;
  }
}