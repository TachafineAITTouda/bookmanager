<?php

namespace App\Http\Controllers;

use App\Helpers\Formatters\{CsvFormatter, XmlFormatter};
use App\Http\Requests\ExportRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use SimpleXMLElement;

class ExportController extends Controller
{

    public function __construct(private XmlFormatter $xmlFormatter, private CsvFormatter $csvFormatter)
    {
    }
    /**
     * Display export form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('exports.index');
    }

    /**
     * Export data to CSV or XML file.
     *
     * @param \App\Http\Requests\ExportRequest $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\Response
     */
    public function export(ExportRequest $request)
    {
        $format = $request->format;
        $fields = $request->fields;

        $fields = ($fields === 'all') ? ['title', 'author'] : [$fields];

        if (in_array('title', $fields)) {
            $query = Book::query();
            $query->addSelect('books.title');
            if (in_array('author', $fields)) {
                $query->addSelect('authors.fullname as author')
                      ->join('authors', 'authors.id', '=', 'books.author_id');
            }
        }else {
            $query = Author::query();
            $query->addSelect('authors.fullname as author');
        }

        $data = $query->get();

        if ($format === 'csv') {
            return $this->csvFormatter->format($data, $fields);
        } elseif ($format === 'xml') {
            return $this->xmlFormatter->format($data, $fields);
        }

        return redirect()->route('export.index')->with('error', 'Invalid format.');
    }
}
