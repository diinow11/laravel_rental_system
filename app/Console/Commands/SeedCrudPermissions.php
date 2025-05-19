<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedCrudPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:seed-crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $models = ['Apartment','Unit','Tenant','Payment','Issue'];
    $abilities = ['view','create','update','delete','restore'];

    foreach ($models as $model) {
        foreach ($abilities as $ability) {
            \Spatie\Permission\Models\Permission::firstOrCreate([
                'name'       => "{$ability} {$model}",
                'guard_name' => 'web',
            ]);
        }
    }

    $this->info('CRUD permissions seeded.');
    }
}
