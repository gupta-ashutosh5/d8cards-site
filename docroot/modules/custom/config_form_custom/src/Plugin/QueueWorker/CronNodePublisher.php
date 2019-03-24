<?php

namespace Drupal\config_form_custom\Plugin\QueueWorker;

/**
 * A Node Publisher that publishes nodes on CRON run.
 *
 * @QueueWorker(
 *   id = "cron_node_publisher",
 *   title = @Translation("Cron Node Publisher"),
 *   cron = {"time" = 100}
 * )
 */
class CronNodePublisher extends NodePublishBase {

}
