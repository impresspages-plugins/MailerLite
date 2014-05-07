<?php

// Put this into Controller.php

namespace Plugin\MailerLite\Widget\MailerLite;

class Controller extends \Ip\WidgetController
{
    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {

        $form = Model::showForm();
        $formHtml = $form->render();
        $data = array ('formHtml' => $formHtml);

        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }

}
