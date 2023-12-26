<select name="formal" class="appearance-none bg-[#2370f4] text-white text-sm cursor-pointer" onchange="javascript:handleSelectedOption(this)">
<option class="text-white text-sm" value="">User Options</option>
<option class="<?php echo isset($_SESSION['loginUser'])? "visible" :"hidden"; ?> "  value="userpanel">Edit Profile</option>
<option class="<?php echo isset($_SESSION['loginUser'])? "visible" :"hidden"; ?> "value="myorders">MyOrders</option>
<option class="<?php echo !isset($_SESSION['loginUser'])? "visible" :"hidden"; ?> " value="user_login">Login</option>
<option class="<?php echo isset($_SESSION['loginUser'])? "visible" :"hidden"; ?> " value="user_logout">Logout</option>
</select>

<script type="text/javascript">
  function handleSelectedOption(element)
  {
     window.location = element.value+".php";
  }
</script>