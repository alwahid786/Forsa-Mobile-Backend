<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\Size;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

$data = [
    [
        'category_name' => 'WomenWear',
        'category_image' => 'http://kodextech.net/forsa/public/category/1701153831_realwomwnwear.avif',
    ],
    [
        'category_name' => 'MenWear',
        'category_image' => 'http://kodextech.net/forsa/public/category/1701155563_Mens wear.jpg',
    ],
    [
        'category_name' => 'Kidswear',
        'category_image' => 'http://kodextech.net/forsa/public/category/1701155758_kids waer.jpg',
    ],
    [
        'category_name' => 'Home',
        'category_image' => 'http://kodextech.net/forsa/public/category/1701155798_Home-Decorative-Accessories.webp',
    ],
    [
        'category_name' => 'Electronics',
        'category_image' => 'http://kodextech.net/forsa/public/category/1701155837_electronics-setaccessoires-travel-concept_529200-118.avif',
    ],
    [
        'category_name' => 'Women Clothing',
        'parent_id' => 1,
    ],
    [
        'category_name' => 'Women Shoes',
        'parent_id' => 1,
    ],
    [
        'category_name' => 'Women Bags',
        'parent_id' => 1,
    ],
    [
        'category_name' => 'Women Accessories',
        'parent_id' => 1,
    ],
    [
        'category_name' => 'Women Jewellery',
        'parent_id' => 1,
    ],
    [
        'category_name' => 'Mens Clothing',
        'parent_id' => 2,
    ],
    [
        'category_name' => 'Mens Shoes',
        'parent_id' => 2,
    ],
    [
        'category_name' => 'Mens Bags',
        'parent_id' => 2,
    ],
    [
        'category_name' => 'Mens Accessories',
        'parent_id' => 2,
    ],
    [
        'category_name' => 'Girslwear',
        'parent_id' => 3,
    ],
    [
        'category_name' => 'Boyswear',
        'parent_id' => 3,
    ],
    [
        'category_name' => 'Furniture',
        'parent_id' => 4,
    ],
    [
        'category_name' => 'Decoration',
        'parent_id' => 4,
    ],
    [
        'category_name' => 'Phones',
        'parent_id' => 5,
    ],
    [
        'category_name' => 'Cameras',
        'parent_id' => 5,
    ],
    [
        'category_name' => 'IT Gadgets',
        'parent_id' => 5,
    ],

     [
        'category_name' => 'Tops',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'Knitwear',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'Dresses',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'Skirts',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'Trousers',
        'parent_id' => 6,
        'size' => ['FR 33','FR 34','FR 35',' FR 36','FR 37','FR 38','FR 39','FR 40','FR 41','FR 42','FR 43']

    ],
     [
        'category_name' => 'Shorts',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'Jumpsuits',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'Jeans',
        'parent_id' => 6,
        'size' => ['FR 33','FR 34','FR 35',' FR 36','FR 37','FR 38','FR 39','FR 40','FR 41','FR 42','FR 43']
    ],
     [
        'category_name' => 'Jackets',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'coats',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
         [
        'category_name' => 'Lingerie',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
         [
        'category_name' => 'Swimwear',
        'parent_id' => 6,
        'size' => ['3XS','XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
   [
        'category_name' => 'Boots',
        'parent_id' => 7,
        'size' => ['EU 32','EU 33','EU 34','EU 35','EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','US 3','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12' ]
    ], [
        'category_name' => 'Trainers',
        'parent_id' => 7,
          'size' => ['EU 32','EU 33','EU 34','EU 35','EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','US 3','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12' ]
    ], [
        'category_name' => 'Flats',
        'parent_id' => 7,
          'size' => ['EU 32','EU 33','EU 34','EU 35','EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','US 3','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12' ]
    ], [
        'category_name' => 'Ballet flats',
        'parent_id' => 7,
          'size' => ['EU 32','EU 33','EU 34','EU 35','EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','US 3','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12' ]
    ], [
        'category_name' => 'Sandals',
        'parent_id' => 7,
          'size' => ['EU 32','EU 33','EU 34','EU 35','EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','US 3','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12' ]
    ], [
        'category_name' => 'Mule & Clogs',
        'parent_id' => 7,
          'size' => ['EU 32','EU 33','EU 34','EU 35','EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','US 3','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12' ]
    ], [
        'category_name' => 'Heels',
        'parent_id' => 7,
          'size' => ['EU 32','EU 33','EU 34','EU 35','EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','US 3','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12' ]
    ], [
        'category_name' => 'Ankle boots',
        'parent_id' => 7,
          'size' => ['EU 32','EU 33','EU 34','EU 35','EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','US 3','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12' ]
    ], [
        'category_name' => 'Expadrilles',
        'parent_id' => 7,
          'size' => ['EU 32','EU 33','EU 34','EU 35','EU 36','EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','US 3','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12' ]
    ],
    [
        'category_name' => 'Sunglasses',
        'parent_id' => 9,
    ],
  [
        'category_name' => 'Wallets',
        'parent_id' => 9,
    ],  [
        'category_name' => 'Belts',
        'parent_id' => 9,
    ],  [
        'category_name' => 'Silk handkerchief',
        'parent_id' => 9,
    ],  [
        'category_name' => 'Hats',
        'parent_id' => 9,
    ],  [
        'category_name' => 'Scarves',
        'parent_id' => 9,
    ],  [
        'category_name' => 'Purses,wallets & coat',
        'parent_id' => 9,
    ], [
        'category_name' => 'Watches',
        'parent_id' => 9,
    ], [
        'category_name' => 'Gloves',
        'parent_id' => 9,
    ], [
        'category_name' => 'Rings',
        'parent_id' => 10,
    ],
     [
        'category_name' => 'Bracelets',
        'parent_id' => 10,
    ], [
        'category_name' => 'Pins & brooches',
        'parent_id' => 10,
    ], [
        'category_name' => 'Necklaces',
        'parent_id' => 10,
    ], [
        'category_name' => 'Pendants',
        'parent_id' => 10,
    ], [
        'category_name' => 'Long necklaces',
        'parent_id' => 10,
    ], [
        'category_name' => 'Jewellery sets',
        'parent_id' => 10,
    ], [
        'category_name' => 'Earrings',
        'parent_id' => 10,
    ], [
        'category_name' => 'Hair accessories',
        'parent_id' => 10,
    ],
     [
        'category_name' => 'Bag charms',
        'parent_id' => 10,
    ],
     [
        'category_name' => 'Phone charms',
        'parent_id' => 10,
    ],
     [
        'category_name' => 'Shirts',
        'parent_id' => 11,
        'size' => ['XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ], [
        'category_name' => 'Polo shirts',
        'parent_id' => 11,
        'size' => ['XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ], [
        'category_name' => 'T-shirts',
        'parent_id' => 11,
        'size' => ['XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ], [
        'category_name' => 'Knitwear & Sweatshirts',
        'parent_id' => 11,
        'size' => ['XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ], [
        'category_name' => 'Jackets',
        'parent_id' => 11,
        'size' => ['XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ], [
        'category_name' => 'Coats',
        'parent_id' => 11,
        'size' => ['XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ], [
        'category_name' => 'Suits',
        'parent_id' => 11,
        'size' => [ ' XXS','XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'Trousers',
        'parent_id' => 11,
          'size' => [' FR 36','FR 37','FR 38','FR 39','FR 40','FR 41','FR 42','FR 43','FR 44','FR 45','FR 46','FR 47','FR 48' ,'XS','S','M','L','Xl','2XL','3XL','4XL',]
    ], [
        'category_name' => 'Jeans',
        'parent_id' => 11,
          'size' => [' FR 36','FR 37','FR 38','FR 39','FR 40','FR 41','FR 42','FR 43','FR 44','FR 45','FR 46','FR 47','FR 48' ,'XS','S','M','L','Xl','2XL','3XL','4XL',]
    ], [
        'category_name' => 'Shorts',
        'parent_id' => 11,
        'size' => ['XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'Swimwear',
        'parent_id' => 11,
        'size' => ['XS','S','M','L','Xl','2XL','3XL','4XL','5XL']
    ],
     [
        'category_name' => 'Trainers',
        'parent_id' => 12,
          'size' => ['EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','EU 44','EU 45','EU 46','EU 47','EU 48','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12',' US 13' ,' US 14' ,' US 15']
    ], [
        'category_name' => 'Flats',
        'parent_id' => 12,
         'size' => ['EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','EU 44','EU 45','EU 46','EU 47','EU 48','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12',' US 13' ,' US 14' ,' US 15']
    ], [
        'category_name' => 'Boots',
        'parent_id' => 12,
         'size' => ['EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','EU 44','EU 45','EU 46','EU 47','EU 48','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12',' US 13' ,' US 14' ,' US 15']
    ], [
        'category_name' => 'Formal',
        'parent_id' => 12,
         'size' => ['EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','EU 44','EU 45','EU 46','EU 47','EU 48','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12',' US 13' ,' US 14' ,' US 15']
    ], [
        'category_name' => 'Sandals',
        'parent_id' => 12,
         'size' => ['EU 37','EU 38','EU 39','EU 40','EU 41','EU 42','EU 43','EU 44','EU 45','EU 46','EU 47','EU 48','US 4','US 5','US 6','US 7','US 8','US 9','US 10','US 11',' US 12',' US 13' ,' US 14' ,' US 15']
    ], [
        'category_name' => 'Clothing',
        'parent_id' => 15,
    ], [
        'category_name' => 'Shoes',
        'parent_id' => 15,
       
    ], [
        'category_name' => 'Accessories',
        'parent_id' => 15,
    ], [
        'category_name' => 'Clothing',
        'parent_id' => 16,
    ], [
        'category_name' => 'Shoes',
        'parent_id' => 16,
    ],
    [
        'category_name' => 'Accessories',
        'parent_id' => 16,
    ],
        [
        'category_name' => 'Dresses',
        'parent_id' => 79,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years']
    ],
        [
        'category_name' => 'Skirt',
        'parent_id' => 79,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
        [
        'category_name' => 'Trousers',
        'parent_id' => 79,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
        [
        'category_name' => 'Tops',
        'parent_id' => 79,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
            [
        'category_name' => 'Outfits',
        'parent_id' => 79,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
        [
        'category_name' => 'Shorts',
        'parent_id' => 79,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
        [
        'category_name' => 'Knitwear',
        'parent_id' => 79,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
        [
        'category_name' => 'Jacket & Coat',
        'parent_id' => 79,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
            [
        'category_name' => 'Pujamas & Bodysuits',
        'parent_id' => 79,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
        [
        'category_name' => 'Slippers',
        'parent_id' => 80,
          'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
        [
        'category_name' => 'Sandals',
        'parent_id' => 80,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
            [
        'category_name' => 'Ballet Flats',
        'parent_id' => 80,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
        [
        'category_name' => 'Trainers',
        'parent_id' => 80,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
            [
        'category_name' => 'Boots',
        'parent_id' => 80,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
        [
        'category_name' => 'Lace up boots',
        'parent_id' => 80,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
            [
        'category_name' => 'Flats',
        'parent_id' => 80,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
        [
        'category_name' => 'First Shoes',
        'parent_id' => 80,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
            [
        'category_name' => 'Sunglasses',
        'parent_id' => 81,
    ],
                [
        'category_name' => 'Belts & Suspenders',
        'parent_id' => 81,
    ],
                [
        'category_name' => 'Scarves',
        'parent_id' => 81,
    ],
                [
        'category_name' => 'Hats & Gloves',
        'parent_id' => 81,
    ],
                [
        'category_name' => 'Bags & Pencil cases',
        'parent_id' => 81,
    ],
                [
        'category_name' => 'Jewellery',
        'parent_id' => 81,
    ],
                    [
        'category_name' => 'Outfits',
        'parent_id' => 82,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
                        [
        'category_name' => 'Trousers',
        'parent_id' => 82,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
                        [
        'category_name' => 'Shorts',
        'parent_id' => 82,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
                        [
        'category_name' => 'Tops',
        'parent_id' => 82,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
                        [
        'category_name' => 'knitwear',
        'parent_id' => 82,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
                        [
        'category_name' => 'Jacket & Coats',
        'parent_id' => 82,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
                        [
        'category_name' => 'Pajamas & Bodysuits',
        'parent_id' => 82,
        'size' => [ '0-3 months',' 3-6 months', '6 months', '9 months', '12 months',' 18 months',  '2 years', '3 years until 16 years' ]
    ],
                        [
        'category_name' => 'Slippers',
        'parent_id' => 83,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
                            [
        'category_name' => 'Sandals',
        'parent_id' => 83,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
                            [
        'category_name' => 'Ballet flats',
        'parent_id' => 83,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
                            [
        'category_name' => 'Trainers',
        'parent_id' => 83,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
                            [
        'category_name' => 'Boots',
        'parent_id' => 83,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
                            [
        'category_name' => 'Lace up boots',
        'parent_id' => 83,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
                            [
        'category_name' => 'Flats',
        'parent_id' => 83,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],
                            [
        'category_name' => 'First Shoes',
        'parent_id' => 83,
         'size' => ['FR 16','FR 17','FR 18','FR 19','FR 20','FR 21','FR 22','FR 23','FR 24','FR 25','FR 26','FR 27','FR 28','FR 29','FR 30','FR 31','FR 32','FR 33','FR 34','FR 35','FR 36','FR 37','FR 38' , 'US 1', 'US 2', 'US 2.5', 'US 4', 'US 4.5', 'US 5', 'US 6', 'US 6.5', 'US 7.5', 'US 8', 'US 8.5', 'US 9.5', 'US 10.5', 'US 11', 'US 11.5', 'US 12', 'US 12.5', 'US 13','US 13.5' ,'US 14','US 14.5','US 15','US 15.5','US 16']
    ],

        [
        'category_name' => 'Sunglasses',
        'parent_id' => 84,
    ],
                                    [
        'category_name' => 'Belts & Suspenders',
        'parent_id' => 84,
    ],
                                    [
        'category_name' => 'Scarves',
        'parent_id' => 84,
    ],
                                    [
        'category_name' => 'Hats & Gloves',
        'parent_id' => 84,
    ],
                                    [
        'category_name' => 'Bag & Pencile cases',
        'parent_id' => 84,
    ],
                                    [
        'category_name' => 'Jewellery',
        'parent_id' => 84,
    ],
   
];

foreach ($data as $d) {
    
    // dd($d['category_name']);
    $category = Category::create([
        'category_name' => $d['category_name'] ?? '',
        'category_image' => $d['category_image'] ?? '',
        'parent_id' => $d['parent_id'] ?? null
    ]);

    // dd($category);
    if (isset($d['size']) && !empty($d['size'])) {
        foreach ($d['size'] as $size) {
            Size::create([
                'category_id' => $category->id ?? '',
                'size' => $size ?? '',
            ]);
        }
    }
}
}
}
