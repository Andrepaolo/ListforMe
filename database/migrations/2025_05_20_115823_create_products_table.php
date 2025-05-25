    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->foreignId('category_id')->constrained()->onDelete('cascade');
                $table->string('image')->nullable(); // URL o nombre del archivo
                $table->boolean('is_healthy')->default(false)->nullable();
                $table->foreignId('preference_id')->nullable()->constrained()->onDelete('set null');
                

                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('products');
        }
    };
