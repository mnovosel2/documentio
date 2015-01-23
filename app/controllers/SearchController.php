<?php

class SearchController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Input::all()){
            $searchQuery=Input::except(['_token','_method']);
            $repository=null;
            $document=null;
            $version=null;
            if(!empty($searchQuery['repository_name'])){
                $repository=Repository::where('name','=',$searchQuery['repository_name'])->get()->first();
                if(count($repository)){
                    if(!empty($searchQuery['version_description'])){
                        $version=Version::where('description','=',$searchQuery['version_description'])->get()->first();
                        if(!empty($searchQuery['document_heading']) && count($version)){
                            $document=Document::where('heading','=',$searchQuery['document_heading'])->where('id','=',$version->document_id)->where('repository_id','=',$repository->id)->get();
                            return View::make('documents.index',['documents'=>$document,'repositoryId'=>null]);
                        }else{
                            $document=[];
                            return View::make('documents.index',['documents'=>$document,'repositoryId'=>null]);
                        }
                    }else if(!empty($searchQuery['document_heading'])){
                        $document=Document::where('heading','=',$searchQuery['document_heading'])->where('repository_id','=',$repository->id)->get();
                        return View::make('documents.index',['documents'=>$document,'repositoryId'=>null]);
                    }
                }
            }else if(!empty($searchQuery['document_heading'])){
                if(!empty($searchQuery['version_description'])){
                    $version=Version::where('description','=',$searchQuery['version_description'])->get()->first();
                    if(!empty($searchQuery['document_heading']) && count($version)){
                        $document=Document::where('heading','=',$searchQuery['document_heading'])->where('id','=',$version->document_id)->get();
                        return View::make('documents.index',['documents'=>$document,'repositoryId'=>null]);
                    }else{
                        $document=[];
                        return View::make('documents.index',['documents'=>$document,'repositoryId'=>null]);
                    }
                }else if(!empty($searchQuery['document_heading'])) {
                    $document = Document::where('heading', '=', $searchQuery['document_heading'])->get();
                    return View::make('documents.index',['documents'=>$document,'repositoryId'=>null]);
                }
            }else if(!empty($searchQuery['version_description'])){
                $version=Version::where('description','=',$searchQuery['version_description'])->get()->first();
                $document=Document::where('id','=',$version->document_id)->get();
                return View::make('documents.index',['documents'=>$document,'repositoryId'=>null]);
            }

        }
	}


}
