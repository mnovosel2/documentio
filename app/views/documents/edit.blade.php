@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit Document</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($document, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('documents.update', $document->id,$repositoryId))) }}

        <div class="form-group">

            <div class="col-sm-10">
              {{ Form::hidden('repository_id', $document->repositoryId, array('class'=>'form-control')) }}
               {{ Form::hidden('id',$documentId) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('heading', 'Heading:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('heading', Input::old('heading'), array('class'=>'form-control', 'placeholder'=>'Heading')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('subheading', 'Subheading:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('subheading', Input::old('subheading'), array('class'=>'form-control', 'placeholder'=>'Subheading')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('abstract', 'Abstract:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('abstract', Input::old('abstract'), array('class'=>'form-control', 'placeholder'=>'Abstract')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('content', 'Content:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('content', Input::old('content'), array('class'=>'form-control', 'placeholder'=>'Content')) }}
            </div>
        </div>



        <div class="form-group">
            {{ Form::label('tags', 'Tags:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('tags', Input::old('tags'), array('class'=>'form-control', 'placeholder'=>'Tags')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('url', 'Url:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('url', Input::old('url'), array('class'=>'form-control', 'placeholder'=>'Url')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('format', 'Format:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('format', Input::old('format'), array('class'=>'form-control', 'placeholder'=>'Format','readonly'=>'readonly')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('documents.show', 'Cancel', $document->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop