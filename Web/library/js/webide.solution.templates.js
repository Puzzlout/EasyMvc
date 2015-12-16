(function($) {
  var fileType = $("#fileType").find(":selected").attr("data-id");
  if(!utils.isNullOrEmpty(fileType)) {
    datacx.post("WebIdeAjax/GetTemplateContents", {"fileType":fileType}).then(function(reply) {
      if (reply === null || reply.result === 0) {//has an error
        toastr.error(reply.message);
        return undefined;
      } else {//success
        toastr.success(reply.message);
      }
    });
  }

})(jQuery);