<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\Formatters\CsvFormatter;
use App\Helpers\Formatters\XmlFormatter;
use App\Models\Book;

class FormatterHelpersTest extends TestCase
{
    /**
     * Test if the csv formatter helper works as expected.
     *
     * @return void
     */

    public function test_csv_formatter(): void
    {
        $csvBooks = Book::all();
        $fields = ['title', 'author'];
        $csvFormatter = new CsvFormatter();
        $response = $csvFormatter->convert($csvBooks, $fields);
        $this->assertStringContainsString('title,author', $response);
    }

    /**
     * Test if the xml formatter helper works as expected.
     *
     * @return void
     */
    public function test_xml_formatter(): void
    {
        $xmlBooks = Book::all();
        $fields = ['title', 'author'];
        $xmlFormatter = new XmlFormatter();
        $response = $xmlFormatter->convert($xmlBooks, $fields);
        $this->assertStringContainsString('<books/>', $response);

    }
}
