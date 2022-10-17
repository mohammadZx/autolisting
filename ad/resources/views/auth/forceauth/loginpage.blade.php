@extends('layouts.master')

@section('content')
	@includeFirst([config('larapen.core.customizedViewPath') . 'common.spacer', 'common.spacer'])

<div class="mb-3 mt-3">
	@include('auth.forceauth.loginform')
</div>

@endsection
