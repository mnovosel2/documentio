<?php

class RepositoriesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		 DB::table('repositories')->truncate();

		$repositories = array(
            array('name' => 'TestRepo','owner_id' => 1,
                'description' => 'TestniRepozitorijOpis',
                'tags' => '{OznakaRepo1,OznakaRepo2}')
		    );

		// Uncomment the below to run the seeder
		 DB::table('repositories')->insert($repositories);
	}

}
