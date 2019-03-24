<?php

namespace Drupal\config_form_custom\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;
use Drupal\Core\Form\FormStateInterface;

/**
 * New custom filter to capitalize.
 *
 * @Filter(
 *   id = "filter_capitalize",
 *   title = @Translation("Capitalize Filter"),
 *   description = @Translation("Help this text format to cpaitalize specific letters"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_HTML_RESTRICTOR,
 * )
 */
class CapitalizeFilter extends FilterBase {

  /**
   * Overriding process function.
   *
   * @param string $text
   *   The incoming text.
   * @param string $langcode
   *   The text langcode.
   *
   * @return \Drupal\filter\FilterProcessResult
   *   Returning filter process result.
   */
  public function process($text, $langcode) {
    // TODO: Implement process() method.
    if (isset($this->settings['word_list'])) {
      $words = explode(',', $this->settings['word_list']);
      foreach ($words as $value) {
        $text = str_replace($value, strtoupper($value), $text);
      }
    }

    return new FilterProcessResult($text);
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['word_list'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Word List'),
      '#default_value' => $this->settings['word_list'],
      '#description' => $this->t('Add a word list to capitalize'),
    ];
    return $form;
  }

}
