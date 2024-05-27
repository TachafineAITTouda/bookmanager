<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use SimpleXMLElement;

class ExportController extends Controller
{
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

        if ($fields === 'all') {
            $fields = ['title', 'author'];
        }else{
            $fields = explode(',', $fields);
        }

        $query = Book::query();

        if (in_array('title', $fields)) {
            $query->addSelect('books.title');
        }

        if (in_array('author', $fields)) {
            $query->addSelect('authors.fullname as author')
                  ->join('authors', 'authors.id', '=', 'books.author_id');
        }

        $data = $query->get();

        $fields = array_map(function ($field) {
            return ucfirst($field);
        }, $fields);

        if ($format === 'csv') {
            return $this->exportCsv($data, $fields);
        } elseif ($format === 'xml') {
            return $this->exportXml($data, $fields);
        }

        return redirect()->route('export.index')->with('error', 'Invalid format.');
    }

    /**
     * Export data to CSV format.
     *
     * @param \Illuminate\Support\Collection $data
     * @param array $fields
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    private function exportCsv($data, $fields)
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export_'.date('Y-m-d_H-i-s').'.csv"',
        ];

        $callback = function () use ($data, $fields) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $fields);
            foreach ($data as $row) {
                $csvRow = [];
                foreach ($fields as $field) {
                    $csvRow[] = $row->$field ?? '';
                }
                fputcsv($handle, $csvRow);
            }
            fclose($handle);
        };
        return Response::stream($callback, 200, $headers);
    }

    /**
     * Export data to XML format.
     *
     * @param \Illuminate\Support\Collection $data
     * @param array $fields
     * @return \Illuminate\Http\Response
     */
    private function exportXml(Collection $data, array $headings)
    {
        $headers = [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="export_'.date('Y-m-d_H-i-s').'.xml"',
        ];
        $xml = new \SimpleXMLElement('<data/>');

        foreach ($data as $row) {
            $item = $xml->addChild('row');
            foreach ($headings as $heading) {
                $field = strtolower($heading);
                $item->addChild($heading, htmlspecialchars($row->$field ?? ''));
            }
        }

        return Response::make($xml->asXML(), 200, $headers);
    }
}
