function addPhotoForm(div_name) {
  // Get the div that holds the collection of tags
  var collectionHolder = $("#"+div_name);
  if (collectionHolder.children("div").length > 9) {
    alert("Maksymalna liczba zdjęć do jednego kroku to 10");
    return;
  }
  // Get the data-prototype we explained earlier
  var prototype = collectionHolder.attr('data-prototype');
  // Replace '$$name$$' in the prototype's HTML to
  // instead be a number based on the current collection's length.
  form = prototype.replace(/\$\$name\$\$/g, collectionHolder.children().length);
  // Display the form in the page
  collectionHolder.append(form);
}

$('a.add_photo').click(function(event){
  event.preventDefault();
  var divName = $(this).prev().attr('id');
  addPhotoForm(divName);
});

$('a.delete_photo').click(function(event){
  event.preventDefault();
  $(this).parent("div.photo").remove();
});

$('a.delete').click(function(){
  if( !confirm('Czy jesteś pewien, że chcesz to usunąć??') ) {
    return false;
  }
});

$('#edit_action .photo input[type="file"]').click(function(){
  $("#"+$(this).attr('id').replace('file', 'ischanged')).val('1');
});

$('#edit_action .document input[type="file"]').click(function(){
  $("#"+$(this).attr('id').replace('file', 'ischanged')).val('1');
});
