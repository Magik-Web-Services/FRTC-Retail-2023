$(document).ready(function() {
/* alert('sss'); */
/* $('img.lazy').hover(function(){
 $(this).find("div").css('display','block');
}); */
	



$('.dff table:nth-child(2)').wrap('<div class="imgs-area"></div>');
$('.imgs-area table tbody tr td div:nth-child(2)').wrap('<div class="imgs-area22"></div>');
$('.imgs-area22 table tbody tr td:nth-child(2) div div div table tbody tr').addClass("imgs-area93");


$("img.lazy").parent().parent().wrap('<div class="imgs-area103"></div>');
$("imgs-area103").wrapInner(".flash-area");
/* $('.flash-area').hide(); */
$("img.lazy").mouseenter(function() {
      $(".flash-area").show();
	   $(".flash-area").css("float","left"); 
	   $(".flash-area").css("top","20px"); 
	   $(".flash-area").css("z-index","100000000"); 
	   $(".flash-area").css("position","absolute"); 
	   $(".flash-area").css("width","260px"); 
}).mouseleave(function() {
      $(".flash-area").hide();
});

});