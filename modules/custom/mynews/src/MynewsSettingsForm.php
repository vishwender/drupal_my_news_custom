<?php
namespace Drupal\Mynews;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides Configure settings.
 */

 class MynewsSettingsForm extends ConfigFormBase{

    /**
     * @inheritdoc
     */

     public function getFormId(){
        return 'mynews_admin_settings';
     }

     /**
      * @inheritdoc
      */

      public function getEditableConfigNames(){
        return ['mynews.settings'];
      }

      /**
       * @inheritdoc
       */

      public function buildForm(array $form, FormStateInterface $form_state){   
        $config = $this->config('mynews.settings');
        if(empty($config->get('mynews_access_token'))){
            $mynews_access_token = "";
        }else{
            $mynews_access_token = $config->get('mynews_access_token');
        }

        $form['mynews'] = array(
            '#type' => 'fieldset',
            '#title' => $this->t('Mynews Settings'),
            '#collapsible' => FALSE,
        );

        $form['mynews']['mynews_access_token'] = array(
            '#type' => 'textarea',
            '#title' => $this->t('Mynews Access Token'),
            '#size' => 150,
            '#default_value' => $mynews_access_token,
            '#required' => TRUE,
            '#description' => $this->t('Access Token from Newsapi.org'),
        );

        return parent::buildForm($form, $form_state);
      }

        /**
         * @inheritdoc
         */

        public function submitForm(array &$form, FormStateInterface $form_state){
            $this->config('mynews.settings')
                ->set('mynews_access_token', $form_state->getValue('mynews_access_token'))
                ->save();
            
            parent::submitForm($form, $form_state);
        }
 }