    <?php

    use App\Models\Order;
    use App\Models\User;
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
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Order::class)->constrained();
                $table->foreignIdFor(User::class)->nullable()->constrained();
                $table->double('amount');                              // Số tiền
                $table->tinyInteger('transaction_type')->comment(' 0 Loại A, 1 Loại B');
                $table->enum('payment_method', ['COD', 'VnPAY', 'MOMO']);
                $table->tinyInteger('status')->comment('0 Chưa thanh toán 1 Đã thanh toán');  
                $table->string('note')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('payments');
        }
    };
