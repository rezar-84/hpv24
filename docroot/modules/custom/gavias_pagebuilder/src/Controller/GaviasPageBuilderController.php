<?php
/**
 * @file
 * Contains \Drupal\gavias_pagebuilder\Controller\GaviasPageBuilderController.
 */
namespace Drupal\gavias_pagebuilder\Controller;

use  Drupal\Core\Cache\Cache;
use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

class GaviasPageBuilderController extends ControllerBase {

  public function gavias_pagebuilder_list(){
    $page['#attached']['library'][] = 'gavias_pagebuilder/gavias_pagebuilder.assets.admin';
    $header = array( 'ID', 'Title', 'Action');
    $results = \Drupal::database()->select('{gavias_pagebuilder}', 'd')
            ->fields('d', array('id', 'title', 'machine_name'))
            ->orderBy('title', 'ASC')
            ->execute();
    $rows = array();
    foreach ($results as $row) {

      $tmp =  array();
      $tmp[] = $row->id;
      $tmp[] = $row->title;
      $tmp[] = t('<a href="@link">Change Name</a> | <a href="@link_2">Configuration</a> |  <a href="@link_3">Delete</a> | <a href="@link_4">Duplicate</a> | <a href="@link_5">Export</a>', array(
            '@link' => Url::fromRoute('gavias_pagebuilder.admin.add', array('bid' => $row->id))->toString(),
            '@link_2' => Url::fromRoute('gavias_pagebuilder.admin.edit', array('bid' => $row->id))->toString(),
            '@link_3' => Url::fromRoute('gavias_pagebuilder.admin.delete', array('bid' => $row->id))->toString(),
            '@link_4' => Url::fromRoute('gavias_pagebuilder.admin.clone', array('bid' => $row->id))->toString(),
            '@link_5' => Url::fromRoute('gavias_pagebuilder.admin.export', array('bid' => $row->id))->toString(),
        ));
      $rows[] = $tmp;
    }
    
    $page['gbb-admin-list'] = array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => t('No Block Builder Available. <a href="@link">Add Block Builder</a>', array('@link' => Url::fromRoute('gavias_pagebuilder.admin.add', array('bid'=>0))->toString() )),
    );
    return $page;
  }

  public function gavias_pagebuilder_edit($bid) {
    require_once GAVIAS_PAGE_BUILDER_PATH . '/includes/utilities.php';

    $page['#attached']['library'][] = 'gavias_pagebuilder/gavias_pagebuilder.assets.admin';

    $page['#attributes']['classes_array'][] = 'form-blockbuilder';

    $abs_url_config = Url::fromRoute('gavias_pagebuilder.admin.save', array(), array('absolute' => FALSE))->toString(); 
    
    $page['#attached']['drupalSettings']['gavias_pagebuilder']['saveConfigURL'] = $abs_url_config;

    $page['#attached']['drupalSettings']['gavias_pagebuilder']['base_path'] = base_path();

    $page['#attached']['drupalSettings']['gavias_pagebuilder']['path_modules'] = base_path()  . \Drupal::service('extension.list.module')->getPath('gavias_pagebuilder');

    $url_redirect = '';
    
    if(isset($_GET['destination']) && $_GET['destination']){
      $url_redirect = $_GET['destination'];
    }
    
    $pbd_single = gavias_pagebuilder_load($bid);
    $el_fields = gavias_pagebuilder_load_el_fields();
    $gbb_title = $pbd_single->title;
    $gbb_id = $pbd_single->id;
    $params = $pbd_single->params;
    $page['#attached']['drupalSettings']['gavias_pagebuilder']['params'] = $params ? $params : '[{}]';
    $page['#attached']['drupalSettings']['gavias_pagebuilder']['element_fields'] = $el_fields;

    //Translate
    $page['#attached']['drupalSettings']['gavias_pagebuilder']['text_translate']['cancel'] = t('Cancel');
    $page['#attached']['drupalSettings']['gavias_pagebuilder']['text_translate']['update'] = t('Update');
    
    ob_start();

    include \Drupal::service('extension.list.module')->getPath('gavias_pagebuilder') . '/templates/backend/form.php';

    $content = ob_get_clean();
    $page['gcb-admin-form'] = array(
      '#theme' => 'gcb-admin-form',
      '#content' => $content
    );
    return $page;
  }

  public function gavias_pagebuilder_save(){
    header('Content-type: application/json');
    $data = $_REQUEST['data'];
    $pid = $_REQUEST['pid'];

    \Drupal::database()->update("gavias_pagebuilder")
          ->fields(array(
              'params' => $data,
          ))
          ->condition('id', $pid)
          ->execute();
    
    \Drupal::service('plugin.manager.block')->clearCachedDefinitions();     
    foreach (Cache::getBins() as $service_id => $cache_backend) {
      if($service_id == 'render' || $service_id == 'page'){
        $cache_backend->deleteAll();
      }
    }

    $result = array(
      'data' => 'update saved'
    );
 
    print json_encode($result);
    exit(0);
  }

   private function friendly_title($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
  }

  public function gavias_pagebuilder_export($bid){
    $pbd_single = gavias_pagebuilder_load($bid);
    $data = $pbd_single->params;
    $title = 'blockbuilder_' . $this->friendly_title($pbd_single->title) . '_export'; 
    header("Content-Type: text/txt");
    header("Content-Disposition: attachment; filename={$title}.txt");
    print $data;
    exit;
  }
 
  public function gavias_pagebuilder_export_node($nid){
    if($nid){
      $node = \Drupal\node\Entity\Node::load($nid);
      if ($node instanceof \Drupal\node\NodeInterface) {
        try {
          $data = $node->get('gva_pagebuilder_content')->value;
          $title = 'pagebuilder-' . $this->friendly_title($node->get('title')->value); 
          header("Content-Type: text/txt");
          header("Content-Disposition: attachment; filename={$title}.txt");
          print $data;
          exit;
        }
        catch (\Exception $e) {
          watchdog_exception('myerrorid', $e);
        }
      }
    }
    exit;
  }

    public function gavias_pagebuilder_save_node(){
      header('Content-type: application/json');
      $data = $_REQUEST['data'];
      $nid = $_REQUEST['nid'];
      $langid = $_REQUEST['lang'];
      $changed = '';
      if($nid){
        $node = \Drupal\node\Entity\Node::load($nid);
        if ($node instanceof \Drupal\node\NodeInterface) {
          try {
            $node_change = $node;
            if(!empty($langid)){
              if ($node->hasTranslation($langid)) {
                $node_change = $node->getTranslation($langid);
              }
            }
            $node_change->set('gva_pagebuilder_content', $data);
            $node_change->save(); 
            $changed = $node->get('changed')->value;
          }
          catch (\Exception $e) {
            watchdog_exception('myerrorid', $e);
          }
        }
      }
      $result = array(
        'notify' => 'Gavias Page Builder updated',
        'changed' => $changed
      );
   
      print json_encode($result);
      exit(0);
    }

}
