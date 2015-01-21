<?php
namespace Documentio\Repositories\Documents;
interface DocumentInterface{
    public function listDocuments($repositoryId);
    public function store($repositoryId,$data,$file);
    public function update($documentId,$data);
    public function destroy($documentId,$repositoryId);
    public function edit($id);
    public function show($id);
    public function versions($documentId);
    public function createVersion($documentId);
}