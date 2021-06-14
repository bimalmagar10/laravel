<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //laptops
        for($i=1;$i<9;$i++){
            
        Product::create([
             'name' => 'macBook Pro'.$i,
             'slug' => 'laptop-'.$i,
             'details' =>'15 inch,1 TB ROM, 16 GB rRAM',
             'price' =>rand(14999,24999),
             'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem'    


        ])->categories()->attach(1);
    }

     $product= Product::find(1);         //we must have
    $product->categories()->attach(2);  //at least one
                                        //product with two categories
    

    //desktops
        for($i=1;$i<8;$i++){
            
        Product::create([
             'name' => 'Desktop'.$i,
             'slug' => 'desktop-'.$i,
             'details' =>'24 inch,1 TB ROM, 16 GB rRAM',
             'price' =>rand(29999,3999),
             'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem',    


        ])->categories()->attach(2);
    }

   

    //Phones
        for($i=1;$i<8;$i++){
                
            Product::create([
                 'name' => 'Phone'.$i,
                 'slug' => 'phone-'.$i,
                 'details' =>'6 inch,6 GB RAM, 128 GB R0M',
                 'price' =>rand(3495,4499),
                 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem',    


            ])->categories()->attach(3);
        }

        //tablets
        for($i=1;$i<8;$i++){
            
            Product::create([
                 'name' => 'Tablet'.$i,
                 'slug' => 'tablet-'.$i,
                 'details' =>'15 inch,1 TB ROM, 16 GB rRAM',
                 'price' =>rand(3737,9839),
                 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem',    


            ])->categories()->attach(4);
        }

        //tvs
            for($i=1;$i<8;$i++){
                
            Product::create([
                 'name' => 'TV'.$i,
                 'slug' => 'tv-'.$i,
                 'details' =>'32 inch ,smart tv 4K',
                 'price' =>rand(3737,9393),
                 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem',    


            ])->categories()->attach(5);
        }

        //cameras

            for($i=1;$i<8;$i++){
                
            Product::create([
                 'name' => 'camera'.$i,
                 'slug' => 'camera-'.$i,
                 'details' =>'24MP C_Mos sensor,18-55 mm vr kit lens',
                 'price' =>rand(3734,8398),
                 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem',    


            ])->categories()->attach(6);
        }

        //appliances

            for($i=1;$i<8;$i++){
                
            Product::create([
                 'name' => 'Appliance'.$i,
                 'slug' => 'appliance-'.$i,
                 'details' =>'lorem ipsum this is appliance worth it.',
                 'price' =>rand(7373,73737),
                 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore vitae nisi, consequuntur illum dolores cumque pariatur quis provident deleniti nesciunt officia est reprehenderit sunt aliquid possimus temporibus enim eum hic lorem',    


            ])->categories()->attach(7);
        }






         
    }
}
