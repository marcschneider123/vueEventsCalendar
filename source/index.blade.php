@extends('_layouts/base', ['class' => 'bg-img'])
@section ('title', 'Vue Events')
@section('meta-description', 'Vue events calendar')

@section('body')
	<section class="events" id="events">
		<div class="container">
			<events></events>
		</div>
	</section>
@stop