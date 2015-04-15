function print_today() {
  var now = new Date();
  var months = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
  var date = ((now.getDate()<10) ? "0" : "")+ now.getDate();
  function fourdigits(number) {
    return (number < 1000) ? number + 1900 : number;
  }
  var today =  months[now.getMonth()] + " " + date + ", " + (fourdigits(now.getYear()));
  return today;
}
function roundNumber(number,decimals) {
  var newString;// The new rounded number
  decimals = Number(decimals);
  if (decimals < 1) {
    newString = (Math.round(number)).toString();
  } else {
    var numString = number.toString();
    if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
      numString += ".";// give it one at the end
    }
    var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
    var d1 = Number(numString.substring(cutoff,cutoff+1));// The value of the last decimal place that we'll end up with
    var d2 = Number(numString.substring(cutoff+1,cutoff+2));// The next decimal, after the last one we want
    if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
      if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
        while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
          if (d1 != ".") {
            cutoff -= 1;
            d1 = Number(numString.substring(cutoff,cutoff+1));
          } else {
            cutoff -= 1;
          }
        }
      }
      d1 += 1;
    } 
    if (d1 == 10) {
      numString = numString.substring(0, numString.lastIndexOf("."));
      var roundedNum = Number(numString) + 1;
      newString = roundedNum.toString() + '.';
    } else {
      newString = numString.substring(0,cutoff) + d1.toString();
    }
  }
  if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
    newString += ".";
  }
  var decs = (newString.substring(newString.lastIndexOf(".")+1)).length;
  for(var i=0;i<decimals-decs;i++) newString += "0";
  //var newNumber = Number(newString);// make it a number if you like
  return newString; // Output the result to the form field (change for your purposes)
}
function calculatePercent(v,p) {
	var percent_val = 0;
	percent_val = (p/100);
	percent_val = percent_val*v;
	return percent_val;
}
function calculateRow(row) {
    var price = +row.find('input[name^="unit_cost"]').val();
    var qty = +row.find('input[name^="quantity"]').val();
	var total = 0;
	total = (price * qty);
    row.find('span[class^="amount"]').html("INR"+roundNumber(total,2));
    row.find('input[class^="total-amount"]').val(roundNumber(total,2));
}
function calculateGrandTotal() {
    var subTotal = 0;
    $("table#items").find('input[class^="total-amount"]').each(function () {
        subTotal += +$(this).val();
    });
    $("#subtotal").html(roundNumber(subTotal,2));
    $("#sub_total").val(roundNumber(subTotal,2));
	
	var central_excise = $("#central_excise").val();
	var vat = $("#vat").val();
	var freight = $("#freight").val();
	
	var excise_rupees = calculatePercent(subTotal,central_excise);
	excise_rupees = roundNumber(excise_rupees,2);
	var vat_rupees = calculatePercent(subTotal,vat);
	vat_rupees = roundNumber(vat_rupees,2);
	//var freight_rupees = calculatePercent(subTotal,freight);
	//freight_rupees = roundNumber(freight_rupees,2);
	
	$('.excise_rs').html("INR"+excise_rupees);
    $('#central_excise_rs').val(excise_rupees);
	
	$('.vat_rs').html("INR"+vat_rupees);
    $('#vat_rupees').val(vat_rupees);
	
	//$('.freight_rs').html("INR"+freight);
    $('#freight_rupees').val(freight);
	//Grand total
	var final_total_amount = parseFloat(subTotal)+parseFloat(excise_rupees)+parseFloat(vat_rupees)+parseFloat(freight);
	final_total_amount = roundNumber(final_total_amount,2);
	$('.final_total_amount').html(final_total_amount);
    $('.final-total-amount').val(final_total_amount);
	
}
$(document).ready(function() {
	$('#order_date').datepicker({"format":"yyyy-mm-dd"});
  $('input').click(function(){
    $(this).select();
  });

  //$("#paid").blur(update_balance);
   
  $("#addrow").click(function(){
	var htm = '';
	var no_rows = $(".item-row").length;
	no_rows = parseInt(no_rows)+1;
	htm+='<tr class="item-row">';
		htm+='<td class="item-name">';
			htm+='<div class="delete-wpr">';
				htm+='<span class="sno">'+no_rows+'</span>';
				htm+='<a class="delete" href="javascript:;" title="Remove row">X</a>';
			htm+='</div>';
		htm+='</td>';
		htm+='<td class="description">';
			htm+='<textarea name="item_description[]" class="item-description"></textarea>';
		htm+='</td>';
		htm+='<td>';
			htm+='<input type="text" name="quantity[]" value="0" class="qty allownumeric" placeholder="Quantity"/>';
		htm+='</td>';
		htm+='<td>';
			htm+='<input type="text" name="unit_cost[]" value="0" class="price allownumeric" placeholder="Rate/Unit"/>';
		htm+='</td>';
		htm+='<td>';
			htm+='<span class="amount">0.0</span>';
			htm+='<input type="hidden" class="total-amount" name="total_amount[]"/>';
		htm+='</td>';
	htm+='</tr>';
    $(".item-row:last").after(htm);
    if ($(".delete").length > 0) $(".delete").show();
  });  
  $(document).on('click',".delete",function(){
	if($(".delete").length >1)
		$(this).closest("tr").remove();
	else
		alert("You cannot delete this");
  });
  $(document).on('click',".delete,#addrow",function(){
	$('.sno').each(function(index,element){                 
		$(this).html(parseInt(index)+1);
	});
	calculateGrandTotal();
  });
  $("table#items").on("change", 'input[name^="quantity"], input[name^="unit_cost"]', function (event) {
        calculateRow($(this).closest("tr"));
        calculateGrandTotal();
  });
  $("table#items").on("change", '#central_excise, #vat, #freight', function (event) {
	calculateGrandTotal();
  });
  $("#cancel-logo").click(function(){
    $("#logo").removeClass('edit');
  });
  $("#delete-logo").click(function(){
    $("#logo").remove();
  });
  $("#change-logo").click(function(){
    $("#logo").addClass('edit');
    $("#imageloc").val($("#image").attr('src'));
    $("#image").select();
  });
  $("#save-logo").click(function(){
    $("#image").attr('src',$("#imageloc").val());
    $("#logo").removeClass('edit');
  });
  
  $("#date").val(print_today());
	$(document).on("click","#generate_pdf",function(){
		var errors = [];
		var mob = /^[0-9]{10}/;
		if(($.trim($("#phone").val())).length>=1) {
			if(!mob.test($.trim($("#phone").val()))) {
				errors.push("Company phone number should be valid 10 digit number");
			}
		} else {
			errors.push("Company phone number should not be empty");
		}
		if(($.trim($("#invoice_title").val())).length==0) {
			errors.push("Invoice title should not be empty");
		}
		if(($.trim($("#tin").val())).length==0) {
			errors.push("TIN number should not be empty");
		}
		
		if(($.trim($("#our_company").val())).length==0) {
			errors.push("Company name should not be empty");
		}
		if(($.trim($("#our_address").val())).length==0) {
			errors.push("Company address should not be empty");
		}
		if(($.trim($("#order_date").val())).length==0) {
			errors.push("Order date should not be empty");
		}
		if(($.trim($("#order_number").val())).length==0) {
			errors.push("Quotation number should not be empty");
		}
		if(($.trim($("#billing_company").val())).length==0) {
			errors.push("Billing company name should not be empty");
		}
		if(($.trim($("#billing_address").val())).length==0) {
			errors.push("Billing address name should not be empty");
		}
		if(($.trim($("#billing_city").val())).length==0) {
			errors.push("Billing city name should not be empty");
		}
		if(($.trim($("#billing_pin").val())).length==0) {
			errors.push("Billing PIN code should not be empty");
		}
		if(($.trim($("#billing_country").val())).length==0) {
			errors.push("Billing Country name should not be empty");
		}
		if(($.trim($("#shipping_company").val())).length==0) {
			errors.push("Shipping company name should not be empty");
		}
		if(($.trim($("#shipping_addr").val())).length==0) {
			errors.push("Shipping address name should not be empty");
		}
		if(($.trim($("#shipping_city").val())).length==0) {
			errors.push("Shipping city name should not be empty");
		}
		if(($.trim($("#shipping_pin").val())).length==0) {
			errors.push("Shipping PIN code should not be empty");
		}
		if(($.trim($("#shipping_country").val())).length==0) {
			errors.push("Shipping Country name should not be empty");
		}
		
		if(($.trim($("#our_bank_name").val())).length==0) {
			errors.push("Bank name should not be empty");
		}
		if(($.trim($("#our_ifsc_code").val())).length==0) {
			errors.push("IFSC code should not be empty");
		}
		if(($.trim($("#our_banck_ac").val())).length==0) {
			errors.push("Bank Account number should not be empty");
		}
		if(($.trim($("#our_swift_code").val())).length==0) {
			errors.push("SWIFT code should not be empty");
		}
		if(($.trim($(".final-total-amount").val())).length==0) {
			errors.push("Grand total amount should not be empty");
		}
		if(($.trim($("#sub_total").val())).length==0) {
			errors.push("Sub total amount should not be empty");
		}
		$('.item-description').each(function(index,element){                 
			if(($.trim($(this).val())).length==0) {
				errors.push("Item description should not be empty");
			}
		});
		$('.qty').each(function(index,element){                 
			if(($.trim($(this).val())).length==0) {
				errors.push("Quantity should not be empty");
			}
		});
		$('.price').each(function(index,element){                 
			if(($.trim($(this).val())).length==0) {
				errors.push("Rate/Unit should not be empty");
			}
		});
		$('.total-amount').each(function(index,element){                 
			if(($.trim($(this).val())).length==0) {
				errors.push("Amount should not be empty");
			}
		});
		if(errors.length==0) {
			$( "#invoice_form" ).submit();
		} else {
			var j=1;
			var err_txt = "Clear the following errors: \n";
			$.each($.unique( errors ), function(i,v){
				err_txt+= j+") "+v+"\n";
				j++;
			});
			alert(err_txt);
		}
	});
	$(document).on("keypress",".allownumeric",function (event) {
            //this.value = this.value.replace(/[^0-9\.]/g,'');
     $(this).val($(this).val().replace(/[^0-9\.]/g,''));
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
	});
	$(document).on('click','.same_as_billing',function(){
		if($(this).is(":checked")) {
			 $("[name='shipping_company']").val($("[name='billing_company']").val());
			  $("[name='shipping_addr']").val($("[name='billing_address']").val());
			  $("[name='shipping_address2']").val($("[name='billing_address2']").val());
			  $("[name='shipping_city']").val($("[name='billing_city']").val());
			  $("[name='shipping_pin']").val($("[name='billing_pin']").val());
			  $("[name='shipping_country']").val($("[name='billing_country']").val());
		} else {
			 $("[name='shipping_company']").val('');
			  $("[name='shipping_addr']").val('');
			  $("[name='shipping_address2']").val('');
			  $("[name='shipping_city']").val('');
			  $("[name='shipping_pin']").val('');
			  $("[name='shipping_country']").val('');
		}
	});
	var input = $('input[type=text]');
	
    input.focus(function() {
		input_val = $(this).val();
         $(this).val('');
    }).blur(function() {
         var el = $(this);

         /* use the elements title attribute to store the 
            default text - or the new HTML5 standard of using
            the 'data-' prefix i.e.: data-default="some default" */
         if(el.val() == '')
             el.val(input_val);
    });
});