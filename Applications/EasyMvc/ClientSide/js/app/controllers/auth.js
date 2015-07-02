$(document).ready(function() {
 validator.requiredInput();//validate the inputs
 $("#btn_login").click(function() {//on button click...
  var data = utils.retrieveInputs("login-form", ["f_user_login","f_user_password"]);
  if (data.result)//if the data is valid...
   auth.login(data);//continue to login the user
 });
});
/***********
 * auth namespace 
 * Responsible to authenticate a user.
 */
(function(auth) {
 auth.login = function(data) {
  datacx.post("auth", data.inputs).then(function(reply) {//call AJAX method to call Login WebService
   if (reply === null || reply.result === 0) {//has an error
    toastr.error(reply.message);
   } else {//success
    toastr.success(reply.message);
    //Now redirect to project page
    //window.location.replace("project");
   }
  });
 };
}(window.auth = window.auth || {}));