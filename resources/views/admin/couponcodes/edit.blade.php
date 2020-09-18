@extends('layouts.admin')

@section('content')
 <!-- Content Wrapper. Contains page content -->

<meta name="csrf-token" content="{{ csrf_token() }}" />

    <section class="content-header">
      <h1>
        Edit Coupon code
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i><b class="a_tag_color">Home</b></a></li>
        <li><a href="{{ URL::to('admin/couponcodes') }}" ><b class="a_tag_color">Coupon code Manager</b></a></li>
        <li><b >Edit Coupon code</b></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           {!! Form::open(array('url' => url('admin/couponcodes/edit/'.$couponcodes['id']),'files'=>true ,'method'=>'put','id'=>'codeform')) !!}
             {{ csrf_field() }}
              <div class="box-body">

                 <div class="form-group">
                  <label for="exampleInputEmail1">Name </label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Name" required="required" value="{{ $couponcodes['name'] }}">
                   @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Description </label>
                  <textarea class="form-control" name="description" placeholder="Enter Description" required="required">{{ $couponcodes['description'] }}</textarea>
                 
                   @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                </div>      

                <div class="form-group">
                  <label for="exampleInputEmail1">Code</label>
                  <input type="text" class="form-control codeunique" name="code" placeholder="Enter Code" required="required" codeid="{{ $couponcodes['id'] }}" value="{{ $couponcodes['code'] }}">
                  
                    @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                </div> 

                <div class="form-group">
                  <label for="exampleInputEmail1">Coupon Type</label><br>
                  <div style="margin-left: 10px;"> <b> Percentage</b> <input type="radio" name="coupon_type" class="radio_button" value="percentage" required="required" {{ ($couponcodes['coupon_type'] == 'percentage')?'checked=checked':'' }}>
                  <b style="margin-left: 10px;">Amount </b> <input type="radio" name="coupon_type" class="radio_button" value="amount" {{ ($couponcodes['coupon_type'] == 'amount')?'checked=checked':'' }} required="required" >
                </div>
                
                  @if ($errors->has('coupon_type'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('coupon_type') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" class="labelclass">Amount</label>
                  <input type="number" class="form-control" name="amount" placeholder="Enter Amount / Percentage" required="required" value="{{ $couponcodes['amount'] }}">
                  @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                </div>


                <div class="form-group">
                  <label for="exampleInputEmail1">Total available</label>
                  <input type="number" class="form-control" name="coupon_count" placeholder="Enter Total available" required="required" value="{{ $couponcodes['coupon_count'] }}">
                  @if ($errors->has('coupon_count'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('coupon_count') }}</strong>
                                    </span>
                                @endif
                </div> 

                <div class="form-group">
                  <label for="exampleInputEmail1">Using Code (number of times)</label>
                  <input type="number" class="form-control" name="use_code_times" placeholder="Enter Number of times" required="required" value="{{ $couponcodes['use_code_times'] }}">
                  @if ($errors->has('use_code_times'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('use_code_times') }}</strong>
                                    </span>
                                @endif
                </div>  

                <div class="form-group">
                  <label for="exampleInputEmail1">Group</label>
                   <select name="group_id" class="form-control">
                     <option value="0">-Select Group-</option>
                     @foreach($group_list as $group)
                      <option value="{{ $group->id }}" {{ ($couponcodes['group_id'] == $group->id)?'selected':'' }}>{{ ucwords($group->name)}}</option>
                     @endforeach
                   </select>

                </div>

                <div class="col-md-6">
                  <div class="form-group">
                  <label for="exampleInputEmail1">Start date</label>
                  <input type="date" class="form-control" name="start_date" placeholder="Enter date" required="required" value="{{ $couponcodes['start_date'] }}">
                  @if ($errors->has('start_date'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                </div>  
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Expire date</label>
                  <input type="date" class="form-control" name="expire_date" placeholder="Enter Email" required="required" value="{{ $couponcodes['expire_date'] }}">
                  @if ($errors->has('expire_date'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('expire_date') }}</strong>
                                    </span>
                                @endif
                </div>  
              </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Apply a discount</label><br>
                  <div style="margin-left: 10px;"> <input type="radio" name="apply_for" class="radio_button_select" value="category" required="required" {{ ($couponcodes['apply_for'] == 'category')?'checked=checked':'' }}><b> Category</b> 
                  <b style="margin-left: 10px;">Product </b> <input type="radio" name="apply_for" class="radio_button_select" value="product"{{ ($couponcodes['apply_for'] == 'product')?'checked=checked':'' }} required="required" >

                  <b style="margin-left: 10px;">Cart </b> <input type="radio" name="apply_for" class="radio_button_select" value="cart" {{ ($couponcodes['apply_for'] == 'cart')?'checked=checked':'' }} required="required" >

                </div>
                
                  @if ($errors->has('apply_for'))
                                    <span class="help-block">
                                        <strong style="color:red;">{{ $errors->first('apply_for') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group product_list_box" style="display: none;">
                  <label for="exampleInputEmail1">Product List</label>

                  <input type="text"  id="products_list_select" name="product_id" placeholder="Enter Products" value="{{ $product_value }}">

                </div>
                <div class="form-group category_list_box" style="display: none;">
                  <label for="exampleInputEmail1">Category</label>

                  <input type="text"  id="category_list_select" name="category_id" placeholder="Enter Category" value="{{ $category_value }}">

                </div>


                <div class="form-group">
                  <label for="exampleInputPassword1">Status</label>
                   <input type="checkbox" name="status" {{ ($couponcodes['status'] == 1)?'checked':'unchecked' }}>
                </div>
        
        
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" id="submitbutton" class="btn btn-primary">Submit</button>
              </div>
            
           {!! Form::close() !!}
          </div>
          <!-- /.box -->

         
        </div>
        
      </div>
      <!-- /.row -->
    </section>

  
@endsection
<script src="{{ asset('js/admin/jquery.min2.1.3.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
  
  var buttonvalold = $('input[type="radio"]:checked').val();
 
  //radio_button_select

  //alert(button_val_old);
   
   $('.radio_button').change(function(){
        var buttonval = $(this).val();
    if (buttonval == 'percentage') {
    $('.labelclass').html('Percentage');
    }else {
       $('.labelclass').html('Amount');
    }

   });

  if (buttonvalold == 'percentage') {
    $('.labelclass').html('Percentage');
  }else {
    $('.labelclass').html('Amount');
  }



   $('#products_list_select').selectize({
    persist: false,
    createOnBlur: true,
    create: true,
    
    plugins: ['remove_button'],
    
    
     maxItems: null,
     valueField: 'id',
     searchField: 'title',
     options: [<?php foreach($product_list as $key => $search){ ?>
      {id: '<?php echo $search->id; ?>', title: '<?php echo ucwords($search->name); ?>'},
   <?php } ?>
     ],
     render: {
      option: function(data, escape) {
       return '<div class="option">' +
         '<span class="title">' + escape(data.title) + '</span>' +
        '</div>';
      },
      item: function(data, escape) {
       return '<div class="item">'+ escape(data.title) + '</div>';
      }
     },
     create: function(input) {
      return {
       id: input,
       title: input
      };
     }
    });



 $('#category_list_select').selectize({
    persist: false,
    createOnBlur: true,
    create: true,
    
    plugins: ['remove_button'],
    
    
     maxItems: null,
     valueField: 'id',
     searchField: 'title',
     options: [<?php foreach($category_list as $key => $category){ ?>
      {id: '<?php echo $category->id; ?>', title: '<?php echo ucwords($category->name).' -- '.ucwords($category->parent->name); ?>'},
   <?php } ?>
     ],
     render: {
      option: function(data, escape) {
       return '<div class="option">' +
         '<span class="title">' + escape(data.title) + '</span>' +
        '</div>';
      },
      item: function(data, escape) {
       return '<div class="item">'+ escape(data.title) + '</div>';
      }
     },
     create: function(input) {
      return {
       id: input,
       title: input
      };
     }
    });

 var button_val_old = $("input[name='apply_for']:checked").val();

     if (button_val_old == 'product') {

      $('.product_list_box').css('display','block');  

    }
    if(button_val_old == 'category'){

         $('.category_list_box').css('display','block');
    }

   $('.radio_button_select').change(function(){
        var buttonval = $(this).val();
        //alert(buttonval);
    if (buttonval == 'product') {

      $('.product_list_box').css('display','block');
      $('.category_list_box').css('display','none');
      $('#category_list_select').val('');      

    }
    if(buttonval == 'category'){

         $('.category_list_box').css('display','block');
         $('.product_list_box').css('display','none');
         $('#products_list_select').val(''); 
    }
    if(buttonval == 'cart'){
      $('.category_list_box').css('display','none');
      $('.product_list_box').css('display','none');
      $('#category_list_select').val(''); 
      $('#products_list_select').val(''); 
    }

   });


});
</script>

<script type="text/javascript">
/*$(document).ready(function(){

    $('#submitbutton').click(function(){


      var code = $('.codeunique').val();

      var codeid = $('.codeunique').attr('codeid');
      
      var baseUrl = '{{ URL::to('/admin') }}';

      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      
      $.ajax({
      
      url: baseUrl+'/couponcodes/getAjaxcodeunique',
      
      type: 'post',
      
      data: {code: code,codeid: codeid,_token: CSRF_TOKEN},
      
      dataType: 'html',
      
      success: function(result) {
        if(result == 1){
            $('.helpcode').html('This Code is already used.');
            return false;
        } else {
          $('#codeform').submit();
        }    
      
      }
      
      });
                       
  }); 

});*/
</script>