//RECAPTCHA
var onloadCallback = function() {
  console.log("recaptcha ready");
  grecaptcha.render('contact_recaptcha', {
    'sitekey' : '6LcF_pMUAAAAALX0UHZIb9Fbdxk5ylTIkXQyPWqT'
  });
};
function closeNav() {
  document.getElementById("sidebar").style.width = "0";
  document.getElementById("overlay").classList.remove("overlay3");
}
function openNav() {
  document.getElementById("sidebar").style.width = "240px";
  document.getElementById("overlay").classList.toggle("overlay3");
}


$(document).ready(function() {
    //for Contact Form Index
    $("#ContactForm").submit(function(e) {

      e.preventDefault();
      var fullname = $("#fn").val();
      var email = $("#e").val();
      var message = $("#m").val();
      var fd = new FormData(this);

      var $captcha = $( '#contact_recaptcha' ),
      response = grecaptcha.getResponse();

      if (fullname == "" || email == "" || message == "" || response.length === 0) {
        $(".contact-form-err").empty();
        $(".contact-form-err").fadeIn(1000);
        $(".contact-form-err").append("There was an error while submitting the form. Please try again!");
        $(".contact-form-err").fadeOut(3000);
      }
      else {
            httpAjaxFD("post", "contactsent", fd).then(res => {
              $(".contact-form-success").fadeIn(1000);
              $("#ContactForm").trigger("reset");
              $(".contact-form-err").hide();
              $(".contact-form-success").fadeOut(3000);
              grecaptcha.reset();
            });
      }
    });

    $("#EditProduct").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget);
    var pId = button.data("productid");
    var pName = button.data("productname");
    var pDesc = $('#' + button.data("productdesc")).html();
    var pImg = button.data("productimg");
    // var oldImg = $("#oldImg");
    // var ImgModal = $("#ImgModal");
    var modal = $(this);
    modal.find(".modal-body #product_id_e").val(pId);
    modal.find(".modal-body #product_name_e").val(pName);
    modal.find(".modal-body #product_desc_e").html(pDesc);
    modal
      .find(".modal-body #product_image_prev")
      .attr("src", "../image/" + pImg);
    });
    $("#EditProductForm").submit(function(e) {
      //  $("#EditProductForm").attr("action", "updateproduct");
      e.preventDefault();
      var p_name = $("#product_name_e").val();
      var p_desc = $("#product_desc_e").html();
      $('#pDescTemp_e').val(p_desc);
      var p_img = $("#product_image_e").val();
      
      var fd = new FormData(this);
      if (p_name == "" || p_desc == "" || p_img == "") {
        //   $(".form-feedback-err").html("All fields are required")
        $(".form-updateproduct-err").fadeIn(1000);
        $(".form-updateproduct-err").fadeOut(5000);
      } else {
        httpAjaxFD("post", "updateproduct", fd).then(res => {
          $(".form-updateproduct-success").fadeIn(1000);
          $("#addProductForm").trigger("reset");
          $(".form-updateproduct-err").hide();
          $(".form-updateproduct-success").fadeOut(6000);
          setTimeout(() => {
            window.location.href = "../Admin/products";
          }, 1000);
        });
      }
    });
    $("#DropProduct").on("show.bs.modal", function(event) {
      var fd = new FormData(this);
      //e.preventDefault();
      var button = $(event.relatedTarget);
      var pId = button.data("dropproductid");
      var modal = $(this);
      modal.find(".modal-body #drop_pID").val(pId);

      $("#DropProductForm").submit(function(e) {
        //  $("#EditProductForm").attr("action", "updateproduct");
        //$("#drop_pID").val();
        e.preventDefault();
        httpAjax("post", "dropproduct", {
          data: { product_id: $("#drop_pID").val() }
        }).then(res => {
         // alert(res);
          setTimeout(() => {
            window.location.href = "../Admin/products";
          }, 1000);
        });
      });

    });

    $("#addProductForm").submit(function(e) {

      e.preventDefault();
      var p_name = $("#product_name").val();
      var p_desc = $("#product_desc").html();
      $('#pDescTemp').val(p_desc);
      var p_img = $("#product_image").val();
      //console.log(p_desc); 
      var fd = new FormData(this);

      if (p_name == "" || p_desc == "" || p_img == "") {
        //   $(".form-feedback-err").html("All fields are required")
        $(".form-product-err").fadeIn(1000);
        $(".form-product-err").fadeOut(5000);
      } else {
        httpAjaxFD("post", "addproduct", fd).then(res => {
          console.log(res);
          $(".form-product-success").fadeIn(1000);
          $("#addProductForm").trigger("reset");
          $(".form-product-err").hide();
          $(".form-product-success").fadeOut(6000);
             setTimeout(() => {
            window.location.href = '../Admin/products'
          }, 1000);
        });
      }
    });

    //Ordering 
    //For Pending Orders
    $("#OrderRequestModal").on("show.bs.modal", function(event) {
      var button = $(event.relatedTarget);
      var orid = button.data("orid");
      var fn = button.data("fullname");
      var email = button.data("email");
      var contactnumber = button.data("contactnumber");
      var productname = button.data("productname");
      var quantity = button.data("quantity");
      var address = button.data("address");
      var additionalnote = button.data("additionalnote");
      var status = button.data("status");
      var modal = $(this);
      modal.find(".modal-body #or_id").val(orid);
      modal.find(".modal-body #full_name").val(fn);
      modal.find(".modal-body #email").val(email);
      modal.find(".modal-body #contact_number").val(contactnumber);
      modal.find(".modal-body #product_name").val(productname);
      modal.find(".modal-body #quantity").val(quantity);
      modal.find(".modal-body #address").val(address);
      modal.find(".modal-body #additional_note").val(additionalnote);
      modal.find(".modal-body #status").val(status);
    });
    $("#OrderRequestForm").submit(function(e) {
      //  $("#EditProductForm").attr("action", "updateproduct");
      e.preventDefault();
      
      var fd = new FormData(this);
        httpAjaxFD("post", "updateorderreq", fd).then(res => {
          $(".form-order-req-success").fadeIn(1000);
          $("#OrderRequestForm").trigger("reset");
          $(".form-order-req-success").fadeOut(3000);
          setTimeout(() => {
            window.location.href = "../Admin/ordering";
          }, 1000);
        });

    });
    //Index Order Form
    $("#OrderModal").on("show.bs.modal", function(event) {
      var button = $(event.relatedTarget);
      var o_pid = button.data("opid");
      var o_pname = button.data("opn");
      var modal = $(this);
      modal.find(".modal-body #order_product_id").val(o_pid);
      modal.find(".modal-body #order_product_name").val(o_pname);
    }); 

    $("#OrderModalForm").submit(function(e) {
      e.preventDefault();
      var fullname = $("#order_product_fn").val();
      var email = $("#order_product_email").val();
      var contact_number = $("#order_product_contact_number").val();
      var quantity = $("#order_product_quantity").val();
      var address = $("#order_product_address").val();
      var fd = new FormData(this);
      if(fullname == ''|| email=='' || contact_number == '' || quantity == '' || address == '')
      {
        $(".form-order-main-err").fadeIn(1000);
        $(".form-order-main-err").fadeOut(3000);
      }else{
        httpAjaxFD("post", "ordersent", fd).then(res => {
           $(".form-order-main-success").fadeIn(1000);
           $("#OrderRequestForm").trigger("reset");
           $(".form-order-main-err").hide(1000);
           $("#OrderModalForm").reset();
           $(".form-order-main-success").fadeOut(3000);
           setTimeout(() => {
             window.location.href = "../";
           }, 1000);
         });
      }
    });
    
    $("#OrderProcessModal").on("show.bs.modal", function(event) {
      var opbutton = $(event.relatedTarget);
      var oporid = opbutton.data("oporid");
      var opfn = opbutton.data("opfullname");
      var opemail = opbutton.data("opemail");
      var opcontactnumber = opbutton.data("opcontactnumber");
      var opproductname = opbutton.data("opproductname");
      var opquantity = opbutton.data("opquantity");
      var opaddress = opbutton.data("opaddress");
      var opadditionalnote = opbutton.data("opadditionalnote");
      var opstatus = opbutton.data("opstatus");
      var modal = $(this);
      modal.find(".modal-body #on_p_or_id").val(oporid);
      modal.find(".modal-body #on_p_full_name").val(opfn);
      modal.find(".modal-body #on_p_email").val(opemail);
      modal.find(".modal-body #on_p_contact_number").val(opcontactnumber);
      modal.find(".modal-body #on_p_product_name").val(opproductname);
      modal.find(".modal-body #on_p_quantity").val(opquantity);
      modal.find(".modal-body #on_p_address").val(opaddress);
      modal.find(".modal-body #on_p_additional_note").val(opadditionalnote);
      modal.find(".modal-body #on_p_status").val(opstatus);
    });
    $("#OrderProcessForm").submit(function(e) {
      //  $("#EditProductForm").attr("action", "updateproduct");
      e.preventDefault();
      
      var fd = new FormData(this);
        httpAjaxFD("post", "updateoporder", fd).then(res => {
          $(".form-order-req-success").fadeIn(1000);
          $("#OrderRequestForm").trigger("reset");
          $(".form-order-req-success").fadeOut(3000);
          setTimeout(() => {
            window.location.href = "../Admin/ordering";
          }, 1000);
        });

    });
});

