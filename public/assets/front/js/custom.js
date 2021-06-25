$(function ($) {
    "use strict";


    $(document).ready(function () {


//**************************** CUSTOM JS SECTION ****************************************

    // LOADER
      if(gs.is_loader == 1)
      {
        $(window).on("load", function (e) {
          setTimeout(function(){
              $('#preloader').fadeOut(500);
            },100)
        });
      }

    // LOADER ENDS

      //  Alert Close
      $("button.alert-close").on('click',function(){
        $(this).parent().hide();
      });

      $(window).scroll(function() {
          if ($(this).scrollTop()) {
              $('#toTop').fadeIn();
          } else {
              $('#toTop').fadeOut();
          }
      });

      $("#toTop").click(function () {
         //1 second of animation time
         //html works for FFX but not Chrome
         //body works for Chrome but not FFX
         //This strange selector seems to work universally
         $("html, body").animate({scrollTop: 0}, 1000);
      });


    //More Categories
    $('.rx-parent').on('click', function() {
            $('.rx-child').toggle();
            $(this).toggleClass('rx-change');
        });



    $("#ws-ac-side li").each(function() {
      var pageUrl = window.location.href.split(/[?#]/)[0];
      // alert(5);
      var href=$(this).find('.ws-user-mn').attr('href');
      if (href == pageUrl) {
        $(this).find('.ws-user-mn').addClass('active');
        }
    
    });


    //  Quantitity increase  SECTION
    $(document).ready(function () {


        $(window).scroll(function(){
            if ($(window).scrollTop() >= 300) {
                $('.sticky-header').addClass('fixed-header-prod');   
                $('.autocomplete').css('position','relative');   
            }
            else {
                $('.sticky-header').removeClass('fixed-header-prod');
                $('.autocomplete').css('position','absolute');
            }
            

        }); 

        // $(window).scroll(function(){
        //     if ($(window).scrollTop() >= 300) {
        //         $('.sticky-bucket').addClass('fixed-bucket-prod');        
        //     }
        //     else {
        //         $('.sticky-bucket').removeClass('fixed-bucket-prod');
        //     }
        // }); 
      // Product & category jquery ends    
      // $(window).scroll(function() {
      //   if ($(window).scrollTop() > 150) {
      //     $(".sticky-bucket").addClass("position", "fixed");
      //     $(".sticky-bucket").css("top", "90px");
      //   } else if ($(window).scrollTop() <= 0) {
      //     $(".sticky-bucket").css("position", "");
      //     $(".sticky-bucket").css("top", "");
      //   }
      //   if (
      //     $(".sticky-bucket").offset().top + $(".sticky-bucket").height() >
      //     $(".ps-footer").offset().top
      //   ) {
      //         $(".sticky-bucket").css(
      //           "top",-($(".sticky-bucket").offset().top +$(".ps-footer").offset().top )
      //         );  }
      // });
  
    });

    //  FORM SUBMIT SECTION

    $(document).on('submit','#contactform',function(e){
      e.preventDefault();
      $('.gocover').show();
      $('button.submit-btn').prop('disabled',true);
          $.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger ul').html('');
                for(var error in data.errors)
                {
                  $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
                }
                $('#contactform input[type=text], #contactform input[type=email], #contactform textarea').eq(0).focus();
                $('#contactform .refresh_code').trigger('click');

              }
              else
              {
                $('.alert-danger').hide();
                $('.alert-success').show();
                $('.alert-success p').html(data);
                $('#contactform input[type=text], #contactform input[type=email], #contactform textarea').eq(0).focus();
                $('#contactform input[type=text], #contactform input[type=email], #contactform textarea').val('');
                $('#contactform .refresh_code').trigger('click');

              }
              $('.gocover').hide();
              $('button.submit-btn').prop('disabled',false);
               $('html,body').animate({
                scrollTop: $("#cpointed-area").offset().top},
                'slow');
           }

          });

    });
    //  FORM SUBMIT SECTION ENDS


    //  SUBSCRIBE FORM SUBMIT SECTION

    $(document).on('submit','#subscribeform',function(e){
      e.preventDefault();
      $('#sub-btn').prop('disabled',true);
          $.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {

                for(var error in data.errors) {
                  toastr.error(langg.subscribe_error);
                }
              }
              else {
                 toastr.success(langg.subscribe_success);
                  $('.preload-close').click()
              }

              $('#sub-btn').prop('disabled',false);


           }

          });

    });

    //  SUBSCRIBE FORM SUBMIT SECTION ENDS


  // Resend Verification Start
      $(document).on('click','.resendcodelk',function () {
         var $this = $(this).parent().parent().parent().parent().parent();
          $this.find('.alert-info').show();
          $this.find('.alert-info p').html($('.linksnd').val());
        var link = $(this).attr('data-href');
            $.get( link, function(data) {
              }).done(function(data) {

                  toastr.success('Code Resend Successfully!');
                  $this.find('.alert-info').hide();
            })
              // 
          });
  // Resend Verification Ends

    // LOGIN FORM
    $("#loginform").on('submit', function (e) {
      var $this = $(this).parent();
      e.preventDefault();
      $this.find('button.submit-btn').prop('disabled', true);
      $this.find('.alert-info').show();
      $this.find('.alert-info p').html($('#authdata').val());
      $.ajax({
        method: "POST",
        url: $(this).prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if(data[3]==5){
            $('#VerificationModal .useremail').val(data[0]);
            $('#VerificationModal .resendcodelk').attr('data-href',data[111]);
             $('.modal').modal('hide');
             $('#VerificationModal').modal('show');
          }
          else if ((data.errors)) {
            $this.find('.alert-success').hide();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger ul').html('');
            for (var error in data.errors) {
              $this.find('.alert-danger p').html(data.errors[error]);
            }
          } else {
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').hide();
            $this.find('.alert-success').show();
            $this.find('.alert-success p').html('Success !');
            if (data == 1) {
              location.reload();
            } else {
              window.location = data;
            }

          }
          $this.find('button.submit-btn').prop('disabled', false);
        }

      });

    });
    // LOGIN FORM ENDS


    // MODAL LOGIN FORM
    $(".mloginform").on('submit', function (e) {
      var $this = $(this).parent();
      e.preventDefault();
      $this.find('button.submit-btn').prop('disabled', true);
      $this.find('.alert-info').show();
      var authdata = $this.find('.mauthdata').val();
      $('.signin-form .alert-info p').html(authdata);
      $.ajax({
        method: "POST",
        url: $(this).prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if(data[3]==5){
             $('#VerificationModal .useremail').val(data[0]);             
             $('#VerificationModal .resendcodelk').attr('data-href',data[111]);
             $('.modal').modal('hide');
             $('#VerificationModal').modal('show');
          }
          else if ((data.errors)) {
            $this.find('.alert-success').hide();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger ul').html('');
            for (var error in data.errors) {
              $('.signin-form .alert-danger p').html(data.errors[error]);
            }
          } else {
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').hide();
            $this.find('.alert-success').show();
            $this.find('.alert-success p').html('Success !');
            if (data == 1) {
              location.reload();
            } else {
              window.location = data;
            }

          }
          $this.find('button.submit-btn').prop('disabled', false);
        }

      });

    });
    // MODAL LOGIN FORM ENDS

    // REGISTER FORM
    $("#registerform").on('submit', function (e) {
      var $this = $(this).parent();
      e.preventDefault();
      $this.find('button.submit-btn').prop('disabled', true);
      $this.find('.alert-info').show();
      $this.find('.alert-info p').html($('#processdata').val());
      $.ajax({
        method: "POST",
        url: $(this).prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if(data[3]==5){
            $('#VerificationModal .useremail').val(data[0]);
            $('#VerificationModal .resendcodelk').attr('data-href',data[111]);
             $('.modal').modal('hide');
             $('#VerificationModal').modal('show');
          }
          else if (data == 1) {
            window.location = mainurl + '/user/dashboard';
          } else {

            if ((data.errors)) {
              $this.find('.alert-success').hide();
              $this.find('.alert-info').hide();
              $this.find('.alert-danger').show();
              $this.find('.alert-danger ul').html('');
              for (var error in data.errors) {
                $this.find('.alert-danger p').html(data.errors[error]);
              }
              $this.find('button.submit-btn').prop('disabled', false);
            } else {
              $this.find('.alert-info').hide();
              $this.find('.alert-danger').hide();
              $this.find('.alert-success').show();
              $this.find('.alert-success p').html(data);
              $this.find('button.submit-btn').prop('disabled', false);
            }



          }
          $('.refresh_code').click();

        }

      });

    });
    // REGISTER FORM ENDS


    // MODAL REGISTER FORM
    $(".mregisterform").on('submit', function (e) {
      e.preventDefault();
      var $this = $(this).parent();
      $this.find('button.submit-btn').prop('disabled', true);
      $this.find('.alert-info').show();
      var processdata = $this.find('.mprocessdata').val();
      $this.find('.alert-info p').html(processdata);
      $.ajax({
        method: "POST",
        url: $(this).prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if(data[3]==5){
             // window.location=data[0];
             $('#VerificationModal .useremail').val(data[0]);
             $('#VerificationModal .resendcodelk').attr('data-href',data[111]);
             $('.modal').modal('hide');
             $('#VerificationModal').modal('show');
          }
          else if (data == 1) {
            window.location = mainurl + '/user/dashboard';
          }
           else {

            if ((data.errors)) {
              $this.find('.alert-success').hide();
              $this.find('.alert-info').hide();
              $this.find('.alert-danger').show();
              $this.find('.alert-danger ul').html('');
              for (var error in data.errors) {
                $this.find('.alert-danger p').html(data.errors[error]);
              }
              $this.find('button.submit-btn').prop('disabled', false);
            } else {
              $this.find('.alert-info').hide();
              $this.find('.alert-danger').hide();
              $this.find('.alert-success').show();
              $this.find('.alert-success p').html(data);
              $this.find('button.submit-btn').prop('disabled', false);
            }
          }

          $('.refresh_code').click();

        }
      });

    });
    // MODAL REGISTER FORM ENDS


    // Resend Verification link

    $("#verify_account").on('submit', function (e) {
      e.preventDefault();
      var $this = $(this).parent();
      $this.find('button.submit-btn').prop('disabled', true);
      $this.find('.alert-info').show();
      $this.find('.alert-info p').html($('.authdata').val());
      $.ajax({
        method: "POST",
        url: $(this).prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if(data==1){
             location.reload();
          }
          else if (data[1]==2) {
            window.location=data[0];

          } else {
            $this.find('.alert-success').hide();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger p').html(data);
            
          }
            $this.find('button.submit-btn').prop('disabled', false);
        }

      });

    });

    // FORGOT FORM

    $("#forgotform").on('submit', function (e) {
      e.preventDefault();
      var $this = $(this).parent();
      $this.find('button.submit-btn').prop('disabled', true);
      $this.find('.alert-info').show();
      $this.find('.alert-info p').html($('.fauthdata').val());
      $.ajax({
        method: "POST",
        url: $(this).prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if ((data.errors)) {
            $this.find('.alert-success').hide();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger ul').html('');
            for (var error in data.errors) {
              $this.find('.alert-danger p').html(data.errors[error]);
            }
          } else {
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').hide();
            $this.find('.alert-success').show();
            $this.find('.alert-success p').html(data);
            $this.find('input[type=email]').val('');
          }
            $this.find('button.submit-btn').prop('disabled', false);
        }

      });

    });




    $("#mforgotform").on('submit', function (e) {
      e.preventDefault();
      var $this = $(this).parent();
      $this.find('button.submit-btn').prop('disabled', true);
      $this.find('.alert-info').show();
      $this.find('.alert-info p').html($('.fauthdata').val());
      $.ajax({
        method: "POST",
        url: $(this).prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if ((data.errors)) {
            $this.find('.alert-success').hide();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger ul').html('');
            for (var error in data.errors) {
              $this.find('.alert-danger p').html(data.errors[error]);
            }
          } else {
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').hide();
            $this.find('.alert-success').show();
            $this.find('.alert-success p').html(data);
            $this.find('input[type=email]').val('');
          }
          $this.find('button.submit-btn').prop('disabled', false);
        }

      });

    });

    // FORGOT password reset FORM ENDS



    $("#f-reset-password").on('submit', function (e) {
      e.preventDefault();
      var $this = $(this).parent();
      $this.find('button.submit-btn').prop('disabled', true);
      $this.find('.alert-info').show();
      $this.find('.alert-info p').html($('.authdata').val());
      $.ajax({
        method: "POST",
        url: $(this).prop('action'),
        data: new FormData(this),
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if(data[3]==5){
             window.location=data[0];
          }
         else if ((data.errors)) {
            $this.find('.alert-success').hide();
            $this.find('.alert-info').hide();
            $this.find('.alert-danger').show();
            $this.find('.alert-danger ul').html('');
            for (var error in data.errors) {
              $this.find('.alert-danger p').html(data.errors[error]);
            }
          } else {
                window.location=data[1];
          }
            $this.find('button.submit-btn').prop('disabled', false);
        }

      });

    });


