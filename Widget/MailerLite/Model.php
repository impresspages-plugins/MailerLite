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

    public static function showForm($listId){
        // Create a form object
        $form = new \Ip\Form();

        // Add a text field to form object
        $field = new \Ip\Form\Field\Email(
            array(
                'name' => 'email', // HTML "name" attribute
                'label' => ipGetOption('MailerLite.emailFormLabel'), // Field label that will be displayed next to input field
            ));
        $field->addValidator('Required');
        $form->addField($field);

        $field = new \Ip\Form\Field\Submit(
            array(
                'name' => 'submit', // HTML "name" attribute
                'value' => ipGetOption('MailerLite.subscribeFormLabel'), // Field label that will be displayed next to input field
            ));
        $form->addField($field);



        $field = new \Ip\Form\Field\Hidden(
            array(
                'name' => 'listId', // HTML "name" attribute
                'value' => $listId, // Field label that will be displayed next to input field
            ));
        $field->addValidator('Required');
        $form->addField($field);

        $field = new \Ip\Form\Field\Hidden(
            array(
                'name' => 'sa', // HTML "name" attribute
                'value' => 'MailerLite.save', // Field label that will be displayed next to input field
            ));
        $form->addField($field);

        return $form;
    }

    public static function groupSelectForm()
    {
        $form = new \Ip\Form();

        if ($values = self::getAllLists()){

            $selectFields = array(
                'name' => 'selectedGroup',
                'label' => __('Select MailerLite group:','MailerLite'),
                'values' => $values,
                'value' => 1
            );


            $field = new \Ip\Form\Field\Select($selectFields);
            $form->addField($field);
        }

        return  $form;

    }

    public static function getApiKey(){

        $key = ipGetOption('MailerLite.apiKey');
        return $key;
    }

    public static function getAllLists()
    {
        require_once(ipFile('Plugin/MailerLite/lib/ML_Lists.php'));

        if ($ML_Lists = new \ML_Lists( self::getApiKey() )){
            $lists = json_decode($ML_Lists->getAll( ));

            $retval = false;

            if (!empty($lists->Results)){
                foreach ($lists->Results as $list){
                    if (isset($list->id)&&(isset($list->name))){
                        $retval[]= array($list->id, $list->name);
                    }
                }
            }

            return $retval;
        }else{
            return false;
        }
    }

    public static function addSubscriber($email, $listId){

        require_once(ipFile('Plugin/MailerLite/lib/ML_Subscribers.php'));
        $apiKey = self::getApiKey();
        if ($ML_Subscribers = new \ML_Subscribers( $apiKey )){

            $subscriber = array(
                'email' => $email,
            );


            $ML_Subscribers->setId($listId )->add( $subscriber, 1 /* set resubscribe to true*/ );
        }
    }
}