<?php
namespace Drupal\gavias_pagebuilder\Form;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
class DelForm extends ConfirmFormBase  {
   /**
   * The ID of the item to delete.
   *
   * @var string
   */
    protected $bid;

   /**
   * Implements \Drupal\Core\Form\FormInterface::getFormID().
   */
   public function getFormID() {
      return 'del_form';
   }
  
  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Do you want to delete %bid?', array('%bid' => $this->bid));
  }

  /**
   * {@inheritdoc}
   */
    public function getCancelUrl() {
      return new Url('gavias_pagebuilder.admin');
  }

  /**
   * {@inheritdoc}
   */
    public function getDescription() {
    return t('Only do this if you are sure!');
  }

  /**
   * {@inheritdoc}
   */
    public function getConfirmText() {
    return t('Delete it!');
  }

  /**
   * {@inheritdoc}
   */
    public function getCancelText() {
    return t('Cancel');
  }

  /**
   * {@inheritdoc}
   *
   * @param int $id
   *   (optional) The ID of the item to be deleted.
   */
  public function buildForm(array $form, FormStateInterface $form_state, $bid = NULL) {
    $this->bid = $bid;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
     $bid = $this->bid;
    if(!$bid && \Drupal::request()->attributes->get('bid')) $bid = \Drupal::request()->attributes->get('bid');
    \Drupal::database()->delete('gavias_pagebuilder')
            ->condition('id', $bid)
            ->execute();
    \Drupal::service('plugin.manager.block')->clearCachedDefinitions();
    \Drupal::messenger()->addMessage("blockbuilder '#{$bid}' has been delete");
    $response = new \Symfony\Component\HttpFoundation\RedirectResponse(Url::fromRoute('gavias_pagebuilder.admin')->toString());
    $response->send();
  }

}