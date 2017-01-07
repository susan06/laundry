<?php

use App\Package;
use Illuminate\Database\Seeder;

class PackageTableSeeder extends Seeder
{
    protected $description = '<h1>Ex dolorum qui illum delectus.</h1><p>Nam officiis quaerat recusandae omnis praesentium dolore. Hic ut rerum voluptas eaque voluptates. Sint in quo quidem distinctio. Quibusdam aspernatur ab non amet rerum qui harum quasi. Non cupiditate hic repellat sunt tempore commodi aliquid. Nulla itaque id corporis ut est deserunt ea. Explicabo quo temporibus magni. Sunt minima suscipit expedita qui harum dolor. Alias ipsum vel et corporis et molestiae. Porro odit et ut eius eum quod et accusamus. Aliquam sit odio ea labore. Quia ducimus perferendis est totam facere pariatur. Et natus fugiat veniam sunt. Repellendus omnis excepturi voluptate eveniet dolor. Commodi recusandae maxime deserunt laborum. Sequi sunt eos dicta ullam suscipit rerum earum enim. Quo asperiores architecto est perspiciatis sint. Blanditiis ut ut labore eius corrupti quo earum. Officiis quis beatae consequatur alias.</p><p>Iure laboriosam facilis et error ea. Dolorum qui ipsa sit aut et corporis. Voluptates numquam aliquam eum asperiores quia. Dignissimos voluptates omnis perferendis modi consequatur. Fugiat eos non doloribus ullam. Et qui sed impedit qui esse. Corporis magnam ut quia officia. Sapiente deserunt amet illo voluptas voluptatum. Veritatis voluptatibus optio aut quaerat in et. Earum rerum et omnis numquam quia. Consequatur cum aliquam aut. Reiciendis et id quis qui fugiat totam. Sapiente quia inventore repellendus et. Iure voluptates dignissimos dolores nam eaque mollitia voluptates. Soluta ut dolorem eligendi aut quibusdam alias quas animi. Porro illum suscipit quod error. Deserunt qui mollitia earum. Quibusdam possimus aliquid sunt id at placeat corporis pariatur. Atque iure necessitatibus voluptatem voluptate nostrum laborum nobis reprehenderit. Quisquam sint quisquam doloribus aut et voluptatem. Officia mollitia repellat consectetur. Laboriosam voluptatem dolorem qui sed autem. Cumque nobis et corrupti accusamus. Eum et autem quia. Voluptas omnis quas sed nostrum repudiandae. Ea doloribus dolore quos non quo ut. Sunt veritatis maiores est facilis. Repellat ipsam ducimus molestiae quae sit ab. Iste et architecto reprehenderit itaque et ab dolores rerum. Omnis esse quis enim asperiores et veniam aspernatur.</p>';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(Package::class)->create([
            'name' => 'Pack Test',
            'package_category_id' => 1,
            'description' => $this->description,
            'created_at' => \Carbon\Carbon::now()
        ]);

    	factory(Package::class)->create([
            'name' => 'Bolsa 10 libras',
            'package_category_id' => 2,
            'description' => $this->description,
            'created_at' => \Carbon\Carbon::now()
        ]);

    	factory(Package::class)->create([
            'name' => 'Bolsa 15 libras',
            'package_category_id' => 2,
            'description' => $this->description,
            'created_at' => \Carbon\Carbon::now()
        ]);

    	factory(Package::class)->create([
            'name' => 'Trajes',
            'package_category_id' => 3,
            'description' => $this->description,
            'created_at' => \Carbon\Carbon::now()
        ]);

    	factory(Package::class)->create([
            'name' => 'Edredones',
            'package_category_id' => 4,
            'description' => $this->description,
            'created_at' => \Carbon\Carbon::now()
        ]);

    }
}
