<?php

namespace Moxl\Stanza;

use Moxl\Stanza\Form;

class Register {
    static function get($to = false)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $query = $dom->createElementNS('jabber:iq:register', 'query');

        \Moxl\API::request(\Moxl\API::iqWrapper($query, $to, 'get'));
    }

    static function set($to = false, $data)
    {
        $form = new Form($data);

        $xml = '
            <query xmlns="jabber:iq:register">
                '.$form.'
            </query>
            ';
        $xml = \Moxl\API::iqWrapper($xml, $to, 'set');
        \Moxl\API::request($xml);
    }

    static function remove()
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $query = $dom->createElementNS('jabber:iq:register', 'query');
        $query->appendChild($dom->createElement('remove'));

        $xml = \Moxl\API::iqWrapper($query, false, 'set');
        \Moxl\API::request($xml);
    }

    static function changePassword($to, $username, $password)
    {
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $query = $dom->createElementNS('jabber:iq:register', 'query');
        $query->appendChild($dom->createElement('username', $username));
        $query->appendChild($dom->createElement('password', $password));

        $xml = \Moxl\API::iqWrapper($query, $to, 'set');
        \Moxl\API::request($xml);
    }
}
