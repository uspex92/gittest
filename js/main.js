//$(function(){
//$('li').animate({'change-color':'#ff0000','font-size':'200px'},3000);

//var kakawka = $('header');
//kakawka.mouseover(function() {
//$(this).addClass('kakawka');
//})
//kakawka.mouseout(function() {
//    $(this).removeClass('kakawka');
//    })
$(document).ready(function(){
 $('.small a').click(function(e) {
     $('.big img').hide().attr('src', $(this.attr("href").fadeIn(1000)))
    e.preventDefault();
});
});