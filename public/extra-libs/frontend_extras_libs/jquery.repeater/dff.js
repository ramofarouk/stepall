var room = 1;

function education_fields() {

    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = '<form class="row"><div class="col-sm-3"><div class="form-group"><input type="text" class="form-control" id="Schoolname" name="Schoolname" placeholder="School Name"></div></div><div class="col-sm-2"> <div class="form-group"> <input type="text" class="form-control" id="Age" name="Age" placeholder="Age"> </div></div><div class="col-sm-2"> <div class="form-group"> <input type="text" class="form-control" id="Degree" name="Degree" placeholder="Degree"> </div></div><div class="col-sm-3"> <div class="form-group"> <select class="form-control" id="educationDate" name="educationDate"> <option>Date</option> <option value="2015">2015</option> <option value="2016">2016</option> <option value="2017">2017</option> <option value="2018">2018</option> </select> </div></div><div class="col-sm-2"> <div class="form-group"> <button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');"> <i class="fa fa-minus"></i> </button> </div></div></form>';

    objTo.appendChild(divtest)
}

function remove_education_fields(rid) {
    $('.removeclass' + rid).remove();
}
//For email fields
var room_email = 1;
function email_fields() {

    room_email++;
    var objTo = document.getElementById('email_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room_email);
    var rdiv = 'removeclass' + room_email;
    divtest.innerHTML = '<div class="row"><div class="col-sm-4"><div class="form-group"><select class="form-control" id="educationDate" name="type_mail' + room_email + '" required><option value="">Type mail</option><option value="Perso">Perso</option><option value="Prof">Prof</option><option value="Autre">Autre</option></select></div></div><div class="col-sm-2"><div class="form-group"><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon22"><i class="ti-email"></i></span></div><input type="email" class="form-control" name="mail' + room_email + '" placeholder="Email" aria-label="Email" aria-describedby="basic-addon22" required></div></div></div></div>';

    objTo.appendChild(divtest)
}

function remove_email_fields() {
    if (room_email > 1) {
        $('.removeclass' + room_email).remove();
        room_email -= 1;
        clearTel();
    }
}
//For telephone fields
var room_tel = 1;
function telephone_fields() {

    room_tel++;
    var objTo = document.getElementById('telephone_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room_tel);
    var rdiv = 'removeclass' + room_tel;
    divtest.innerHTML = '<div class="row"><div class="col-sm-4"><div class="form-group"><select class="form-control" id="educationDate" name="type_tel' + room_tel + '" required><option value=""> Choisir le type de numéro</option><option value="Perso">Perso</option><option value="Prof">Prof</option><option value="Autre">Autre</option></select ></div></div><div class="col-sm-2"><div class="form-group"><input id="phone' + room_tel + '" type="tel" name ="phone' + room_tel + '" class="form-control" required></div></div></div>';
    objTo.appendChild(divtest)
    clearTel();
}

function remove_telephone_fields() {
    if(room_tel > 1){
        $('.removeclass' + room_tel).remove();
        room_tel -= 1;
        clearTel();
    }

}
//For telephone fields
var room_tel2 = 1;
function telephone3_fields() {

    room_tel2++;
    var objTo = document.getElementById('telephone3_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room_tel2);
    var rdiv = 'removeclass' + room_tel2;
    divtest.innerHTML = '<div class="row"><div class="col-sm-4"><div class="form-group"><select class="select2 form-control custom-select" name="old_tel' + room_tel2 + '" id="old_tel' + room_tel2 + '" style="width: 100%; height:36px;" required></select></div></div></div>';
    objTo.appendChild(divtest);
    clearTel2();
}

function remove_telephone3_fields() {
    if (room_tel2 > 1) {
        $('.removeclass' + room_tel2).remove();
        room_tel2 -= 1;
        clearTel2();
    }

}

var room_tel3 = 1;
function telephone2_fields() {

    room_tel3++;
    var objTo = document.getElementById('telephone2_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room_tel3);
    var rdiv = 'removeclass' + room_tel3;
    divtest.innerHTML = '<div class="row"><div class="col-sm-4"><div class="form-group"><input id="phone' + room_tel3 + '" type="tel" name ="phone' + room_tel3 + '" class="form-control" required></div></div></div>';
    objTo.appendChild(divtest);
    clearTel();
}

function remove_telephone2_fields() {
    if (room_tel3 > 1) {
        $('.removeclass' + room_tel3).remove();
        room_tel3 -= 1;
        clearTel();
    }

}