// REPORT FORM


$("#reportform").on('submit',function(e){
  e.preventDefault();
  $('.gocover').show();
  var $reportform = $(this);
  $reportform.find('button.submit-btn').prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       dataType:'JSON',
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {

            for(var error in data.errors)
            {
              $reportform.find('.alert-danger').show();
              $reportform.find('.alert-danger p').html(data.errors[error]);
            }
          }
          else
          {

          $reportform.find('input[type=text],textarea').val('');

          $('#report-modal').modal('hide');
          toastr.success('Report Submitted Successfully.');

          }

                  $('.gocover').hide();
                  $reportform.find('button.submit-btn').prop('disabled',false);

       }

      });

});


// REPORT FORM ENDS

// Checkout Form
    $(document).on('submit','#checkoutform',function(e){
      e.preventDefault();
      $('#preloader').show();
      $('button.submit-btn').prop('disabled',true);
          $.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger ul').html('');
                for(var error in data.errors)
                {
                  $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
                }

                $('html,body').animate({
                scrollTop: $("#cpointed-area").offset().top},
                'slow');
                
              }
              else
              {
                if(data[0]==2){
                  window.location = data[6];
                }
                if(data[0]==1){
                  toastr.error(data[5]);
                  window.location = data[6];

                }
                else if(data[0]==0){
                 toastr.error(data[5]);
                }
                // $('.alert-danger').hide();
                // $('.alert-success').show();
                // $('.alert-success p').html(data);
              }
              $('#preloader').hide();
              $('button.submit-btn').prop('disabled',false);
           }

          });

    });
