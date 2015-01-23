<?php
namespace Documentio\Repositories\Documents;
class DocumentRepository implements DocumentInterface{
    public function update($documentId,$repositoryId,$data){
        $validation = \Validator::make($data, \Document::$rules);

        if ($validation->passes())
        {

            $document =\Document::find($documentId)->update($data);

            return \Redirect::route('documents.index',$repositoryId);
        }
    }
    public function store($repositoryId,$data,$file){
        $document=$data['document'];
        $structuredDocument['heading']=trim(preg_replace('/\s\s+/', ' ', $document['heading']));
        $structuredDocument['subheading']=trim(preg_replace('/\s\s+/', ' ',$document['subheading']));
        $structuredDocument['abstract']=trim(preg_replace('/\s\s+/', ' ',$document['abstract']));
        $structuredDocument['content']=trim(preg_replace('/\s\s+/', ' ',$document['content']));
        $structuredDocument['tags']='{'.$data['tags'].'}';
        $structuredDocument['url']=$data['url'];
        $structuredDocument['format']=$data['formats'];
        $structuredDocument['repository_id']=$repositoryId;
        $structuredDocument['parent']=true;
        $validation = \Validator::make($structuredDocument, \Document::$rules);

        if ($validation->passes())
        {


            $documentToSave=new \Document();
            $documentToSave->fill($structuredDocument);
            $documentToSave->save();
            $lastDocumentId=$documentToSave->id;
            if($file) {
                $ext = $file->guessExtension();
                $filename=md5($file->getClientOriginalName().strtotime("now")).'_'.$file->getClientOriginalName();
                $file->move(public_path().'/assets/uploaded/',$filename);
                $path=public_path().'/assets/uploaded/'.$filename;
                \DB::update("UPDATE documents SET logo=lo_import('$path'),SET logo_path='$path' WHERE id=".$lastDocumentId.";");
            }

            $version=new \Version();
            $version->version_hash=substr(md5($document['heading'].strtotime("now")),0,15);
            $version->parent_document=$lastDocumentId;
            $version->document()->associate($documentToSave);
            $version->save();
            return true;
        }
        return false;
    }
    public function destroy($documentId,$repositoryId){
        \Document::find($documentId)->delete();


    }
    public function listDocuments($repositoryId){
        $documents=\Document::where('repository_id','=',$repositoryId)->where('parent','=',true)->get();

        return $documents;
    }
    public function show($documentId){
        $document=\Document::firstOrFail($documentId);
        return \View::make('documents.show', compact('document'));
    }
    public function edit($documentId,$repositoryId){
        $document = \Document::find($documentId);
        if (is_null($document))
        {
            return \Redirect::route('documents.index');
        }

        return \View::make('documents.edit', ['document'=>$document,'documentId'=>$documentId,'repositoryId'=>$repositoryId]);
    }
    public function versions($documentId){
        $versions=\Version::where('parent_document','=',$documentId)->get()->toArray();
        $documents=[];
        foreach($versions as $version){
            $document=\Document::where('id','=',$version['document_id'])->get()->toArray();
            if($document[0]['heading']){
                $document[0]['version_hash']=$version['version_hash'];
                $documents[]=$document;
            }

        }
        return $documents;
    }
    public function createVersion($documentId,$parsedData=[]){
        if(!empty($parsedData)){
            $documentData['repository_id']=$parsedData['repositoryId'];
            $documentData['heading']=trim(preg_replace('/\s\s+/', ' ',$parsedData['heading']));
            $documentData['subheading']=trim(preg_replace('/\s\s+/', ' ',$parsedData['subheading']));
            $documentData['abstract']=trim(preg_replace('/\s\s+/', ' ',$parsedData['abstract']));
            $documentData['content']=trim(preg_replace('/\s\s+/', ' ',$parsedData['content']));
            $documentData['tags']=$parsedData['tags'];
            $documentData['url']=$parsedData['url'];
            $documentData['format']=$parsedData['format'];
            $documentData['parent']=false;


            $documentToCreate=new \Document();
            $documentToCreate->fill($documentData);
            $documentToCreate->save();
            $versionData['document_id']=$documentToCreate->id;
            $versionData['parent_document']=$documentId;
            $versionData['version_hash']=$parsedData['version_hash'];
            $versionToCreate=new \Version();
            $versionToCreate->fill($versionData);
            $versionToCreate->save();

            return \Redirect::route('documents.versions',$documentId);
        }
        $document=\Document::find($documentId)->first();
        $version_hash=substr(md5($document['heading'].strtotime("now")),0,15);
        $document['version_hash']=$version_hash;
        $structuredDocument='<document>'."\n";
        $structuredDocument.='<heading>'.$document['heading'].'</heading>'."\n";
        $structuredDocument.='<subheading>'.$document['subheading'].'</subheading>'."\n";
        $structuredDocument.='<abstract>'.$document['abstract'].'</abstract>'."\n";
        $structuredDocument.='<content>'.$document['content'].'</content>'."\n";
        $structuredDocument.='</document>';
        $document['structured']=$structuredDocument;
        return $document;
    }
}