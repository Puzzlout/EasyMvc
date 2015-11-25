function getFolderPaths(callback) {
  var dataValue = {};
  var urlValue = "../WebIdeAjax/GetSolutionFolders";
  dataValue = {"filter": $('#fileDirPath').val()};

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
  $('#fileDirPath').autocomplete({
    minLength: 0,
    source: function(request, response) {
      getFolderPaths(function(folderPaths) {
        response(folderPaths);
      });
    },
    select: function(event, ui) {
      $("#fileDirPath").val(ui.item.label);
      return false;
    }
  });
});