// Checkout Form ends


    //  USER FORM SUBMIT SECTION

    $(document).on('submit','#userform',function(e){
      e.preventDefault();
      $('.gocover').show();
      $('button.submit-btn').prop('disabled',true);
          $.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger ul').html('');
                for(var error in data.errors)
                {
                  $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
                }
                $('#userform input[type=text], #userform input[type=email]').eq(0).focus();
              }
              else
              {
                $('.alert-danger').hide();
                $('.alert-success').show();
                $('.alert-success p').html(data);
                $('#userform input[type=text], #userform input[type=email]').eq(0).focus();
              }
              $('.gocover').hide();
              $('button.submit-btn').prop('disabled',false);
           }

          });

    });




    // USER FORM SUBMIT SECTION ENDS

    // Pagination Starts

    // $(document).on('click', '.pagination li', function (event) {
    //   event.preventDefault();
    //   if ($(this).find('a').attr('href') != '#') {
    //     $('#preloader').show();
    //     $('#ajaxContent').load($(this).find('a').attr('href'), function (response, status, xhr) {
    //       if (status == "success") {
    //         $('#preloader').hide();
    //         $("html,body").animate({
    //           scrollTop: 0
    //         }, 1);
    //       }
    //     });
    //   }
    // });

    // Pagination Ends

        // IMAGE UPLOADING :)

        $(".upload").on( "change", function() {
          var imgpath = $(this).parent().parent().prev().find('img');
          var file = $(this);
          readURL(this,imgpath);
        });

        function readURL(input,imgpath) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                  imgpath.attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        // IMAGE UPLOADING ENDS :)

// MODAL SHOW

$("#show-forgot").on('click',function(){
  $("#comment-log-reg").modal("hide");
  $("#forgot-modal").modal("show");
});

