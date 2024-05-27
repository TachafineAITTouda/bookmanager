@extends('layouts.app')
@section('title', 'Author Edit')

@section('content')

@include('authors.form' , ['author' => $author])
@endsection
