(function($) {
  $("button#createFile").click(function() {
    var inputsRequired = ["fileName", "fileDesc", "fileDirPath", "fileContents"];
    var data = utils.retrieveInputs("fileCreationForm", inputsRequired);
    datacx.post($(this).attr("action"), {"form": data}).then(function(reply) {
      if (reply === null || reply.result === 0) {//has an error
        toastr.error(reply.message);
        throw "Call to " + url + " failed! Reason: " + reply.message;
      }
      //success
      toastr.success("Success");
    });
  });
})(jQuery);