$("#show-forgot1").on('click',function(){
  $("#vendor-login").modal("hide");
  $("#forgot-modal").modal("show");
});

$("#show-login").on('click',function(){
    $("#forgot-modal").modal("hide");
    $("#comment-log-reg").modal("show");
});

// MODAL SHOW ENDS

// Catalog Search Options

// $('.check-cat').on('change',function(){
//   var len = $('input.check-cat').filter(':checked').length;
//   if(len == 0){
//     $("#catalogform").attr('action','');
//     $('.check-cat').removeAttr("name");
//   }
//   else{
//     var search = $("#searchform").val();
//     $("#catalogform").attr('action',search);
//     $('.check-cat').attr('name','cat_id[]');
//   }
//
// });

$('#category_select').on('change',function(){
  var val = $(this).val();
  $('#category_id').val(val);
  $('#searchForm').attr('action', mainurl+'/category/'+$(this).val());
});

// Catalog Search Options Ends


// Auto Complete Section
  $('#prod_name').on('keyup',function(){
     var search = encodeURIComponent($(this).val());
      if(search == ""){
        $(".autocomplete").hide();
      }
      else{
        $(".autocomplete").show();
        $("#myInputautocomplete-list").load(mainurl+'/autosearch/product/'+search);

      }
    });
// Auto Complete Section Ends

// Quick View Section

    $(document).on('click', '.quick-view', function(){
      var $this = $("#quickview");
      $this.find('.modal-header').hide();
      $this.find('.modal-body').hide();
      $this.find('.modal-content').css('border','none');
        $('.submit-loader').show();
        $(".quick-view-modal").load($(this).data('href'),function(response, status, xhr){
          if(status == "success")
          $('.quick-zoom').on('load', function(){
          $('.submit-loader').hide();
              $this.find('.modal-header').show();
              $this.find('.modal-body').show();
              $this.find('.modal-content').css('border','1px solid #00000033');
    $('.quick-all-slider').owlCarousel({
        loop: true,
        dots: false,
        nav: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 0,
        autoplay: false,
        items: 4,
        autoplayTimeout: 6000,
        smartSpeed: 1000,
        responsive: {
            0: {
                items: 4
            },
            768: {
                items: 4
            }
        }
    });
  });
        });

              return false;

    });
// Quick View Section Ends

// Currency and Language Section

        $(".selectors").on('change',function () {
          var url = $(this).val();
          window.location = url;
        });

// Currency and Language Section Ends


// Wishlist Section

    $(document).on('click', '.add-to-wish', function(){
        $.get( $(this).data('href') , function( data ) {

            if(data[0] == 1) {
              toastr.success(langg.add_wish);
              $('#wishlist-count').html(data[1]);

              }
            else {

              toastr.error(langg.already_wish);
              }

        });

              return false;
    });

    $(document).on('click', '#wish-btn', function(){

              return false;

    });


    $(document).on('click', '.wishlist-remove', function(){
      $(this).parent().parent().remove();
        $.get( $(this).data('href') , function( data ) {
          $('#wishlist-count').html(data[1]);
          toastr.success(langg.wish_remove);
        });
    });

// Wishlist Section Ends




// Compare Section

    $(document).on('click', '.add-to-compare', function(){
        $.get( $(this).data('href') , function( data ) {
            $("#compare-count").html(data[1]);
            if(data[0] == 0) {
                                                              toastr.success(langg.add_compare);
              }
            else {
                                                              toastr.error(langg.already_compare);
              }

        });
              return false;
    });


    $(document).on('click', '.compare-remove', function(){
      var class_name = $(this).attr('data-class');
        $.get( $(this).data('href') , function( data ) {
            $("#compare-count").html(data[1]);
            if(data[0] == 0) {
          $('.'+class_name).remove();
                                                              toastr.success(langg.compare_remove);
              }
            else {
          $('h2.title').html(langg.lang60);
          $('.compare-page-content-wrap').remove();
          $('.'+class_name).remove();
                                                             toastr.success(langg.compare_remove);
              }


        });
    });

// Compare Section Ends



// Cart Section

    $(document).on('click', '.add-to-cart', function(){



        $.get( $(this).data('href') , function( data ) {

            if(data == 'digital') {
              toastr.error(langg.already_cart);
             }
            else if(data == 0) {
              toastr.error(langg.out_stock);
              }
            else {
              $("#cart-count").html(data[0]);
              $("#cart-items").load(mainurl+'/carts/view');
              toastr.success(langg.add_cart);
              }
        });
                    return false;
    });



// Adding Muliple Quantity Starts

    var sizes = "";
    var size_qty = "";
    var size_price = "";
    var size_key = "";
    var colors = "";
    var total = "";
    var stock = $("#stock").val();
    var keys = "";
    var values = "";
    var prices = "";

    // Product Details Product Size Active Js Code
    $(document).on('click', '.product-size .siz-list .box', function () {
        $('.qttotal').html('1');
        var parent = $(this).parent();
         size_qty = $(this).find('.size_qty').val();
         size_price = $(this).find('.size_price').val();
         size_key = $(this).find('.size_key').val();
         sizes = $(this).find('.size').val();
                $('.product-size .siz-list li').removeClass('active');
                parent.addClass('active');
         total = getAmount()+parseFloat(size_price);
         total = total.toFixed(2);
         stock = size_qty;

         var pos = $('#curr_pos').val();
         var sign = $('#curr_sign').val();
         if(pos == '0')
         {
         $('#sizeprice').html(sign+total);
         }
         else {
         $('#sizeprice').html(total+sign);
         }

    });

    // Product Details Attribute Code 

