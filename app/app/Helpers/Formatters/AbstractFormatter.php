<?php

namespace App\Helpers\Formatters;

use App\Helpers\Formatters\FormatterInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class AbstractFormatter defining the common properties and methods for all Formatter classes
 * @package App\Helpers\Formatters
 */
abstract class AbstractFormatter implements FormatterInterface
{
    protected string $contentType;
    protected string $fileExtension;
    protected string $fileName;

    public function __construct(string $contentType, string $fileExtension, string $fileName = 'export')
    {
        $this->contentType = $contentType;
        $this->fileExtension = $fileExtension;
        $this->fileName = $fileName;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getFileExtension(): string
    {
        return $this->fileExtension;
    }

    public function getFileName(): string
    {
        return $this->fileName . '-' . Date('Y-m-d-H-i-s') . '.' . $this->fileExtension;
    }

    public function format(Collection $books, array $fields): StreamedResponse
    {
        $fields = array_map('ucfirst', $fields);
        $content = $this->convert($books, $fields);
        return Response::stream(
            fn () => print($content),
            200,
            [
                'Content-Type' => $this->contentType,
                'Content-Disposition' => 'attachment; filename="' . $this->getFileName() . '"',
            ]
        );
    }

    abstract public function convert(Collection $books, array $fields): string;
}
