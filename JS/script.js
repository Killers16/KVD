window.addEventListener('load', function(event) {
  let type_selector = document.getElementsByClassName("product_type_selector")[0];
  type_selector.addEventListener("change", function(event) {
      let option = this.options[this.selectedIndex];
              console.log(option);
              console.log(this.selectedIndex);
              if(this.selectedIndex == 1){document.getElementById("one").style.display = "block";
          } else {
              document.getElementById("one").style.display = "none";
          }
          if(this.selectedIndex == 2){document.getElementById("two").style.display = "block";
          } else {
              document.getElementById("two").style.display = "none";
          }
          if(this.selectedIndex == 3){document.getElementById("three").style.display = "block";
          } else {
              document.getElementById("three").style.display = "none";
          }
          
  });
  
})
function TextValidation_sku() {
  let validation_text_sku = document.getElementById("sku").value;
  let text;
  if (validation_text_sku == "") {
    text = "  Nothing is entered in SKU &#10060;";
  } else {
    text = " Text input was made";
  }
  document.getElementById("output_sku").innerHTML = text;
}
function TextValidation_name() {
  let validation_text_name = document.getElementById("name").value;
  let text1;
  if (validation_text_name == "") {
    text1 = "  Nothing is entered in Name &#10060;";
  } else {
    text1 = " Text input was made";
  }
  document.getElementById("output_name").innerHTML = text1;
}
function TextValidation_price() {
  let validation_text_price = document.getElementById("price").value;
  let text2;
  if (validation_text_price == "") {
    text2 = "  Nothing is entered in Price&#10060;";
  } else {
    text2 = " Text input was made";
  }
  document.getElementById("output_price").innerHTML = text2;
}