$(document).on('change','.product-attr',function(){

         var total = 0;
         total = getAmount()+getSizePrice();
         total = total.toFixed(2);
         var pos = $('#curr_pos').val();
         var sign = $('#curr_sign').val();
         if(pos == '0')
         {
         $('#sizeprice').html(sign+total);
         }
         else {
         $('#sizeprice').html(total+sign);
         }
});


function getSizePrice()
{

  var total = 0;
  if($('.product-size .siz-list li').length > 0)
  {
    total = parseFloat($('.product-size .siz-list li.active').find('.size_price').val());
  }

  return total;
}


function getAmount()
{
  var total = 0;
  var value = parseFloat($('#product_price').val());
  var datas = $(".product-attr:checked").map(function() {
     return $(this).data('price');
  }).get();

  var data;
  for (data in datas) {
    total += parseFloat(datas[data]);
  }
  total += value;
  return total;
}



    // Product Details Product Color Active Js Code
    $(document).on('click', '.product-color .color-list .box', function () {
        colors = $(this).data('color');
        var parent = $(this).parent();
            $('.product-color .color-list li').removeClass('active');
            parent.addClass('active');
    });

// COMMENT FORM

$(document).on('submit','#comment-form',function(e){
  e.preventDefault();
  $('#comment-form button.submit-btn').prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          $("#comment_count").html(data[4]);
          $('#comment-form textarea').val('');
          $('.all-comment').prepend('<li>'+
                          '<div class="single-comment comment-section">'+
                          '<div class="left-area">'+
                          '<img src="'+ data[0] +'" alt="">'+
                          '<h5 class="name">'+ data[1] +'</h5>'+
                          '<p class="date">'+data[2]+'</p>'+
                          '</div>'+
                          '<div class="right-area">'+
                          '<div class="comment-body">'+
                          '<p>'+data[3]+'</p>'+
                          '</div>'+
                          '<div class="comment-footer">'+
                          '<div class="links">'+
                        '<a href="javascript:;" class="comment-link reply mr-2"><i class="fas fa-reply "></i>'+langg.lang107+'</a>'+
                        '<a href="javascript:;" class="comment-link edit mr-2"><i class="fas fa-edit "></i>'+langg.lang111+'</a>'+
                        '<a href="javascript:;" data-href="'+data[5]+'" class="comment-link comment-delete mr-2">'+
                          '<i class="fas fa-trash"></i>'+langg.lang112+'</a>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                      '<div class="replay-area edit-area">'+
                        '<form class="update" action="'+data[6]+'" method="POST">'+
                          '<input type="hidden" name="_token" value="'+$('input[name=_token]').val()+'">'+
                          '<textarea placeholder="'+langg.lang113+'" name="text" required=""></textarea>'+
                          '<button type="submit">'+langg.lang114+'</button>'+
                          '<a href="javascript:;" class="remove">'+langg.lang115+'</a>'+
                        '</form>'+
                      '</div>'+
                      '<div class="replay-area reply-reply-area">'+
                        '<form class="reply-form" action="'+data[7]+'" method="POST">'+
                        '<input type="hidden" name="user_id" value="'+data[8]+'">'+
                          '<input type="hidden" name="_token" value="'+$('input[name=_token]').val()+'">'+
                          '<textarea placeholder="'+langg.lang117+'" name="text" required=""></textarea>'+
                          '<button type="submit">'+langg.lang114+'</button>'+
                          '<a href="javascript:;" class="remove">'+langg.lang115+'</a>'+
                        '</form>'+
                      '</div>'+
                          '</li>');

          $('#comment-form button.submit-btn').prop('disabled',false);
       }

      });
});

// COMMENT FORM ENDS

// REPLY FORM

$(document).on('submit','.reply-form',function(e){
  e.preventDefault();
    var btn = $(this).find('button[type=submit]');
    btn.prop('disabled',true);
    var $this = $(this).parent();
    var text = $(this).find('textarea');
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          $('#comment-form textarea').val('');
          $('button.submit-btn').prop('disabled',false);
                      $this .before('<div class="single-comment replay-review">'+
                          '<div class="left-area">'+
                          '<img src="'+ data[0] +'" alt="">'+
                          '<h5 class="name">'+ data[1] +'</h5>'+
                          '<p class="date">'+data[2]+'</p>'+
                          '</div>'+
                          '<div class="right-area">'+
                          '<div class="comment-body">'+
                          '<p>'+data[3]+'</p>'+
                          '</div>'+
                          '<div class="comment-footer">'+
                          '<div class="links">'+
                        '<a href="javascript:;" class="comment-link reply mr-2"><i class="fas fa-reply "></i>'+langg.lang107+'</a>'+
                        '<a href="javascript:;" class="comment-link edit mr-2"><i class="fas fa-edit "></i>'+langg.lang111+'</a>'+
                        '<a href="javascript:;" data-href="'+data[4]+'" class="comment-link reply-delete mr-2">'+
                          '<i class="fas fa-trash"></i>'+langg.lang112+'</a>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                          '</div>'+
                      '<div class="replay-area edit-area">'+
                        '<form class="update" action="'+data[5]+'" method="POST">'+
                          '<input type="hidden" name="_token" value="'+$('input[name=_token]').val()+'">'+
                          '<textarea placeholder="'+langg.lang116+'" name="text" required=""></textarea>'+
                          '<button type="submit">'+langg.lang114+'</button>'+
                          '<a href="javascript:;" class="remove">'+langg.lang115+'</a>'+
                        '</form>'+
                      '</div>');
          $this.toggle();
          text.val('');
          btn.prop('disabled',false);
       }

      });
});

