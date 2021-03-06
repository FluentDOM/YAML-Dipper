<?php
/**
 * Load a DOM document from a HTML5 string or file
 *
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @copyright Copyright (c) 2009-2014 Bastian Feder, Thomas Weinert
 */

namespace FluentDOM\YAML\Dipper {

  use FluentDOM\Document;
  use FluentDOM\DocumentFragment;
  use FluentDOM\Loadable;
  use FluentDOM\Loader\Options;
  use FluentDOM\Loader\Supports;

  use secondparty\Dipper\Dipper as Dipper;

  /**
   * Load a DOM document from a HTML5 string or file
   */
  class Loader extends \FluentDOM\Loader\Json\JsonDOM {

    use Supports;

    /**
     * @return string[]
     */
    public function getSupported() {
      return ['yaml', 'text/yaml'];
    }


    /**
     * Load the YAML string into an DOMDocument
     *
     * @param mixed $source
     * @param string $contentType
     * @param array|\Traversable|Options $options
     * @return Document|NULL
     */
    public function load($source, $contentType, $options = []) {
      if ($this->supports($contentType)) {
        $settings = $this->getOptions($options);
        $settings->isAllowed($sourceType = $settings->getSourceType($source));
        switch ($sourceType) {
        case Options::IS_FILE :
          $source = file_get_contents($source);
        case Options::IS_STRING :
        default :
          $yaml = Dipper::parse($source);
          if (!empty($yaml) || is_array($yaml)) {
            $document = new Document('1.0', 'UTF-8');
            $document->appendChild(
              $root = $document->createElementNS(self::XMLNS, 'json:json')
            );
            $this->transferTo($root, $yaml);
            return $document;
          }
        }
      }
      return NULL;
    }

    /**
     * Load the YAML string into an DOMDocumentFragment
     *
     * @param mixed $source
     * @param string $contentType
     * @param array|\Traversable|Options $options
     * @return DocumentFragment|NULL
     */
    public function loadFragment($source, $contentType, $options = []) {
      if ($this->supports($contentType)) {
        $yaml = Dipper::parse($source);
        if (!empty($yaml) || is_array($yaml)) {
          $document = new Document('1.0', 'UTF-8');
          $fragment = $document->createDocumentFragment();
          $this->transferTo($fragment, $yaml);
          return $fragment;
        }
      }
      return NULL;
    }

    /**
     * @param array|Options|\Traversable $options
     * @return Options
     */
    public function getOptions($options) {
      $result = new Options(
        $options,
        [
          Options::CB_IDENTIFY_STRING_SOURCE => function($source) {
            return (FALSE !== strpos($source, "\n"));
          }
        ]
      );
      return $result;
    }
  }
}