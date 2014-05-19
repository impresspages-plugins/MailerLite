<?php
namespace Plugin\MailerLite;

class SiteController extends \Ip\Controller
{
    public function save()
    {
        $postData = ipRequest()->getPost();

        $listId = $postData['listId'];

        $form = \Plugin\MailerLite\Widget\MailerLite\Model::showForm($listId);

        $errors = $form->validate($postData);

        if (!$errors){

            $email = $postData['email'];
            $listId = $postData['listId'];
            \Plugin\MailerLite\Widget\MailerLite\Model::addSubscriber($email, $listId);

            $data = array('email'=> $email);
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
