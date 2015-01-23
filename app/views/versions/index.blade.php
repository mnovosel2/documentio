@extends('layouts.scaffold')

@section('main')

<h1>All versions</h1>
<p>{{ link_to_route('versions.create', 'New version',['documentId'=>$documentId], array('class' => 'btn btn-lg btn-success')) }}</p>
@if (count($documents))
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Heading</th>
				<th>Description</th>
				<th>Version</th>
				<th>Options</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($documents as $document)
			 	<tr>

             	    <td>{{{ $document[0]['heading'] }}}</td>
             	    <td>{{$document[0]['description']}}</td>
             		<td>{{{ $document[0]['version_hash'] }}}</td>

                    <td>
                       {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('documents.destroy', $document[0]['id'],$document[0]['repository_id']))) }}
                       {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                       {{ Form::close() }}
                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target={{'#'.$document[0]['id']}}>
                         Preview
                       </button>
                    </td>
             	</tr>
             	<div class="modal fade" id={{$document[0]['id']}} tabindex="-1" role="dialog" aria-labelledby={{$document[0]['heading']}} aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id={{$document[0]['heading']}}>{{$document[0]['heading']}}</h4>
                      </div>
                      <div class="modal-body">
                      @if(!empty($document[0]['logo_path']))
                       <img src={{$document[0]['logo_path']}} alt="document-logo" style="display:block;max-width:100%"/>
                      @endif
                        <p style="font-size:14px">{{$document[0]['abstract']}}</p>
                         <hr>
                        <p>{{$document[0]['content']}}</p>

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
