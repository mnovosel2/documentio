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

{{ Form::open(array('route' => ['documents.store',$repositoryId],'files'=>true, 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{Form::label('document','XML document',array('class'=>'col-md-2 control-label'))}}
             <div class="col-sm-10">
                {{ Form::textarea('document', Input::old('document'), array('class'=>'form-control', 'placeholder'=>'Document')) }}
              </div>
        </div>

        <div class="form-group">
            {{ Form::label('logo', 'Logo:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
             {{Form::file('logo',['class'=>'form-control'])}}
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
            {{ Form::label('formats', 'Format:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
                {{Form::select('formats',['html'=>'html','pdf'=>'pdf' ],['html'],['class'=>'form-control'])}}
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


