@extends('layouts.admin')

@section('content')
<script src="{{ asset('js/admin/ckeditor/ckeditor.js') }}"></script>
 <!-- Content Wrapper. Contains page content -->

<meta name="csrf-token" content="{{ csrf_token() }}" />
 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin') }}"><i class="fa fa-dashboard"></i><b class="a_tag_color">Home</b></a></li>
        <li><a href="{{ URL::to('admin/products') }}" ><b class="a_tag_color">Product Manager</b></a></li>
        <li><b >Add Product</b></li>
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
            <form action="{{ route('admin.products.add.post') }}" enctype="multipart/form-data" method="POST" >
             {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Product Name</label>
                  <input type="text" class="form-control" name="name" id="product_Name" placeholder="Enter Product name" required="required">
                  @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                  @endif
                </div>    

                <div class="form-group">
                  <label for="exampleInputEmail1">Product Slug </label>
                  <input type="text" class="form-control" name="slug" id="product_Slug" placeholder="Enter Product slug" required="required">
                   @if ($errors->has('slug'))
                    <span class="help-block">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Price </label>
                  <input type="text" class="form-control" name="price" id="price" placeholder="Enter Product Price" required="required">
                   @if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                    @endif
                </div>   

                 <div class="form-group">
                  <label for="exampleInputEmail1"> Quantity</label>
                  <input type="text" class="form-control number_for" name="quantity" id="quantity" placeholder="Enter Total Product Quantity" required="required">
                   @if ($errors->has('quantity'))
                    <span class="help-block">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
                    @endif
                </div>   
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Server Text heading</label>
                  <input type="text" class="form-control" name="server_text_heading" placeholder="Enter Server Text heading" >
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Main Category</label>
                    <select class="form-control" name="category_id" id="main_category" required="required">
                      <option class="selectcategory" value="">-Select Category-</option>
                        @foreach($category_list as $category)
                            <option class="selectcategory" value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                        @endforeach
                    </select>
                  
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Sub Category</label>
                    <select class="form-control" name="sub_category_id" id="sub_category">
                       <option class="selectcategory" value="">-Select Main Category-</option>
                    </select>
                  
                </div>

                
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <input type="file" class="form-control" name="image" >
                   @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                    @endif
                </div>   

                
                <div class="form-group">
                  <label for="exampleInputEmail1">Short Description</label>
                  <textarea class="form-control"  name="short_description" maxlength="80"></textarea>                 
                   @if ($errors->has('short_description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('short_description') }}</strong>
                    </span>
                    @endif
                </div> 

                 <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <textarea class="form-control" id="editor1" name="description"></textarea>                 
                   @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                </div>              
                <div class="form-group box-footer box-comments">
                    <label for="exampleInputEmail1">Product Feature</label><br>

                    <div class="row"> 
                    <?php foreach ($productFeatures as $key => $productFeature) {
                     ?> 
                     <div class="col-md-6" style="margin-bottom: 15px;">                     
                     <div class="col-md-4">                     
                       <input type="checkbox" name="ProductFeature[{{ $key }}][active]">
                     <b> {{$productFeature->value}}</b></div><div class="col-md-4"> <input type="text" class="form-control" name="ProductFeature[{{ $key }}][price]" placeholder="Enter Price" ><input type="hidden" name="ProductFeature[{{ $key }}][id]" value="{{$productFeature->id}}"></div>
                     </div>

                      <?php } ?>
                  </div>
                  
                  </div>                
                <div class="form-group">
                  <label for="exampleInputEmail1">Tag</label>
                  <input type="text" class="form-control" name="tag[]" placeholder="Enter Tag">
                </div>

                <div class="form-group attachment_fields">
                
                </div>
                <div class="form-group">
                  <a href="javascript:void(0)" class="add_tag btn btn-info"><i class="fa fa-plus"> Add More Tag</i></a>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Item Title</label>
                  <input type="text" class="form-control" name="Item[1][title]" placeholder="Enter Item Title">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Item Price</label>
                   <input type="text" class="form-control" name="Item[1][price]" placeholder="Enter Price">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Item Price type</label>
                    <select class="form-control" name="Item[1][price_type]">
                      <option value="Increment">+(Increment)</option>
                      <option value="Decrement">-(Decrement)</option>
                    </select>
                </div> 

                <div class="form-group item_fields">
                
                </div>
                <div class="form-group">
                  <a href="javascript:void(0)" class="add_item btn btn-info"><i class="fa fa-plus"> Add Items</i></a>
                </div>


                <div class="form-group">
                  <label for="exampleInputEmail1">Allergen Key</label>
                  <textarea class="form-control" name="allergen_key" placeholder="Enter Allergen Key"></textarea> 
                </div> 


                <div class="form-group">
                  <label for="exampleInputEmail1">Meta Title</label>
                  <input type="text" class="form-control" name="meta_title" placeholder="Enter Meta Title" required="required">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Meta Keywords</label>
                  <input type="text" class="form-control" name="meta_keyword" placeholder="Enter Meta Keywords" required="required">
                </div> 

                <div class="form-group">
                  <label for="exampleInputEmail1">Meta Description</label>
                  <textarea class="form-control" name="meta_description" placeholder="Enter Meta Description" required="required"></textarea> 
                </div> 

               

                <div class="form-group">
                  <label for="exampleInputPassword1">Status</label>
                   <input type="checkbox" name="status">
                </div>

                 <div class="form-group">
                  <label for="exampleInputPassword1">Popular</label>
                   <input type="checkbox" name="is_popular">
                </div>
        
        
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" id="submitbutton" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

         
        </div>
        
      </div>
      <!-- /.row -->
    </section>
 
<input type="hidden" id="totalitems" value="1"  />
  
@endsection

<script src="{{ asset('js/admin/jquery.min2.1.3.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
  //alert('sdfdsf');
    $("#product_Name").keyup(function(){
          var Text = $(this).val();
          Text = Text.toLowerCase();
          Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
          $("#product_Slug").val(Text);        
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  
  $(document).on('click','.add_tag',function(){
    //alert('baseUrl');
     var baseUrl = '{{ URL::to('/') }}';
     //alert(baseUrl);
    
     $(".attachment_fields").append('<div class="form-group"><div class="input-group my-colorpicker2 colorpicker-element"><input type="text" class="form-control" name="tag[]" placeholder="Enter Tag"><div class="input-group-addon"><i class="fa fa-close deleteCurrentRow_1" style="cursor:pointer;color: #d33b3b;float:right;"/></i></div></div></div>');

  });
  
  $(document).on('click','.deleteCurrentRow_1',function(){
    if (confirm('Are You Sure?')){
      $(this).parent().parent().remove();
    }
  }); 
   

});
</script>

<script type="text/javascript">
$(document).ready(function() {
  
  $(document).on('click','.add_item',function(){
    //alert('baseUrl');
     var baseUrl = '{{ URL::to('/') }}';
     //alert(baseUrl);
     var totalitems = $("#totalitems").val();
     totalitems = parseInt(totalitems) + 1;
     $("#totalitems").val(totalitems);

        $(".item_fields").append('<div class="box-footer box-comments" style="margin-bottom: 12px"><div class="form-group"><label for="exampleInputEmail1">Item Title</label><i class="fa fa-close deleteitem_1" style="cursor:pointer;color: #d33b3b;float:right;"/></i><input type="text" class="form-control" name="Item['+totalitems+'][title]" placeholder="Enter Item Title" required="required"></div><div class="form-group"><label for="exampleInputEmail1">Item Price</label><input type="text" class="form-control" name="Item['+totalitems+'][price]" placeholder="Enter Price" required="required"></div><div class="form-group"><label for="exampleInputEmail1">Item Price type</label><select class="form-control" name="Item['+totalitems+'][price_type]" required="required"><option value="Increment">+(Increment)</option><option value="Decrement">-(Decrement)</option></select></div></div>');

  });
  
  $(document).on('click','.deleteitem_1',function(){
    if (confirm('Are You Sure?')){
      $(this).parent().parent().remove();
    }
  }); 
   

});
</script>

<script type="text/javascript">
$(document).ready(function(){
  
    $('#main_category').on('change',function(){
      
      var category_id = $(this).val();
      
      var baseUrl = '{{ URL::to('/admin') }}';
      
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
       // alert(CSRF_TOKEN);
      $.ajax({
      
      url: baseUrl+'/products/getAjaxsubcategoryList',
      
      type: 'post',
      
      data: {category_id: category_id,_token: CSRF_TOKEN},
      
      dataType: 'html',
      
      success: function(result) {
      
      $('#sub_category').html(result);
      
      }
      
      });
                       
  }); 
});
</script>

<script type="text/javascript">
 /* $(document).ready(function () {
  //called when key is pressed in textbox
  $(".number_for").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});*/
</script> 

