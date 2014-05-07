<?php
namespace Plugin\MailerLite;

class SiteController extends \Ip\Controller
{
    public function save()
    {
        $postData = ipRequest()->getPost();

        $form = \Plugin\MailerLite\Widget\MailerLite\Model::showForm();

        $errors = $form->validate($postData);

        if (!$errors){

            $email = $postData['email'];
            \Plugin\MailerLite\Widget\MailerLite\Model::addSubscriber($email);

            $thankYouMessage = ipGetOption('MailerLite.thankYouMessage');

            $data = array('email'=> $email, 'thankYouMessage'=>$thankYouMessage);
            $answer = ipView('view/thankyou.php', $data)->render();

            return new \Ip\Response\Json(array(
                'replaceHtml' => $answer
            ));

        }else{
            return new \Ip\Response\Json(array(
                'status' => 'error',
                'errors' => $errors
            ));
        }


    }



}
