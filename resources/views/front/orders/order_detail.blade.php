@extends('layouts.front')
@section('title','Order')
@section('description','Order')
@section('keywords','Order')
@section('content')

<!-- Breadcrumb Start -->
<div class="page-title bg-light">
    <div class="bg-image bg-parallax"><img src="{{asset('css/front/img/bg-desk.jpg')}}" alt=""></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-4">
                <h1 class="mb-0">Order</h1>
                <h4 class="text-muted mb-0">Some informations about our restaurant</h4>
            </div>
        </div>
    </div>
</div>
<br>
<!-- Breadcrumb End -->
			

<div class="container invoice_page">
    <div class="stylishbox">
        <div class="row menu-category-content">
            <div class="col-sm-12">
                <div class="invoice-title">
                    <h3 class="bg-dark dark p-4">ORDER ID: <?php echo $orderDetail->order_number ?></h3> <br/>
                    <h6>You have <span><?php echo count($orderDetail->order_items); ?> items</span> in your order.</h6>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-4 ">
                        <address>
                        <strong>Billed To:</strong><br>
                            <?php echo $orderDetail->user->first_name.' '.$orderDetail->user->last_name; ?><br>
                            <?php echo $orderDetail->user->address.', '.$orderDetail->user->postcode; ?><br>
                            <?php echo $orderDetail->user->email; ?><br>
                            <?php echo $orderDetail->user->phone; ?><br>
                            
                        </address>
                    </div>
                    <div class="col-sm-4 text-center">
                        <address>
                        <strong>Delivery Address:</strong><br>
                            <?php echo $orderDetail->user->first_name.' '.$orderDetail->user->last_name; ?><br>
                            <?php echo $orderDetail->delivery_address.', '.$orderDetail->delivery_postcode; ?><br>
                            <?php echo $orderDetail->delivery_phone; ?><br>
                        </address>
                    </div>
                    <!-- <div class="col-sm-6">
                        <address>
                            <strong>Payment Method:</strong><br>
                            Visa ending **** 4242<br>
                            jsmith@email.com
                        </address> 
                    </div> -->
                    <div class="col-sm-4 text-right">
                        <address>
                            <strong>Order Date:</strong><br>
                            <?php echo date('d/m/Y H:i A', strtotime($orderDetail->created_at)); ?><br><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading  bg-dark dark p-4">
                        <h3 class="panel-title"><strong>Order summary</strong><span class="btn btn-primary float-right" style="cursor: default;">{{($orderDetail->payment_mode == 'cod')?'Cash on delivery':'Paid'}}</span></h3>
                        
                    </div>
                    <div class="panel-body ">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <td><strong>Image</strong></td>
                                        <!-- <td class="text-center"><strong>Category</strong></td> -->
                                        <td class="text-center"><strong>Item</strong></td>
                                        <td class="text-center"><strong>Rating</strong></td>
                                        <td class="text-center"><strong>Price</strong></td>
                                        <td class="text-center"><strong>Quantity</strong></td>
                                        <td class="text-right"><strong>Totals</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                    <?php 

                                        if(!empty($orderDetail->order_items)){
                                            foreach($orderDetail->order_items as $order_item){ 
                                            
                                            $product_slug = getProductSlugByProductId($order_item->product_id);
                                            $iImgPath = asset('image/no_product_image.jpg');
                                              if(isset($order_item->image) && !empty($order_item->image)){
                                                $iImgPath = asset('image/product/200x200/'.$order_item->image);
                                              }

                                            $attributes = getAttributeDetail($order_item->productFeatureItem_id) ; 

                                            //echo '<pre>';print_r($order_item);die;
                                    ?>
                                    <?php  //$categoryname = getcategoryname_byproduct_id($order_item->product_id);  ?>   
                                    <tr>
                                                                        

                                        <td><!-- <a href="{{ URL::to('product/'.$product_slug) }}"> --><img src="<?php echo $iImgPath ?>" class="img-fluid order_item_img" alt="thumb" title="<?php echo $order_item->product_name ?>"  /><!-- </a> --></td>
                                 <!--        <td></td>     -->
                                        <td class="text-center"><!-- <a href="{{ URL::to('product/'.$product_slug) }}"> --><?php echo $order_item->product_name ?> <!-- </a> --><br><!--  -->
                                        <span class="caption text-muted">{{$attributes['name']}}</span>
                                        </td>
                                        <td class="text-center"><?php  $avg_rating = getProductAverageRatingfor_many_items($order_item->product_id);  ?>
                                               
                                        <div class="rating">
                                          <?php for($i = 1; $i <=5; $i++){ ?>
                                            
                                                <i class="fa fa-star <?php echo ($i <= $avg_rating) ? 'selected_star_rating' : 'not_selected_star_rating'; ?>"></i>
                                            <?php } ?>
                                        </div></td>
                                        <td class="text-center"><?php echo getSiteCurrencyType(); ?><?php echo $order_item->amount ?></td>
                                        <td class="text-center"><?php echo $order_item->qty ?></td>
                                        <td class="text-right"><?php echo getSiteCurrencyType(); ?><?php echo $order_item->total_amount ?></td>
                                    </tr>
                                   <?php } ?>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                        <td class="thick-line text-right"><?php echo getSiteCurrencyType(); ?><?php echo $orderDetail->subtotal ?></td>
                                    </tr>                                
                                   <?php if (!empty($orderDetail->coupon_discount)) {
                                        if($orderDetail->coupon_type == 'percentage'){
                                              $amount_coupon = $orderDetail->coupon_amount.'%' ;
                                        }else{
                                          $amount_coupon = getSiteCurrencyType().' '.$orderDetail->coupon_amount;
                                        } ?>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Coupon:<?php echo $orderDetail->coupon_code; ?> <br/>(Discount:<?php echo $amount_coupon;?>)</strong></td>
                                        <td class="thick-line text-right"><?php echo getSiteCurrencyType(); ?><?php echo $orderDetail->coupon_discount ?></td>
                                    </tr>                                 
                                    <?php } ?>
                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Tax</strong></td>
                                        <td class="thick-line text-right"><?php echo getSiteCurrencyType(); ?><?php echo $orderDetail->tax_amount ?></td>
                                    </tr>                                

                                    <tr>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line"></td>
                                        <td class="thick-line text-center"><strong>Shipping Charges</strong></td>
                                        <td class="thick-line text-right"><?php echo getSiteCurrencyType(); ?><?php echo $orderDetail->shippingamount ?></td>
                                    </tr>                               


                                    <tr>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line"></td>
                                        <td class="no-line text-center"><strong>Total</strong></td>
                                        <td class="no-line text-right"><?php echo getSiteCurrencyType(); ?><?php echo $orderDetail->total_amount ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
            <h3 class="panel-title bg-dark dark p-4"><strong>Track Order:</strong></h3><hr>
                <ol class="progtrckr" data-progtrckr-steps="4">
                    <li class="progtrckr-<?php echo isset($orderDeliveryStatusArr['confirmed']) ? 'done' : 'todo'; ?>">Order Confirmed <?php echo isset($orderDeliveryStatusArr['confirmed']) ? '('.date('h:i A', strtotime($orderDeliveryStatusArr['confirmed']->updated_at)).')' : '';  ?></li>
                    <li class="progtrckr-<?php echo isset($orderDeliveryStatusArr['assign_staff']) ? 'done' : 'todo'; ?>">Food Pack & Assign <?php echo isset($orderDeliveryStatusArr['assign_staff']) ? '('.date('h:i A', strtotime($orderDeliveryStatusArr['assign_staff']->updated_at)).')' : '';  ?></li>
                    <li class="progtrckr-<?php echo isset($orderDeliveryStatusArr['out_for_delivery']) ? 'done' : 'todo'; ?>">Out For Delivery <?php echo isset($orderDeliveryStatusArr['out_for_delivery']) ? '('.date('h:i A', strtotime($orderDeliveryStatusArr['out_for_delivery']->updated_at)).')' : '';  ?></li>
                    <li class="progtrckr-<?php echo isset($orderDeliveryStatusArr['delivered']) ? 'done' : 'todo'; ?>">Delivered <?php echo isset($orderDeliveryStatusArr['delivered']) ? '('.date('h:i A', strtotime($orderDeliveryStatusArr['delivered']->updated_at)).')' : '';  ?></li>
                </ol>
            </div>
        </div>
    
						
	<div class="clearfix"></div>
	<?php 
		if(isset($orderDeliveryStatusArr['assign_staff']) && !empty($orderDeliveryStatusArr['assign_staff'])){
	?>	
    <div class="row ">
        <div class="col-md-12 ">
                <div class="col-sm-offset-12 col-sm-12 delevery_staff_detail_box stylishbox2">
                    <h3 class="bg-dark dark p-4">Deliver By:</h3>
                    <div class="media">
                        <?php  $img = asset('image/no_product_image.jpg');
                        if(!empty($deliveryUserDetailArr['image'])){
                            $img = asset('image/staff/200x200/'.$deliveryUserDetailArr['image']);
                        }
                        ?>
                        <img class="mr-3 img-thumbnail" src="{{ $img }}" alt="" style="width:139px;height: 130px;">
                        <div class="media-body">
                            <?php if(!empty($deliveryUserDetailArr)){ ?>
                            <h4><?php echo $deliveryUserDetailArr['name']; ?></h4>
                            <p><i class="ti ti-email"></i> <?php echo $deliveryUserDetailArr['email']; ?></p>
                            <p><i class="ti ti-mobile"></i> <?php echo isset($deliveryUserDetailArr['phone']) ? $deliveryUserDetailArr['phone'] : ''; ?>
                            <p><i class="ti ti-mobile"></i> <?php echo isset($deliveryUserDetailArr['mobile']) ? $deliveryUserDetailArr['mobile'] : ''; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
	<?php  } ?>

    <div class="row" style="margin-bottom: 50px;"><div class="col-md-12 "><div class="col-sm-offset-3 col-sm-4 "></div></div></div>
    </div>
</div>
    

        			
@endsection
