<?php
/**
 * Serialize an (XHTML) DOM into a HTML5 string.
 *
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright Copyright (c) 2009-2014 Bastian Feder, Thomas Weinert
 */

namespace FluentDOM\YAML\Dipper {

  use secondparty\Dipper\Dipper as Dipper;

  /**
   * Serialize an (XHTML) DOM into a HTML5 string.
   *
   * @license http://www.opensource.org/licenses/mit-license.php The MIT License
   * @copyright Copyright (c) 2009-2014 Bastian Feder, Thomas Weinert
   */
  class Serializer {

    /**
     * @var \DOMDocument
     */
    private $_document = NULL;

    /**
     * @var array
     */
    private $_options = [];

    public function __construct(\DOMDocument $document, array $options = []) {
      $this->_document = $document;
      $this->_options = $options;
    }

    public function __toString() {
      try {
        return $this->asString();
      } catch (\Exception $e) {
        return '';
      }
    }

    public function asString() {
      $jsondom = new \FluentDOM\Serializer\Json($this->_document);
      $yaml = Dipper::make($jsondom->jsonSerialize());
      return (string)$yaml;
    }
  }
}
