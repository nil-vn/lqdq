<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>


<p class="btn btn-primary">Congratulations! You have successfully created your Yii application.</p>
<div id="fb-root"></div>
<script>

  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '148448412008984', // App ID
    channelUrl : '/channel.html', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });
  FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
	alert("IOK");
    // the user is logged in and has authenticated your
    // app, and response.authResponse supplies
    // the user's ID, a valid access token, a signed
    // request, and the time the access token 
    // and signed request each expire
    var uid = response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
  } else if (response.status === 'not_authorized') {
    // the user is logged in to Facebook, 
    // but has not authenticated your app
  } else {
    // the user isn't logged in to Facebook.
  }
 });

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Good to see you, ' + response.name + '.');
    });
  }
</script>
<!--Below we include the Login Button social plugin. This button uses the JavaScript SDK to-->
<!--present a graphical Login button that triggers the FB.login() function when clicked.-->
<!--fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>-->