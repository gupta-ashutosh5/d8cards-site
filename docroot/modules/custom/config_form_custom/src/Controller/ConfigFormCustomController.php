<?php

namespace Drupal\config_form_custom\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Config Form Custom routes.
 */
class ConfigFormCustomController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
