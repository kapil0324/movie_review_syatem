<?php

namespace Drupal\movie_utility\Plugin\Block;

use Drupal\node\NodeInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides a 'AddToWishlist' block.
 *
 * @Block(
 *  id = "add_to_wishlist",
 *  admin_label = @Translation("Add to wishlist"),
 * )
 */
class AddToWishlist extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node instanceof NodeInterface) {
      $url = Url::fromRoute('movie_utility.user_wishlist_controller_content', ['id' => $node->id()])->toString();
    }
    $build['#theme'] = 'add_to_wishlist';
    $build['add_to_wishlist']['#markup'] = '<a href="' . $url . '">Add to wishlist</a>';

    return $build;
  }

}
