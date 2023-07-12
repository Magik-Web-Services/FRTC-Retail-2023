(function($){
  var my_lazy_loader_loaded_files = new Array(); //Will hold all loaded files
  $.fn.lazyloadScript = function (filename,callback_func,callback_already_loaded) //callback(data,status)
  {
    //Check if the file is already loaded
    var length = my_lazy_loader_loaded_files.length;
    for(var i = 0; i < length; i++) {
      if (my_lazy_loader_loaded_files[i] == filename)
        if((callback_already_loaded)&&(typeof callback_already_loaded== 'function')){
          callback_already_loaded.call(this);
          return false;
        }
    }
    if((callback_func)&&(typeof callback_func == 'function')){
      jQuery.getScript( filename, function(data)
       {
        my_lazy_loader_loaded_files.push(filename);
        callback_func.call(this,data)
        return true;
      });
    }else
    {
      jQuery.getScript( filename, function(data)
      {
        my_lazy_loader_loaded_files.push(filename);
      });
    }
    return false;
  }
}) (jQuery);