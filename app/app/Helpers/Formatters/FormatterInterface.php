<?php

namespace App\Helpers\Formatters;

use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Interface FormatterInterface defining the methods that a Formatter class should implement
 * @package App\Helpers\Formatters
 */
interface FormatterInterface
{
    /**
     * Format the given collection of books and return a StreamedResponse to download the formatted content
     *
     * @param Collection $books
     * @param array $fields
     * @return StreamedResponse
     */
    public function format( Collection $books, array $fields): StreamedResponse;

    /**
     * Convert the given collection of books to the desired format
     *
     * @param Collection $books
     * @param array $fields
     * @return string
     */
    public function convert(Collection $books, array $fields): string;

    /**
     * Get the content type of the formatted file
     *
     * @return string
     */
    public function getContentType(): string;

    /**
     * Get the file extension of the formatted file
     *
     * @return string
     */
    public function getFileExtension(): string;

    /**
     * Get the file name of the formatted file
     *
     * @return string
     */
    public function getFileName(): string;
}
