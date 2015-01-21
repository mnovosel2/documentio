<?php
namespace Documentio\Repositories\Documents;
class DocumentRepository implements DocumentInterface{
    public function update($documentId,$data){
        $validation = \Validator::make($data, \Document::$rules);
        if ($validation->passes())
        {
            $document =\Document::find($documentId);
            $document->update($data);
            return \Redirect::route('documents.show', $documentId);
        }

        return \Redirect::route('documents.edit', $data['repository_id'])
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }
    public function store($repositoryId,$data,$file){
        $document=$data['document'];
        $structuredDocument['heading']=$document['heading'];
        $structuredDocument['subheading']=$document['subheading'];
        $structuredDocument['abstract']=$document['abstract'];
        $structuredDocument['content']=$document['content'];
        $structuredDocument['tags']='{'.$data['tags'].'}';
        $structuredDocument['url']=$data['url'];
        $structuredDocument['format']=$data['formats'];
        $structuredDocument['repository_id']=$repositoryId;

        $validation = \Validator::make($structuredDocument, \Document::$rules);

        if ($validation->passes())
        {


            $documentToSave=new \Document();
            $documentToSave->fill($structuredDocument);
            $documentToSave->save();
            if($file) {
                $ext = $file->guessExtension();
                $filename=md5($file->getClientOriginalName().strtotime("now")).'_'.$file->getClientOriginalName();
                $file->move(public_path().'/assets/uploaded/',$filename);
                $path=public_path().'/assets/uploaded/'.$filename;
                \DB::insert("INSERT INTO documents(logo) VALUES (lo_import('$path'));");
            }
            $lastDocumentId=$documentToSave->id;
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
        $documents=\Document::where('repository_id','=',$repositoryId)->get();
        return $documents;
    }
    public function show($documentId){
        $document=\Document::firstOrFail($documentId);
        return \View::make('documents.show', compact('document'));
    }
    public function edit($documentId){
        $document = \Document::find($documentId);
        if (is_null($document))
        {
            return \Redirect::route('documents.index');
        }

        return \View::make('documents.edit', ['document'=>$document,'documentId'=>$documentId]);
    }
    public function versions($documentId){
        $versions=\Version::where('parent_document','=',$documentId)->get();
        $documents=[];
        foreach($versions as $version){
            $document=\Document::where('id','=',$version->document_id)->first();
            $document['version_hash']=$version->version_hash;
            $documents[]=$document;
        }
        return $documents;
    }
    public function createVersion($documentId){
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