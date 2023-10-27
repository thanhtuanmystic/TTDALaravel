<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); // Cột ID duy nhất
            $table->string('code')->unique(); // Mã giảm giá (unique)
            $table->decimal('discount', 10, 2); // Số tiền giảm giá hoặc tỷ lệ giảm giá (ví dụ: 10% sẽ là 0.10)
            $table->dateTime('valid_until'); // Ngày hết hạn của mã giảm giá
            $table->timestamps(); // Các cột thời gian tạo và cập nhật tự động
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
