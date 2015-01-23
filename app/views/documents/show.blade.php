@extends('layouts.scaffold')

@section('main')

<h1>Show Document</h1>

<p>{{ link_to_route('documents.index', 'Return to All documents', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Repository_id</th>
				<th>Heading</th>
				<th>Subheading</th>
				<th>Abstract</th>
				<th>Content</th>
				<th>Logo</th>
				<th>Tags</th>
				<th>Url</th>
				<th>Format</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $document->repository_id }}}</td>
					<td>{{{ $document->heading }}}</td>
					<td>{{{ $document->subheading }}}</td>
					<td>{{{ $document->abstract }}}</td>
					<td>{{{ $document->content }}}</td>
					<td>{{{ $document->logo }}}</td>
					<td>{{{ $document->tags }}}</td>
					<td>{{{ $document->url }}}</td>
					<td>{{{ $document->format }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('documents.destroy', $document->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('documents.edit', 'Edit', array($document->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
