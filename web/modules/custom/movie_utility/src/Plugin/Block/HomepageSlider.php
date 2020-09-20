<?php

namespace Drupal\movie_utility\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\user\Entity\User;
/**
 * Provides a 'HomepageSlider' block.
 *
 * @Block(
 *  id = "homepage_slider",
 *  admin_label = @Translation("Homepage slider"),
 * )
 */
class HomepageSlider extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    // get config data from movie configuration form.
    $config = \Drupal::config('movie_utility.settings');
    $current_user_id = \Drupal::currentUser()->id();
    $user_data = User::load($current_user_id);
    if (!empty($user_data)) {
      $username = $user_data->get('field_name')->value;
    }
    $data = [];
    foreach ($config->get('data') as $key => $value) {
      $image_url = $config->get('image')[$key];
      if ($key == '0') {
        $active = 'active';
      }
      else {
        $active = '';
      }
      $data[] = ['title' => $value['title'][$key], 'body' => $value['body'][$key], 'image' => $image_url, 'active' => $active, 'name' => $username];
    }
    return [
      '#theme' => 'homepage_slider',
      '#data' => $data,
      '#cache' => [
        'max-age' => 0,
      ],
    ];
    return $build;
  }

}
