<?php

namespace App\Helpers\Formatters;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class CsvFormatter to format the books collection to CSV
 * @package App\Helpers\Formatters
 */
class CsvFormatter extends AbstractFormatter
{
    public function __construct()
    {
        parent::__construct('text/csv', 'csv');
    }

    public function convert(Collection $books, array $fields): string
    {
        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $fields);
        foreach ($books as $book) {
            fputcsv($handle, $book->toArray());
        }
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return $content;
    }
}
