<?php
namespace Drupal\gavias_pagebuilder\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseDialogCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;
use Drupal\Core\Url;
use Drupal\Core\Ajax\RedirectCommand;

class ImportNode extends FormBase{

  /**
   * {@inheritdoc}.
   */
  public function getFormId(){
    return 'gva_pagebuider_import_node';
  }

  /**
   * {@inheritdoc}.
  */
  public function buildForm(array $form, FormStateInterface $form_state){
    $args = $this->getFormArgs($form_state);
    $form['builder-dialog-messages'] = array(
      '#markup' => '<div id="builder-dialog-messages"></div>',
    );
    $nid = 0;
    $curl = '';
    if(\Drupal::request()->attributes->get('nid')) $nid = \Drupal::request()->attributes->get('nid');
    if(\Drupal::request()->attributes->get('curl')) $curl = \Drupal::request()->attributes->get('curl');
    $form['nid'] = array(
      '#type' => 'hidden',
      '#default_value' => $nid
    );
    $form['curl'] = array(
      '#type' => 'hidden',
      '#default_value' => $curl
     );
    $form['file'] = array(
      '#type' => 'managed_file',
      '#title' => t('Upload File Content'),
      '#description' => t('Import will be refresh page after imported, you should save content before. Allowed extensions: .txt'),
      '#upload_location' => 'public://',
      '#upload_validators' => array(
          'file_validate_extensions' => array('txt'),
          // Pass the maximum file size in bytes
          'file_validate_size' => array(1024 * 1280 * 800),
      ),
      '#required' => TRUE,
    );
    $form['actions']['submit'] = array(
      '#value' => t('Submit'),
      '#type' => 'submit',
      '#ajax' => array(
        'callback' => '::modal',
      ),
    );
  return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   * Submit handle for adding Element
   */
  public function submitForm(array &$form, FormStateInterface $form_state){
    $values = $form_state->getValues();
    $params = '';
    $nid = 0;
    if (!empty($values['file'][0])) {
      $fid = $values['file'][0];
      $file = File::load($fid);
      $read_file = \Drupal::service('file_system')->realpath($file->getFileUri());
      $params = file_get_contents($read_file);
    }

    if(!empty($values['nid'])){
      $nid = $values['nid'];
    }

    $node = \Drupal\node\Entity\Node::load($nid);
    if ($node instanceof \Drupal\node\NodeInterface) {
      try {
        $node->set('gva_pagebuilder_content', $params);
        $node->save();
      }
      catch (\Exception $e) {
        watchdog_exception('myerrorid', $e);
      }
    }

  }

  public function getFormArgs($form_state){
    $args = array();
    $build_info = $form_state->getBuildInfo();
    if (!empty($build_info['args'])) {
        $args = array_shift($build_info['args']);
    }
    return $args;
  }

  /**
   * AJAX callback handler for Add Element Form.
   */
  public function modal(&$form, FormStateInterface $form_state){
    $values = $form_state->getValues();
    $errors = array();

    if (!empty($errors)) {
      $form_state->clearErrors();
      drupal_get_messages('error'); // clear next message session;
      $content = '<div class="messages messages--error" aria-label="Error message" role="contentinfo"><div role="alert"><ul>';
      foreach ($errors as $name => $error) {
          $response = new AjaxResponse();
          $content .= "<li>$error</li>";
      }
      $content .= '</ul></div></div>';
      $data = array(
          '#markup' => $content,
      );
      $data['#attached']['library'][] = 'core/drupal.dialog.ajax';
      $data['#attached']['library'][] = 'core/drupal.dialog';
      $response->addCommand(new HtmlCommand('#builder-dialog-messages', $content));
      return $response;
    }
    return $this->dialog($values);
  }

  protected function dialog($values = array()){
    $nid = isset($values['nid']) ? $values['nid'] : '';
    $response = new AjaxResponse();

    $content['#attached']['library'][] = 'core/drupal.dialog.ajax';
    
    $content['#attached']['library'][] = 'core/drupal.dialog';
    
    $response->addCommand(new CloseDialogCommand('.ui-dialog-content'));

    if($nid){
      $node_url = Url::fromRoute('entity.node.edit_form', array('node' => $nid))->toString();
      $response->addCommand(new RedirectCommand($node_url));
    }

    return $response;
    
    }

}