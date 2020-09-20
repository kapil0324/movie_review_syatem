<?php

namespace Drupal\movie_utility\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class CustomSerachForm.
 */
class CustomSerachForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_serach_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $get_movie_name = \Drupal::request()->query->get('movie');
    $get_actor_actress = \Drupal::request()->query->get('user');
    $movie_name = strip_tags($get_movie_name);
    $user_name = strip_tags($get_actor_actress);
    $form['movie_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Movie Name'),
      '#attributes' => [
        'placeholder' => [
          'Search By Movie Name',
        ],
        'class' => [
          'movie_name',
        ],
      ],
      '#default_value' => (isset($movie_name)) ? $movie_name : NULL,
      '#weight' => '0',
    ];
    $form['actor_actress'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Actor/Actress'),
      '#attributes' => [
        'placeholder' => [
          'Search By Actor/actress',
        ],
        'class' => [
          'actor_actress',
        ],
      ],
      '#default_value' => (isset($user_name)) ? $user_name : NULL,
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    $url = Url::fromRoute('movie_utility.search')->toString();
    $form['reset'] = [
      '#type' => 'markup',
      '#markup' => '<a href="' . $url . '" class="btn btn-primary">Reset</a>',
    ];

    return $form;
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
    $movie_name = strip_tags($form_state->getValue('movie_name'));
    $actor_actress = strip_tags($form_state->getValue('actor_actress'));
    $url = Url::fromRoute('movie_utility.search', ['movie' => $movie_name, 'user' => $actor_actress])->toString();
    $response = new RedirectResponse($url);
    $response->send();
  }

}
