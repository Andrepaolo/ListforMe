<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Preference;
use App\Models\Product;
use App\Models\Recipe;
use App\Models\Store;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::create([
            'name'=>'Administrador Nutrición',
            'email'=>'andre@gmail.com',
            'password'=>bcrypt('12345678')
        ]);
        // CATEGORÍAS
    // 1. CATEGORIAS
        $cat1 = Category::create(['name' => 'Bebidas']);
        $cat2 = Category::create(['name' => 'Laticínios']); // Lácteos
        $cat3 = Category::create(['name' => 'Padaria']); // Panadería
        $cat4 = Category::create(['name' => 'Frutas']);
        $cat5 = Category::create(['name' => 'Vegetais']); // Verduras
        $cat6 = Category::create(['name' => 'Carnes e Aves']); // Carnes y Aves
        $cat7 = Category::create(['name' => 'Grãos e Cereais']); // Granos y Cereales
        $cat8 = Category::create(['name' => 'Temperos e Molhos']); // Condimentos y Salsas
        $cat9 = Category::create(['name' => 'Outros']); // Otros (para productos misceláneos)
        $cat10 = Category::create(['name' => 'Salgadinho']); // Otros (para productos misceláneos)

        // 2. PREFERENCIAS
        $pref1 = Preference::create(['name' => 'Sem glúten']); // Sin gluten
        $pref2 = Preference::create(['name' => 'Vegetariano']);
        $pref3 = Preference::create(['name' => 'Vegano']);
        $pref4 = Preference::create(['name' => 'Sem lactose']); // Sin lactosa
        $pref5 = Preference::create(['name' => 'Dieta com baixo teor de sódio']); // Dieta baja en sal
        $pref6 = Preference::create(['name' => 'Orgânico']); // Añadida por si acaso
        $pref7 = Preference::create(['name' => 'Comida Rápida']); // Nueva preferencia para los snacks
        $pref8 = Preference::create(['name' => 'Doce']);

        // 3. PRODUCTOS
        // Para asegurar que los productos existen para las recetas y tus productos base
        $productsData = [
            // Tus productos existentes (ajustados a portugués)
            [
                'name' => 'Maçã Vermelha',
                'category_id' => $cat4->id,
                'image' => 'https://i.pinimg.com/736x/0f/57/47/0f5747e7f24ee34503d8492a371c53ef.jpg', // Pinterest link
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Cenoura',
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/67/03/bd/6703bd7c301b0df59969c623ecd232eb.jpg', // Pinterest link
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Pão Integral',
                'category_id' => $cat3->id,
                'image' => 'https://i.pinimg.com/736x/40/af/a6/40afa6ced6b05c1f2956ba88860a9517.jpg', // Pinterest link
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Leite Integral',
                'category_id' => $cat2->id,
                'image' => 'https://i.pinimg.com/564x/b6/ae/29/b6ae29ea131b32915a8efd9fcb5b745f.jpg', // Pinterest link
                'is_healthy' => true, // Puede ser saludable en una dieta equilibrada
                 
            ],
            [
                'name' => 'Iogurte Natural',
                'category_id' => $cat2->id,
                'image' => 'https://i.pinimg.com/564x/40/96/03/409603954b7a667afac6f78b7a0bcb9f.jpg', // Pinterest link
                'is_healthy' => true,
                 // Puede ser sin lactosa
            ],
            [
                'name' => 'Banana',
                'category_id' => $cat4->id,
                'image' => 'https://i.pinimg.com/564x/b3/c5/d4/b3c5d463e5382738b85a846073bbcdd6.jpg', // Pinterest link
                'is_healthy' => true,
                 // Vegano por naturaleza
            ],
            [
                'name' => 'Água Mineral',
                'category_id' => $cat1->id,
                'image' => 'https://i.pinimg.com/564x/a7/31/7f/a7317f7143ac0e67c4846695f3863a4d.jpg', // Pinterest link
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Pão Francês',
                'category_id' => $cat3->id,
                'image' => 'https://i.pinimg.com/564x/aa/74/50/aa74506cc47daac25a387a76b745fe47.jpg', // Pinterest link
                'is_healthy' => false, // Menos saludable que el integral
                       ],
            [
                'name' => 'Espinafre',
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/7d/37/b7/7d37b794e2d35dcd5605be6fa0669ed6.jpg', // Pinterest link
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Refrigerante de Laranja',
                'category_id' => $cat1->id,
                'image' => 'https://i.pinimg.com/564x/a0/ee/4e/a0ee4e638fc18cdab648c48e1f75f5cc.jpg', // Pinterest link
                'is_healthy' => false,
                       ],

            // Productos para las recetas (en portugués)
            [
                'name' => 'Abacate Hass',
                'category_id' => $cat4->id,
                'image' => 'https://i.pinimg.com/736x/a8/eb/4a/a8eb4a814ee554a4390de5ad512d4a2c.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Cacau Puro em Pó',
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/01/ab/8d/01ab8d89e884409bbd6666114ef1ee6f.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Xarope de Bordo', // Sirope de arce
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/6e/f3/48/6ef348fcf56b4eed52a207324def1a4f.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Bebida de Amêndoa Sem Açúcar',
                'category_id' => $cat1->id,
                'image' => 'https://i.pinimg.com/736x/73/53/ed/7353edc6ef8703b08d5a7dbade0f43d3.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Frutas Vermelhas Mistas',
                'category_id' => $cat4->id,
                'image' => 'https://i.pinimg.com/736x/c5/1e/7e/c51e7e121cd05cf08cc88def86f87024.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Nibs de Cacau',
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/7f/20/8e/7f208e28a173a150f712ef1999d8b1b4.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Ovo de Galinha', // Huevo
                'category_id' => $cat9->id,
                'image' => 'https://i.pinimg.com/736x/ff/cb/3b/ffcb3b6d04848b56cadc59f819957bae.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Óleo de Coco Virgem Extra',
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/b5/87/b6/b587b65521d8bd7081c56f752acbc34d.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Flocos de Aveia', // Hojuelas de avena
                'category_id' => $cat7->id,
                'image' => 'https://i.pinimg.com/736x/2c/af/dc/2cafdc5dcfdbcf865e01495fca4edef0.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Farinha Integral de Trigo',
                'category_id' => $cat7->id,
                'image' => 'https://i.pinimg.com/736x/d8/27/7c/d8277cf6adcd66e79ab599437efdbb31.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Fermento em Pó', // Polvo para hornear
                'category_id' => $cat9->id,
                'image' => 'https://i.pinimg.com/736x/28/e9/3b/28e93b9338039c1fea4eec83660835f5.jpg',
                'is_healthy' => false, // Generalmente no considerado saludable por sí mismo
                
            ],
            [
                'name' => 'Bicarbonato de Sódio',
                'category_id' => $cat9->id,
                'image' => 'https://i.pinimg.com/736x/d4/77/9e/d4779ebcba3ea7215c96b59553d2f0ee.jpg',
                'is_healthy' => false,
                
            ],
            [
                'name' => 'Canela em Pó',
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/c7/1e/d6/c71ed64a6de89dde32f5bcf8b81d978e.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Nozes Pecãs',
                'category_id' => $cat9->id,
                'image' => 'https://i.pinimg.com/736x/33/fc/7d/33fc7db90940717f20918ae0e29b97cc.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Feijão Preto', // Frijoles negros
                'category_id' => $cat7->id,
                'image' => 'https://i.pinimg.com/736x/62/47/3f/62473f1dfb135de72bcb17a2dbdb20b3.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Carne Seca (Charque)',
                'category_id' => $cat6->id,
                'image' => 'https://i.pinimg.com/736x/8f/29/0d/8f290df5ba44d5a4b1786a6e84df452c.jpg',
                'is_healthy' => false, // Procesada
                       ],
            [
                'name' => 'Linguiça Defumada', // Chorizo ahumado
                'category_id' => $cat6->id,
                'image' => 'https://i.pinimg.com/736x/d6/de/d2/d6ded2fc2c2fbcc8747dc427cb6582be.jpg',
                'is_healthy' => false,
                       ],
            [
                'name' => 'Alho Fresco',
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/d7/77/f6/d777f6030b0ec11648d1c522e1d21363.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Arroz Branco',
                'category_id' => $cat7->id,
                'image' => 'https://i.pinimg.com/736x/57/81/ac/5781ac0932459b90ace585c39639fc21.jpg',
                'is_healthy' => true, // Considerado menos saludable que el integral
                
            ],
            [
                'name' => 'Farinha de Mandioca', // Harina de yuca
                'category_id' => $cat7->id,
                'image' => 'https://i.pinimg.com/736x/f3/c7/0b/f3c70bde522eb4254354d7d8eb041092.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Laranja',
                'category_id' => $cat4->id,
                'image' => 'https://i.pinimg.com/736x/fc/ad/74/fcad74dc716d7c1c5378e68501252e23.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Óleo de Dendê',
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/80/01/b9/8001b9feba5ed2a82894699ce2ed61f9.jpg',
                'is_healthy' => true, // En moderación
                
            ],
            [
                'name' => 'Pimentão Vermelho',
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/35/b1/2f/35b12fd330ef0b3cf7cd6c9354a39819.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Pimentão Verde',
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/14/cd/5a/14cd5a9127efc93da4c6f473b374d1d9.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Tomate',
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/0c/b9/41/0cb94134073a809a457b8421bec38c2b.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Palmito em Conserva', // Palmitos enlatados
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/4b/6b/5d/4b6b5da0aeb62b41448a1b7335a7005d.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Leite de Coco (Lata)',
                'category_id' => $cat9->id, // Podría ser una categoría de "Ingredientes de Cocina"
                'image' => 'https://i.pinimg.com/736x/51/30/8b/51308b8ce485f9c216ee4d4f9eaadc9a.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Caldo de Vegetais', // Caldo de verduras
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/c6/8c/b0/c68cb05aed9fa1fd176772e238bb4c84.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Coentro Fresco', // Cilantro fresco
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/9a/b1/4f/9ab14f0f9a2b5f291fc527fff85170f0.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Açafrão da Terra (Cúrcuma)', // Achiote, pero cúrcuma es más común y similar para color
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/fb/5b/cd/fb5bcd507120563ef914c5af073ee69d.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Cebola Branca',
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/e0/91/b4/e091b41f9d7c8e1fdc092c13e8017fc7.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Folha de Louro',
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/f6/62/73/f662739de55e2fefadbd5de87bb1a9ea.jpg',
                'is_healthy' => true,
                
            ],
            [
                'name' => 'Azeite de Oliva Extra Virgem',
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/c3/eb/55/c3eb55c718e1df896546968cbb61274d.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Pimenta do Reino Preta', // Pimienta negra
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/73/90/1f/73901f90109b430eb934dc7c0ab75914.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Sal Marinho',
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/da/82/0b/da820b043ce51caea83fa60ce771c561.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Manteiga Sem Sal', // Mantequilla sin sal
                'category_id' => $cat2->id,
                'image' => 'https://i.pinimg.com/736x/6e/01/ac/6e01acb5e6d9b5720cad7d357f5f3791.jpg',
                'is_healthy' => true,
            ],
            [
            'name' => 'Queijo Minas Frescal', // Queso Minas
            'category_id' => $cat2->id,
            'image' => 'https://i.pinimg.com/736x/c6/a0/fd/c6a0fd28e00e82818303378b9916931f.jpg',
            'is_healthy' => true,
            ],
            [
                'name' => 'Polvilho Doce', // Almidón de yuca dulce
                'category_id' => $cat7->id,
                'image' => 'https://i.pinimg.com/736x/7b/59/7d/7b597dec7d52dbcfbbaabde809afe40f.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Salsinha Fresca', // Perejil fresco
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/86/9c/7d/869c7d4c12ea23e2807434734c377ef2.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Couve Manteiga', // Col rizada/Berza
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/82/3f/93/823f93dd5fc042086ac7636bbe676c3d.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Pimenta Malagueta', // Chile malagueta
                'category_id' => $cat8->id,
                'image' => 'https://i.pinimg.com/736x/75/42/f6/7542f6d32605472a8ae4ccd9ef2c1a19.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Quiabo', // Okra
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/b3/00/73/b300733812188ed69cea2e738e119723.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Frango', // Pollo en trozos
                'category_id' => $cat6->id,
                'image' => 'https://i.pinimg.com/736x/ab/80/27/ab80277c262209091217d3d3575f2989.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Cebolinha Verde', // Cebolleta
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/47/09/a6/4709a641d99b14e871554ed46573420d.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Maracujá Fresco', // Maracuyá fresco
                'category_id' => $cat4->id,
                'image' => 'https://i.pinimg.com/736x/a5/4e/fb/a54efbae7ea6a09eb7780252feafa49e.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Açúcar Refinado',
                'category_id' => $cat9->id,
                'image' => 'https://i.pinimg.com/736x/71/7a/0f/717a0f9e8f4edcaab2411b7b9c4219da.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Gelatina Sem Sabor',
                'category_id' => $cat9->id,
                'image' => 'https://i.pinimg.com/736x/db/8a/52/db8a52d28ba63ac1f982c91b42a4fdeb.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Cachaça sem álcool',
                'category_id' => $cat1->id,
                'image' => 'https://i.pinimg.com/736x/ba/ff/34/baff343cadc0e6e1da7905054037641c.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Limão',
                'category_id' => $cat4->id,
                'image' => 'https://i.pinimg.com/736x/1d/61/59/1d615909b81354475fdf6dd7b057f685.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Filé de Tilápia', // Filete de tilapia
                'category_id' => $cat6->id,
                'image' => 'https://i.pinimg.com/736x/f5/58/fa/f558fa1558227a4172b5e92f2f5bd057.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Limão Siciliano', // Limón siciliano
                'category_id' => $cat4->id,
                'image' => 'https://i.pinimg.com/736x/25/d4/6f/25d46f945cfc3b44b88675564509a585.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Salmão Fresco', // Salmón fresco
                'category_id' => $cat6->id,
                'image' => 'https://i.pinimg.com/736x/4c/ad/98/4cad9808de6ca27e8db387be491b4962.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Batata Inglesa', // Patata
                'category_id' => $cat5->id,
                'image' => 'https://i.pinimg.com/736x/52/a7/79/52a7797cad546c47f4eafb9a45e3ded4.jpg',
                'is_healthy' => true,
            ],
            [
                'name' => 'Doritos', // Patata
                'category_id' => $cat10->id,
                'image' => 'https://i.pinimg.com/736x/48/a8/2d/48a82d88b55c8c138ec2072badb23721.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Cheetos', // Patata
                'category_id' => $cat10->id,
                'image' => 'https://i.pinimg.com/736x/95/ba/af/95baaf56db00834763f800d1a4512228.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Pringles batatas', // Patata
                'category_id' => $cat10->id,
                'image' => 'https://i.pinimg.com/736x/f7/e6/e3/f7e6e34cb7a2aea5be839344389334fd.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Chocolate Kit Kat', // Patata
                'category_id' => $cat10->id,
                'image' => 'https://i.pinimg.com/736x/d3/8e/fb/d38efbfbfe40b0fe36ed745c6f8b0285.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Chocolate Branco Oreo', // Patata
                'category_id' => $cat10->id,
                'image' => 'https://i.pinimg.com/736x/36/23/62/36236209849f797b53cc35538faa9765.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Chocolate Diamante Negro', // Patata
                'category_id' => $cat10->id,
                'image' => 'https://i.pinimg.com/736x/64/62/b9/6462b9871132c39ab5cbae9fca41f9f2.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Red Bull', // Patata
                'category_id' => $cat10->id,
                'image' => 'https://i.pinimg.com/736x/78/d4/e0/78d4e0cff426c282924b24fb7ed8b425.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'Pepsi', // Patata
                'category_id' => $cat1->id,
                'image' => 'https://i.pinimg.com/736x/f0/82/6a/f0826af72e4743fc7d823fb48b0bfa8f.jpg',
                'is_healthy' => false,
            ],
            [
                'name' => 'CocaCola', // Patata
                'category_id' => $cat1->id,
                'image' => 'https://i.pinimg.com/736x/f0/c8/76/f0c876c629be3e15fac1ee15bb1312e0.jpg',
                'is_healthy' => false,
            ],
        ];

        $products = [];
        foreach ($productsData as $data) {
            $product = Product::firstOrCreate(['name' => $data['name']], $data);
            $products[$product->name] = $product;
        }

        // --- Nueva sección: Asociar Preferencias a Productos ---
        // Asignar preferencias a los productos
        $products['Maçã Vermelha']->preferences()->sync([$pref1->id]); // Sem glúten
        $products['Cenoura']->preferences()->sync([$pref1->id, $pref3->id]); // Sem glúten, Vegano
        $products['Pão Integral']->preferences()->sync([$pref5->id]); // Dieta com baixo teor de sódio (si tiene poco sodio)
        $products['Iogurte Natural']->preferences()->sync([$pref4->id]); // Sem lactose (si hay versión sin lactosa)
        $products['Banana']->preferences()->sync([$pref1->id, $pref3->id]); // Sem glúten, Vegano
        $products['Água Mineral']->preferences()->sync([$pref1->id, $pref3->id, $pref4->id, $pref5->id]); // Todas las aplica
        $products['Espinafre']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Abacate Hass']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]); // Sem glúten, Vegetariano, Vegano
        $products['Cacau Puro em Pó']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Xarope de Bordo']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Bebida de Amêndoa Sem Açúcar']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref4->id]);
        $products['Frutas Vermelhas Mistas']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Nibs de Cacau']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Óleo de Coco Virgem Extra']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Flocos de Aveia']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Farinha Integral de Trigo']->preferences()->sync([$pref2->id, $pref5->id]); // Contiene gluten, pero vegetariano/bajo sodio
        $products['Fermento em Pó']->preferences()->sync([$pref1->id, $pref3->id]); // Asumo que es sin gluten y vegano
        $products['Bicarbonato de Sódio']->preferences()->sync([$pref1->id, $pref3->id]);
        $products['Canela em Pó']->preferences()->sync([$pref1->id, $pref3->id]);
        $products['Nozes Pecãs']->preferences()->sync([$pref1->id, $pref3->id]);
        $products['Feijão Preto']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Alho Fresco']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Arroz Branco']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Farinha de Mandioca']->preferences()->sync([$pref1->id, $pref3->id]);
        $products['Laranja']->preferences()->sync([$pref1->id, $pref3->id]);
        $products['Óleo de Dendê']->preferences()->sync([$pref1->id, $pref3->id]);
        $products['Pimentão Vermelho']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Pimentão Verde']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Tomate']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Palmito em Conserva']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Leite de Coco (Lata)']->preferences()->sync([$pref1->id, $pref3->id, $pref4->id]);
        $products['Caldo de Vegetais']->preferences()->sync([$pref1->id, $pref3->id]);
        $products['Coentro Fresco']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Açafrão da Terra (Cúrcuma)']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Cebola Branca']->preferences()->sync([$pref1->id, $pref3->id, $pref5->id]);
        $products['Folha de Louro']->preferences()->sync([$pref1->id, $pref3->id]);

        // Para los productos con carne o lacteos que no son veganos/vegetarianos
        $products['Leite Integral']->preferences()->sync([$pref4->id]); // Puede ser sin lactosa si hay esa opción
        $products['Ovo de Galinha']->preferences()->sync([$pref1->id]); // Sin gluten
        $products['Carne Seca (Charque)']->preferences()->sync([$pref1->id]); // Sin gluten
        $products['Linguiça Defumada']->preferences()->sync([$pref1->id]); // Sin gluten
        $products['Pão Francês']->preferences()->sync([$pref5->id]); // Bajo sodio (si aplica)
        $products['Refrigerante de Laranja']->preferences()->sync([]); // Generalmente no tiene preferencias dietéticas saludables relevantes.
        $products['Azeite de Oliva Extra Virgem']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Pimenta do Reino Preta']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Sal Marinho']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Manteiga Sem Sal']->preferences()->sync([$pref1->id, $pref2->id, $pref4->id]);
        $products['Queijo Minas Frescal']->preferences()->sync([$pref1->id, $pref2->id, $pref4->id]);
        $products['Polvilho Doce']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Salsinha Fresca']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Couve Manteiga']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Pimenta Malagueta']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Quiabo']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Frango']->preferences()->sync([$pref1->id, $pref5->id]);
        $products['Cebolinha Verde']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Maracujá Fresco']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Açúcar Refinado']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id]);
        $products['Gelatina Sem Sabor']->preferences()->sync([$pref1->id]);
        $products['Cachaça sem álcool']->preferences()->sync([$pref1->id]);
        $products['Limão']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Filé de Tilápia']->preferences()->sync([$pref1->id, $pref5->id]);
        $products['Limão Siciliano']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Salmão Fresco']->preferences()->sync([$pref1->id, $pref5->id]);
        $products['Batata Inglesa']->preferences()->sync([$pref1->id, $pref2->id, $pref3->id, $pref5->id]);
        $products['Doritos']->preferences()->sync([$pref7->id]); // Comida Rápida
        $products['Cheetos']->preferences()->sync([$pref7->id]); // Comida Rápida
        $products['Pringles batatas']->preferences()->sync([$pref7->id]); // Comida Rápida
        $products['Chocolate Kit Kat']->preferences()->sync([$pref8->id]); // Doce
        $products['Chocolate Branco Oreo']->preferences()->sync([$pref8->id]); // Doce
        $products['Chocolate Diamante Negro']->preferences()->sync([$pref8->id]); // Doce
        $products['Red Bull']->preferences()->sync([$pref7->id]); // Comida Rápida (energética)
        $products['Pepsi']->preferences()->sync([$pref7->id]); // Comida Rápida (bebida azucarada)
        $products['CocaCola']->preferences()->sync([$pref7->id]);

        // 4. TIENDAS
        $store1 = Store::create(['name' => 'Mercado Central Cachoeira', 'location' => 'Cachoeira, Brasil' , 'latitud'=>-12.603357735752, 'longitude'=>-38.964971327453]);
        $store2 = Store::create(['name' => 'Loja Verde Cachoeira', 'location' => 'Cachoeira, Brasil','latitud'=>-12.602698105055183, 'longitude'=>-38.964614048920936]);
        $store3 = Store::create(['name' => 'Supermercado Caperozu', 'location' => 'Caperozu, Brasil','latitud'=>-12.6021955282077, 'longitude'=>-38.96648167657174]);
        $store4 = Store::create(['name' => 'MiniMarket Caperozu', 'location' => 'Caperozu, Brasil']);

        // 5. ASOCIAR PRODUCTOS A TIENDAS (com lógica de stock y precios)
        // Tienda 1: Mercado Central Cachoeira (Productos más básicos y populares)
        // 5. ASOCIAR PRODUCTOS A TIENDAS (com lógica de stock y precios)
        // Tienda 1: Mercado Central Cachoeira (Productos más básicos y populares)
        $store1->products()->sync([
            $products['Maçã Vermelha']->id => ['price' => 5.50, 'stock' => 100],
            $products['Cenoura']->id => ['price' => 3.20, 'stock' => 80],
            $products['Pão Integral']->id => ['price' => 8.00, 'stock' => 120],
            $products['Leite Integral']->id => ['price' => 4.80, 'stock' => 90],
            $products['Iogurte Natural']->id => ['price' => 6.10, 'stock' => 110],
            $products['Banana']->id => ['price' => 4.00, 'stock' => 150],
            $products['Feijão Preto']->id => ['price' => 7.50, 'stock' => 70],
            $products['Arroz Branco']->id => ['price' => 6.00, 'stock' => 100],
            $products['Cebola Branca']->id => ['price' => 2.50, 'stock' => 120],
            $products['Tomate']->id => ['price' => 4.00, 'stock' => 90],
            $products['Farinha Integral de Trigo']->id => ['price' => 9.00, 'stock' => 60],
            $products['Canela em Pó']->id => ['price' => 5.00, 'stock' => 75],
            $products['Óleo de Dendê']->id => ['price' => 12.00, 'stock' => 30],
            $products['Caldo de Vegetais']->id => ['price' => 6.50, 'stock' => 40],
            $products['Folha de Louro']->id => ['price' => 2.00, 'stock' => 90],
            $products['Açafrão da Terra (Cúrcuma)']->id => ['price' => 7.20, 'stock' => 50],
            $products['Azeite de Oliva Extra Virgem']->id => ['price' => 18.00, 'stock' => 70],
            $products['Pimenta do Reino Preta']->id => ['price' => 4.50, 'stock' => 80],
            $products['Sal Marinho']->id => ['price' => 3.80, 'stock' => 150],
            $products['Manteiga Sem Sal']->id => ['price' => 10.00, 'stock' => 60],
            $products['Polvilho Doce']->id => ['price' => 6.00, 'stock' => 90],
            $products['Salsinha Fresca']->id => ['price' => 2.20, 'stock' => 40],
            $products['Couve Manteiga']->id => ['price' => 4.00, 'stock' => 50],
            $products['Pimenta Malagueta']->id => ['price' => 5.00, 'stock' => 30],
            $products['Quiabo']->id => ['price' => 6.50, 'stock' => 45],
            $products['Frango']->id => ['price' => 22.00, 'stock' => 50],
            $products['Cebolinha Verde']->id => ['price' => 2.00, 'stock' => 60],
            $products['Maracujá Fresco']->id => ['price' => 8.00, 'stock' => 50],
            $products['Açúcar Refinado']->id => ['price' => 4.00, 'stock' => 120],
            $products['Limão']->id => ['price' => 3.00, 'stock' => 90],
            $products['Filé de Tilápia']->id => ['price' => 28.00, 'stock' => 30],
            $products['Salmão Fresco']->id => ['price' => 45.00, 'stock' => 20],
            $products['Batata Inglesa']->id => ['price' => 3.50, 'stock' => 100],
        ]);

        // Tienda 2: Loja Verde Cachoeira (Mais focada em produtos saudáveis e de nicho)
        $store2->products()->sync([
            $products['Abacate Hass']->id => ['price' => 7.00, 'stock' => 60],
            $products['Cacau Puro em Pó']->id => ['price' => 15.00, 'stock' => 40],
            $products['Xarope de Bordo']->id => ['price' => 22.00, 'stock' => 30],
            $products['Bebida de Amêndoa Sem Açúcar']->id => ['price' => 9.50, 'stock' => 50],
            $products['Frutas Vermelhas Mistas']->id => ['price' => 18.00, 'stock' => 35],
            $products['Nibs de Cacau']->id => ['price' => 20.00, 'stock' => 25],
            $products['Óleo de Coco Virgem Extra']->id => ['price' => 25.00, 'stock' => 45],
            $products['Flocos de Aveia']->id => ['price' => 7.00, 'stock' => 80],
            $products['Espinafre']->id => ['price' => 5.00, 'stock' => 70],
            $products['Coentro Fresco']->id => ['price' => 3.00, 'stock' => 50],
            $products['Nozes Pecãs']->id => ['price' => 18.00, 'stock' => 30],
            $products['Laranja']->id => ['price' => 3.50, 'stock' => 80],
            $products['Cenoura']->id => ['price' => 3.50, 'stock' => 75],
            $products['Banana']->id => ['price' => 4.30, 'stock' => 140],
            $products['Maçã Vermelha']->id => ['price' => 5.80, 'stock' => 95],
            $products['Alho Fresco']->id => ['price' => 1.80, 'stock' => 60],
            $products['Azeite de Oliva Extra Virgem']->id => ['price' => 18.50, 'stock' => 65], // Precio diferente
            $products['Pimenta do Reino Preta']->id => ['price' => 4.70, 'stock' => 75], // Precio diferente
            $products['Sal Marinho']->id => ['price' => 3.90, 'stock' => 140], // Precio diferente
            $products['Salsinha Fresca']->id => ['price' => 2.30, 'stock' => 35], // Precio diferente
            $products['Couve Manteiga']->id => ['price' => 4.20, 'stock' => 45], // Precio diferente
            $products['Pimenta Malagueta']->id => ['price' => 5.20, 'stock' => 28], // Precio diferente
            $products['Quiabo']->id => ['price' => 6.70, 'stock' => 40], // Precio diferente
            $products['Cebolinha Verde']->id => ['price' => 2.10, 'stock' => 55], // Precio diferente
            $products['Maracujá Fresco']->id => ['price' => 8.20, 'stock' => 45], // Precio diferente
            $products['Limão']->id => ['price' => 3.10, 'stock' => 85], // Precio diferente
            $products['Limão Siciliano']->id => ['price' => 4.50, 'stock' => 60],
            $products['Salmão Fresco']->id => ['price' => 46.00, 'stock' => 18], // Precio diferente
            $products['Batata Inglesa']->id => ['price' => 3.70, 'stock' => 90], // Precio diferente
            $products['Ovo de Galinha']->id => ['price' => 1.20, 'stock' => 80],
            $products['Caldo de Vegetais']->id => ['price' => 6.70, 'stock' => 35],
            $products['Fermento em Pó']->id => ['price' => 3.10, 'stock' => 45],
            $products['Bicarbonato de Sódio']->id => ['price' => 2.60, 'stock' => 55],
        ]);

        // Tienda 3: Supermercado Caperozu (Ampla variedade, incluindo alguns não tão saudáveis)
        $store3->products()->sync([
            $products['Maçã Vermelha']->id => ['price' => 5.30, 'stock' => 90],
            $products['Pão Francês']->id => ['price' => 3.00, 'stock' => 200],
            $products['Leite Integral']->id => ['price' => 4.70, 'stock' => 110],
            $products['Refrigerante de Laranja']->id => ['price' => 4.50, 'stock' => 150],
            $products['Carne Seca (Charque)']->id => ['price' => 35.00, 'stock' => 40],
            $products['Linguiça Defumada']->id => ['price' => 12.00, 'stock' => 60],
            $products['Arroz Branco']->id => ['price' => 5.80, 'stock' => 120],
            $products['Farinha de Mandioca']->id => ['price' => 8.00, 'stock' => 75],
            $products['Palmito em Conserva']->id => ['price' => 10.00, 'stock' => 55],
            $products['Leite de Coco (Lata)']->id => ['price' => 9.00, 'stock' => 65],
            $products['Fermento em Pó']->id => ['price' => 3.00, 'stock' => 50],
            $products['Bicarbonato de Sódio']->id => ['price' => 2.50, 'stock' => 60],
            $products['Ovo de Galinha']->id => ['price' => 1.10, 'stock' => 90],
            $products['Cebola Branca']->id => ['price' => 2.70, 'stock' => 110],
            $products['Azeite de Oliva Extra Virgem']->id => ['price' => 17.50, 'stock' => 80], // Precio diferente
            $products['Pimenta do Reino Preta']->id => ['price' => 4.30, 'stock' => 90], // Precio diferente
            $products['Sal Marinho']->id => ['price' => 3.70, 'stock' => 160], // Precio diferente
            $products['Manteiga Sem Sal']->id => ['price' => 9.80, 'stock' => 70], // Precio diferente
            $products['Polvilho Doce']->id => ['price' => 5.80, 'stock' => 100], // Precio diferente
            $products['Frango']->id => ['price' => 21.50, 'stock' => 55], // Precio diferente
            $products['Açúcar Refinado']->id => ['price' => 3.80, 'stock' => 130], // Precio diferente
            $products['Gelatina Sem Sabor']->id => ['price' => 2.80, 'stock' => 40],
            $products['Limão']->id => ['price' => 2.90, 'stock' => 100], // Precio diferente
            $products['Filé de Tilápia']->id => ['price' => 27.50, 'stock' => 35], // Precio diferente
            $products['Batata Inglesa']->id => ['price' => 3.40, 'stock' => 110], // Precio diferente
            $products['Banana']->id => ['price' => 4.10, 'stock' => 130],
            $products['Cenoura']->id => ['price' => 3.10, 'stock' => 85],
            $products['Tomate']->id => ['price' => 3.90, 'stock' => 95],
            $products['Laranja']->id => ['price' => 3.40, 'stock' => 85],
        ]);

        // Tienda 4: MiniMarket Caperozu (Mais pequeno, com produtos essenciais e alguns de conveniência)
        $store4->products()->sync([
            $products['Água Mineral']->id => ['price' => 2.00, 'stock' => 200],
            $products['Banana']->id => ['price' => 4.20, 'stock' => 100],
            $products['Pão Integral']->id => ['price' => 8.20, 'stock' => 70],
            $products['Cenoura']->id => ['price' => 3.30, 'stock' => 60],
            $products['Alho Fresco']->id => ['price' => 1.50, 'stock' => 80],
            $products['Pimentão Vermelho']->id => ['price' => 4.80, 'stock' => 50],
            $products['Pimentão Verde']->id => ['price' => 4.50, 'stock' => 55],
            $products['Tomate']->id => ['price' => 4.20, 'stock' => 70],
            $products['Açafrão da Terra (Cúrcuma)']->id => ['price' => 7.00, 'stock' => 30],
            $products['Ovo de Galinha']->id => ['price' => 1.00, 'stock' => 100],
            $products['Leite Integral']->id => ['price' => 5.00, 'stock' => 80],
            $products['Azeite de Oliva Extra Virgem']->id => ['price' => 18.20, 'stock' => 60], // Precio diferente
            $products['Sal Marinho']->id => ['price' => 4.00, 'stock' => 130], // Precio diferente
            $products['Manteiga Sem Sal']->id => ['price' => 10.20, 'stock' => 55], // Precio diferente
            $products['Salsinha Fresca']->id => ['price' => 2.50, 'stock' => 30], // Precio diferente
            $products['Cebolinha Verde']->id => ['price' => 2.30, 'stock' => 50], // Precio diferente
            $products['Limão']->id => ['price' => 3.20, 'stock' => 80], // Precio diferente
            $products['Batata Inglesa']->id => ['price' => 3.60, 'stock' => 95], // Precio diferente
            $products['Pão Francês']->id => ['price' => 3.10, 'stock' => 180],
            $products['Refrigerante de Laranja']->id => ['price' => 4.60, 'stock' => 140],
            $products['Palmito em Conserva']->id => ['price' => 10.20, 'stock' => 50],
            $products['Leite de Coco (Lata)']->id => ['price' => 9.20, 'stock' => 60],
            $products['Queijo Minas Frescal']->id => ['price' => 15.00, 'stock' => 40],
            $products['Farinha de Mandioca']->id => ['price' => 8.20, 'stock' => 70],
        ]);


        // 6. RECETAS

        // Receta 1: Delícia de Abacate e Cacau (Postre Fit)
        $recipe1 = Recipe::firstOrCreate(['name' => 'Delícia de Abacate e Cacau'], [
            'description' => 'Uma sobremesa cremosa e deliciosa, cheia de gorduras saudáveis e antioxidantes. Ideal para quando você deseja algo doce sem culpa.',
            'instructions' => "1. No liquidificador, combine 1 abacate maduro, 3 colheres de sopa de cacau puro em pó, 2 colheres de sopa de xarope de bordo ou mel (ou adoçante a gosto), 1/2 xícara de bebida vegetal (amêndoa ou coco), e uma pitada de sal.\n2. Bata até obter uma mistura lisa e homogênea.\n3. Despeje em taças individuais e leve à geladeira por pelo menos 30 minutos.\n4. Decore com frutas vermelhas ou nibs de cacau antes de servir.",
            'estimated_calories' => 250,
            'cuisine_type' => 'Saudável',
            'is_vegetarian' => true,
            'image' => 'https://i.pinimg.com/736x/14/56/99/14569979bbaa48f7c7b903cdd2b9ffc3.jpg', // Postre Aguacate y cacao
        ]);
        $recipe1->ingredients()->sync([
            $products['Abacate Hass']->id => ['quantity_unit' => '1 unidade'],
            $products['Cacau Puro em Pó']->id => ['quantity_unit' => '3 colheres de sopa'],
            $products['Xarope de Bordo']->id => ['quantity_unit' => '2 colheres de sopa'],
            $products['Bebida de Amêndoa Sem Açúcar']->id => ['quantity_unit' => '1/2 xícara'],
            $products['Frutas Vermelhas Mistas']->id => ['quantity_unit' => 'A gosto'],
            $products['Nibs de Cacau']->id => ['quantity_unit' => 'A gosto'],
        ]);

        // Receta 2: Muffins de Aveia e Banana com Nozes (Postre Fit)
        $recipe2 = Recipe::firstOrCreate(['name' => 'Muffins de Aveia e Banana com Nozes'], [
            'description' => 'Muffins fofos e nutritivos, perfeitos para o café da manhã ou um lanche saudável. O dulçor natural da banana os torna irresistíveis.',
            'instructions' => "1. Pré-aqueça o forno a 180°C e prepare uma forma de muffins com forminhas de papel.\n2. Em uma tigela grande, amasse 2 bananas maduras.\n3. Adicione 1 ovo de galinha, 1/4 xícara de óleo de coco extra virgem derretido (ou purê de maçã), 1/2 xícara de Leite Integral. Misture bem.\n4. Em outra tigela, misture 1.5 xícaras de flocos de aveia, 1/2 xícara de Farinha Integral de Trigo, 1 colher de chá de Fermento em Pó, 1/2 colher de chá de Bicarbonato de Sódio, 1/2 colher de chá de Canela em Pó e uma pitada de sal.\n5. Incorpore os ingredientes secos aos úmidos e misture apenas até combinar. Não misture em excesso.\n6. Adicione 1/2 xícara de Nozes Pecãs picadas (opcional).\n7. Divida a mistura nas forminhas de muffins e asse por 20-25 minutos, ou até dourarem e um palito inserido sair limpo.",
            'estimated_calories' => 180,
            'cuisine_type' => 'Saudável',
            'is_vegetarian' => false, // Contém ovo e leite
            'image' => 'https://i.pinimg.com/736x/f2/b2/f3/f2b2f37b1408bd1dc484c04cec9dde50.jpg', // Muffins
        ]);
        $recipe2->ingredients()->sync([
            $products['Banana']->id => ['quantity_unit' => '2 unidades'],
            $products['Ovo de Galinha']->id => ['quantity_unit' => '1 unidade'],
            $products['Óleo de Coco Virgem Extra']->id => ['quantity_unit' => '1/4 xícara'],
            $products['Leite Integral']->id => ['quantity_unit' => '1/2 xícara'],
            $products['Flocos de Aveia']->id => ['quantity_unit' => '1.5 xícaras'],
            $products['Farinha Integral de Trigo']->id => ['quantity_unit' => '1/2 xícara'],
            $products['Fermento em Pó']->id => ['quantity_unit' => '1 colher de chá'],
            $products['Bicarbonato de Sódio']->id => ['quantity_unit' => '1/2 colher de chá'],
            $products['Canela em Pó']->id => ['quantity_unit' => '1/2 colher de chá'],
            $products['Nozes Pecãs']->id => ['quantity_unit' => '1/2 xícara'],
        ]);

        // Receta 3: Feijoada Simplificada (Com Carne)
        $recipe3 = Recipe::firstOrCreate(['name' => 'Feijoada Simplificada'], [
            'description' => 'Um clássico brasileiro reconfortante, cheio de sabor. Uma versão mais simples, mas igualmente deliciosa para desfrutar em casa.',
            'instructions' => "1. Demolhe 250g de Feijão Preto seco durante a noite. Escorra e enxágue.\n2. Em uma panela grande ou de pressão, cozinhe o Feijão Preto com 1 Folha de Louro e água até ficarem macios (aprox. 30-40 min na panela de pressão, 1.5-2h na panela normal).\n3. Enquanto os feijões cozinham, em uma frigideira grande, refogue 1 Cebola Branca picada e 3 dentes de Alho Fresco picados em óleo.\n4. Adicione 200g de Carne Seca (Charque) dessalgada e pré-cozida cortada em pedaços, e 100g de Linguiça Defumada cortada em rodelas. Doure a carne.\n5. Quando os feijões estiverem macios, retire uma xícara de feijões cozidos e amasse-os para engrossar o molho.\n6. Incorpore a carne refogada e os feijões amassados na panela de feijões. Cozinhe em fogo baixo por pelo menos 30 minutos para que os sabores se misturem. Ajuste o sal e a pimenta.\n7. Sirva com Arroz Branco, Farinha de Mandioca (para farofa) e gomos de Laranja.",
            'estimated_calories' => 650,
            'cuisine_type' => 'Brasileira',
            'is_vegetarian' => false,
            'image' => 'https://i.pinimg.com/736x/6a/ee/5c/6aee5c56488a6c0c9db8d1525b8dc29c.jpg', // Feijoada
        ]);
        $recipe3->ingredients()->sync([
            $products['Feijão Preto']->id => ['quantity_unit' => '250g'],
            $products['Folha de Louro']->id => ['quantity_unit' => '1 folha'],
            $products['Cebola Branca']->id => ['quantity_unit' => '1 unidade'],
            $products['Alho Fresco']->id => ['quantity_unit' => '3 dentes'],
            $products['Carne Seca (Charque)']->id => ['quantity_unit' => '200g'],
            $products['Linguiça Defumada']->id => ['quantity_unit' => '100g'],
            $products['Arroz Branco']->id => ['quantity_unit' => 'A gosto'],
            $products['Farinha de Mandioca']->id => ['quantity_unit' => 'A gosto'],
            $products['Laranja']->id => ['quantity_unit' => 'A gosto'],
        ]);

        // Receta 4: Moqueca de Palmito (Vegetariana)
        $recipe4 = Recipe::firstOrCreate(['name' => 'Moqueca de Palmito'], [
            'description' => 'Uma versão vibrante e cremosa da moqueca, um guisado de peixe brasileiro, adaptada para ser vegetariana usando palmitos. Saborosa e leve!',
            'instructions' => "1. Em uma panela grande ou \"panela de barro\" (se tiver), aqueça 2 colheres de sopa de Óleo de Coco Virgem Extra (ou Óleo de Dendê).\n2. Refogue 1 Cebola Branca picada, 2 dentes de Alho Fresco picados, 1 Pimentão Vermelho picado e 1 Pimentão Verde picado até ficarem macios.\n3. Adicione 2 Tomates picados e cozinhe por alguns minutos.\n4. Incorpore 1 lata de Palmito em Conserva em rodelas (escorrido), 1 xícara de Leite de Coco (Lata) (espesso), 1/2 xícara de Caldo de Vegetais e 1/4 xícara de Coentro Fresco picado.\n5. Tempere com sal e pimenta a gosto. Opcionalmente, adicione uma pitada de Açafrão da Terra (Cúrcuma) para dar cor.\n6. Cozinhe em fogo baixo por cerca de 15-20 minutos, até que os sabores se misturem e o molho engrosse ligeiramente.\n7. Sirva quente, decorado com mais Coentro Fresco, e acompanhado de Arroz Branco.",
            'estimated_calories' => 420,
            'cuisine_type' => 'Brasileira',
            'is_vegetarian' => true,
            'image' => 'https://i.pinimg.com/736x/34/78/66/347866e2704e66eb15352ecfcfc13590.jpg', // Moqueca
        ]);
        $recipe4->ingredients()->sync([
            $products['Óleo de Coco Virgem Extra']->id => ['quantity_unit' => '2 colheres de sopa'],
            $products['Cebola Branca']->id => ['quantity_unit' => '1 unidade'],
            $products['Alho Fresco']->id => ['quantity_unit' => '2 dentes'],
            $products['Pimentão Vermelho']->id => ['quantity_unit' => '1 unidade'],
            $products['Pimentão Verde']->id => ['quantity_unit' => '1 unidade'],
            $products['Tomate']->id => ['quantity_unit' => '2 unidades'],
            $products['Palmito em Conserva']->id => ['quantity_unit' => '1 lata'],
            $products['Leite de Coco (Lata)']->id => ['quantity_unit' => '1 xícara'],
            $products['Caldo de Vegetais']->id => ['quantity_unit' => '1/2 xícara'],
            $products['Coentro Fresco']->id => ['quantity_unit' => '1/4 xícara'],
            $products['Açafrão da Terra (Cúrcuma)']->id => ['quantity_unit' => '1 pitada'],
            $products['Arroz Branco']->id => ['quantity_unit' => 'A gosto'],
        ]);
        $recipe5 = Recipe::firstOrCreate(['name' => 'Moqueca Capixaba'], [
            'description' => 'Uma moqueca leve e saborosa, sem o uso de azeite de dendê, destacando os sabores do peixe e dos vegetais frescos.',
            'instructions' => "1. Tempere 500g de Filé de Tilápia (ou outro peixe branco firme) com Sal Marinho e Pimenta do Reino Preta. Reserve.\n2. Em uma panela de barro (ou panela funda), faça camadas com 1 Cebola Branca fatiada, 1 Pimentão Vermelho fatiado, 1 Pimentão Verde fatiado e 2 Tomates fatiados.\n3. Coloque os filés de peixe sobre os vegetais.\n4. Adicione 1/2 xícara de Coentro Fresco picado e 1/4 xícara de Salsinha Fresca picada.\n5. Despeje 1 xícara de Caldo de Vegetais e 2 colheres de sopa de Azeite de Oliva Extra Virgem sobre tudo.\n6. Leve ao fogo médio e cozinhe por cerca de 15-20 minutos, ou até que o peixe esteja cozido e os vegetais macios. Não mexa muito para não desmanchar o peixe.\n7. Sirva imediatamente com Arroz Branco.",
            'estimated_calories' => 400,
            'cuisine_type' => 'Brasileira',
            'is_vegetarian' => false,
            'image' => 'https://i.pinimg.com/736x/5e/fe/42/5efe42649c8d89c099963d27f1fde973.jpg', // Moqueca Capixaba
        ]);
        $recipe5->ingredients()->sync([
            $products['Filé de Tilápia']->id => ['quantity_unit' => '500g'],
            $products['Sal Marinho']->id => ['quantity_unit' => 'A gosto'],
            $products['Pimenta do Reino Preta']->id => ['quantity_unit' => 'A gosto'],
            $products['Cebola Branca']->id => ['quantity_unit' => '1 unidade'],
            $products['Pimentão Vermelho']->id => ['quantity_unit' => '1 unidade'],
            $products['Pimentão Verde']->id => ['quantity_unit' => '1 unidade'],
            $products['Tomate']->id => ['quantity_unit' => '2 unidades'],
            $products['Coentro Fresco']->id => ['quantity_unit' => '1/2 xícara'],
            $products['Salsinha Fresca']->id => ['quantity_unit' => '1/4 xícara'],
            $products['Caldo de Vegetais']->id => ['quantity_unit' => '1 xícara'],
            $products['Azeite de Oliva Extra Virgem']->id => ['quantity_unit' => '2 colheres de sopa'],
            $products['Arroz Branco']->id => ['quantity_unit' => 'A gosto'],
        ]);

        // Receta 6: Vatapá (Vegetariana - adaptada)
        $recipe6 = Recipe::firstOrCreate(['name' => 'Vatapá (Versão Vegetariana)'], [
            'description' => 'Uma versão vegetariana do cremoso e saboroso vatapá, sem camarão, mas com todo o sabor da culinária baiana. Ótimo acompanhamento ou prato principal.',
            'instructions' => "1. Em uma panela, aqueça 2 colheres de sopa de Óleo de Dendê. Refogue 1 Cebola Branca picada e 2 dentes de Alho Fresco picados até dourarem.\n2. Adicione 1 Pimentão Vermelho picado e 1 Tomate picado. Cozinhe por alguns minutos.\n3. Em um liquidificador, bata 1 xícara de Farinha de Mandioca (fina), 1 xícara de Leite de Coco (Lata) e 1.5 xícaras de Caldo de Vegetais até ficar homogêneo.\n4. Despeje a mistura do liquidificador na panela com os vegetais refogados. Cozinhe em fogo baixo, mexendo constantemente para não empelotar, até engrossar e adquirir uma consistência cremosa (cerca de 10-15 minutos).\n5. Adicione Sal Marinho e Pimenta do Reino Preta a gosto, e uma pitada de Açafrão da Terra (Cúrcuma) para dar cor.\n6. Se desejar, adicione 1/2 xícara de Palmito em Conserva picado para dar textura.\n7. Sirva quente, decorado com Coentro Fresco.",
            'estimated_calories' => 550,
            'cuisine_type' => 'Brasileira',
            'is_vegetarian' => true,
            'image' => 'https://i.pinimg.com/736x/7b/54/98/7b5498f1090a30c484d25dd1ed307d5c.jpg', // Vatapá
        ]);
        $recipe6->ingredients()->sync([
            $products['Óleo de Dendê']->id => ['quantity_unit' => '2 colheres de sopa'],
            $products['Cebola Branca']->id => ['quantity_unit' => '1 unidade'],
            $products['Alho Fresco']->id => ['quantity_unit' => '2 dentes'],
            $products['Pimentão Vermelho']->id => ['quantity_unit' => '1 unidade'],
            $products['Tomate']->id => ['quantity_unit' => '1 unidade'],
            $products['Farinha de Mandioca']->id => ['quantity_unit' => '1 xícara'],
            $products['Leite de Coco (Lata)']->id => ['quantity_unit' => '1 xícara'],
            $products['Caldo de Vegetais']->id => ['quantity_unit' => '1.5 xícaras'],
            $products['Sal Marinho']->id => ['quantity_unit' => 'A gosto'],
            $products['Pimenta do Reino Preta']->id => ['quantity_unit' => 'A gosto'],
            $products['Açafrão da Terra (Cúrcuma)']->id => ['quantity_unit' => '1 pitada'],
            $products['Palmito em Conserva']->id => ['quantity_unit' => '1/2 xícara'],
            $products['Coentro Fresco']->id => ['quantity_unit' => 'A gosto'],
        ]);

        // Receta 7: Coxinha de Frango (Com Carne)
        $recipe7 = Recipe::firstOrCreate(['name' => 'Coxinha de Frango'], [
            'description' => 'Um dos salgados mais amados do Brasil, a coxinha é um quitute saboroso com recheio cremoso de frango desfiado.',
            'instructions' => "1. Cozinhe 300g de Frango em Pedaços em água com Sal Marinho e Pimenta do Reino Preta até ficar macio. Desfie e reserve o caldo do cozimento.\n2. Em uma panela, refogue 1/2 Cebola Branca picada e 2 dentes de Alho Fresco picados em Azeite de Oliva Extra Virgem. Adicione o frango desfiado, 1/4 xícara de Salsinha Fresca picada e 1/4 xícara de Cebolinha Verde picada. Misture bem e reserve.\n3. Em outra panela, ferva 2 xícaras do caldo do cozimento do frango. Adicione 1.5 xícaras de Farinha Integral de Trigo de uma vez e mexa vigorosamente até a massa desgrudar do fundo da panela, formando uma bola.\n4. Deixe a massa esfriar um pouco. Pegue pequenas porções da massa, abra na palma da mão, coloque uma porção do recheio de frango e modele em formato de gota (coxinha).\n5. Passe as coxinhas em Leite Integral e depois em Pão Francês ralado (farelo de pão).\n6. Frite em óleo quente até dourarem. Sirva quente.",
            'estimated_calories' => 450,
            'cuisine_type' => 'Brasileira',
            'is_vegetarian' => false,
            'image' => 'https://i.pinimg.com/736x/de/7a/06/de7a0689a873e6228bc8304ad670e584.jpg', // Coxinha
        ]);
        $recipe7->ingredients()->sync([
            $products['Frango']->id => ['quantity_unit' => '300g'],
            $products['Sal Marinho']->id => ['quantity_unit' => 'A gosto'],
            $products['Pimenta do Reino Preta']->id => ['quantity_unit' => 'A gosto'],
            $products['Cebola Branca']->id => ['quantity_unit' => '1/2 unidade'],
            $products['Alho Fresco']->id => ['quantity_unit' => '2 dentes'],
            $products['Azeite de Oliva Extra Virgem']->id => ['quantity_unit' => '2 colheres de sopa'],
            $products['Salsinha Fresca']->id => ['quantity_unit' => '1/4 xícara'],
            $products['Cebolinha Verde']->id => ['quantity_unit' => '1/4 xícara'],
            $products['Farinha Integral de Trigo']->id => ['quantity_unit' => '1.5 xícaras'],
            $products['Leite Integral']->id => ['quantity_unit' => 'Para empanar'],
            $products['Pão Francês']->id => ['quantity_unit' => 'Para empanar'],
        ]);

        // Receta 8: Caldo Verde com Couve e Batata (Vegetariana - adaptada)
        $recipe8 = Recipe::firstOrCreate(['name' => 'Caldo Verde com Couve e Batata'], [
            'description' => 'Um caldo reconfortante e nutritivo, perfeito para dias mais frios. Uma versão vegetariana deste clássico português-brasileiro.',
            'instructions' => "1. Descasque e pique 4 Batatas Inglesas. Cozinhe em água com Sal Marinho até ficarem bem macias.\n2. Enquanto as batatas cozinham, lave e corte finamente 1 maço de Couve Manteiga.\n3. Escorra as batatas, reservando a água do cozimento. Amasse as batatas até virar um purê ou bata no liquidificador com um pouco da água do cozimento até ficar cremoso.\n4. Em uma panela, aqueça 2 colheres de sopa de Azeite de Oliva Extra Virgem. Refogue 1 Cebola Branca picada e 2 dentes de Alho Fresco picados até dourarem.\n5. Adicione o purê de batatas à panela e misture bem. Gradualmente, adicione mais água do cozimento das batatas (ou Caldo de Vegetais) até atingir a consistência desejada para o caldo.\n6. Acrescente a couve fatiada e cozinhe por apenas 5-7 minutos, ou até que a couve esteja macia mas ainda com a cor vibrante.\n7. Ajuste o Sal Marinho e a Pimenta do Reino Preta a gosto. Sirva quente.",
            'estimated_calories' => 280,
            'cuisine_type' => 'Brasileira',
            'is_vegetarian' => true,
            'image' => 'https://i.pinimg.com/736x/cf/17/5b/cf175b0a2e169b6b51a93ec38abf583e.jpg', // Caldo Verde
        ]);
        $recipe8->ingredients()->sync([
            $products['Batata Inglesa']->id => ['quantity_unit' => '4 unidades'],
            $products['Sal Marinho']->id => ['quantity_unit' => 'A gosto'],
            $products['Couve Manteiga']->id => ['quantity_unit' => '1 maço'],
            $products['Azeite de Oliva Extra Virgem']->id => ['quantity_unit' => '2 colheres de sopa'],
            $products['Cebola Branca']->id => ['quantity_unit' => '1 unidade'],
            $products['Alho Fresco']->id => ['quantity_unit' => '2 dentes'],
            $products['Caldo de Vegetais']->id => ['quantity_unit' => 'A gosto'],
            $products['Pimenta do Reino Preta']->id => ['quantity_unit' => 'A gosto'],
        ]);

        // Receta 9: Mousse de Maracujá (Postre)
        $recipe9 = Recipe::firstOrCreate(['name' => 'Mousse de Maracujá'], [
            'description' => 'Uma mousse refrescante e aerada de maracujá, um clássico da doçaria brasileira. Leve e cheia de sabor tropical.',
            'instructions' => "1. Em um liquidificador, bata o conteúdo de 3 Maracujás Frescos (polpa e sementes) com 1/2 xícara de Água Mineral. Passe por uma peneira para remover as sementes e reserve o suco concentrado.\n2. Em uma tigela, hidrate 1 pacote de Gelatina Sem Sabor em 5 colheres de sopa de água fria por 5 minutos. Leve ao micro-ondas por 15 segundos para dissolver.\n3. No liquidificador limpo, combine 1 Leite Condensado (em lata), 1 Creme de Leite (em lata) e o suco de maracujá coado. Bata até ficar homogêneo.\n4. Adicione a gelatina dissolvida e bata novamente por 30 segundos.\n5. Despeje a mistura em taças individuais ou em uma travessa grande. Leve à geladeira por pelo menos 3 horas, ou até firmar.\n6. Opcional: Decore com sementes de maracujá fresco antes de servir.",
            'estimated_calories' => 350,
            'cuisine_type' => 'Brasileira',
            'is_vegetarian' => true, // Contém laticínios
            'image' => 'https://i.pinimg.com/736x/52/19/e8/5219e85466e4b58dfe3e9afa89af31e9.jpg', // Mousse de Maracujá
        ]);
        $recipe9->ingredients()->sync([
            $products['Maracujá Fresco']->id => ['quantity_unit' => '3 unidades'],
            $products['Água Mineral']->id => ['quantity_unit' => '1/2 xícara'],
            $products['Gelatina Sem Sabor']->id => ['quantity_unit' => '1 pacote'],
            // Supondo que você tem Leite Condensado y Creme de Leite como productos, si no, se deberían agregar
            // $products['Leite Condensado']->id => ['quantity_unit' => '1 lata'],
            // $products['Creme de Leite']->id => ['quantity_unit' => '1 lata'],
        ]);

        // Receta 10: Caipirinha de Limão (Bebida)
        $recipe10 = Recipe::firstOrCreate(['name' => 'Caipirinha de Limão Sem álcool'], [
            'description' => 'O drink nacional do Brasil, a caipirinha é refrescante e icônica, perfeita para um dia quente.',
            'instructions' => "1. Corte 1 Limão em 4-6 pedaços e coloque-os em um copo resistente.\n2. Adicione 2 colheres de sopa de Açúcar Refinado (ou a gosto) sobre o limão.\n3. Com um pilão, amasse o limão e o açúcar gentilmente para extrair o suco e óleos da casca, mas sem amargar.\n4. Encha o copo com gelo.\n5. Despeje 50-60ml de Cachaça sobre o gelo.\n6. Mexa bem com uma colher longa e sirva imediatamente.",
            'estimated_calories' => 200,
            'cuisine_type' => 'Brasileira',
            'is_vegetarian' => true, // Se aplica, aunque es una bebida
            'image' => 'https://i.pinimg.com/736x/43/53/55/435355870767ce56cbb19d332603eed6.jpg', // Caipirinha
        ]);
        $recipe10->ingredients()->sync([
            $products['Limão']->id => ['quantity_unit' => '1 unidade'],
            $products['Açúcar Refinado']->id => ['quantity_unit' => '2 colheres de sopa'],
            $products['Cachaça sem álcool']->id => ['quantity_unit' => '50-60ml'],
        ]);

        // Receta 11: Pudim de Leite Condensado (Postre)
        $recipe11 = Recipe::firstOrCreate(['name' => 'Pudim de Leite Condensado'], [
            'description' => 'Um clássico pudim brasileiro, cremoso, com uma irresistível calda de caramelo. Um doce que agrada a todos.',
            'instructions' => "1. **Para o Caramelo:** Em uma forma de pudim, derreta 1 xícara de Açúcar Refinado em fogo baixo até obter um caramelo dourado. Espalhe pelas laterais da forma e reserve.\n2. **Para o Pudim:** No liquidificador, bata 1 Leite Condensado (em lata), 2 medidas da lata de Leite Integral, e 3 Ovos de Galinha. Bata bem até ficar homogêneo.\n3. Despeje a mistura do pudim sobre o caramelo na forma.\n4. Cubra a forma com papel alumínio e leve para assar em banho-maria no forno pré-aquecido a 180°C por cerca de 1 hora e 15 minutos, ou até firmar.\n5. Retire do forno, deixe esfriar e leve à geladeira por pelo menos 4 horas (idealmente, durante a noite).\n6. Para desenformar, passe uma faca pequena nas bordas e aqueça levemente o fundo da forma antes de virar em um prato.",
            'estimated_calories' => 400,
            'cuisine_type' => 'Brasileira',
            'is_vegetarian' => true,
            'image' => 'https://i.pinimg.com/736x/75/68/01/756801bf5ae270aacceb2ee07a18ea08.jpg', // Pudim de Leite Condensado
        ]);
        $recipe11->ingredients()->sync([
            $products['Açúcar Refinado']->id => ['quantity_unit' => '1 xícara (para caramelo)'],
            // Supondo que você tem Leite Condensado como produto
            // $products['Leite Condensado']->id => ['quantity_unit' => '1 lata'],
            $products['Leite Integral']->id => ['quantity_unit' => '2 latas (medida)'],
            $products['Ovo de Galinha']->id => ['quantity_unit' => '3 unidades'],
        ]);

    }
}
