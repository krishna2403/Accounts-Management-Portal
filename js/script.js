function display_emp() {
    var btn = document.getElementById("tab3-emp-show");
    if(btn.value == "Show Employee List") {
        document.getElementById("tab3-del-emp").style.display="block";
        btn.value = "Hide Employee List";
        var element = document.getElementsByClassName("tab3-display-emp-btn");
        element[0].style.paddingBottom="3em";
    }
    else {
        document.getElementById("tab3-del-emp").style.display="none";
        btn.value = "Show Employee List";
        var element = document.getElementsByClassName("tab3-display-emp-btn");
        element[0].style.paddingBottom="5em";
    }
}

function display_hod() {
    var btn = document.getElementById("tab4-hod-show");
    if(btn.innerHTML == "Show HOD List") {
        document.getElementById("tab4-hod-add").style.display="block";
        btn.innerHTML = "Hide HOD List";
        var element = document.getElementsByClassName("tab4-display-hod-btn");
        element[0].style.paddingBottom="3em";
    }
    else {
        document.getElementById("tab4-hod-add").style.display="none";
        btn.innerHTML = "Show HOD List";
        var element = document.getElementsByClassName("tab4-display-hod-btn");
        element[0].style.paddingBottom="5em";
    }
}

function hod_man(dept, sig) {
    var btn = document.getElementById(dept+'-btn');
    var form1 = document.getElementById(dept+'-id1');
    var form2 = document.getElementById(dept+'-name1');
    var id = document.getElementById(dept+'-id');
    var name = document.getElementById(dept+'-name');
    var btn2 = document.getElementById("tab4-"+dept+"-form-submit")
    if(btn.value != 'Cancel') {
        btn.value = 'Cancel';
        form1.style.display="block";
        form2.style.display="block";
        id.style.display="none";
        name.style.display="none";
        btn2.style.display="block";
    }
    else {
        if(sig == 0) {
            btn.value = 'Assign';
        }
        else {
            btn.value = 'Change';
        }
        form1.style.display="none";
        form2.style.display="none";
        id.style.display="block";
        name.style.display="block";
        btn2.style.display="none";
    }
}

function selected_id(dept) {
    var chosen = document.getElementById("select-hod-id-"+dept);
    document.getElementById(dept+"-name1").style.display="none";
    document.getElementById("evaluated-name-"+dept).style.display="block";
}

function selected_name(dept) {
    var chosen = document.getElementById("select-hod-name-"+dept);
    document.getElementById(dept+"-id1").style.display="none";
}

function submitForm(dept) {
    document.getElementById("tab4-"+dept+"-id").submit();
}

