<html>
<head>
<title>Credit Card Processing Form</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
<script src="jquery.creditCardValidator.js"></script>

</head>
<body>
<script>
$(function(){
	$("#expmo").blur(function(){
		var curmonth = new Date().getMonth();
		var curyear = parseInt(new Date().getFullYear().toString().substr(2,2));
		if($(this).val()<= curmonth ){
			$("#expyr option:eq(1)").prop('disabled', true);
		} else {
			$("#expyr option:eq(1)").prop('disabled', false);
		}
	});
	$("#expyr").blur(function(){
		var curmonth = new Date().getMonth();
		var curyear = parseInt(new Date().getFullYear().toString().substr(2,2));
		for(var i = 1;i<=12;i++){
			if($("#expmo option").eq(i).val()<=curmonth &&($(this).val()== curyear)) {
				$("#expmo option").eq(i).prop('disabled', true);
			} else {
				$("#expmo option").eq(i).prop('disabled', false);
			}
		}
	});

	$('#ccinput').on('submit', function() {
		$('#cctype').prop('disabled', false);
	});
	$("#ccnum").validateCreditCard(function(result) {
		$("#cctype").val('');
		$("i").attr("style","color:gray;");
		if(result.valid==0){
			$("#ccnum").attr("pattern","\d{0}");
		}
		if(result.valid!=0){
			$("#ccnum").attr("pattern","[0-9]{15,16}");
		}
		if(result.card_type.name=='amex'){
			$("#cctype").val('AX');
			$("#icon-ax").attr("style","color:blue;");
			$("#code").attr("pattern","[0-9]{4}");
		}
		if(result.card_type.name=='discover'){
			$("#cctype").val('DS');
			$("#icon-ds").attr("style","color:blue;");
			$("#code").attr("pattern","[0-9]{3}");
		}
		if(result.card_type.name=='mastercard'){
			$("#cctype").val('MC');
			$("#icon-mc").attr("style","color:blue;");
			$("#code").attr("pattern","[0-9]{3}");
		}
		if(result.card_type.name=='visa'){
			$("#cctype").val('VS');
			$("#icon-vs").attr("style","color:blue;");
			$("#code").attr("pattern","[0-9]{3}");
		}
	});

});
</script>
<?php include('header.php'); ?>
<form name="ccinput" id="ccinput" action="confirm.php" method="post" autocomplete="off">
<fieldset><legend>Customer Information</legend>
<label for="firstname">First Name:</label><input type="text" class="text" name="firstname" id="firstname" size="35" required autofocus />
<label for="lastname">Last Name:</label><input type="text" class="text" name="lastname" id="lastname" size="35" required autofocus />
<label for="addr1">Address:</label><input type="text" class="text" name="addr1" id="addr1" size="35" required />
<label for="addr2">&nbsp;</label><input type="text" class="text" name="addr2" id="addr2" size="35" />
<label for="city">City:</label><input type="text" class="text" name="city" id="city" size="35" required />
<label for="state">State:</label>
<select name="state" form="ccinput" required>
<option disabled selected></option>
<option value="AL">Alabama</option>
<option value="AK">Alaska</option>
<option value="AZ">Arizona</option>
<option value="AR">Arkansas</option>
<option value="CA">California</option>
<option value="CO">Colorado</option>
<option value="CT">Connecticut</option>
<option value="DE">Delaware</option>
<option value="DC">District Of Columbia</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="HI">Hawaii</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="IA">Iowa</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="ME">Maine</option>
<option value="MD">Maryland</option>
<option value="MA">Massachusetts</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MS">Mississippi</option>
<option value="MO">Missouri</option>
<option value="MT">Montana</option>
<option value="NE">Nebraska</option>
<option value="NV">Nevada</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NY">New York</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="OH">Ohio</option>
<option value="OK">Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VT">Vermont</option>
<option value="VA">Virginia</option>
<option value="WA">Washington</option>
<option value="WV">West Virginia</option>
<option value="WI">Wisconsin</option>
<option value="WY">Wyoming</option>
</select>			
<label for="zip">ZIP Code:</label><input type="text" class="text" name="zip" id="zip" size="10" maxlength="5" pattern="\d{5}" required />
<label for="phone">Phone Number:</label><input type="text" class="text" name="phone" id="phone" maxlength="10" pattern="\d{10}" title="please enter a 10-digit phone number" required />
</fieldset>
<fieldset><legend>Payment Information</legend>
<label for="ccnum">Credit Card Number:</label><input type="text" class="text" name="ccnum" id="ccnum" maxlength="16" title="please enter a valid credit card number" required />
<label for="cctype">Credit Card Type:</label>
<select name="cctype" id="cctype" form="ccinput" disabled>
<option disabled selected></option>
<option value="AX">American Express</option>
<option value="DS">Discover</option>
<option value="MC">MasterCard</option>
<option value="VS">VISA</option>
</select>
<label>&nbsp;</label>
<i id="icon-ax" class="fa fa-cc-amex fa-2x" style="color:gray;"></i>
<i id="icon-ds"  class="fa fa-cc-discover fa-2x" style="color:gray;"></i>
<i id="icon-mc"  class="fa fa-cc-mastercard fa-2x" style="color:gray;"></i>
<i id="icon-vs"  class="fa fa-cc-visa fa-2x" style="color:gray;"></i>
<label for="ccname">Name as it appears on the card:</label><input type="text" class="text" name="ccname" id="ccname" size="35" maxlength="40" required />
<label for="expmo">Expiration Date:</label>
<select name="expmo" id="expmo" form="ccinput" required>
<option disabled selected></option>
<option value="01">01-Jan</option>
<option value="02">02-Feb</option>
<option value="03">03-Mar</option>
<option value="04">04-Apr</option>
<option value="05">05-May</option>
<option value="06">06-Jun</option>
<option value="07">07-Jul</option>
<option value="08">08-Aug</option>
<option value="09">09-Sep</option>
<option value="10">10-Oct</option>
<option value="11">11-Nov</option>
<option value="12">12-Dec</option>
</select>
<select name="expyr" id="expyr" form="ccinput" required>
<option disabled selected></option>
<option value="15">2015</option>
<option value="16">2016</option>
<option value="17">2017</option>
<option value="18">2018</option>
<option value="19">2019</option>
<option value="20">2020</option>
<option value="21">2021</option>
<option value="22">2022</option>
</select>
<label for="code">Security Code:</label><input type="text" class="text" name="code" id="code" size="10" maxlength="4" pattern="\d{0}" title="please enter a valid security code" required />
<label for="amount">Purchase Amount:</label><input type="text" class="text" name="amount" id="amount" size="10" pattern="\d+(\.\d{0,2})?" onblur ="this.value = Number(this.value).toFixed(2)" required />
<label for="approval">Approval Code:</label><input type="text" class="text" name="approval" id="approval" size="10" maxlength="6" pattern="[A-Za-z0-9][0-9]{5,5}" required />
</fieldset>
<div class="input">
<input type="reset" class="button" value="Clear Form" />
<input type="submit" class="button" value="Submit Payment" />
</div>
</div>
</form>
</body>
</html>