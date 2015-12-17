(function($) {
  var fileType = $("#fileType").find(":selected").attr("data-id");
  if(utils.isNullOrEmpty(fileType)) {
    throw "fileType is null or empty";
  }
  datacx.post("WebIdeAjax/GetTemplateContents", {"fileType":fileType}).then(function(reply) {
    if (reply === null || reply.result === 0) {//has an error
      toastr.error(reply.message);
      return undefined;
    }
    //success
    toastr.success(reply.message);
  });
  }

})(jQuery);
