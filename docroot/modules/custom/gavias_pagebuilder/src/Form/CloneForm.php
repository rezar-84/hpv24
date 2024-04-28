<?php
namespace Drupal\gavias_pagebuilder\Form;

use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation;
use Drupal\Core\Url;

class CloneForm implements FormInterface {
   /**
   * Implements \Drupal\Core\Form\FormInterface::getFormID().
   */
   public function getFormID() {
      return 'import_form';
   }

   /**
    * Implements \Drupal\Core\Form\FormInterface::buildForm().
   */
    public function buildForm(array $form, FormStateInterface $form_state) {
      $bid = 0;
      if(\Drupal::request()->attributes->get('bid')) $bid = \Drupal::request()->attributes->get('bid');
      if (is_numeric($bid) && $bid > 0) {
        $builder = \Drupal::database()->select('{gavias_pagebuilder}', 'd')
            ->fields('d', array('id', 'title', 'machine_name'))
            ->condition('id', $bid)
            ->execute()
            ->fetchAssoc();
      } else {
        $builder = array('id' => 0, 'title' => '', 'machine_name' => '');
      }      

       $form['id'] = array(
          '#type' => 'hidden',
          '#default_value' => $builder['id']
      );
      $form['title'] = array(
        '#type' => 'textfield',
        '#title' => 'Title',
        '#default_value' => 'Clone ' . $builder['title']
      );
       $form['machine_name'] = array(
        '#type' => 'textfield',
        '#title' => 'Machine name',
        '#description' => 'A unique machine-readable name containing letters, numbers, and underscores<br>Sample home_page_1, Use shortcode for page basic [gbb name="home_page_1"]',
        '#default_value' => ''
      );
      $form['actions'] = array('#type' => 'actions');
      $form['submit'] = array(
        '#type' => 'submit',
        '#value' => 'Save'
      );
    return $form;
   }

   /**
   * Implements \Drupal\Core\Form\FormInterface::validateForm().
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!$form_state->getValue('title')  ) {
      $form_state->setErrorByName('title', 'Please enter title for buider block.');
    }
  }

   /**
   * Implements \Drupal\Core\Form\FormInterface::submitForm().
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if ($form['id']['#value']) {
      $bid = $form['id']['#value'];
      if (is_numeric($bid) && $bid > 0) {
        $builder = \Drupal::database()->select('{gavias_pagebuilder}', 'd')
            ->fields('d', array('id', 'title', 'params'))
            ->condition('id', $bid)
            ->execute()
            ->fetchAssoc();
      } else {
        $builder = array('id' => 0, 'title' => '', 'machine_name' => '', 'params' => '');
      }    

      $pid = \Drupal::database()->insert("gavias_pagebuilder")
        ->fields(array(
            'title'         => $form['title']['#value'],
            'machine_name'  => $form['machine_name']['#value'],
            'params'        => $builder['params'],
        ))
        ->execute();
      \Drupal::service('plugin.manager.block')->clearCachedDefinitions();
      \Drupal::messenger()->addMessage("Builder '{$form['title']['#value']}' has been clone");
      $response = new \Symfony\Component\HttpFoundation\RedirectResponse(Url::fromRoute('gavias_pagebuilder.admin')->toString());
      $response->send();
    }  
  }
}