<?php
/**
 * @file
 * Contains \Drupal\joshuamodule\Form\ToptalForm.
 */
namespace Drupal\joshuamodule\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

class ToptalForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'joshuamodule.settings';
  /**
   * {@inheritdoc}
   */

  public function getFormId() {
      return 'toptal_form';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }
  
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title:'),
      '#required' => FALSE,
      '#default_value' => $config->get('title'),
    );
    $form['content'] = array(
      '#type' => 'textarea',
      '#title' => t('Content:'),
      '#required' => FALSE,
      '#default_value' => $config->get('content'),
    );
    
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );

    return parent::buildForm($form, $form_state);
  }
  
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }
  
	public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->config(static::SETTINGS)
      ->set('title', $form_state->getValue('title'))
      ->set('content', $form_state->getValue('content'))
      ->save();
    
      parent::submitForm($form, $form_state);
	}
}
