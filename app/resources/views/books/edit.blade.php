@extends('layouts.app')
@section('title', 'Books')

@section('content')

@include('books.form' , ['book' => $book])
@endsection
