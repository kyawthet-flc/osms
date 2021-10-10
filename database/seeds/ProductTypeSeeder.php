<?php

use Illuminate\Database\Seeder;
use App\Model\ProductSetup\ProductType;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::truncate();
        
        $product_types = array(
            array('name' => 'Cloth', 'desc' => ''),
            array('name' => 'Eletronic', 'desc' => '')
        );

        foreach($product_types as $item) {
            ProductType::create([
                'name' => $item['name'],
                'desc' => $item['desc'],
            ]);
        }

    }
}
