{{Form::open(['method'=>'POST','route'=>['documents.search']])}}
           <div class="form-group">
                {{Form::label('document_heading','Document heading',array('class'=>'col-md-2 control-label'))}}
                 <div class="col-sm-10">
                    {{ Form::text('document_heading', Input::old('document_heading'), array('class'=>'form-control', 'placeholder'=>'Document heading')) }}
                  </div>
            </div>
           <div class="form-group">
                {{Form::label('repository_name','Repository name',array('class'=>'col-md-2 control-label'))}}
                 <div class="col-sm-10">
                    {{ Form::text('repository_name', Input::old('repository_name'), array('class'=>'form-control', 'placeholder'=>'Repository name')) }}
                  </div>
            </div>
           <div class="form-group">
                {{Form::label('version_description','Version description',array('class'=>'col-md-2 control-label'))}}
                 <div class="col-sm-10">
                    {{ Form::text('version_description', Input::old('version_description'), array('class'=>'form-control', 'placeholder'=>'Version description')) }}
                  </div>
            </div>
            <div class="form-group">
                 {{Form::label('tags','Tags',array('class'=>'col-md-2 control-label'))}}
                     <div class="col-sm-10">
                       {{ Form::text('tags', Input::old('tags'), array('class'=>'form-control', 'placeholder'=>'Tags')) }}
                     </div>
           </div>
           <div class="form-group">
               <label class="col-sm-2 control-label">&nbsp;</label>
               <div class="col-sm-10">
                 {{ Form::submit('Search', array('class' => 'btn btn-lg btn-primary')) }}
               </div>
           </div>
{{Form::close()}}