<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></script>
<form name="catwebformform46465" method="post" onsubmit="return checkWholeForm46465(this)" enctype="multipart/form-data" action="/FormProcessv2.aspx?WebFormID=83516&OID={module_oid}&OTYPE={module_otype}&EID={module_eid}&CID={module_cid}&JSON=1" id="contact_form">
  <span class="req">*</span> Required
  <table class="webform" cellspacing="0" cellpadding="2" border="0">
  <tr>
  <td>
  <label for="Title">Title</label>
  <br />
  <select name="Title" id="Title" class="cat_dropdown_smaller">
  <option value="317601">DR</option>
  <option value="317600">MISS</option>
  <option value="317597" selected="selected">MR</option>
  <option value="317598">MRS</option>
  <option value="317599">MS</option>
  <option value="435168">sasasa</option>
  <option value="435179">sdad</option>
  <option value="435166">vbvbvb</option>
  <option value="435167">ytytyty</option>
  </select>
  </td>
  </tr>
  <tr>
  <td>
  <label for="FirstName">First Name <span class="req">*</span>
  </label>
  <br />
  <input type="text" name="FirstName" id="FirstName" class="cat_textbox" maxlength="255" /> </td>
  </tr>
  <tr>
  <td>
  <label for="LastName">Last Name <span class="req">*</span>
  </label>
  <br />
  <input type="text" name="LastName" id="LastName" class="cat_textbox" maxlength="255" /> </td>
  </tr>
  <tr>
  <td>
  <label for="EmailAddress">Email Address <span class="req">*</span>
  </label>
  <br />
  <input type="text" name="EmailAddress" id="EmailAddress" class="cat_textbox" maxlength="255" /> </td>
  </tr>
  <tr>
  <td>{module_ccsecurity}</td>
  </tr>
  <tr>
  <td>
  <input class="cat_button" type="submit" value="Submit" id="catwebformbutton" />
  </td>
  </tr>
  </table>
  <script type="text/javascript" src="/CatalystScripts/ValidationFunctions.js?vs=b1818.r472141-phase1"></script>
  <script type="text/javascript">
  //<![CDATA[
  var submitcount46465 = 0;
  
  function checkWholeForm46465(theForm) {
  var why = "";
  if (theForm.FirstName) why += isEmpty(theForm.FirstName.value, "First Name");
  if (theForm.LastName) why += isEmpty(theForm.LastName.value, "Last Name");
  if (theForm.EmailAddress) why += checkEmail(theForm.EmailAddress.value);
  if (why != "") {
  alert(why);
  return false;
  }
  if (submitcount46465 == 0) {
  submitcount46465++;
  jqsub();
  return false;
  } else {
  alert("Form submission is in progress.");
  return false;
  }
  }
  //]]>
  </script>
  </form>
<div style="display:none" id="message">Success</div>
<script type="text/javascript">
  function jqsub() {
  var $f = $('#contact_form');
  var $m = $('#message');
  $.ajax({
  type: 'POST',
  url: $f.attr('action'),
  data: $f.serialize(),
  success: function(msg) {
  var formResponse = eval(msg); // This line evaluates the JSON data and converts it to JSON object. In older version of jQuery you will have to evaluate JSON object as a string.
  if (formResponse.FormProcessV2Response.success) { 
  $m.addClass('success').fadeIn().html(formResponse.FormProcessV2Response.message); 
  $f.fadeOut(); //Hide the form
  }
  
  },
  error: function(msg) {
  alert('error'+msg);
  return false;
  }
  });
  }
  </script>