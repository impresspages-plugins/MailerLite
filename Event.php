<?php

namespace Plugin\MailerLite;

class Event
{
    public static function ipBeforeController()
    {
        ipAddJs('Widget/MailerLite/assets/mailerlite.js');
    }
}
