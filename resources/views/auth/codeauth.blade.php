@extends('layouts.Out')
@section('con')
    @livewire('CodeAuth',['code'=>session()->get('usercode')])
@endsection