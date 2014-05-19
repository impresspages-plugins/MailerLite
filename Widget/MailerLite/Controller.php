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

        $lists = Model::getAllLists();
        $variables ['lists'] = $lists;

        if ($lists === false) {
            $noapikeyVars = array(
                'pluginConfigUrl' => ipConfig()->baseUrl() . '?aa=Plugins.index#/hash=&plugin=MailerLite'
            );
            $variables['note'] = ipView('view/noapikey.php', $noapikeyVars);
        } elseif (time() < strtotime('2015-06-01')) {
            $variables['note'] = ipView('view/voucher.php');
        } else {
            $variables['note'] = '';
        }

        return ipView('snippet/popup.php', $variables)->render();
    }

}
