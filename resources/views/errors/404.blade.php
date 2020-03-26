@extends('layouts.app')
@section('title','Gabim 404')
@section('dashboar','active')
@section('content')
<!-- 404 Error Text -->
<div class="text-center">
  <div class="error mx-auto" data-text="404">404</div>
  <p class="lead text-gray-800 mb-5">Faqja Nuk është gjendur</p>
  <p class="text-gray-500 mb-0">Faqja e cila po kërkoni nuk gjindet...</p>
  <a href="/">&larr; Kthehu në fillim</a>
</div>
@endsection