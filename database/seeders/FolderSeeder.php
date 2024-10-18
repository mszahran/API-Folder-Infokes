<?php

namespace Database\Seeders;

use App\Models\Folder;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Folder::create(['name' => 'Root']);
        $child1 = Folder::create(['name' => 'Documents', 'parent_id' => $root->id]);
        Folder::create(['name' => 'Photos', 'parent_id' => $root->id]);
        Folder::create(['name' => 'Videos', 'parent_id' => $child1->id]);
    }
}
