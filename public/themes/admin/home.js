$(function(){   
	ajax_form();   
	$('.remove').click(function(){
		$('#myModalRemove #myModalRemoveLink').attr('href',$(this).attr('href'));
		$('#myModalRemove').modal();
		return false;
	});
	$('.flash').fadeOut(3000);

	var fixHelper = function(e, ui) {  
            
            ui.children().each(function() {  
                $(this).width($(this).width());   
            });  
            return ui;  
        };  
           


	$( "#sortable" ).sortable({helper:fixHelper});
	
});

 

function ajax_form(){
  $(".ajax_form").each(function(e){
    $(this).unbind("submit").bind("submit",function(){
      $("button").attr({"disabled":"disabled"});
      return simple_ajax_form(this);
    })
  });
}

function simple_ajax_form(form){
  var options={
    dataType:'json',
    success:function(data){
      if(data.status){
        if(data.fun != undefined && data.fun!=''){
          eval(data.fun);
        }
        if(data.msg != undefined && data.msg!=''){
          alert(data.msg);
        }
        if(data.page_goto != undefined && data.page_goto!=''){
          window.location.href=data.page_goto;
        }
      }
      else{
        show_error($(form),data.msg);
        $("button").attr("disabled",false);
        if(data.page_goto != undefined && data.page_goto!=''){
          window.location.href=data.page_goto;
        }
      }

      $("button").removeAttr("disabled");
    },
    error:function(e){
      alert('错误：'+e.status);
      console.log(e);
      $("button").removeAttr("disabled");
    }
  };

  $(form).ajaxSubmit(options);
  return false;
}

function show_error(form,msg){
  $('.error',form).html('').hide();
  console.log(msg);
  for(var i in msg){
    console.log(i);
    
    if($('input[name='+i+']:last',form).parent().find('.error')[0]){
      $('input[name='+i+']:last',form).parent().find('.error').html(msg[i]).show();
      $('input[name='+i+']',form).one('focus',function(){
        $(this).parent().find('.error').html('').hide();
      })
    }
    else if($('select[name='+i+']:last',form).parent().find('.error')[0]){
      $('select[name='+i+']:last',form).parent().find('.error').html(msg[i]).show();
      $('select[name='+i+']',form).one('focus',function(){
        $(this).parent().find('.error').html('').hide();
      })
    }
    else if($('textarea[name='+i+']:last',form).parent().find('.error')[0]){
      $('textarea[name='+i+']:last',form).parent().find('.error').html(msg[i]).show();
      $('textarea[name='+i+']',form).one('focus',function(){
        $(this).parent().find('.error').html('').hide();
      })
    }

    else if($('input[name='+i+']:last',form).parent().find('.help_inline')[0]){
      $('input[name='+i+']:last',form).parent().addClass('has_error');
      $('input[name='+i+']:last',form).parent().find('.help_inline').html(msg[i]);
      $('input[name='+i+']',form).one('focus',function(){
        $(this).parent().removeClass('has_error');
        $(this).parent().find('.help_inline').html('');
      })
    }
    else if($('select[name='+i+']:last',form).parent().find('.help_inline')[0]){
      $('select[name='+i+']:last',form).parent().addClass('has_error');
      $('select[name='+i+']:last',form).parent().find('.help_inline').html(msg[i]);
      $('select[name='+i+']',form).one('focus',function(){
        $(this).parent().removeClass('has_error');
        $(this).parent().find('.help_inline').html('');
      })
    }
    else if($('textarea[name='+i+']:last',form).parent().find('.help_inline')[0]){
      $('textarea[name='+i+']:last',form).parent().addClass('has_error');
      $('textarea[name='+i+']:last',form).parent().find('.help_inline').html(msg[i]);
      $('textarea[name='+i+']',form).one('focus',function(){
        $(this).parent().removeClass('has_error');
        $(this).parent().find('.help_inline').html('');
      })
    }

    else{
      alert(msg[i]);
    }
  }
  
}


 

function autocomplate(ele,url){
	$(ele).autocomplete({
		source: function( request, response ) {
	        $.ajax({
	          url: url,
	          dataType: "jsonp",
	          data: {
	            q: request.term
	          },
	          success: function( data ) {
	            response(data);
	          }
	        });
	      },
	      minLength: 1,
	      select: function( event, ui ) {
		      $('#user2').val(ui.item.key);
	      }
	});
}

  