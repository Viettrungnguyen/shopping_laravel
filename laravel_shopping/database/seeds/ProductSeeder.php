<?php

use App\Category;
use App\Product;
use App\Tags;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $iphone = Category::where('name', 'iPhone')->first();
        $xiaomi = Category::where('name', 'Xiaomi')->first();
        $samsung = Category::where('name', 'Samsung')->first();
        $ip13 = Product::where('name', 'iPhone 13 Pro Max')->first();
        $ss22 = Product::where('name', 'Samsung Galaxy S22 Ultra 5G')->first();
        $xiaomi12 = Product::where('name', 'Xiaomi 12 ')->first();
        $tagsip13 = Tags::where('name', 'ip13pm')->first();
        $tagsss22 = Tags::where('name', 'ss22')->first();
        $tagsxiaomi12 = Tags::where('name', 'xiaomi12')->first();
        if (!$iphone) {
            $iphone = new Category();
            $iphone->name = 'iPhone';
            $iphone->slug = 'iPhone';
            $iphone->save();
        }
        if (!$xiaomi) {
            $xiaomi = new Category();
            $xiaomi->name = 'Xiaomi';
            $xiaomi->slug = 'Xiaomi';
            $xiaomi->save();
        }
        if (!$samsung) {
            $samsung = new Category();
            $samsung->name = 'SamSung';
            $samsung->slug = 'SamSung';
            $samsung->save();
        }
        if (!$tagsip13) {
            $tagsip13 = new Tags();
            $tagsip13->name = "ip13pm";
            $tagsip13->save();
        }
        if (!$tagsss22) {
            $tagsss22 = new Tags();
            $tagsss22->name = "ss22";
            $tagsss22->save();
        }
        if (!$tagsxiaomi12) {
            $tagsxiaomi12 = new Tags();
            $tagsxiaomi12->name = "xiaomi12";
            $tagsxiaomi12->save();
        }
        if (!$ip13) {
            $ip13 = new Product();
            $ip13->code = "iPhone13ProMax";
            $ip13->name = "iPhone 13 Pro Max";
            $ip13->description = "Điện thoại iPhone 13 Pro Max 128 GB - siêu phẩm được mong chờ nhất ở nửa cuối năm 2021 đến từ Apple. Máy có thiết kế không mấy đột phá khi so với người tiền nhiệm, bên trong đây vẫn là một sản phẩm có màn hình siêu đẹp, tần số quét được nâng cấp lên 120 Hz mượt mà, cảm biến camera có kích thước lớn hơn, cùng hiệu năng mạnh mẽ với sức mạnh đến từ Apple A15 Bionic, sẵn sàng cùng bạn chinh phục mọi thử thách.";
            $ip13->image_url =  '/storage/image_products/2/iphone-13-pro-max-(16).jpg';
            $ip13->image_name = "iphone-13-pro-max-(16).jpg";
            $ip13->price = "600";
            $ip13->slug = 'iPhone-13-Pro-Max';
            $ip13->category_id = $iphone->id;
            $ip13->save();
            $ip13->tags()->attach($tagsip13->id);
        }
        if (!$ss22) {
            $ss22 = new Product();
            $ss22->code = "SamsungGalaxyS22Ultra5G";
            $ss22->name = "Samsung Galaxy S22 Ultra 5G";
            $ss22->description = "Galaxy S22 Ultra 5G chiếc smartphone cao cấp nhất trong bộ 3 Galaxy S22 series mà Samsung đã cho ra mắt. Tích hợp bút S Pen hoàn hảo trong thân máy, trang bị vi xử lý mạnh mẽ cho các tác vụ sử dụng vô cùng mượt mà và nổi bật hơn với cụm camera không viền độc đáo mang đậm dấu ấn riêng.";
            $ss22->image_url =  '/storage/image_products/2/Galaxy-S22-Ultra-Burgundy-600x600.jpg';
            $ss22->image_name = "Galaxy-S22-Ultra-Burgundy-600x600.jpg";
            $ss22->price = "1200";
            $ss22->slug = "Samsung-Galaxy-S22-Ultra-5G";
            $ss22->category_id = $samsung->id;
            $ss22->save();
            $ss22->tags()->attach($tagsss22->id);
        }
        if (!$xiaomi12) {
            $xiaomi12 = new Product();
            $xiaomi12->code = "Xiaomi 2";
            $xiaomi12->name = "Xiaomi 12";
            $xiaomi12->description = "Điện thoại Xiaomi đang dần khẳng định chỗ đứng của mình trong phân khúc flagship bằng việc ra mắt Xiaomi 12 với bộ thông số ấn tượng, máy có một thiết kế gọn gàng, hiệu năng mạnh mẽ, màn hình hiển thị chi tiết cùng khả năng chụp ảnh sắc nét nhờ trang bị ống kính đến từ Sony.";
            $xiaomi12->image_url =  '/storage/image_products/2/Xiaomi-12-xam-thumb-mau-600x600.jpg';
            $xiaomi12->image_name = "Xiaomi-12-xam-thumb-mau-600x600.jpg";
            $xiaomi12->price = "1217";
            $xiaomi12->slug = "Xiaomi-12";
            $xiaomi12->category_id = $xiaomi->id;
            $xiaomi12->save();
            $xiaomi12->tags()->attach($tagsxiaomi12->id);
        }
    }
}
