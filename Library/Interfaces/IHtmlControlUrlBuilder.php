<?php

namespace Library\Interfaces;

interface IHtmlControlUrlBuilder {
  /**
   * Method that builds a url to use an internal resource like a Style sheet and
   * a JavaScript file.
   * @param string $resourcePathFile The internal resource filepath.
   * @see Web/library/css/webide.css
   */
  public function ForInternalResource($resourcePathFile);
  /**
   * Method that builds a url to use an internal resource like a Style sheet and
   * a JavaScript file.
   * @param string $resourceUrl The external resource url.
   * @see https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css
   */
  public function ForExternalResource($resourceUrl);
}
