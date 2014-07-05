$(function() {
  
  $(".block").each(function(i, elem) {
    var titulo = $(elem).find("div.header h2").text();
    console.log(titulo);

    var $bloque = $(elem).detach();

    var $item = $('<div class="btn-group"><button class="btn btn-info dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> '+titulo+'<span class="caret"></span></button>\n\
      <div class="dropdown-menu bloque-insertar"></div></div>');

    $bloque.appendTo($item.find(".bloque-insertar"));
    $item.appendTo("#bloques");
  });
});
  
