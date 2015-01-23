@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Create Document</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('files'=>true, 'class' => 'form-horizontal')) }}

       {{Form::hidden('repositoryId',$document['repository_id'])}}
        <div class="form-group">
            {{Form::label('version_hash','Version ID',array('class'=>'col-md-2 control-label'))}}
             <div class="col-sm-10">
                {{ Form::text('version_hash',$document['version_hash'], array('class'=>'form-control', 'readonly'=>'readonly')) }}
              </div>
        </div>
        <div class="form-group">
            {{Form::label('description','Version description',array('class'=>'col-md-2 control-label'))}}
             <div class="col-sm-10">
                {{ Form::text('description',Input::old('description'), array('class'=>'form-control','placeholder'=>'Version name')) }}
              </div>
        </div>
        <div class="form-group">
            {{Form::label('document','XML document',array('class'=>'col-md-2 control-label'))}}
             <div class="col-sm-10">
                {{ Form::textarea('document', $document['structured'], array('class'=>'form-control', 'placeholder'=>'Document')) }}
              </div>
        </div>

        <div class="form-group">
            {{ Form::label('tags', 'Tags:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('tags', $document['tags'], array('class'=>'form-control', 'placeholder'=>'Tags')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('url', 'Url:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('url', $document['url'], array('class'=>'form-control', 'placeholder'=>'Url')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('format', 'Format:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
                {{Form::select('format',['html'=>'html','pdf'=>'pdf' ],['html'],['class'=>'form-control'])}}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Create', array('class' => 'btn btn-lg btn-primary')) }}
    </div>
</div>

{{ Form::close() }}

@stop