// REPLY FORM ENDS

// EDIT
$(document).on('click','.edit',function(){
  var text = $(this).parent().parent().prev().find('p').html();
  text = $.trim(text);
  $(this).parent().parent().parent().parent().next('.edit-area').find('textarea').val(text);
  $(this).parent().parent().parent().parent().next('.edit-area').toggle();
});
// EDIT ENDS

// UPDATE
$(document).on('submit','.update',function(e){
  e.preventDefault();
  var btn = $(this).find('button[type=submit]');
  var text = $(this).parent().prev().find('.right-area .comment-body p');
  var $this = $(this).parent();
  btn.prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
        text.html(data);
        $this.toggle();
        btn.prop('disabled',false);
       }
      });
});
// UPDATE ENDS

// COMMENT DELETE
$(document).on('click','.comment-delete',function(){
  var count = parseInt($("#comment_count").html());
  count--;
  $("#comment_count").html(count);
  $(this).parent().parent().parent().parent().parent().remove();
  $.get($(this).data('href'));
});
// COMMENT DELETE ENDS


// COMMENT REPLY
$(document).on('click','.reply',function(){
  $(this).parent().parent().parent().parent().parent().show().find('.reply-reply-area').show();
  $(this).parent().parent().parent().parent().parent().show().find('.reply-reply-area .reply-form textarea').focus();

});
// COMMENT REPLY ENDS

// REPLY DELETE
$(document).on('click','.reply-delete',function(){
  $(this).parent().parent().parent().parent().remove();
  $.get($(this).data('href'));
});
// REPLY DELETE ENDS

// View Replies
$(document).on('click','.view-reply',function(){
  $(this).parent().parent().parent().parent().siblings('.replay-review').removeClass('hidden');

});
// View Replies ENDS

// CANCEL CLICK

$(document).on('click','#comment-area .remove',function(){
  $(this).parent().parent().hide();
});

// CANCEL CLICK ENDS



    /*-----------------------------
        Cart Page Quantity
    -----------------------------*/
    $(document).on('click', '.qtminus', function () {
        var el = $(this);
        var $tselector = el.parent().parent().find('.qttotal');
        total = $($tselector).text();
        if (total > 1) {
            total--;
        }
        $($tselector).text(total);
    });

    $(document).on('click', '.qtplus', function () {
        var el = $(this);
        var $tselector = el.parent().parent().find('.qttotal');
        total = $($tselector).text();
        if(stock != "")
        {
            var stk = parseInt(stock);
              if(total < stk)
              {
                 total++;
                 $($tselector).text(total);
              }
        }
        else {
        total++;
        }

        $($tselector).text(total);
    });


        // Product & category jquery
        $(document).ready(function(){
            $('.count').prop('disabled', true);
            

        });

    // $(document).on("click", ".addcrt" , function(e){    
    //  e.preventDefault();
    //  if($(this).attr('data-class')=="minus1"){
    //       $(this).siblings('.count').val(parseInt($(this).siblings('.count').val()) - 1 );
    //       if ($(this).siblings('.count').val() <= 0) {
    //         $(this).siblings('.count').val(0);
    //       }      
    //  }
    //  else{
    //     $(this).siblings('.count').val(parseInt($(this).siblings('.count').val()) + 1 );  
    //  }
      
    //  var qty = $(this).siblings('.qttotal').val();
     
    //  var pid = $(this).parent().parent().parent().parent().find(".product_id").val();
    //  alert(pid);

    //     if($('.product-attr').length > 0)
    //     {
    //       values = $(".product-attr:checked").map(function() {
    //        return $(this).val();
    //     }).get();

    //     keys = $(".product-attr:checked").map(function() {
    //        return $(this).data('key');
    //     }).get();

    //     prices = $(".product-attr:checked").map(function() {
    //        return $(this).data('price');
    //     }).get();



    //     }

    //     $.ajax({
    //       type: "GET",
    //       url:mainurl+"/addnumcart",
    //       data:{id:pid,qty:qty,size:sizes,color:colors,size_qty:size_qty,size_price:size_price,size_key:size_key,keys:keys,values:values,prices:prices},
    //       success:function(data){

    //         if(data == 'digital') {
    //             toastr.error(langg.already_cart);
    //          }
    //         else if(data == 0) {
    //             toastr.error(langg.out_stock);
    //           }
    //         else {
    //           $("#cart-count").html(data[0]);
    //           $("#cart-items").load(mainurl+'/carts/view');
    //             toastr.success(langg.add_cart);
    //           }
    //          }
    //       });

    // });


// Adding Muliple Quantity Ends

// Add By ONE

      $(document).on("click", ".adding" , function(){
        var pid =  $(this).parent().parent().find('.prodid').val();
        var itemid =  $(this).parent().parent().find('.itemid').val();
        var size_qty = $(this).parent().parent().find('.size_qty').val();
        var size_price = $(this).parent().parent().find('.size_price').val();
        var stck = $(this).parent().parent().find(".stock"+itemid).val();
        var qty = $(this).siblings(".qty"+itemid).val();
        var methodofcollect=$('.methodofcollect:checked').val();
        if(stck != "")
        {
        var stk = parseInt(stck);
          if(qty < stk)
          {
             qty++;
             $(".qty"+itemid).val(qty);
          }
          else{
            toastr.error(langg.out_stock);
          }
        }
        else{
         qty++;
         $(".qty"+itemid).val(qty);
        }
            $.ajax({
                    type: "GET",
                    url:mainurl+"/addbyone",
                    data:{id:pid,itemid:itemid,size_qty:size_qty,size_price:size_price,methodofcollect:methodofcollect},
                    success:function(data){
                        if(data == 0)
                        {
                        }
                        else
                        {
                        $("#bucket-load").load(mainurl+'/carts/view');
                        $("#cart-count").html(data[4]);
                       
                        }
                      }
              });
       });

