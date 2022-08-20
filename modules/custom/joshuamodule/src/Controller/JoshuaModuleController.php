<?php
namespace Drupal\joshuamodule\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for the Example module.
 */
class JoshuaModuleController extends ControllerBase {
  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'joshuamodule.settings';
  /**
   * {@inheritdoc}
   */

  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function toptalPage() {
    $config = $this->config(static::SETTINGS);
    $title = $config->get('title') ? $config->get('title') : 'Toptal page title';
    $content = $config->get('content') ? $config->get('content') : 'Toptal page content';

    return [
      '#theme' => 'toptal_page',
      '#title' => $title,
      '#content' => $content
    ];
  }

}
