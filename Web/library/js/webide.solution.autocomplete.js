function getFolderPaths(request, callback) {
  var autocompleteSelected = $(':focus');
  var dataValue = {};
  var urlValue = "../" + $(autocompleteSelected).attr("data-ctrl") + "/" + $(autocompleteSelected).attr("data-action");
  dataValue = {"filter": request.term};

  $.ajax({
    url: urlValue,
    data: JSON.stringify(dataValue),
    type: 'POST',
    contentType: 'application/json',
    dataType: 'json',
    success: callback
  });
}
;
$(function() {
  $('.autocomplete-item').autocomplete({
    minLength: 0,
    source: function(request, response) {
      getFolderPaths(request, function(folderPaths) {
        response(folderPaths);
      });
    },
    select: function(event, ui) {
      $("#fileDirPath").val(ui.item.label);
      return false;
    }
  });
});