<?php
use Documentio\Repositories\Documents\DocumentInterface;
use \Documentio\Repositories\XMLParser\XMLParserInterface;
class DocumentController extends BaseController {
    protected $document;
    protected $parser;
    public function __construct(DocumentInterface $document,XMLParserInterface $parser){
        $this->document=$document;
        $this->parser=$parser;
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($repositoryId)
	{

        $documents=$this->document->listDocuments($repositoryId);
        return View::make('documents.index',['documents'=>$documents,'repositoryId'=>$repositoryId]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
        return View::make('documents.create',['repositoryId'=>$id]);
	}

	public function store($repositoryId)
	{
        $data=Input::all();
        $parsedData=$this->parser->parse($data['document']);
        $data['document']=$parsedData;
        $file=Input::file('logo');
		if($this->document->store($repositoryId,$data,$file)){
            return  Redirect::route('documents.index',['repositoryId'=>$repositoryId]);
        }else{
            return Redirect::route('documents.create')
                ->withInput()
                ->with('message', 'There were errors.');
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $this->document->show($id);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id,$repositoryId)
	{
       return  $this->document->edit($id,$repositoryId);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,$repositoryId)
	{
        $data=array_except(Input::all(),['_method','_token']);

		return $this->document->update($id,$repositoryId,$data);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, $repositoryId)
	{
		$this->document->destroy($id,$repositoryId);
        return \Redirect::route('documents.index',['repositoryId'=>$repositoryId]);
	}
    public function versions($documentId){
      $documents=$this->document->versions($documentId);

      return View::make('versions.index',['documents'=>$documents,'documentId'=>$documentId]);
    }
    public function createVersion($documentId){
        $parsedData=[];
        if(Input::all()){
            $data=Input::except(['token','_method']);
            $parsedData=$this->parser->parse($data['document']);
            $parsedData['version_hash']=$data['version_hash'];
            $parsedData['description']=$data['description'];
            $parsedData['tags']=$data['tags'];
            $parsedData['url']=$data['url'];
            $parsedData['format']=$data['format'];
            $parsedData['repositoryId']=$data['repositoryId'];
        }
        if(!empty($parsedData)){
            $document=$this->document->createVersion($documentId,$parsedData);
            return $document;
        }else{
            $document=$this->document->createVersion($documentId);
            return View::make('versions.create',compact('document'));
        }


    }
}
