<?php
/**
 * Created by PhpStorm.
 * User: Marijus
 * Date: 5/7/14
 * Time: 12:12 PM
 */
namespace Plugin\MailerLite\Widget\MailerLite;

class Model{

    public function __construct(){
        require_once(ipFile('Plugin/MailerLite/lib/ML_Subscribers.php'));
    }

    public static function showForm(){
        // Create a form object
        $form = new \Ip\Form();


        // Add a text field to form object
        $field = new \Ip\Form\Field\Email(
            array(
                'name' => 'email', // HTML "name" attribute
                'label' => ipGetOption('MailerLite.emailFormLabel'), // Field label that will be displayed next to input field
            ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Submit(
            array(
                'name' => 'submit', // HTML "name" attribute
                'value' => ipGetOption('MailerLite.subscribeFormLabel'), // Field label that will be displayed next to input field
            ));
        $form->addField($field);

        $field = new \Ip\Form\Field\Hidden(
            array(
                'name' => 'sa', // HTML "name" attribute
                'value' => 'MailerLite.save', // Field label that will be displayed next to input field
            ));
        $form->addField($field);

        return $form;
    }

    public static function getApiKey(){

        $key = ipGetOption('MailerLite.apiKey');
        return $key;
    }

    public static function getList(){
        $listId = ipGetOption('MailerLite.listId');
        return $listId;
    }
    public static function getAllLists()
    {

    }

    public static function addSubscriber($email){

        require_once(ipFile('Plugin/MailerLite/lib/ML_Subscribers.php'));
        $apiKey = self::getApiKey();
        $ML_Subscribers = new \ML_Subscribers( $apiKey );

        $subscriber = array(
            'email' => $email,
        );

        $listId = self::getList();

        $ML_Subscribers->setId($listId )->add( $subscriber, 1 /* set resubscribe to true*/ );
    }
}