// Reduce By ONE

      $(document).on("click", ".reducing" , function(){
        var pid =  $(this).parent().parent().find('.prodid').val();
        var itemid =  $(this).parent().parent().find('.itemid').val();
        var size_qty = $(this).parent().parent().find('.size_qty').val();
        var size_price = $(this).parent().parent().find('.size_price').val();
        var stck = $(this).parent().parent().find(".stock"+itemid).val();
        var qty = $(this).siblings(".qty"+itemid).val();
        var methodofcollect=$('.methodofcollect:checked').val();
        if(qty==0){
          return;
        }
        qty--;
        if(qty < 1)
         {
         $(".qty"+itemid).val("1");
         }
         else{
         $(".qty"+itemid).val(qty);
            $.ajax({
                    type: "GET",
                    url:mainurl+"/reducebyone",
                    data:{id:pid,itemid:itemid,size_qty:size_qty,size_price:size_price,methodofcollect:methodofcollect},
                    success:function(data){
                        $("#cart-count").html(data[4]);
                        $("#bucket-load").load(mainurl+'/carts/view');

                        
                      }
              });
         }
       });

      // Removing products
      $(document).on('click','.cart-remove', function(e){
        e.preventDefault();
        var $selector = $(this).data('class');
        var $selector2 = $(this).data('id');

        $('.'+$selector).hide();

          $.get( $(this).data('href') , function( data ) {

            $("#cart-count").html(data[4]);
            $("#bucket-load").load(mainurl+'/carts/view');
            $('.'+$selector2).val(0);
              
          });
      });
// shipchange products
     $(document).on('change','.methodofcollect', function(e){
        e.preventDefault();
          $.get( $(this).data('href') , function( data ) {
            $("#bucket-load").load(mainurl+'/carts/view');
            
              
          });
      });


     // Coupon Form
     $(document).on("submit", '#coupon-form', function(event) { 
        var val = $("#code").val();
        var total = $("#grandtotal").val();
            $.ajax({
                    type: "GET",
                    url:mainurl+"/carts/coupon",
                    data:{code:val, total:total},
                    success:function(data){
                        if(data == 0)
                        {
                           toastr.error(langg.no_coupon);
                            $("#code").val("");
                        }
                        else if(data == 2)
                        {
                            toastr.error(langg.already_coupon);
                            $("#code").val("");
                        }
                        else if(data == 33){
                          toastr.error("Order Amount does not match !");
                          $("#code").val("");
                        }
                        else if(data == 34){
                          toastr.error("Only one coupon is allowed in one time !");
                          $("#code").val("");
                        }
                        else if(data == 35){
                          toastr.error("This coupon is for free delivery !");
                          $("#code").val("");
                        }
                        else
                        {

                           toastr.success(langg.coupon_found);
                            $("#code").val("");
                            $("#bucket-load").load(mainurl+'/carts/view');
                        }
                      }
              });
              return false;
    });

     //Checkout Coupon Form
     $(document).on("click", '#chkoutcoupon', function(e) { 
      e.preventDefault();
        var val = $(this).siblings(".coupon-v").val();
        if(!val){
          toastr.error('Please Enter a code !');
          return;
        }

        var total = $("#grandtotal").val();
            $.ajax({
                    type: "GET",
                    url:mainurl+"/carts/coupon",
                    data:{code:val, total:total},
                    success:function(data){
                        if(data == 0)
                        {
                           toastr.error(langg.no_coupon);
                            $("#code").val("");
                        }
                        else if(data == 2)
                        {
                            toastr.error(langg.already_coupon);
                            $("#code").val("");
                        }
                        else if(data == 33){
                          toastr.error("Order Amount does not match !");
                          $("#code").val("");
                        }
                        else if(data == 34){
                          toastr.error("Only one coupon is allowed in one time !");
                          $("#code").val("");
                        }
                        else if(data == 35){
                          toastr.error("This coupon is for free delivery !");
                          $("#code").val("");
                        }
                        else
                        {
                          $("#tincheck").html(data[6]);

                           toastr.success(langg.coupon_found);
                            $("#code").val("");
                            $("#bucket-load").load(mainurl+'/carts/view/1');
                        }
                      }
              });
              return false;
    });

// Cart Section Ends

// Cart Page Section

       $(document).on("change", ".color" , function(){
        var id =  $(this).parent().find('input[type=hidden]').val();
        var colors = $(this).val();
        $(this).css('background',colors);
            $.ajax({
                    type: "GET",
                    url:mainurl+"/upcolor",
                    data:{id:id,color:colors},
                    success:function(data){
                          toastr.success(langg.color_change);
                      }
              });
       });


