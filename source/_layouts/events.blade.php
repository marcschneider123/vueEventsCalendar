@extends('_layouts/base', ['class' => 'bg-medium'])
@section ('title', 'Vue Events')
@section('meta-description', '')

@section('body')
	<div class="container">
		<div class="row">
			<div class="col-6">
				<h1>{{$page->title}}</h1>
				<p>
					{{$page->location}}
					<br>
					{{$page->date}}
				</p>
				<p>
					Beginn: {{$page->time}}
					<br>
					{{$page->location}}
				</p>
				<p>
					<button class="btn btn-primary">Zum Kalender hinzufügen</button>
					<button class="btn btn-secondary">Auf Facebook folgen</button>
				</p>
			</div>
			<div class="col-6">
				<div style="width:300px;height:300px" class="border">Karte</div>
			</div>
		</div>
	</div>
@stop
