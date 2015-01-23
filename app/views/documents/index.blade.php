
@extends('layouts.scaffold')

@section('main')

<h1>All Documents</h1>
@if($repositoryId)
    <p>{{ link_to_route('documents.create', 'Add New Document',['repositoryId'=>$repositoryId], array('class' => 'btn btn-lg btn-success')) }}</p>
@endif
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
                        {{ link_to_route('documents.edit', 'Edit', array($document->id,($repositoryId || $document->repository_id) ), array('class' => 'btn btn-info')) }}
                        {{ link_to_route('documents.versions', 'All versions', [$document->id], array('class' => 'btn btn-info')) }}
                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target={{'#'.$document->id}}>
                          Preview
                       </button>
                    </td>
				</tr>
        	    <div class="modal fade" id={{$document->id}} tabindex="-1" role="dialog" aria-labelledby={{$document->heading}} aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title" id={{$document->heading}}>{{$document->heading}}</h4>
                      </div>
                      <div class="modal-body">
                        <img src={{$document->logo_path}} alt="document-logo" style="max-width: 60px !important"/>
                        {{$document->content}}
                      </div>
                    </div>
                  </div>
                </div>
			@endforeach
		</tbody>
	</table>
@else
	There are no Documents
@endif

@stop
