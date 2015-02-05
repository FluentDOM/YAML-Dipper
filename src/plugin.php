<?php

namespace FluentDOM\YAML\Dipper {

  if (class_exists('\\FluentDOM')) {
    \FluentDOM::registerLoader(
      new \FluentDOM\Loader\Lazy(
        [
          'text/yaml' => function () {
            return new Loader;
          },
          'yaml' => function () {
            return new Loader;
          }
        ]
      )
    );
  }
}