/**
* nama Plugin : code-validator
* Author : Huiralb
* github : github.com/huiralb/code-validator
*/

(function($){

  var blurCount = 0;

  $.fn.inputCode = function(options){

    var settings = $.extend({
      required  : true,
      animation : 'Loading...',
      pathAnimation : '',
      ajax : ''
    }, options)

    var target = $(this),
        parent = target.parent(),
        targetVal = target.val();

    // 
    target.focus(function(){
      $('.check').remove();
    });

    // setting required attribute
    if (settings.required == true) {
      $(this).attr('required', 'required')
    }
    else{
      $(this).removeAttr('required')
    }

    // animation
    var animation = ''
    if (settings.pathAnimation == ''){
      animation = settings.animation
    }
    else{
      animation = '<img src="'+settings.pathAnimation+'"/>'
    } 

    this.blur(function(){
      if(target.val() == targetVal)
      {
        target.closest('form').find('button[type="submit"]').removeAttr('disabled');
      }
      if(target.val() == '')
      {
        target.closest('form').find('button[type="submit"]').attr('disabled', 'disabled');
      }
      if(target.val() != '' && target.val() != targetVal)
      {
        target.parent().find('span').remove()
        target.parent().append('<span class="loader">'+animation+'</span>')
        $.getJSON(settings.ajax, {code : slugify(target.val())}, function(data){
          // target.next('.loader').remove()
          $('.loader').remove()
          text(data, target)
        })
      }
      
      blurCount++;

    });


  }

  function text(data, target){
    var success = {
      title : 'Available!',
      class : 'text-success' 
    }
    var danger = {
      title : 'Not Available!',
      class : 'text-danger' 
    }
    if (data) {
      target.closest('form').find('button[type="submit"]').attr('disabled', 'disabled')
      target.parent().find('span.check').remove()
      target.parent().append('<span class="check '+danger.class+'">'+danger.title+'</span>')
    }else{
      target.closest('form').find('button[type="submit"]').removeAttr('disabled')
      target.parent().find('span.check').remove()
      target.parent().append('<span class="check '+success.class+'">'+success.title+'</span>')
    }
  }

  function slugify(text){
  return text.toString()
    .replace(/\s+|-/g, '')           // Replace spaces with 
    .replace(/[^\u0100-\uFFFF\w\-]/g,'') // Remove all non-word chars ( fix for UTF-8 chars )
    .replace(/\-\-+/g, '')         // Replace multiple - with single 
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
  }


})(jQuery)