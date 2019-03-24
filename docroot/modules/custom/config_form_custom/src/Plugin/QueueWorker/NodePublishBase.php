<?php

namespace Drupal\config_form_custom\Plugin\QueueWorker;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Queue\QueueWorkerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

// Make Class.
/**
 * Class NodePublishBase.
 *
 * @package Drupal\config_form_custom\Plugin\QueueWorker
 */
class NodePublishBase extends QueueWorkerBase implements ContainerFactoryPluginInterface {

  /**
   * The entityTypeManager object.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The Constructor for this class.
   *
   * @param array $configuration
   *   The plugin configuration array.
   * @param mixed $plugin_id
   *   The plugin Id.
   * @param mixed $plugin_definition
   *   The plugin definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entityTypeManager object.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entityTypeManager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function publishNode($node) {
    $node->setPublished(TRUE);
    return $node->save();
  }

  /**
   * {@inheritdoc}
   */
  public function processItem($data) {
    // TODO: Implement processItem() method.
    $node_storage = $this->entityTypeManager->getStorage('node');
    $node = $node_storage->load($data->nid);
    \Drupal::logger('connfig_form_custom')->info($node->isPublished());

    \Drupal::logger('connfig_form_custom')->info('After published @node', ['@node' => $node->isPublished()]);
    return $this->publishNode($node);
  }

}
