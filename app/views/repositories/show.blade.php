@extends('layouts.scaffold')

@section('main')

<h1>Show Repository</h1>

<p>{{ link_to_route('repositories.index', 'Return to All repositories', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
				<th>Owner_id</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $repository->name }}}</td>
					<td>{{{ $repository->owner_id }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('repositories.destroy', $repository->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('repositories.edit', 'Edit', array($repository->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
