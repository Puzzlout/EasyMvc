/** 
 * Set the template in the textarea
 *
 * @param {string} templateType
 * @returns {undefined}
 */
function LoadTemplate(templateType) {
  var url = "WebIdeAjax/GetTemplateContents";
  datacx.post(url, {"templateType": templateType}).then(function(reply) {
    if (reply === null || reply.result === 0) {//has an error
      toastr.error(reply.message);
      throw "Call to " + url + " failed! Reason: " + reply.message;
    }
    //success
    toastr.success("Success");
    $("#fileContents").val(reply);
  });

}
function GetType() {
  var fileType = $("#fileType").find(":selected").attr("data-id");
  if (utils.isNullOrEmpty(fileType)) {
    throw "fileType is null or empty";
  }
  LoadTemplate(fileType);
}

(function($) {
  GetType();//on page load
  $("#fileType").change(function() {
    GetType();//on change on select #fileType
  });
})(jQuery);
