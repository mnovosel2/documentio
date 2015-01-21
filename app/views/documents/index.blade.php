@extends('layouts.scaffold')

@section('main')

<h1>All Documents</h1>

<p>{{ link_to_route('documents.create', 'Add New Document',['repositoryId'=>$repositoryId], array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($documents->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Heading</th>
				<th>Format</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($documents as $document)
				<tr>
					<td>{{{ $document->heading }}}</td>
					<td>{{{ $document->formats }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('documents.destroy', $document->id,$repositoryId))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('documents.edit', 'Edit', array($document->id), array('class' => 'btn btn-info')) }}
                        {{ link_to_route('documents.versions', 'All versions', [$document->id], array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no Documents
@endif

@stop
