<?php

// Put this into Controller.php

namespace Plugin\MailerLite\Widget\MailerLite;

class Controller extends \Ip\WidgetController
{
    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {
        if (isset($data['selectedGroup'])) {
            $listId = $data['selectedGroup'];
            $form = Model::showForm($listId);
            $formHtml = $form->render();
            $data['formHtml'] = $formHtml;

        } else {
            $data['formHtml'] = '';
        }

        return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }

    public function adminHtmlSnippet()
    {
        $form = Model::groupSelectForm();

        $variables = array(
            'form' => $form
        );

        if (time() < strtotime('2015-06-01')) {
            $variables['commercial'] = ipView('view/commercial.php');
        } else {
            $variables['commercial'] = '';
        }

        return ipView('snippet/popup.php', $variables)->render();
    }

}
