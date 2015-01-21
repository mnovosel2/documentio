@extends('layouts.scaffold')

@section('main')

<h1>All versions</h1>
<p>{{ link_to_route('versions.create', 'New version',['documentId'=>$documentId], array('class' => 'btn btn-lg btn-success')) }}</p>
@if (count($documents))
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Heading</th>
				<th>Version</th>
				<th>Date created</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($documents as $document)
				<tr>
					<td>{{{ $document->heading }}}</td>
					<td>{{{ $document->version_hash }}}</td>
					<td>{{{date("d-m-Y", strtotime($document->created_at))}}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('documents.destroy', $document->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('documents.edit', 'Edit', array($document->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no Documents
@endif

@stop