$(function() {
  /* onloadCallback();*/

  $("#Home").parallax({
    imageSrc: "image/12-min.jpg",
    speed: 0.2
  });

  $(window).scroll(function() {
    if ($(this).scrollTop() > 90 && $(this).scrollTop() > 90) {
      $("#mynavs").css({
        "background-color": "#450d6b",
        "border-bottom-color": "#fff",
        "border-bottom-style": "solid",
        "border-bottom-width": "2px"
      });
    } else {
      $("#mynavs").css({
        "background-color": "transparent",
        "border-bottom-color": "none",
        "border-bottom-style": "none",
        "border-bottom-width": "none"
      });
    }
  });

  $(window).scroll(function() {
    //  var scrollBarLocation = $(this).scrollTop();
    //console.log(scrollBarLocation);
    if ($(this).scrollTop() > 60 && $(this).scrollTop() > 60) {
      $("#Services .services-card").addClass("animated zoomIn");
      $("#Services .services-card").css("display", "block");
    }
  });

  //nav scroll
  var scrollAnimate = $(".nav-scroll");

  scrollAnimate.click(function(e) {
    e.preventDefault();
    $("body,html").animate(
      {
        scrollTop: $(this.hash).offset().top
      },
      1000
    );
  });
});

function iFrameOn() {
  //document.designMode = "on";
}

function iBold() {
  document.execCommand("bold", false, null);
}

function iUnderline() {
  document.execCommand("underline", false, null);
}
function iItalic() {
  document.execCommand("italic", false, null);
}
function iHorizontalRule() {
  document.execCommand("insertHorizontalRule", false, null);
}
function iUnorderedList() {
  document.execCommand("insertUnorderedList", false, "newUL");
}
function iOrderedList() {
  document.execCommand("insertOrderedList", false, "newOL");
}
function iLink() {
  var link = prompt("Enter a link", "");
  product_desc.document.execCommand("createLink", false, link);
}
function iUnlink() {
  product_desc.document.execCommand("unlink", false, null);
}
function iIndent() {
  product_desc.document.execCommand("indent", false, null);
}
function iOutdent() {
  product_desc.document.execCommand("outdent", false, null);
}
function iAlignCenter() {
  product_desc.document.execCommand("justifyCenter", false, null);
}
function iAlignJustify() {
  product_desc.document.execCommand("justifyFull", false, null);
}
function iAlignLeft() {
  product_desc.document.execCommand("justifyLeft", false, null);
}
function iAlignRight() {
  product_desc.document.execCommand("justifyRight", false, null);
}
