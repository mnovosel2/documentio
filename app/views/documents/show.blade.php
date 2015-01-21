@extends('layouts.scaffold')

@section('main')

<h1>Show Document</h1>

<p>{{ link_to_route('Documents.index', 'Return to All Documents', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

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
			<td>{{{ $Document->repository_id }}}</td>
					<td>{{{ $Document->heading }}}</td>
					<td>{{{ $Document->subheading }}}</td>
					<td>{{{ $Document->abstract }}}</td>
					<td>{{{ $Document->content }}}</td>
					<td>{{{ $Document->logo }}}</td>
					<td>{{{ $Document->tags }}}</td>
					<td>{{{ $Document->url }}}</td>
					<td>{{{ $Document->format }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('Documents.destroy', $Document->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('Documents.edit', 'Edit', array($Document->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