// Cart Page Section Ends



    $(document).on('click','.product-modal-show',function(){

      $('.fixed-header-prod').removeClass('fixed-header-prod');

      $('#product_modal').find('.modal-title').html($(this).attr('data-name'));
      $('#product_modal .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
           


        });
    });

    $(document).on('click','.addressbookModal',function(){

      $('#UserAddressModal').find('.modal-title').html($(this).attr('data-name'));
      $('#UserAddressModal .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
          

        });
    });

    $(document).on('click','.addressbookModaledit',function(){
      $('#UserAddressModal').find('.modal-title').html($(this).attr('data-name'));
      $('#UserAddressModal .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
        
        });
    });

    $(document).on('click','.UserAddCardModal',function(){

      $('#UserAddCardModal').find('.modal-title').html($(this).attr('data-name'));
      $('#UserAddCardModal .modal-content .modal-body').html('').load($(this).attr('data-href'),function(response, status, xhr){
          

        });
    });


    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#confirm-delete .btn-ok').on('click', function(e) {
            
            $.ajax({
             type:"GET",
             url:$(this).attr('href'),
             success:function(data)
             {
                  toastr.success(data);
                  $('#confirm-delete').modal('toggle');
                  location.reload();
                  
             }
            });
            return false;
      });

   $(document).on('click','[data-target="#ShopNowModal"]',function(){
    $('.fixed-header-prod').removeClass('fixed-header-prod');
   });




//User Dashboard form Section Ends

    $(document).on('submit','#userdashform',function(e){
      var $this = $(this);
      e.preventDefault();
      $('.gocover').show();
      $('button.submit-btn').prop('disabled',true);
          $.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {

                for(var error in data.errors)
                {
                   toastr.error(data.errors[error]);
                }

              }
              else
              {
                toastr.success(data);
                location.reload();
              }
              $('.gocover').hide();
              $('button.submit-btn').prop('disabled',false);
           }

          });
    });

//User Dashboard form Section Ends



// Review Section

    $(document).on('click','.stars', function(){
      $('.stars').removeClass('active');
      $(this).addClass('active');
      $('#rating').val($(this).data('val'));

    });

    $(document).on('submit','#reviewform',function(e){
      var $this = $(this);
      e.preventDefault();
      $('.gocover').show();
      $('button.submit-btn').prop('disabled',true);
          $.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger ul').html('');
                for(var error in data.errors)
                {
                  $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
                }
                $('#reviewform textarea').eq(0).focus();

              }
              else
              {
                $('.alert-danger').hide();
                $('.alert-success').show();
                $('.alert-success p').html(data[0]);
                $('#star-rating').html(data[1]);
                $('#reviewform textarea').eq(0).focus();
                $('#reviewform textarea').val('');
                $('#reviews-section').load($this.data('href'));
              }
              $('.gocover').hide();
              $('button.submit-btn').prop('disabled',false);
           }

          });
    });

// Review Section Ends


// MESSAGE FORM

$(document).on('submit','#messageform',function(e){
  e.preventDefault();
  var href = $(this).data('href');
  $('.gocover').show();
  $('button.mybtn1').prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
            }
            $('#messageform textarea').val('');
          }
          else
          {
            $('.alert-danger').hide();
            $('.alert-success').show();
            $('.alert-success p').html(data);
            $('#messageform textarea').val('');
            $('#messages').load(href);
          }
          $('.gocover').hide();
          $('button.mybtn1').prop('disabled',false);
       }
      });
});

// MESSAGE FORM ENDS


// User Vendor MESSAGE FORM

$(document).on('submit','#emailreply1',function(e){
  e.preventDefault();
  $('.fa-spin').show();
  $('button.mybtn1').prop('disabled',true);
      $.ajax({ 
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
          if ((data.errors)) {
          $('.alert-success').hide();
          $('.alert-danger').show();
          $('.alert-danger ul').html('');
            for(var error in data.errors)
            {
              $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
            }            
          }
          else
          {
               toastr.success(data);
          }
          $('#emailreply1 textarea').val('');
          $('.close').click();
          $('.fa-spin').hide();
          $('button.mybtn1').prop('disabled',false);
       }
      });
});

// User Vendor MESSAGE FORM ENDS

//**************************** CUSTOM JS SECTION ENDS****************************************

        $(document).on("click", ".favorite-prod" , function(){
          var $this = $(this);
            $.get( $(this).data('href'));
              $this.html('<i class="icofont-check"></i> Favorite');
              $this.prop('class','');

            });


//**************************** GLOBAL CAPCHA****************************************

        $('.refresh_code').on( "click", function() {
            $.get(mainurl+'/contact/refresh_code', function(data, status){
                $('.codeimg1').attr("src",mainurl+"/assets/images/capcha_code.png?time="+ Math.random());
            });
        })

//**************************** GLOBAL CAPCHA ENDS****************************************

//**************************** VENDOR MODAL****************************************

        $('#nav-log-tab11').on( "click", function() {
          $('#vendor-login .modal-dialog').removeClass('modal-lg');
        });

        $('#nav-reg-tab11').on( "click", function() {
          $('#vendor-login .modal-dialog').addClass('modal-lg');
        });

//**************************** VENDOR MODAL ENDS****************************************

$(document).on('click','.affilate-btn',function(e){
  e.preventDefault();
  window.open($(this).data('href'), '_blank');

});

$(document).on('click','.add-to-cart-quick',function(e){
  e.preventDefault();
  window.location = $(this).data('href');

});


// TRACK ORDER

$('#track-form').on('submit',function(e){
  e.preventDefault();
  var code = $('#track-code').val();
  $('.submit-loader').removeClass('d-none');
  $('#track-order').load(mainurl+'/order/track/'+code,function(response, status, xhr){
  if(status == "success")
  {
        $('.submit-loader').addClass('d-none');
  }
});
});

// TRACK ORDER ENDS

});





});
