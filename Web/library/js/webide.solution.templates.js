/**
 * Set the template in the textarea
 */
function LoadTemplate(templateType) {
  datacx.post("WebIdeAjax/GetTemplateContents", {"templateType": templateType}).then(function(reply) {
    if (reply === null || reply.result === 0) {//has an error
      toastr.error(reply.message);
      return undefined;
    }
    //success
    toastr.success("Success");
    $("#fileContents").val(reply);
  });

}
function GetType(element) {
  var fileType = $("#fileType").find(":selected").attr("data-id");
  if (utils.isNullOrEmpty(fileType)) {
    throw "fileType is null or empty";
  }
  LoadTemplate(fileType);

}
(function($) {
  GetType();
  $("#fileType").change(function() {
    GetType();
  });
})(jQuery);
