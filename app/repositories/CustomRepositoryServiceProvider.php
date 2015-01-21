<?php
namespace Documentio\Repositories;
use Illuminate\Support\ServiceProvider;
class CustomRepositoryServiceProvider extends ServiceProvider{
    public function register(){
        $this->registerAccountProvider();
        $this->registerDocumentProvider();
        $this->registerXMLParser();
    }
    private function registerAccountProvider(){
        $this->app->singleton('Documentio\Repositories\Account\AccountInterface','Documentio\Repositories\Account\AccountRepository');
    }
    private function registerDocumentProvider(){
        $this->app->singleton('Documentio\Repositories\Documents\DocumentInterface','Documentio\Repositories\Documents\DocumentRepository');
    }
    private function registerXMLParser(){
        $this->app->singleton('Documentio\Repositories\XMLParser\XMLParserInterface','Documentio\Repositories\XMLParser\XMLParserRepository');
    }
}