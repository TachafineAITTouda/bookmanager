<?php

namespace App\Helpers\Formatters;

use Illuminate\Database\Eloquent\Collection;
use SimpleXMLElement;

/**
 * Class XmlFormatter to format the books collection to XML
 * @package App\Helpers\Formatters
 */
class XmlFormatter extends AbstractFormatter
{
    public function __construct()
    {
        parent::__construct('application/xml', 'xml');
    }

    public function convert(Collection $books, array $fields): string
    {
        $xml = new SimpleXMLElement('<books/>');
        $fields = array_map('strtolower', $fields);
        foreach ($books as $book) {
            $xmlBook = $xml->addChild('book');
            foreach ($fields as $field) {
                $xmlBook->addChild($field, $book->$field);
            }
        }
        return $xml->asXML();
    }
}
