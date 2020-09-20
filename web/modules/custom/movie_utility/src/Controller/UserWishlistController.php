<?php

namespace Drupal\movie_utility\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\media\Entity\Media;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

/**
 * Class UserWishlistController.
 */
class UserWishlistController extends ControllerBase {

  /**
   * Add item into wishlist.
   */
  public function content($id) {
    $current_user_id = \Drupal::currentUser()->id();
    $query = \Drupal::entityQuery('node');
    $query->condition('type', 'wishlist');
    $query->condition('status', 1);
    $query->condition('field_user', $current_user_id, '=');
    $query->condition('field_movie', $id, '=');
    $result = $query->execute();
    if (empty($result)) {
      $node = Node::create([
        'type'        => 'wishlist',
        'title'       => 'movie',
        'field_movie' => [
          'target_id' => $id,
        ],
        'field_user' => [
          'target_id' => $current_user_id,
        ],
      ]);
      $node->save();
      \Drupal::messenger()->addMessage($this->t('Movie added to your wishlist.'));
    }
    else {
      \Drupal::messenger()->addMessage($this->t('Movie is already in your wishlist.'), 'warning');
    }
    $response = new RedirectResponse("/my-wishlist");
    $response->send();
  }

  /**
   * Remove item into wishlist.
   */
  public function remove($id) {
    $current_user_id = \Drupal::currentUser()->id();
    $query = \Drupal::entityQuery('node');
    $query->condition('type', 'wishlist');
    $query->condition('status', 1);
    $query->condition('field_user', $current_user_id, '=');
    $query->condition('field_movie', $id, '=');
    $result = $query->execute();
    if (!empty($result)) {
      $node = Node::load(reset($result));
      $node->delete();
    }
    $route_name = \Drupal::routeMatch()->getRouteName();
    $url = Url::fromRoute('movie_utility.user_wishlist_remove', ['id' => $id])->toString();
    \Drupal::messenger()->addMessage($this->t('Movie removed from your wishlist'));
    $response = new RedirectResponse("/my-wishlist");
    $response->send();
  }

  /**
   * Implemented Custom Search.
   */
  public function search() {
    $build = [];
    $get_movie_name = \Drupal::request()->query->get('movie');
    $movie_name = strip_tags($get_movie_name);
    $get_actor_actress = \Drupal::request()->query->get('user');
    $user_name = strip_tags($get_actor_actress);
    $qry = \Drupal::entityQuery('node');
    $qry->condition('type', 'movies');
    $qry->condition('status', 1);
    $movie_result = $qry->execute();
    $num_per_page = 30;
    $page = pager_default_initialize(count($movie_result), $num_per_page);
    $offset = $num_per_page * $page;
    $form = $this->formBuilder()->getForm('\Drupal\movie_utility\Form\CustomSerachForm');
    $header = [
      ['data' => $this->t('Movie Name')],
      ['data' => $this->t('Movie Cover Photo')],
      ['data' => $this->t('Release Yeare')],
    ];
    // get list of movies. 
    $query = \Drupal::database()->select('node_field_data', 'nfd');
    $query->leftJoin('paragraphs_item_field_data', 'pifd', 'pifd.parent_id = nfd.nid');
    $query->leftJoin('node__field_movie_cast', 'nfvc', 'nfvc.entity_id = nfd.nid');
    $query->leftJoin('node__field_release_date', 'nfrd', 'nfrd.entity_id = nfd.nid');
    $query->leftJoin('users_field_data', 'ufd', 'ufd.uid = nfvc.field_movie_cast_target_id');
    $query->leftJoin('paragraph__field_marked_as_cover_photo', 'pfmcp', 'pfmcp.entity_id = pifd.id');
    $query->leftJoin('paragraph__field_image', 'pfi', 'pfi.entity_id = pifd.id');
    $query->fields('nfd', ['nid', 'title']);
    $query->fields('pfi', ['field_image_target_id']);
    $query->fields('nfrd', ['field_release_date_value']);
    $query->condition('pfmcp.field_marked_as_cover_photo_value', '1', '=');
    if (!empty($user_name)) {
      $query->condition('ufd.name', '%' . $user_name . '%', 'LIKE');
    }
    if (!empty($movie_name)) {
      $query->condition('nfd.title', '%' . $movie_name . '%', 'LIKE');
    }
    // pager implemetation.
    $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->range($offset, $num_per_page);
    $result = $query->execute()->fetchAll();
    $combined_multiple = [];
    foreach ($result as $key => $value) {
      $combined_multiple[$value->nid] = ['nid' => $value->nid, 'title' => $value->title, 'img_id' => $value->field_image_target_id, 'date' => date('Y', strtotime($value->field_release_date_value))];
    }
    $rows = [];
    foreach ($combined_multiple as $key => $datavalue) {
      $media = Media::load($datavalue['img_id']);
      $fid = $media->field_media_image->target_id;
      $file = File::load($fid);
      if (!empty($file)) {
        $file_url = $file->getFileUri();
      }
      // adding image style.
      $style = ImageStyle::load('medium');
      $style_url = $style->buildUri($file_url);
      if (!file_exists($style_url)) {
        $style->createDerivative($file_url, $style_url);
      }
      $url = file_url_transform_relative($style->buildUrl($file_url));
      if (!empty($datavalue['nid'])) {
       $node_url = Url::fromRoute('entity.node.canonical', ['node' => $datavalue['nid']])->toString();
      } 
      
      $rows[] = [
        'data' => [
          'content' => $this->t('<a href="'. $node_url .'">'. $datavalue['title'] . '</a>'),
          'photo' => $this->t('<img src="' . $url . '">'),
          'year' => $datavalue['date'],
        ],
      ];
    }
    $build['form'] = $form;
    $build['config_table'] = [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      "#empty" => $this->t("No record found."),
    ];
    $build['pager'] = [
      '#type' => 'pager',
    ];
    return $build;
  }

}
