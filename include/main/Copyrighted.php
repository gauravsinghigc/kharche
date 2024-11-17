<?php
include __DIR__ . "/forms/AddExpanse.php";
include __DIR__ . "/forms/AddIncome.php";
include __DIR__ . "/forms/AddNewFillings.php";
include __DIR__ . "/forms/AddVehicleForm.php";
?>
<script>
 function Databar(data) {
  databar = document.getElementById("" + data + "");
  if (databar.style.display === "block") {
   databar.style.display = "none";
  } else {
   databar.style.display = "block";
  }
 }
</script>
<script>
 function ActivityStart() {
  var View = document.getElementById("View");
  var Close = document.getElementById("Close");
  var ViewAddButtons = document.getElementById("ViewAddButtons");

  if (View.style.display == "none") {
   Close.style.display = "none";
   ViewAddButtons.style.display = "none";
   View.style.display = "block";
  } else {
   Close.style.display = "block";
   ViewAddButtons.style.display = "block";
   View.style.display = "none";
  }
 }
</script>