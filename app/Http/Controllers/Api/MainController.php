<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Validator, Auth, DB, Gate, File, Mail, Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\Response as R;
use App\Helpers\Helper;
use \Carbon\Carbon;

use \App\Models\ProductCategory;
use \App\Models\ProductSubCategory;
use \App\User;
use \App\Models\Product;
use \App\Models\Order;
use \App\Models\OrderDetail;
use App\Models\Shop;
use App\Models\Setting;
use App\Models\UserReview;
use App\Models\ProductAttachment;




class MainController extends Controller
{
    public function __construct(Request $request, Helper $helper)
    {        
        $this->request = $request;
        $this->helper = $helper;
    }

 	/**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function registerUser()
    {
        $token = Str::random(60);
        $data = $this->request->all();

        $v = Validator::make($data, [
        	// 'firstname_en' => 'required|string|max:40',
        	// 'firstname_ar' => 'required',
        	'mobile_no' => 'required|string|max:20',
        	'password' => 'required'
        ]);

        if($v->fails()){
            return R::ValidationError($v->errors());
        }

        $data['password'] = Hash::make($data['password']);
        $data['api_token'] = hash('sha256', $token);

        $user = User::create($data);

        return R::Success('Registration Successful', ['token' => $token, 'user_id'=> $user->id]);
    }   

    public function resetPassword()
    {
        $token = Str::random(60);
        $data = $this->request->all();

        $v = Validator::make($data, [
            'mobile_no' => 'required|string|max:20',
        ]);

        if($v->fails()){
            return R::ValidationError($v->errors());
        }

        $user = User::where('mobile_no', $data['mobile_no'])
        ->first();

        if($user != null){
            $code = Str::random(60);
            $newPassword = bcrypt($code);
            $phone = '+974'.$this->request->get('mobile_no');
            $result = $this->helper->sendSMS($phone, $code);

            if($result !== false){
                User::where('mobile_no', $data['mobile_no'])
                ->update(['password' => $newPassword]);

                return R::Success('NEW_PASSWORD_SENT');
            } else {
                return R::SimpleError("CANT_SEND_NEW_PASSWORD");
            }
        } else {
            return R::SimpleError('MOBILE_NOT_REGISTERED');
        }
        
        return R::Success('Registration Successful', ['token' => $token, 'user_id'=> $user->id]);
    }   

    public function productCategoryImage($id=0)
    {
        $path = storage_path("app/images/product-category/$id");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/no-image.jpg");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function productSubCategoryImage($id=0)
    {
        $path = storage_path("app/images/product-sub-category/$id");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/no-image.jpg");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function userImage($id=0)
    {
        $path = storage_path("app/images/users/$id");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/user.png");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function bannerImage($id=0)
    {
        $path = storage_path("app/images/banner/$id");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/no-image.jpg");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function shopLogo($id=0)
    {
        $path = storage_path("app/images/shop-logo/$id");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/no-image.jpg");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function shopBanner($id=0)
    {
        $path = storage_path("app/images/shop-banner/$id");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/no-image.jpg");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function productThumbnail($id=0)
    {
        $path = storage_path("app/images/product/$id/thumbnail");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/no-image.jpg");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function ProductImage($imageId)
    {
        $path = storage_path("app/images/product-images/$imageId");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/no-image.jpg");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function recentShops()
    {
        $data = \App\Models\Shop::all();
        return R::Success('Recent Shops', $data);
    }

    public function recentProducts()
    {
        $data = Product::orderBy('created_at', 'desc')
        ->where('status', 'active')
        ->inRandomOrder()
        ->take(3)
        ->get();
        return R::Success('Recent Products', $data);
    }

    public function recentlyViewedProducts()
    {
        $data = Product::orderBy('last_viewed_date', 'desc')
        ->where('status', 'active')
        ->get();
        return R::Success('Recently Viewed Products', $data);
    }

    public function subcategoryProducts($subcatId)
    {
        $data = Product::with('SubCategory')
        ->where('prod_subcat_id', $subcatId)
        ->where('status', 'active');

        if($this->request->has('manufacturer')){
            $manufacturer = $this->request->get('manufacturer');

            if($manufacturer != 'All'){
                $data->where("manufacture_en", $manufacturer);
            }
        }

        if($this->request->has('order_by')){
            switch ($this->request->get('order_by')) {
                case 'whats_new':
                    $data->orderBy('created_at', 'desc');
                    break;

                case 'low_to_high':
                    $data->orderBy('price', 'asc');
                break;

                case 'high_to_low':
                    $data->orderBy('price', 'desc');
                break;

                case 'popularity':
                    $data->orderBy('total_views', 'desc');
                break;
            }    
        }

        $data = $data->get();
        return R::Success('SubCategory Products', $data);
    }

    public function productDetails($productId)
    {
        $data = Product::with('Images', 'SubCategory', 'SubCategory.MainCategory', 'Reviews', 'Reviews.User', 'Attachments')
        ->where('id', $productId)
        ->first();

        if($data->reviews != null){
            foreach ($data->reviews as $key => $review) {
                $data->reviews[$key]->review_time = $review->ReviewTime();
                $data->reviews[$key]->user = $review->user;
            }
        }

        $product = Product::find($productId);
        $product->increment('total_views');
        $product->last_viewed_date = date('Y-m-d H:i:s');
        $product->save();

        return R::Success('Product Details', $data);
    }

    public function login()
    {
        $v = Validator::make($this->request->all(), [
            'mobile_no' => 'required|max:20',
            'password' => 'required',
        ]);

        if($v->fails()){
            return R::ValidationError($v->errors());
        }

        $result = Auth::guard()->attempt($this->request->only('mobile_no', 'password'));
        if($result == true){
            $token = Str::random(60);

            $this->request->user()->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();

            if($this->request->has('fcm_token') && $this->request->get('fcm_token') != ''){
                $this->request->user()
                ->update(['fcm_token'=>$this->request->get('fcm_token')]);
            }

            $data = $this->request->user();
            $data['api_token'] = $token;

            return R::Success('Login Successful', $data);
        } else {
            return R::SimpleError('Invalid Mobile Number or Password');
        }
    }

    public function placeOrder()
    {
        $inputs = $this->request->all();
        $lang = User::find(2)->language;

        $v = Validator::make($inputs, [
            'delivery_note' => 'required|string|max:500',
            'delivery_address' => 'required|string|max:500',
            'items' => 'required|array',
            'items.*.product_id' => 'required|integer',
            'quantity.*.product_id' => 'required|numeric',
            'price.*.product_id' => 'required|numeric',
        ], [
            'items.required' => 'Your cart is empty'
        ]);

        if($v->fails()){
            return R::ValidationError($v->errors());
        }

        $order = [
            'user_id' => Auth::user()->id,
            'order_date' => date('Y-m-d'),
            'delivery_address' => $inputs['delivery_address'],
            'delivery_note' => $inputs['delivery_note'],
            'status' => 'RECEIVED',
            'delivery_fee' => Setting::first()->delivery_fee
        ];

        $order = Order::create($order);

        $data = [];
        $orderTotal = 0;
        $totalPayable = 0;
        foreach ($inputs['items'] as $key => $value) {
            $data[] = [
                'prod_id' => $value['product_id'],
                'qty' => $value['quantity'],
                'price' => $value['price']
            ];
            $orderTotal += $value['price']*$value['quantity'];
            $totalPayable = $orderTotal + Setting::first()->delivery_fee;

            $product = Product::find($value['product_id']);
            $product->increment('total_orders', $value['quantity']);
            $product->save();
        }
        $order->Items()->createMany($data);
        $order->order_total = $orderTotal;
        $order->total_payable = $totalPayable;
        $order->save();

        // $orderNo = str_pad($order->id, 4, '0', STR_PAD_LEFT);
        if($lang == 'ar'){
            $data = [
                'title' => 'حصلت على طلب جديد',
                'content' => 'لقد تلقيت طلبًا جديدًا. رقم الطلب هو  '.$order->id,
                'type' => 'NEW_ORDER'
            ];
        } else {
            $data = [
                'title' => 'Got New Order',
                'content' => 'You received a new order. Order #'.$order->id,
                'type' => 'NEW_ORDER'
            ];
        }
        
        $this->helper->sendFCM(User::find(2)->fcm_token, $data);
        return R::Success("Order Place Successfully", ['order_no'=>$order->id]);
    }

    public function myOrders()
    {
        $data = Order::where('user_id', Auth::user()->id)
        ->orderBy('order_date', 'desc')
        ->orderBy('id', 'desc')
        ->get();
        return R::Success('My Orders List', $data);
    }

    public function orderDetails($orderId)
    {
        $order = Order::find($orderId);
        $details = orderDetail::with('Product')
        ->where('order_id', $orderId)
        ->get();

        return R::Success('Order Details', ['order'=>$order, 'details'=>$details]);
    }

    public function productCategoriesHomePage()
    {
        $data = ProductCategory::with('SubCategories', 'SubCategories.Products')
        ->inRandomOrder()
        ->take(4)
        ->get();
        return R::Success('Product Categories', $data);       
    }

    public function productCategories()
    {
        $data = ProductCategory::with('SubCategories', 'SubCategories.Products')
        ->get();
        return R::Success('Product Categories', $data);       
    }

    public function ProductSubCatImage($imageId)
    {
        $path = storage_path("app/images/product-sub-category/$imageId");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/no-image.jpg");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function shopDetails($id)
    {
        $data = Shop::with('SubCategory')
        ->where('id', $id)
        ->first();
        return R::Success('Shop Details', $data);
    }

    public function shopProducts()
    {
        $data = Product::with('SubCategory')
        ->where('shop_id', Auth::user()->type_id)
        ->get();
        return R::Success('Shop Products', $data);
    }

    public function updateShopProductStatus()
    {
        $productId = $this->request->get('product_id');
        $status = $this->request->get('status');

        $updated = Product::find($productId)
        ->update(['status' => $status]);

        return R::Success('Status Updated Successfully '.$updated);
    }

    public function shopOrders()
    {  
        $perPage = 15;
        $pageNo = $this->request->page;

        $data = Order::with('Customer')
        ->orderBy('orders.created_at', 'desc')
        ->offset($perPage*$pageNo)
        ->take($perPage)
        ->get();

        foreach ($data as $key => $order) {
            $order->customer->prev_orders = Order::where('user_id', $order->customer->id)
            ->count();
            $order->customer->prev_cancelations = Order::where('user_id', $order->customer->id)->where('status', 'CANCELED')
            ->count();
        }

        return R::Success('Shop Orders', $data);
    }

    public function categoryManufacturers($subcatId)
    {
        $data = Product::where('prod_subcat_id', $subcatId)
        ->selectRaw('distinct manufacture_en, manufacture_ar')
        ->get();

        $data->prepend((object) ['manufacture_en'=>'All', 'manufacture_ar'=>'الكل']);

        return R::Success('Manufacturers', $data);
    }

    public function productSubCategories()
    {
        $data = ProductSubCategory::inRandomOrder()->get();
        return R::Success('Product Sub-Categories', $data);
    }

    public function mostPurchasedProducts()
    {
        $data = Product::orderBy('total_orders', 'desc')
        ->orderBy('total_views', 'desc')
        ->where('status', 'active')
        ->take(2)
        ->get();

        return R::Success('Most Customer Purchased Products', $data);
    }

    public function settings()
    {
        $data = Setting::first();
        return R::Success('Settings', $data);
    }

    public function updateOrderStatus()
    {
        //$lang = $this->request->header('Accept-Language');
        $orderId = $this->request->get('order_id');
        $status = $this->request->get('status');

        $order = Order::find($orderId);
        $order->status = $status;
        $order->save();

        $lang = $order->User->language;
        if($status == 'CONFIRMED' || $status == 'CANCELED' || $status == 'DELIVERED'){

            if($status == 'CANCELED'){
                if($lang == 'ar'){
                    $title = 'تم إلغاء الطلب';
                    $content = 'تم إلغاء طلبك رقم  '.$order->id.' من قبل Garey';
                } else {
                    $title = "Order Canceled";
                    $content = 'Your Order #'.$order->id.' has been CANCELED by Garey';
                }
            }

            if($status == 'CONFIRMED'){
                if($lang == 'ar'){
                    $title = 'تم تاكيد الطلب';
                    $content = 'تم تأكيد طلبك رقم  '.$order->id.' من قبل Garey';
                } else {
                    $title = 'Order Confirmed';
                    $content = 'Your Order #'.$order->id.' has been CONFIRMED by Garey';
                }
            }

            if($status == 'DELIVERED'){
                if($lang == 'ar'){
                    $title = 'أجل تسليم';
                    $content = 'تم تسليم طلبك رقم  '.$order->id.' بواسطة Garey';
                } else {
                    $title = "Order Delivered";
                    $content = 'Your Order #'.$order->id.' has been DELIVERED by Garey';
                }
            }

            $data = [
                'title' => $title,
                'content' => $content,
                'type' => 'STATUS_UPDATE',
                'new_status' => $status,
                'order_id' => $order->id
            ];
            
            $this->helper->sendFCM($order->User->fcm_token, $data);
        }

        return R::Success('Status Updated Successfully ');
    }

    public function searchProducts()
    {
        $data = Product::with('SubCategory');
        
        if($this->request->has('keyword')){
            $keyword = $this->request->get('keyword');
            $data->where('prod_title_en', 'like', "%$keyword%")
            ->orWhere('prod_title_ar', 'like', "%$keyword%")
            ->orWhere('prod_details_en', 'like', "%$keyword%")
            ->orWhere('prod_details_ar', 'like', "%$keyword%");
        }

        $data = $data
        ->where('status', 'active')
        ->get();
        return R::Success('Products', $data);
    }

    public function verificationCode()
    {
        $v = Validator::make($this->request->all(), [
            'mobile_no' => 'required|regex:/[0-9]{8}/',
        ], [
            'mobile.required' => 'Invalid Mobile Number',
            'mobile.regex' => 'Invalid Mobile Number',
        ]);

        if($v->fails()){
            return R::ValidationError($v->errors());
        }

        $phone = '+974'.$this->request->get('mobile_no');
        $code = $this->helper->sendVerificationCode($phone);

        if($code !== false)
            return R::Success('Verification Code', ['code' => $code]);
        else 
            return R::SimpleError("Can't send verification code. Please try again later");
    }

    public function saveReview()
    {
        $data = $this->request->all();

        $v = Validator::make($data, [
            'productId' => 'required|integer',
            'rating' => 'required|integer',
            'comment' => 'required|string'
        ]);

        $reviews = UserReview::where('prod_id', $data['productId'])
        ->selectRaw('sum(rating) as rating, count(1) as total')
        ->first();

        $rating = ($reviews->rating+$data['rating']) / ($reviews->total+1);

        DB::beginTransaction();

        try{
            Product::find($data['productId'])
            ->update(['rating'=>round($rating)]);

            UserReview::create([
                'user_id' => Auth::user()->id,
                'prod_id' => $data['productId'],
                'rating' => $data['rating'],
                'comment' => $data['comment'],
                'date' => date('Y-m-d')
            ]);

            DB::commit();
            return R::Success('Review added successfully');
        } catch(\Exception $e) {
            DB::rollback();
            return R::SimpleError("Can't save review. Please try again later");
        }
    }

    public function saveUserImage()
    {
        $file = base64_decode($this->request->get('image'));
        \Storage::put('images/users/'.Auth::user()->id, $file);
        
        return 'Image uploaded successfully';
    }

    public function saveProfile()
    {
        $data = $this->request->all();

        $v = Validator::make($data, [
            'old_password' => 'required|nullable',
            'new_password' => 'required|nullable',
        ]);

        if($v->fails()){
            return R::ValidationError($v->errors());
        }

        $user = Auth::user();
        if(!Hash::check($data['old_password'], $user->password)){
            return R::SimpleError('Old password does not match');
        }

        unset($data['old_password']);
        $data['password'] = Hash::make($data['new_password']);
        unset($data['new_password']);
        $user->update($data);

        return R::Success('Changes saved successfully');
    }

    public function productReviews($productId)
    {
        $data = UserReview::with('User')
        ->where('prod_id', $productId)
        ->get();

        return R::Success('User Reviews', $data);
    }

    public function cancelOrder()
    {
        $orderId = $this->request->get('order_id');
        Order::where('user_id', Auth::user()->id)
        ->where('id', $orderId)
        ->update(['status' => 'CANCELED']);

        return R::Success('Order Canceled Successfully');
    }

    public function downloadAttachment($attachmentId)
    {
        $filename = ProductAttachment::find($attachmentId)->filename;
        $path = storage_path("app/product-attachments/$filename");

        if (!File::exists($path)) {
            $path = public_path("images/avatars/user.png");
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;       
    }

    public function updateFCMToken()
    {
        $token = $this->request->get('token');
        Auth::user()->update(['fcm_token' => $token]);

        return R::Success('Token Updated Successfully');
    }

    public function setUserLanguage()
    {
        $lang = $this->request->get('language');
        Auth::user()->update(['language' => $lang]);

        return R::Success('Language Updated Successfully');
    }

    public function test()
    {
        $data = [
            'title' => 'Got New Order',
            'content' => 'You received a new order. Order #',
            'type' => 'NEW_ORDER',
            "imageUrl"=> "http://h5.4j.com/thumb/Ninja-Run.jpg", 
            "gameUrl"=> "https://h5.4j.com/Ninja-Run/index.php?pubid=noad"
        ];

        return $this->helper->sendFCM(User::find(2)->fcm_token, $data);
    }
}