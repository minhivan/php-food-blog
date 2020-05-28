@extends('master')
@section('content')
<!-- // Banner -->
<!-- Content -->
<div class="error-page">
    <div class="container">
        <div class="container__error_text">
            <h1 class="error-page__headline">Whoops...</h1>
            <h2 class="error-page__subhead" >this page can't be found</h2>
            <p class="error-page__description">If you bookmarked the page, try our search to find what you're
                looking for.
                <br>
                If you typed the address, be sure it was entered correctly.
                <br>
                If you feel you reached this page in error,
                <a href="https://food.custhelp.com/" target="_blank" rel="noopner" class="error-page__description-btn">Contact Us</a>.
            </p>
        </div>
    </div>
</div>
<!-- // Content -->
@endsection
