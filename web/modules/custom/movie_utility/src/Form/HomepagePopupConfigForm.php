<?php

namespace Drupal\movie_utility\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

/**
 * Class HomepagePopupConfigForm.
 */
class HomepagePopupConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'homepage_popup_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'movie_utility.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $current_user_id = \Drupal::currentUser()->id();
    $config = $this->config('movie_utility.settings');
    // Gather the number of names in the form already.
    $num_names = $form_state->get('num_names');
    // We have to ensure that there is at least one name field.
    if ($num_names === NULL) {
      $name_field = $form_state->set('num_names', 1);
      $num_names = 1;
    }
    $form['#tree'] = TRUE;
    $form['names_fieldset'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Homepage Popup ConfigForm'),
      '#prefix' => '<div id="names-fieldset-wrapper">',
      '#suffix' => '</div>',
    ];
    if (!empty($config->get('counter'))) {
      $num_names = $config->get('counter');
    }
    $k = 1;
    for ($i = 0; $i < $num_names; $i++) {
      $form['names_fieldset']['container'][$i] = [
        '#type' => 'details',
        '#title' => $this->t('Popup Detail (' . $k . ')'),
        '#open' => TRUE,
      ];
      $form['names_fieldset']['container'][$i]['title'][$i] = [
        '#type' => 'textfield',
        '#title' => $this->t('Title'),
        '#default_value' => (isset($config->get('data')[$i]['title'][$i])) ?$config->get('data')[$i]['title'][$i] : NULL,
      ];
      $form['names_fieldset']['container'][$i]['body'][$i] = [
        '#type' => 'textarea',
        '#title' => $this->t('Main Body'),
        '#default_value' => (isset($config->get('data')[$i]['body'][$i])) ? $config->get('data')[$i]['body'][$i] : NULL,
      ];
      $form['names_fieldset']['container'][$i]['image'][$i] = [
        '#type' => 'managed_file',
        '#title' => $this->t('Image'),
        '#upload_location' => 'public://homepage_image',
        '#upload_validators' => [
          'file_validate_extensions' => ['png gif jpg jpeg pdf doc'],
        ],
        '#default_value' => (isset($config->get('data')[$i]['image'][$i])) ? $config->get('data')[$i]['image'][$i] : NULL,
      ];
      $form['names_fieldset']['container'][$i]['user'][$i] = [
        '#type' => 'hidden',
        '#default_value' => $current_user_id,
      ];
      $k++;
    }

    $form['names_fieldset']['actions'] = [
      '#type' => 'actions',
    ];
    $form['names_fieldset']['actions']['add_name'] = [
      '#type' => 'submit',
      '#value' => $this->t('Add one more'),
      '#submit' => ['::addOne'],
      '#ajax' => [
        'callback' => '::addmoreCallback',
        'wrapper' => 'names-fieldset-wrapper',
      ],
    ];
    // If there is more than one name, add the remove button.
    if ($num_names > 1) {
      $form['names_fieldset']['actions']['remove_name'] = [
        '#type' => 'submit',
        '#value' => $this->t('Remove one'),
        '#submit' => ['::removeCallback'],
        '#ajax' => [
          'callback' => '::addmoreCallback',
          'wrapper' => 'names-fieldset-wrapper',
        ],
      ];
    }
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    parent::submitForm($form, $form_state);
    $counter = count($form_state->getValue('names_fieldset')['container']);
    if (empty($counter)) {
      $counter = 1;
    }
    $container = $form_state->getValue('names_fieldset')['container']; 
    foreach ($container as $key => $value) {
      if(empty($value['title'][$key]) && empty($value['body'][$key]) && empty($value['image'][$key])) {
        $counter = $counter - 1;
      }
    }
    $image_data = $form_state->getValue('names_fieldset')['container'];
    $image_array = [];
    foreach ($image_data as $key => $value) {
      if (reset($value['image'][$key])) {
        $file = File::load(reset($value['image'][$key]));
        if (!empty($file)) {
          $file_url = $file->getFileUri();
        }
        $style = ImageStyle::load('banner');
        $style_url = $style->buildUri($file_url);
        if (!file_exists($style_url)) {
          $style->createDerivative($file_url, $style_url);
        }
        $url = file_url_transform_relative($style->buildUrl($file_url));
        $image_array[] = $url;
      }
    }
    $this->config('movie_utility.settings')
      ->set('data', $form_state->getValue('names_fieldset')['container'])
      ->set('counter', $counter)
      ->set('image', $image_array)
      ->save();
  }

  /**
   * Callback for both ajax-enabled buttons.
   *
   * Selects and returns the fieldset with the names in it.
   */
  public function addmoreCallback(array &$form, FormStateInterface $form_state) {
    return $form['names_fieldset'];
  }

  /**
   * Submit handler for the "add-one-more" button.
   *
   * Increments the max counter and causes a rebuild.
   */
  public function addOne(array &$form, FormStateInterface $form_state) {
    $name_field = $form_state->get('num_names');
    $add_button = $name_field + 1;
    $form_state->set('num_names', $add_button);
    $counter = count($form_state->getValue('names_fieldset')['container']);
    $counter = $counter + 1;
    $this->config('movie_utility.settings')
      ->set('counter', $counter)
      ->save();
      //dump($add_button);exit;
    // Since our buildForm() method relies on the value of 'num_names' to
    // generate 'name' form elements, we have to tell the form to rebuild. If we
    // don't do this, the form builder will not call buildForm().
    $form_state->setRebuild();
  }

  /**
   * Submit handler for the "remove one" button.
   *
   * Decrements the max counter and causes a form rebuild.
   */
  public function removeCallback(array &$form, FormStateInterface $form_state) {
    $name_field = $form_state->get('num_names');
    if ($name_field > 1) {
      $remove_button = $name_field - 1;
      $form_state->set('num_names', $remove_button);
    }
    $counter = count($form_state->getValue('names_fieldset')['container']);
    $counter = $counter - 1;
    $this->config('movie_utility.settings')
      ->set('counter', $counter)
      ->save();
    // Since our buildForm() method relies on the value of 'num_names' to
    // generate 'name' form elements, we have to tell the form to rebuild. If we
    // don't do this, the form builder will not call buildForm().
    $form_state->setRebuild();
  }

}
