$(document).ready(function() {
    let wrapper   		= $(".input-field"); //Fields wrapper
    let add_button      = $(".add_field_button"); //Add button ID

    let x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="new-ingredient input-field"><div class="input_fields_wrap"><select name="spice_name[]" id="category"></select><input id="spice_amount" type="text" name="spice_amount[]" placeholder="Amount'+x+'"></div></div>'); //add input box

        }
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        $('div#insert p').load();

    });

    //event enter
    $("#insert_ingre").on("keypress",function(e) {
        let sum="";
        let all="";
        let wrapper = $("#insert");
        // If the user has pressed enter
        if ((e.keyCode || e.which) == 13) {
            let value = document.getElementById("insert_ingre").value;
            let validate = /[0-9]+\s+[a-zA-Z]+/;
            if(validate.test(value)) {
                $(wrapper).append('<div><p>'+value+'</p><button class="remove_field">Remove</button></div>'); //add input box
                $('div#insert p').each(function () {
                    let k = $(this).text();
                    let idx = (k.split(" ").length - 1);
                    sum += k;
                    let split = k.split(' ');
                    if(idx<3){
                        let key = split[split.length-1];
                        all += key+';';
                    }
                    else{
                        let key = split[split.length - 2] + " " + split[split.length - 1];
                        all += key+';';
                    }
                });
                document.getElementById("insert_ingre").value = "";
            }
            else{
                confirm("Wrong input! Please check your ingredient");
                $("insert_ingre").innerHTML="";
            }

        }
        $("#hid1").val(all);
        $("#hid").val(sum);

    });

    //save key to textarea


});

