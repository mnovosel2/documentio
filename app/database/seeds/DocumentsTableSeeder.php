<?php

class DocumentsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('documents')->truncate();
        $repository=Repository::get()->first();
        $documents= array(
            array('repository_id' => $repository->id,
                'heading' => 'TestniDokument',
                'subheading' => 'TestniPodnaslov',
                'abstract' => 'TestniAbstract',
                'content' => 'TestniSadrzaj',
                'logo' => null,
                'tags'=>'{Oznaka1, Oznaka2}',
                'url' => 'testurl',
                'parent'=>true,
                'logo_path'=>'http://178.62.74.13/assets/uploaded/logo_default.jpg')
        );

		// Uncomment the below to run the seeder
		DB::table('documents')->insert($documents);
	}

}
