@extends('layouts.scaffold')

@section('main')
@include('documents.searchbar')
<h1>All Repositories</h1>

<p>{{ link_to_route('repositories.create', 'Add New Repository', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($repositories->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Tags</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($repositories as $repository)
				<tr>
					<td>{{{ $repository->name }}}</td>
					<td>{{{ $repository->description }}}</td>
					<td>{{{ $repository->tags }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('repositories.destroy', $repository->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('repositories.edit', 'Edit', array($repository->id), array('class' => 'btn btn-info')) }}
                        {{ link_to_route('documents.create', 'Add document', [$repository->id], array('class' => 'btn btn-info')) }}
                        {{ link_to_route('documents.index', 'List documents', [$repository->id], array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no repositories
@endif

@stop
