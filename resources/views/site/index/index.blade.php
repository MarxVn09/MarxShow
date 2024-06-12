@extends('layout.site')


@section('content')
    @include('siteIngredient.index.hero')
    @include('siteIngredient.index.banner')
    @include('siteIngredient.index.product')
    @include('siteIngredient.index.category')
    @include('siteIngredient.index.instagram')
    @include('siteIngredient.index.blog')
@endsection
